<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	require APPPATH . '/libraries/REST_Controller.php';
	use Restserver\Libraries\REST_Controller;
	
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
					$token = JWT::encode($token, $this->defaultdata->generatedRandString(10));
				
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
				$super_secret = $this->defaultdata->generatedRandString(20);
				
				// delete cookie
				$cookie = array(
					'name'   => 'secret_key',
					'value'  => '',
					'expire' => '0',
					'prefix' => 'reww_'
				);
				delete_cookie($cookie);
					
				// set cookie
				$cookie = array(
					'name'   => 'secret_key',
					'value'  => $super_secret,
					'expire' => time()+3600,
					'prefix' => 'reww_',
				);
				set_cookie($cookie);
				
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
			}else{
				$response = array(
					"status" => false,
					"message" => $error_msg
				);
				$this->set_response($response, REST_Controller::HTTP_OK);
			}
		}
		
		public function forget_post(){
			$email = $this->post('email');
			
			// check for email existense
			$user_data = $this->userdata->grab_user_details(array("email" => $email));
			if(!empty($user_data)){
				$password = $this->defaultdata->getGeneratedPassword(8);
				$this->userdata->update_user_details(array("email" => $email), array("password" => $this->defaultdata->getSha256Base64Hash($password), "original_password" => $password));
				
				// Send mail to user for password recovery
				
				// Ends				
				$response = array(
					"status" => false,
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
		
		public function users_get(){
			$token = ($this->post('token')) ?  $this->post('token') : (($this->get('token')) ? $this->get('token') : $this->input->request_headers()['x-access-token']);
			
			if($token){
				$key = get_cookie('reww_secret_key');
				try{
					$decoded = JWT::decode($token, $key, array('HS256'));
				}catch(\Exception $e){
					print "Error!: " . $e->getMessage();
					die();
				}
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
			}else{
				$this->set_response(array("status" => false, "message" => "Token not found"), REST_Controller::HTTP_OK);
			}
		}

		/*public function users_get()
		{
			// Users from a data store e.g. database
			$users = [
				['id' => 1, 'name' => 'John', 'email' => 'john@example.com', 'fact' => 'Loves coding'],
				['id' => 2, 'name' => 'Jim', 'email' => 'jim@example.com', 'fact' => 'Developed on CodeIgniter'],
				['id' => 3, 'name' => 'Jane', 'email' => 'jane@example.com', 'fact' => 'Lives in the USA', ['hobbies' => ['guitar', 'cycling']]],
			];

			$id = $this->get('id');

			// If the id parameter doesn't exist return all the users

			if ($id === NULL)
			{
				// Check if the users data store contains users (in case the database result returns NULL)
				if ($users)
				{
					// Set the response and exit
					$this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
				}
				else
				{
					// Set the response and exit
					$this->response([
						'status' => FALSE,
						'message' => 'No users were found'
					], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
				}
			}

			// Find and return a single record for a particular user.
			else {
				$id = (int) $id;

				// Validate the id.
				if ($id <= 0)
				{
					// Invalid id, set the response and exit.
					$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
				}

				// Get the user from the array, using the id as key for retrieval.
				// Usually a model is to be used for this.

				$user = NULL;

				if (!empty($users))
				{
					foreach ($users as $key => $value)
					{
						if (isset($value['id']) && $value['id'] === $id)
						{
							$user = $value;
						}
					}
				}

				if (!empty($user))
				{
					$this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
				}
				else
				{
					$this->set_response([
						'status' => FALSE,
						'message' => 'User could not be found'
					], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
				}
			}
		}*/

		public function users_post()
		{
			// $this->some_model->update_user( ... );
			$message = [
				'id' => 100, // Automatically generated by the model
				'name' => $this->post('name'),
				'email' => $this->post('email'),
				'message' => 'Added a resource'
			];

			$this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
		}

		public function users_delete()
		{
			$id = (int) $this->get('id');

			// Validate the id.
			if ($id <= 0)
			{
				// Set the response and exit
				$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
			}

			// $this->some_model->delete_something($id);
			$message = [
				'id' => $id,
				'message' => 'Deleted the resource'
			];

			$this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
		}

	}
?>
