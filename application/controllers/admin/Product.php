<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product extends CI_Controller{
	
	public $data = array();
	public $loggedin_method_arr = array('product-list', 'product-add', 'product-edit');
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('productdata');
		$this->load->model('categorydata');
			
		$this->data = $this->defaultdata->getBackendDefaultData();
		
		if(in_array($this->data['tot_segments'][2], $this->loggedin_method_arr))
		{
			if($this->defaultdata->is_session_active() == 0)
			{
				redirect(base_url('admin'));
			}
		}
	}
	
	public function product_list(){
		$like = array();
		$cond = array();
		parse_str($_SERVER['QUERY_STRING'], $like);
		unset($like['page']);
		
		$search_key = $this->input->get('productname');
		if(isset($search_key) && $search_key){
			$this->data['search_key'] = $search_key;
		}else{
			$this->data['search_key'] = '';
		}
		
		$search_cat_id = $this->input->get('category_id');
		if(isset($search_cat_id) && $search_cat_id){
			$this->data['search_cat_id'] = $search_cat_id;
			$cond['category_id'] = $search_cat_id;
		}else{
			$this->data['search_cat_id'] = '';
		}
		
		$product_data = $this->productdata->grab_product($cond, $like, array());
		
		//pagination settings
		$config['base_url'] = site_url('admin/product-list');
		$config['total_rows'] = count($product_data);
		
		$pagination = $this->config->item('pagination');
		
		$pagination = array_merge($config, $pagination);

		$this->pagination->initialize($pagination);
		$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		

		$this->data['pagination'] = $this->pagination->create_links();
		
		$product_paginated_data = $this->productdata->grab_product_join_category($cond, $like, array(PAGINATION_PER_PAGE, $this->data['page']));
		$this->data['product_list'] = $product_paginated_data;
		
		$cat_data = $this->categorydata->grab_category(array(), array(), array());
		$this->data['cat_list'] = $cat_data;
		
		$this->load->view('admin/product_list', $this->data); 
	}
	
	public function product_add(){
		if($this->session->userdata('has_error')){
			$this->data['product_details'] = (object)$this->session->userdata;
		}
		$cat_data = $this->categorydata->grab_category(array(), array(), array());
		$this->data['cat_list'] = $cat_data;
		
		$this->data['product_price_range'] = $this->config->item('product_price_range');
		
		$this->load->view('admin/product_add', $this->data); 
	}
	
	public function add_product(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('category_id', 'Category', 'trim|required');
		$this->form_validation->set_rules('productname', 'Product', 'trim|required');
		
		if(!empty($post_data['price'])){
			$cnt = 0;
			foreach($post_data['price'] as $price){
				if($price){
					$cnt++;
				}
			}
		}
		if(count($post_data['price']) != $cnt){
			$this->form_validation->set_rules('price[]', 'Price', 'trim|required', array('required' => 'All prices must be given'));		
		}
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('productadd_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			$imagename = '';
			$imagepathname = '';
			
			if(!empty($_FILES['product'])){
				if($_FILES['product']['error'] == 0){
					move_uploaded_file($_FILES['product']['tmp_name'], UPLOAD_RELATIVE_PRODUCT_PATH.$_FILES['product']['name']);
					
					$imagename = $_FILES['product']['name'];
					$imagepathname = UPLOAD_RELATIVE_PRODUCT_PATH.$_FILES['product']['name'];
				}
			}
			$code = $this->defaultdata->slugify($post_data['productname']);
			$prd_data = $this->productdata->grab_product(array(), array("code" => $code));
			
			if(!empty($prd_data)){
				$index = end(explode("_", $prd_data[0]->code));
				$final_index = $index+1;
				$code = $code.'_'.$final_index;
			}
			
			$prices = implode("|", $post_data['price']);
			
			$data = array(
				"productname" => $post_data['productname'],
				"description" => $post_data['description'],
				"code" => $code,
				"imagename" => $imagename,
				"imagepathname" => $imagepathname,
				"price" => $prices,
				"category_id" => $post_data['category_id'],
				"order_id" => $post_data['order_id'],
				"is_active" => $post_data['is_active'],
				"date_added" => time()
			);
			$this->productdata->insert_product($data);
			
			$this->session->set_userdata('has_error', false);
			
			redirect(base_url('admin/product-list'));
		}
	}
	
	public function product_edit($code){
		if($this->session->userdata('has_error')){
			$sess_data = $this->session->userdata;
			$sess_data['imagename'] = $sess_data['hidden_product'];
			$sess_data['price'] = implode('|', $sess_data['price']);
			$this->data['product_details'] = (object)$sess_data;
		}else{
			$cond['code'] = $code;
			$product_details = $this->productdata->grab_product($cond);
			$this->data['product_details'] = $product_details[0];
		}
		$cat_data = $this->categorydata->grab_category(array(), array(), array());
		$this->data['cat_list'] = $cat_data;
		
		$this->data['product_price_range'] = $this->config->item('product_price_range');
		
		$this->load->view('admin/product_edit', $this->data); 
	}
	
	public function edit_product(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('category_id', 'Category', 'trim|required');
		$this->form_validation->set_rules('productname', 'Product', 'trim|required');
		
		if(!empty($post_data['price'])){
			$cnt = 0;
			foreach($post_data['price'] as $price){
				if($price){
					$cnt++;
				}
			}
		}
		if(count($post_data['price']) != $cnt){
			$this->form_validation->set_rules('price[]', 'Price', 'trim|required', array('required' => 'All prices must be given'));		
		}
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('productedit_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			$imagename = '';
			$imagepathname = '';
			
			if(!empty($_FILES['product'])){
				if($_FILES['product']['error'] == 0){
					if(file_exists(UPLOAD_RELATIVE_PRODUCT_PATH.$post_data['hidden_product'])){
						unlink(UPLOAD_RELATIVE_PRODUCT_PATH.$post_data['hidden_product']);
					}
					move_uploaded_file($_FILES['product']['tmp_name'], UPLOAD_RELATIVE_PRODUCT_PATH.$_FILES['product']['name']);
					
					$imagename = $_FILES['product']['name'];
					$imagepathname = UPLOAD_RELATIVE_PRODUCT_PATH.$_FILES['product']['name'];
				}else{
					if($post_data['hidden_product']){
						$imagename = $post_data['hidden_product'];
						$imagepathname = UPLOAD_RELATIVE_PRODUCT_PATH.$post_data['hidden_product'];
					}
				}
			}
			
			$prices = implode("|", $post_data['price']);
			
			$data = array(
				"productname" => $post_data['productname'],
				"description" => $post_data['description'],
				"imagename" => $imagename,
				"imagepathname" => $imagepathname,
				"price" => $prices,
				"category_id" => $post_data['category_id'],
				"order_id" => $post_data['order_id'],
				"is_active" => $post_data['is_active'],
				"date_added" => time()
			);
			$cond = array("code" => $post_data['code']);
			$this->productdata->update_product($cond, $data);
			
			$this->session->set_userdata('has_error', false);
			
			redirect(base_url('admin/product-list'));
		}
	}
	
	public function product_delete($code){			
		$cond['code'] = $code;
		$prd_data = $this->productdata->grab_product($cond);
		
		if($this->productdata->delete_product($cond)){			
			if(!empty($prd_data)){
				if(file_exists($prd_data[0]->imagepathname)){
					unlink($prd_data[0]->imagepathname);
				}
			}
			
			redirect($this->agent->referrer());		
		}
	}
}