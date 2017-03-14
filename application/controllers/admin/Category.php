<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller{
	
	public $data = array();
	public $loggedin_method_arr = array('category-list', 'category-add', 'category-edit');
	
	public function __construct(){
		parent::__construct();
		
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
	
	public function category_list(){
		$like = array();
		parse_str($_SERVER['QUERY_STRING'], $like);
		unset($like['page']);
		
		$search_key = $this->input->get('categoryname');
		if(isset($search_key) && $search_key){
			$this->data['search_key'] = $search_key;
		}else{
			$this->data['search_key'] = '';
		}
		
		$category_data = $this->categorydata->grab_category(array(), $like, array());
		
		//pagination settings
		$config['base_url'] = site_url('admin/category-list');
		$config['total_rows'] = count($category_data);
		
		$pagination = $this->config->item('pagination');
		
		$pagination = array_merge($config, $pagination);

		$this->pagination->initialize($pagination);
		$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		

		$this->data['pagination'] = $this->pagination->create_links();
		
		$category_paginated_data = $this->categorydata->grab_category(array(), $like, array(PAGINATION_PER_PAGE, $this->data['page']));
		$this->data['category_details'] = $category_paginated_data;
		
		$this->load->view('admin/category_list', $this->data); 
	}
	
	public function category_add(){
		if($this->session->userdata('has_error')){
			$this->data['cat_details'] = (object)$this->session->userdata;
		}
		$this->load->view('admin/category_add', $this->data); 
	}
	
	public function add_category(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('categoryname', 'Categoryname', 'trim|required|is_unique['.TABLE_CATEGORY.'.categoryname]');
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('catadd_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			$code = $this->defaultdata->slugify($post_data['categoryname']);
			$data = array(
				"categoryname" => $post_data['categoryname'],
				"code" => $code,
				"is_active" => $post_data['is_active'],
				"date_added" => time()
			);
			$this->categorydata->insert_category($data);
			
			$this->session->set_userdata('has_error', false);
			
			redirect(base_url('admin/category-list'));
		}
	}
	
	public function category_edit($code){
		if($this->session->userdata('has_error')){
			$this->data['cat_details'] = (object)$this->session->userdata;
		}else{
			$cond['code'] = $code;
			$cat_details = $this->categorydata->grab_category($cond);
			$this->data['cat_details'] = $cat_details[0];
		}
		
		$this->load->view('admin/category_edit', $this->data); 
	}
	
	public function edit_category(){
		$post_data = $this->input->post();
			
		$this->load->library('form_validation');
		
		if($post_data['categoryname'] != $post_data['old_categoryname']){
			$is_unique =  '|is_unique['.TABLE_CATEGORY.'.categoryname]';
		}else{
			$is_unique =  '';
		}
		$this->form_validation->set_rules('categoryname', 'Categoryname', 'trim|required'.$is_unique);		
		
		$this->session->unset_userdata($post_data);
		if($this->form_validation->run() == FALSE)
		{	
			$this->session->set_userdata($post_data);
			
			$this->session->set_userdata('has_error', true);
			$this->session->set_userdata('catedit_notification', validation_errors());
			
			redirect($this->agent->referrer());
		}else{
			$cond['code'] = $post_data['code'];
			$data = array(
				"categoryname" => $post_data['categoryname'],
				"is_active" => $post_data['is_active'],
				"date_added" => time()
			);
			$this->categorydata->update_category($cond, $data);
			
			redirect(base_url('admin/category-list'));
		}
	}
	
	public function category_delete($code){			
		$cond['code'] = $code;
		
		if($this->categorydata->delete_category($cond)){
			redirect($this->agent->referrer());		
		}
	}
}