<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	require APPPATH . '/libraries/REST_Controller.php';
	use Restserver\Libraries\REST_Controller;
	
	require_once APPPATH . '/libraries/BeforeValidException.php';
	require_once APPPATH . '/libraries/ExpiredException.php';
	require_once APPPATH . '/libraries/SignatureInvalidException.php';
	require_once APPPATH . '/libraries/JWT.php';
	
	use \Firebase\JWT\JWT;
	
	class User extends REST_Controller {

		function __construct()
		{
			// Construct the parent class
			parent::__construct();
			
			$this->load->model('userdata');

			// Configure limits on our controller methods
			// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
			$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
			$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
			$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
		}
		
		// register user
		public function register_post(){
			$username = $this->post('username');
			$email = $this->post('email');
			$password = $this->post('password');
			
			// check for existense
			$user_data = $this->userdata->grab_user_details(array("username" => $username));
			if(!empty($user_data)){
				$error_msg[] = "Username already exists";
			}
			
			$user_data = $this->userdata->grab_user_details(array("email" => $email));
			if(!empty($user_data)){
				$error_msg[] = "Email already exists";
			}
			
			if(empty($error_msg)){
				$post_arr = array(
					"username" => $username,
					"email" => $email,
					"password" => $this->defaultdata->getSha256Base64Hash($password),
					"original_password" => $password,
					"is_active" => 1,
					"date_added" => time()			
				);
				
				$last_insert_id = $this->userdata->insert_user($post_arr);
				if($last_insert_id){
					
					// send mail to user
					
					// Ends
					
					$token['id'] = $last_insert_id;
					$token['username'] = $username;
					$date = time();
					$token['iat'] = $date;
					$token['exp'] = $date + 60*60;
					$super_secret = $this->config->item('encryption_key');
					
					$token = JWT::encode($token, $super_secret);
				
					$response = array(
						"status" => true,
						"message" => "You have been successfully registered",
						"data" => array(
							"username" => $this->post('username'),
							"email" => $this->post('email'),
							"user_discount" => 0,
							"token" => $token
						)
					);
					$this->set_response($response, REST_Controller::HTTP_OK);
				}
			}else{
				$response = array(
						"status" => false,
						"message" => $error_msg
					);
				$this->set_response($response, REST_Controller::HTTP_OK);
			}
		}
		
		// login functionality
		public function login_post(){
			$username = $this->post('username');
			$password = $this->post('password');
			
			if($this->defaultdata->checkEmailFormat($username)){
				$cond['email'] = $username;
				$cond['original_password'] = $password;
				$error_msg = 'Improper email/password';
			}else{
				$cond['username'] = $username;
				$cond['original_password'] = $password;
				$error_msg = 'Improper username/password';
			}
			
			// check for existense
			$user_data = $this->userdata->grab_user_details($cond);
			if(!empty($user_data)){
				$token['id'] = $user_data[0]->user_id;
				$token['username'] = $username;
				$date = time();
				$token['iat'] = $date;
				$token['exp'] = $date + 60*60;
				$super_secret = $this->config->item('encryption_key');
				
				$token = JWT::encode($token, $super_secret);
			
				$response = array(
					"status" => true,
					"message" => "You have been successfully authenticated",
					"data" => array(
						"username" => $this->post('username'),
						"email" => $this->post('email'),
						"user_discount" => 0,
						"token" => $token
					)
				);
				$this->set_response($response, REST_Controller::HTTP_OK);
			}else{
				$response = array(
					"status" => false,
					"message" => $error_msg
				);
				$this->set_response($response, REST_Controller::HTTP_OK);
			}
		}
		
		// password recovery
		public function forget_post(){
			$email = $this->post('email');
			
			// check for email existense
			$user_data = $this->userdata->grab_user_details(array("email" => $email));
			if(!empty($user_data)){
				$password = $this->defaultdata->getGeneratedPassword(8);
				$this->userdata->update_user_details(array("email" => $email), array("password" => $this->defaultdata->getSha256Base64Hash($password), "original_password" => $password));
				
				// Send mail to user for password recovery
				$general_settings = $this->defaultdata->grabSettingData();
				$admin_data = $this->userdata->grab_user_details(array("role" => '0'));
				
				$this->data['site_title'] = preg_replace("(^https?://)", "",$general_settings->siteaddress);
				$this->data['site_logo'] = UPLOAD_LOGO_PATH.$general_settings->logoname;
				$this->data['site_url'] = $general_settings->siteaddress;
				$this->data['user_name'] = $user_data[0]->username;
				$this->data['email_address'] = $user_data[0]->email;
				$this->data['password'] = $password;
				
				$message = $this->load->view('email_template/forget', $this->data, true);
				$mail_config = array(
					"from" => $email,
					"to" => array($admin_data[0]->email),
					"subject" => $general_settings->sitename.": Password Recovery",
					"message" => $message
				);
				
				$this->defaultdata->_send_mail($mail_config);
				// Ends	
				
				$response = array(
					"status" => true,
					"message" => "Password has been reset. New Password has been generated. An email has been sent to the given email address to get the login details"
				);
				$this->set_response($response, REST_Controller::HTTP_OK);
			}else{
				$response = array(
					"status" => false,
					"message" => "The given email address does not exists"
				);
				$this->set_response($response, REST_Controller::HTTP_OK);
			}
		}
		
		// fetch all users details
		public function users_get(){
			$token = ($this->post('token')) ?  $this->post('token') : (($this->get('token')) ? $this->get('token') : $this->input->request_headers()['x-access-token']);
			
			if($token){
				$key = $this->config->item('encryption_key');
				try{
					$decoded = JWT::decode($token, $key, array('HS256'));
					
					$user_list = $this->userdata->grab_user_details(array("is_active" => '1', "role" => '1'));
					if(!empty($user_list)){					
						foreach($user_list AS $key => $user){
							$user_data[$key]['username'] = $user->username;
							$user_data[$key]['email'] = $user->email;
							$user_data[$key]['user_discount'] = $user->user_discount;
						}
						$response = array(
							"status" => true,
							"message" => "Users fetched succesfully",
							"data" => $user_data
						);
					}else{
						$response = array(
							"status" => false,
							"message" => "User not found"
						);
					}
					$this->set_response($response, REST_Controller::HTTP_OK);
				}catch(\Exception $e){					
					$response = array(
						"status" => false,
						"message" => $e->getMessage()
					);
					$this->set_response($response, REST_Controller::HTTP_OK);
				}
			}else{
				$this->set_response(array("status" => false, "message" => "Token not found"), REST_Controller::HTTP_OK);
			}
		}
		
		// fetch specific user details
		public function user_get(){
			$token = ($this->post('token')) ?  $this->post('token') : (($this->get('token')) ? $this->get('token') : $this->input->request_headers()['x-access-token']);
			
			if($token){
				$key = $this->config->item('encryption_key');
				try{
					$decoded = JWT::decode($token, $key, array('HS256'));
					
					$user_list = $this->userdata->grab_user_details(array("username" => $decoded->username));
					if(!empty($user_list)){					
						foreach($user_list AS $key => $user){
							$user_data['username'] = $user->username;
							$user_data['email'] = $user->email;
							$user_data['user_discount'] = $user->user_discount;
						}
						$response = array(
							"status" => true,
							"message" => "User fetched succesfully",
							"data" => $user_data
						);
					}else{
						$response = array(
							"status" => false,
							"message" => "User not found"
						);
					}
					$this->set_response($response, REST_Controller::HTTP_OK);
				}catch(\Exception $e){					
					$response = array(
						"status" => false,
						"message" => $e->getMessage()
					);
					$this->set_response($response, REST_Controller::HTTP_OK);
				}
			}else{
				$this->set_response(array("status" => false, "message" => "Token not found"), REST_Controller::HTTP_OK);
			}
		}
	}
?>
