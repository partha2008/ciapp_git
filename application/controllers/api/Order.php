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
			$this->load->model('userdata');

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
								$this->post_order_payment($order_id);
								
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
		
		// send mails after order payment
		public function post_order_payment($order_id){
			/* This section includes send emails to admin, payee & others & creating xml & zip file in server "upload" folder. Later zip file file will be removed from "upload" folder & will be sent to other server via ftp functionality in PHP */
			
			$general_settings = $this->defaultdata->grabSettingData();
			$admin_data = $this->userdata->grab_user_details(array("role" => '0'));
			
			$data['site_title'] = preg_replace("(^https?://)", "",$general_settings->siteaddress);
			$data['site_logo'] = UPLOAD_LOGO_PATH.$general_settings->logoname;
			$data['site_url'] = $general_settings->siteaddress;
			
			$order_data = $this->orderdata->get_order(array("order_id" => $order_id));
			$user_data = $this->userdata->grab_user_details(array("user_id" => $order_data->user_id));
			$mailing_dates_data = $this->orderdata->grab_mailing_dates(array("order_id" => $order_id));
			$uploaded_files_data = $this->orderdata->grab_uploaded_files(array("order_id" => $order_id));
			
			$logo = '';
			$mailinglist = '';
			$letter = '';
			$signature = '';
			$other_files = '';
			
			if(!empty($uploaded_files_data)){
				foreach($uploaded_files_data AS $key => $val){
					
					if($val->filename == 'logo'){
						$logo = $val->filepath;
					}					
					if($val->filename == 'mailing_list'){
						$mailinglist = $val->filepath;
					}					
					if($val->filename == 'letter'){
						$letter = $val->filepath;
					}
					if($val->filename == 'signature'){
						$signature = $val->filepath;
					}					
					if($val->filename == 'otherfiles'){
						$other_files = $val->filepath;
					}
				}
				
			}
			
			if($order_data->status){
				$error_msg = '';
			}else{
				$error_msg = '<div style="font-family: Lucida Grande,Lucida Sans,Lucida Sans Unicode,Arial,Helvetica,Verdana,sans-serif; font-size: 14px; line-height: 2em; color: #C0392B; text-align:center;font-weight:700;">This order has been declined ( '.$order_data->transaction_return_text.' )</div>';
			}
			
			$data['error_msg'] = $error_msg;
			
			// First Section
			$data['order_id'] = $order_data->orderid;
			$data['sender_email'] = $user_data[0]->email;
			$data['postal_addr'] = $order_data->billingAddress;
			$data['phone_num'] = $order_data->phone_num;
			$data['cell_num'] = $order_data->cell_num;
			
			// Order Details
			$mailing_dates = '';
			$mailing_list = '';
			$sec_mailing_list = '';
			$item_orders = '';
			$sub_total = 0;
			
			if(!empty($mailing_dates_data)){
				foreach($mailing_dates_data AS $key => $date){
					$mailer_cnt = str_replace('mailer', '', $date->mailer);		
					$mailing_dates .= '<tr><td style="color: #353535;">Mailer #'.$mailer_cnt.'</td><td style="color: #999999;">'.$date->item.'</td><td style="color: #999999;">'.$date->quantity.'</td><td style="color: #999999;">'.$date->type.'</td><td style="color: #999999;">'.$date->paper.'</td><td style="color: #999999;">'.$date->ink.'</td><td style="color: #999999;">'.$date->envelope.'</td><td style="color: #999999;">'.$date->postage.'</td><td style="color: #999999;">'.$date->per.'</td><td style="color: #999999;">$'.number_format($date->total, 2).'</td><td style="color: #999999;">'.date("m-d-Y", $date->date).'</td></tr>';
					
					$mailing_list .= '<tr><td style="color: #353535;width:30%;">Mailer #'.$mailer_cnt.': '.$date->type.'</td><td style="color: #999999;width:70%;">'.date("m-d-Y", $date->date).'</td></tr>';
					
					$sec_mailing_list .= 'Mailer #'.$mailer_cnt.': '.date('m-d-Y', $date->date).'<br>';
					
					$item_orders .= 'Item Description: Mailer #'.$mailer_cnt.': '.$date->item.'<br>Item Quantity: '.$date->quantity.'<br>Item Price: $'.$date->total.'<br><br>';
					
					$sub_total = $sub_total+$date->total;
				}
			}
			$item_orders .= 'Item Discount: $'.number_format(($sub_total - $order_data->grand_total), 2).'<br><br>';
			$item_orders .= 'Item Net: $'.number_format($order_data->grand_total, 2);
	
			$data['order_details'] = $mailing_dates;
			
			// Product Description
			$data['sub_total'] = number_format($sub_total, 2);
			$data['discount'] = number_format(($sub_total - $order_data->grand_total), 2);
			$data['grand_total'] = '$'.number_format($order_data->grand_total, 2);
			
			// Imprint
			$data['first_name'] = $order_data->first_name;
			$data['last_name'] = $order_data->last_name;
			$data['comp_name'] = $order_data->comp_name;
			$data['website'] = $order_data->website;
			$data['email'] = $order_data->email;
			$data['tel_num'] = $order_data->tel_num;
			$data['instruct'] = $order_data->instruct;
			$data['return_addr'] = $order_data->return_addr;
			
			// Mailing Dates
			$data['mailing_date'] = $mailing_list;
			
			// Text & Images
			$data['logo'] = $logo;
			$data['mailing_list'] = $mailinglist;
			$data['letter'] = $letter;
			$data['signature'] = $signature;
			$data['other_files'] = $other_files;
			
			$message = $this->load->view('email_template/order', $data, true);
			
			// send mail to user
			$mail_config_user = array(
				"from" => $admin_data[0]->email,
				"to" => array($user_data[0]->email),
				"subject" => $general_settings->sitename.": Letter and Postcard Mailing Services Order Receipt",
				"message" => $message
			);			
			$this->defaultdata->_send_mail($mail_config_user);
			
			// send mail to admin
			$mail_config_admin = array(
				"from" => $admin_data[0]->email,
				"to" => array($admin_data[0]->email),
				"cc" => array("swagata@nettrackers.net"),
				"subject" => $general_settings->sitename.": Letter and Postcard Mailing Services Order Receipt",
				"message" => $message
			);			
			$this->defaultdata->_send_mail($mail_config_admin);
			
			// send text mail to admin
			$txt_msg = '';	
			$txt_msg .='
				CUSTOMER INFORMATION
				<br>
				---------------------------------------
				<br>
				Customer Name: '.$order_data->firstName . ' ' . $order_data->lastName.'<br>
				Contact Phone: '.$order_data->phone_num.'<br><br>		

				SHIPPING INFORMATION
				<br>
				---------------------------------------
				<br>
				Name: '.$order_data->first_name.' '.$order_data->last_name.'<br>
				Company: '.$order_data->comp_name.'<br>
				Email: '.$order_data->email.'<br>
				Phone: '.$order_data->tel_num.'<br>
				Website: '.$order_data->website.'<br>
				Special Instructions: '.$order_data->instruct.'<br>
				Return Address: '.$order_data->return_addr.'<br><br>

				MAILER DATE INFORMATION
				<br>
				--------------------------------------
				<br>
				'.$sec_mailing_list.'
				<br>
				ITEMS ORDERED
				<br>
				---------------------------------------
				<br>
				'.$item_orders.'
				<br><br>
				IMPRINT DETAILS
				<br>
				---------------------------------------
				<br>
				Name: '.$order_data->first_name.' '.$order_data->last_name.'<br>
				Company: '.$order_data->comp_name.'<br>
				Email: '.$order_data->email.'<br>
				Phone: '.$order_data->tel_num.'<br>
				Website: '.$order_data->website.'<br>
				Special Instructions: '.$order_data->instruct. '<br>
				Return Address: '.$order_data->return_addr. '<br>
			';
			
			$txt_mail_config_admin = array(
				"from" => $admin_data[0]->email,
				"to" => array($admin_data[0]->email),
				"subject" => $general_settings->sitename.": Letter and Postcard Mailing Services Order Receipt",
				"message" => $txt_msg
			);			
			$this->defaultdata->_send_mail($txt_mail_config_admin);
		}
	}
?>

