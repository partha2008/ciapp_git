<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Order extends CI_Controller {
		
		public $data = array();
		public $loggedin_method_arr = array('order-list', 'failed-order-list', 'order-edit');
		
		public function __construct(){
			parent::__construct();
			
			$this->load->model('orderdata');
			
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
				if($ext != 'pdf' || $ext != 'PDF'){
					$this->form_validation->set_message('checkFileExtension', 'Invalid file extension. Only PDF file is allowed');
					return false;
				}else{
					return true;
				}					
			}
		}
		
		public function edit_order(){
			$post_data = $this->input->post();
			
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
				
				unset($post_data['order_id']);
				unset($post_data['mailing_date_id']);

				if(!empty($post_data)){
					foreach($post_data AS $key => $data){
						if (strpos($key, 'orders_') !== false) { // check order value						
							$index = substr($key, 7);
							if($index == 'date'){
								$index = 'date_added';
								$data = strtotime($data);
							}
							$order_data[$index] = $data;
						}
						if (strpos($key, 'item_') !== false) { // check mailing_dates value
							$index = substr($key, 5);
							$mailing_dates_data[$index] = $data;
						}						
					}
					
					$this->orderdata->update_order($cond, $order_data);
					$this->orderdata->update_mailing_dates($mail_cond, $mailing_dates_data);
				}
				redirect(base_url('admin/order-list'));
			}
		}
		
		public function order_delete($order_id){			
			$cond['order_id'] = $order_id;
			
			if($this->orderdata->delete_order($cond)){
				redirect($this->agent->referrer());		
			}
		}
		
		public function resend_mail_to_user($order_id){
			
			$config = $this->config->item('smtp');
			/*echo "<pre>";
			print_r($config);
			die();*/
			$this->email->initialize($config);

			$this->email->from('partha.chowdhury.sit@gmail.com', 'Partha Chowdhury');
			$list = array('partha.chowdhury@nettrackers.net');
			$this->email->to($list);
			$this->email->subject('This is an email test');
			$this->email->message('It is working. Great!');
			$result = $this->email->send();
			var_dump($result);
			die();
			
			redirect($this->agent->referrer());	
		}
	}
?>