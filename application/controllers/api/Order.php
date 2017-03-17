<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	require APPPATH . '/libraries/REST_Controller.php';
	use Restserver\Libraries\REST_Controller;
	
	require_once APPPATH . '/libraries/BeforeValidException.php';
	require_once APPPATH . '/libraries/ExpiredException.php';
	require_once APPPATH . '/libraries/SignatureInvalidException.php';
	require_once APPPATH . '/libraries/JWT.php';
	
	use \Firebase\JWT\JWT;
	
	class Order extends REST_Controller {

		function __construct()
		{
			// Construct the parent class
			parent::__construct();
			
			$this->load->model('orderdata');

			// Configure limits on our controller methods
			// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
			$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
			$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
			$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
		}
		
		// fetch all orders for a specific user
		public function orders_get(){
			$token = ($this->post('token')) ?  $this->post('token') : (($this->get('token')) ? $this->get('token') : $this->input->request_headers()['x-access-token']);
			
			if($token){
				$key = $this->config->item('encryption_key');
				try{
					$decoded = JWT::decode($token, $key, array('HS256'));
					
					$order_list = $this->orderdata->grab_total_order(array("status" => '1', "user_id" => $decoded->id));
					if(!empty($order_list)){					
						foreach($order_list AS $key => $order){
							$order_data[$key]['mailing_date_id'] = $order->mailing_date_id;
							$order_data[$key]['order_id'] = $order->order_id;
							$order_data[$key]['item'] = $order->item;
							$order_data[$key]['quantity'] = $order->quantity;
							$order_data[$key]['proof_pdf'] = $order->proof_pdf;
							$order_data[$key]['proofapproved_date'] =  ($order->proofapproved_date) ? date("m-d-Y", $order->proofapproved_date) : '';
							$order_data[$key]['proofsent_date'] =  ($order->proofsent_date) ? date("m-d-Y", $order->proofsent_date) : '';
							$order_data[$key]['total'] = $order->total;
							$order_data[$key]['desired_mail_date'] = date("m-d-Y", $order->date);
							$order_data[$key]['status'] = $this->config->item('mailing_dates_status')[$order->status];
							$order_data[$key]['order_created_date'] = date("m-d-Y", $order->date_added);
						}
						$response = array(
							"status" => true,
							"message" => "Orders fetched succesfully",
							"data" => $order_data
						);
					}else{
						$response = array(
							"status" => false,
							"message" => "Order not found"
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
		
		// fetch details for a order
		public function order_get(){
			$token = ($this->post('token')) ?  $this->post('token') : (($this->get('token')) ? $this->get('token') : $this->input->request_headers()['x-access-token']);
			
			if($token){
				$key = $this->config->item('encryption_key');
				try{
					$decoded = JWT::decode($token, $key, array('HS256'));
					
					$mailing_date_id = $this->get('mailing_date_id');
					
					$order = $this->orderdata->get_order_details_by_item(array("mailing_date_id" => $mailing_date_id));
					
					if(!empty($order)){	
						
						// making order
						$orders['mailer'] = $order[0]->mailer;
						$orders['quantity'] = $order[0]->quantity;
						$orders['type'] = $order[0]->type;
						$orders['item'] = $order[0]->item;
						$orders['paper'] = $order[0]->paper;
						$orders['ink'] = $order[0]->ink;
						$orders['envelope'] = $order[0]->envelope;
						$orders['postage'] = $order[0]->postage;
						$orders['per'] = $order[0]->per;
						$orders['total'] = $order[0]->total;
						$orders['proof_pdf'] = $order[0]->proof_pdf;
						$orders['date'] = ($order[0]->date) ? $order[0]->date : '';
						$orders['order_created_date'] = ($order[0]->date) ? $order[0]->date : '';
						
						// making mailing dates
						$imprint['fullname'] = $order[0]->firstName.' '.$order[0]->lastName;
						$imprint['comp_name'] = $order[0]->comp_name;
						$imprint['website'] = $order[0]->website;
						$imprint['email'] = $order[0]->email;
						$imprint['tel_num'] = $order[0]->tel_num;
						$imprint['instruct'] = $order[0]->instruct;
						$imprint['return_addr'] = $order[0]->return_addr;
						
						$payment['fullname'] = $order[0]->first_name.' '.$order[0]->last_name;
						$payment['billingAddress'] = $order[0]->billingAddress;
						$payment['billing_city'] = $order[0]->billing_city;
						$payment['billing_state'] = $order[0]->billing_state;
						$payment['zip'] = $order[0]->zip;
						$payment['phone_num'] = $order[0]->phone_num;
						$payment['cell_num'] = $order[0]->cell_num;
						$payment['card_no'] = $order[0]->card_no;
						$payment['expire'] = $order[0]->month.'/'.$order[0]->year;
						
						// making uploaded files
						foreach($order AS $key => $ord){
							$files = array();
							$files['filename'] = $ord->filename;
							$files['filepath'] = $ord->filepath;
							
							$uploaded_files[] = $files;
						}
						
						$final_arr['imprint'] = $imprint;
						$final_arr['payment'] = $payment;
						$final_arr['order'] = $orders;
						$final_arr['uploadedFiles'] = $uploaded_files;
						
						$response = array(
							"status" => true,
							"message" => "Orders fetched succesfully",
							"data" => $final_arr
						);
						$this->set_response($response, REST_Controller::HTTP_OK);
					}					
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
		
		// make order payment
		public function order_post(){
			$token = ($this->post('token')) ?  $this->post('token') : (($this->get('token')) ? $this->get('token') : $this->input->request_headers()['x-access-token']);
			
			if($token){
				$key = $this->config->item('encryption_key');
				try{
					$decoded = JWT::decode($token, $key, array('HS256'));
					
					$post_data = $this->input->post();
					unset($post_data['token']);
					
					$uploaded_files = $post_data['uploadedFiles'];
					unset($post_data['uploadedFiles']);
					
					$mailing_dates = $post_data['mailingDates'];
					unset($post_data['mailingDates']);
					
					// save log
					$log = $post_data['log'];
					unset($post_data['log']);
					$log_data['data'] = $log;
					$log_data['date_added'] = time();
					
					if($this->orderdata->insert_log($log_data)){
						$post_data['email'] = ($post_data['email'] == 'null') ? '' : $post_data['email'];
						$post_data['user_id'] = $decoded->id;
						$post_data['date_added'] = time();
						
						// save order	
						$order_id = $this->orderdata->insert_order($post_data);
						if($order_id){
							// save mailing dates
							$mailing_dates_arr = json_decode($mailing_dates);
							if(!empty($mailing_dates_arr)){
								$cnt = 1;
								foreach($mailing_dates_arr AS $date){
									$date = (array)$date;
									$dt_arr = explode("-", $date['date']);
									$date['date'] = strtotime($dt_arr[2].'-'.$dt_arr[0].'-'.$dt_arr[1]);
									$date['order_id'] = $order_id;
									$date['mailer'] = 'mailer'.$cnt;
									
									unset($date['$$hashKey']);					
									
									$this->orderdata->insert_mailing_dates($date);
									
									$cnt++;
								}								
								
								// save uploaded files
								$uploaded_files_arr = json_decode($uploaded_files);
								
								if(!empty($uploaded_files_arr[0])){
									foreach($uploaded_files_arr AS $file){
										foreach($file as $key => $value){
											$file_data['filename'] = $key;
											$file_data['filepath'] = $value;
											$file_data['order_id'] = $order_id;
											
											$this->orderdata->insert_uploaded_files($file_data);
										}
									}
								}									
								$this->post_order_payment();
								
								$this->set_response(array("status" => true, "message" => "Order made successfully"), REST_Controller::HTTP_OK);
								
							}
						}
					}
										
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
		
		public function post_order_payment(){
			/* This section includes send emails to admin, payee & others & creating xml & zip file in server "upload" folder. Later zip file file will be removed from "upload" folder & will be sent to other server via ftp functionality in PHP */
				
			// create 
		}
		
		// send mails after order payment
		public function post_order_mail_post(){
			// call function to send mail after order payment
			$this->defaultdata->_send_mail();
			// ends
		}
	}
?>

