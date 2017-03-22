<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Order extends CI_Controller {
		
		public $data = array();
		public $loggedin_method_arr = array('order-list', 'failed-order-list', 'order-edit');
		
		public function __construct(){
			parent::__construct();
			
			$this->load->model('orderdata');
			$this->load->model('userdata');
			
			$this->data = $this->defaultdata->getBackendDefaultData();
			
			if(in_array($this->data['tot_segments'][2], $this->loggedin_method_arr))
			{
				if($this->defaultdata->is_session_active() == 0)
				{
					redirect(base_url('admin'));
				}
			}
		}
		
		public function order_list()
		{
			$like = array();
			parse_str($_SERVER['QUERY_STRING'], $like);
			unset($like['page']);
			
			$search_key = $this->input->get('searchname');
			if(isset($search_key) && $search_key){
				$this->data['search_key'] = $search_key;
			}else{
				$this->data['search_key'] = '';
			}
			
			$cond["status"] = '1';
			$order_data = $this->orderdata->grab_total_order($cond, array(), $like); 
			
			//pagination settings
			$config['base_url'] = site_url('admin/order-list');
			$config['total_rows'] = count($order_data);
			
			$pagination = $this->config->item('pagination');
			
			$pagination = array_merge($config, $pagination);

			$this->pagination->initialize($pagination);
			$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		

			$this->data['pagination'] = $this->pagination->create_links();
			
			$order_paginated_data = $this->orderdata->grab_order($cond, array(PAGINATION_PER_PAGE, $this->data['page']), $like);
			
			$this->data['order_list'] = $order_paginated_data;
			$this->data['title'] = 'List of Successful Orders';
			$this->data['redirect'] = 'order-list';
			
			$this->load->view('admin/order_list', $this->data);
		}		
		
		public function failed_order_list()
		{
			$like = array();
			parse_str($_SERVER['QUERY_STRING'], $like);
			unset($like['page']);
			
			$search_key = $this->input->get('searchname');
			if(isset($search_key) && $search_key){
				$this->data['search_key'] = $search_key;
			}else{
				$this->data['search_key'] = '';
			}
			
			$cond["status"] = '0';
			$order_data = $this->orderdata->grab_total_order($cond, array(), $like); 
			
			//pagination settings
			$config['base_url'] = site_url('admin/failed-order-list');
			$config['total_rows'] = count($order_data);
			
			$pagination = $this->config->item('pagination');
			
			$pagination = array_merge($config, $pagination);

			$this->pagination->initialize($pagination);
			$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		

			$this->data['pagination'] = $this->pagination->create_links();
			
			$order_paginated_data = $this->orderdata->grab_order($cond, array(PAGINATION_PER_PAGE, $this->data['page']), $like);
			
			$this->data['order_list'] = $order_paginated_data;
			$this->data['title'] = 'List of Unsuccessful Orders';
			$this->data['redirect'] = 'failed-order-list';
			
			$this->load->view('admin/order_list', $this->data);
		}
		
		public function order_edit($mailing_date_id){			
			$cond['mailing_date_id'] = $mailing_date_id;
			$order_details = $this->orderdata->get_order_details_by_item($cond);
			$this->data['order_details'] = $order_details[0];
			
			if(!empty($order_details)){
				foreach($order_details AS $order){
					$uploaded_files[$order->filename] = $order->filepath;
				}
			}
			$this->data['uploaded_files'] = $uploaded_files;
			
			$month_arr = $this->config->item('month');
			$this->data['month_arr'] = $month_arr;
			
			$year_arr = array();
			$cur_year = date('Y');
			for ($i=0; $i<=13; $i++) {
				$year_arr[] = $cur_year++;
			}
			$this->data['year_arr'] = $year_arr;
			
			$this->load->view('admin/order_edit', $this->data); 
		}
		
		public function checkFileExtension(){
			if($_FILES['item_proof_pdf']['error'] == 0){
				$ext = pathinfo($_FILES['item_proof_pdf']['name'], PATHINFO_EXTENSION);
				if($ext != 'pdf' && $ext != 'PDF'){
					$this->form_validation->set_message('checkFileExtension', 'Invalid file extension. Only PDF file is allowed');
					return false;
				}else{					
					return true;
				}					
			}
		}
		
		public function edit_order(){
			
			$post_data = $this->input->post();
			/*echo "<pre>";
			print_r($post_data);
			die();*/
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('item_proof_pdf', 'Proof PDF', 'callback_checkFileExtension');			
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('orderedit_notification', validation_errors());
				
				redirect($this->agent->referrer());
			}else{
				$cond['order_id'] = $post_data['order_id'];
				$mail_cond['mailing_date_id'] = $post_data['mailing_date_id'];
				$order_status = $post_data['order_status'];
				
				unset($post_data['order_id']);
				unset($post_data['mailing_date_id']);

				if(!empty($post_data)){
					foreach($post_data AS $key => $data){
						if (strpos($key, 'orders_') !== false) { // check order value						
							$index = substr($key, 7);
							if($index == 'date'){
								$index = 'date_added';
								$dt_arr = explode('-', $data);
								$data = strtotime($dt_arr[2].'-'.$dt_arr[0].'-'.$dt_arr[1]);
							}
							$order_data[$index] = $data;
						}
						if (strpos($key, 'item_') !== false) { // check mailing_dates value
							$index = substr($key, 5);
							if($index == 'date' || $index == 'proofsent_date' || $index == 'proofapproved_date'){
								$dt_arr = explode('-', $data);
								$data = strtotime($dt_arr[2].'-'.$dt_arr[0].'-'.$dt_arr[1]);
							}
							$mailing_dates_data[$index] = $data;
						}						
					}
					$this->orderdata->update_order($cond, $order_data);
					
					$file_name = $this->defaultdata->generatedRandString().'.pdf';					
					if(move_uploaded_file($_FILES['item_proof_pdf']['tmp_name'], UPLOAD_RELATIVE_ORDER_PATH.$file_name)){
						$mailing_dates_data['proof_pdf'] = $file_name;
					}					
					$this->orderdata->update_mailing_dates($mail_cond, $mailing_dates_data);
				}
				if($order_status){
					redirect(base_url('admin/order-list'));
				}else{
					redirect(base_url('admin/failed-order-list'));
				}				
			}
		}
		
		public function order_delete($order_id){			
			$cond['order_id'] = $order_id;
			
			if($this->orderdata->delete_order($cond)){
				redirect($this->agent->referrer());		
			}
		}
		
		public function resend_mail_to_user($order_id){
			
			$general_settings = $this->data['general_settings'];
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
			$sub_total = 0;
			if(!empty($mailing_dates_data)){
				foreach($mailing_dates_data AS $key => $date){
					$mailer_cnt = str_replace('mailer', '', $date->mailer);		
					$mailing_dates .= '<tr><td style="color: #353535;">Mailer #'.$mailer_cnt.'</td><td style="color: #999999;">'.$date->item.'</td><td style="color: #999999;">'.$date->quantity.'</td><td style="color: #999999;">'.$date->type.'</td><td style="color: #999999;">'.$date->paper.'</td><td style="color: #999999;">'.$date->ink.'</td><td style="color: #999999;">'.$date->envelope.'</td><td style="color: #999999;">'.$date->postage.'</td><td style="color: #999999;">'.$date->per.'</td><td style="color: #999999;">$'.number_format($date->total, 2).'</td><td style="color: #999999;">'.date("m-d-Y", $date->date).'</td></tr>';
					
					$mailing_list .= '<tr><td style="color: #353535;width:30%;">Mailer #'.$mailer_cnt.': '.$date->type.'</td><td style="color: #999999;width:70%;">'.date("m-d-Y", $date->date).'</td></tr>';
					
					$sub_total = $sub_total+$date->total;
				}
			}
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
			$mail_config = array(
				"from" => $admin_data[0]->email,
				"to" => array($user_data[0]->email),
				"subject" => $general_settings->sitename.": Letter and Postcard Mailing Services Order Receipt",
				"message" => $message
			);
			
			if($this->defaultdata->_send_mail($mail_config)){
				$this->session->set_userdata('has_error', false);
				$this->session->set_userdata('resend_notification', "Email has been successfully sent to <strong>".$user_data[0]->email."</strong> for order <strong>".$order_data->orderid."</strong>");				
			}else{
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('resend_notification', "Something went wrong. Please try again");				
			}
			
			redirect($this->agent->referrer());	
		}
	}
?>