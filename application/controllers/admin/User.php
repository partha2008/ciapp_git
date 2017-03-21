<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class User extends CI_Controller {
		
		public $data = array();
		public $loggedin_method_arr = array('dashboard', 'profile', 'settings', 'user-list', 'user-add', 'user-edit', 'term', 'privacy');
		public $loggedout_method_arr = array('index');
		
		public function __construct(){
			parent::__construct();
			
			$this->load->model('userdata');
			
			$this->data = $this->defaultdata->getBackendDefaultData();
			
			if(in_array($this->data['tot_segments'][2], $this->loggedin_method_arr))
			{
				if($this->defaultdata->is_session_active() == 0)
				{
					redirect(base_url('admin'));
				}
			}
			
			if(in_array($this->data['tot_segments'][2], $this->loggedout_method_arr))
			{
				if($this->defaultdata->is_session_active() == 1)
				{
					redirect(base_url('admin/dashboard'));
				}
			}
		}
		
		public function index()
		{			
			$this->load->view('admin/login', $this->data); 
		}
		
		public function process_login(){
			$post_data = $this->input->post();
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata('login_error', 'true');
				redirect(base_url('admin'));
			}
			else
			{
				$username = $post_data['username'];
				$password = $post_data['password'];
				
				$encrypted_password = base64_encode(hash("sha256", $password, True));
				
				$data = array(
					"username" => $username,
					"password" => $encrypted_password
				);
				
				$user_data = $this->userdata->grab_user_details($data);
				if(count($user_data) > 0){
					$this->defaultdata->setLoginSession($user_data[0]);
					
					redirect(base_url('admin/dashboard'));					
				}else{
					$this->session->set_userdata('login_error', 'true');
					redirect(base_url('admin'));					
				}
			}
		}
		
		public function dashboard(){
			$this->load->view('admin/dashboard', $this->data);
		}
		
		public function profile(){
			$data = array();
			$data['user_id'] = $this->session->usrid;
			$user_data = $this->userdata->grab_user_details($data);
			
			if($this->session->userdata('has_error')){
				$this->data['profile_data'] = (object)$this->session->userdata;
			}else{
				$this->data['profile_data'] = $user_data[0];
			}
			
			$this->load->view('admin/profile', $this->data);
		}
		
		public function process_profile(){
			$post_data = $this->input->post();
			
			$username = $post_data['username'];
			$old_username = $post_data['old_username'];
			$password = $post_data['password'];
			$original_password = $post_data['original_password'];
			$email = $post_data['email'];
			$old_email = $post_data['old_email'];
			$is_active = $post_data['is_active'];
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			if($username != $old_username){
				$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique['.TABLE_USER.'.username]');
			}
			if($password){
				$this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|max_length[20]');
			}else{
				$password = $original_password;
			}
			if($email != $old_email){
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique['.TABLE_USER.'.email]');
			}
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('profile_notification', validation_errors());
			}else{				
				$encrypted_password = base64_encode(hash("sha256", $password, True));
				
				$cond = array("user_id" => $this->session->usrid);
				$data = array(
					"username" => $username,
					"password" => $encrypted_password,
					"original_password" => $password,
					"email" => $email,
					"is_active" => $is_active,
					"date_added" => time()
				);
				
				$this->userdata->update_user_details($cond, $data);
				
				$this->session->set_userdata('has_error', false);
				$this->session->set_userdata('profile_notification', 'Profile changes have been saved successfully.');
			}
			
			redirect($this->agent->referrer());
		}
		
		public function settings(){		
			if($this->session->userdata('has_error')){
				$this->data['settings_data'] = (object)$this->session->userdata;
			}else{
				$this->data['settings_data'] = $this->defaultdata->grabSettingData();
			}
			
			$this->load->view('admin/settings', $this->data);
		}
		
		public function process_setings(){
			
			$post_data = $this->input->post();
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('sitename', 'Sitename', 'trim|required');
			$this->form_validation->set_rules('siteaddress', 'Siteaddress', 'trim|required');
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('settings_notification', validation_errors());
			}else{
				$data = array(
					"sitename" => $post_data['sitename'],
					"siteaddress" => $post_data['siteaddress'],
					"date_added" => time()
				);
				
				if(isset($_FILES) && $_FILES['logo']['error'] == 0){
					$filename = $_FILES['logo']['name'];
					$file_ext = pathinfo($filename, PATHINFO_EXTENSION);
					$file_name = 'logo'.'.'.$file_ext;
					
					array_map('unlink', glob(UPLOAD_RELATIVE_LOGO_PATH."*"));
					if(move_uploaded_file($_FILES['logo']['tmp_name'], UPLOAD_RELATIVE_LOGO_PATH.$file_name)){
						$data['logoname'] = $file_name;
						$data['logopathname'] = UPLOAD_RELATIVE_LOGO_PATH.$file_name;
					}
				}
				
				$cond = array("settings_id" => $post_data['settings_id']);
				
				$this->userdata->update_settings_details($cond, $data);
				
				$this->session->set_userdata('has_error', false);
				$this->session->set_userdata('settings_notification', 'Settings changes have been saved successfully.');
			}
			
			redirect($this->agent->referrer());			
		}
		
		public function cms(){
			$cms = $this->data['tot_segments'][2];
			if($this->session->userdata('has_error')){
				$this->data['cms_data'] = (object)$this->session->userdata;
			}else{
				$cond['mode'] = $cms;
				$this->data['cms_data'] = $this->userdata->get_cms_content($cond);
			}
			if($cms == 'term'){
				$title = "Terms & Conditions";
			}else{
				$title = "Privacy & Policy";
			}
			$this->data['title'] = $title;
			$this->load->view('admin/cms', $this->data);
		}
		
		public function update_cms(){
			$post_data = $this->input->post();
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('title', 'Title', 'trim|required');			
			$this->form_validation->set_rules('description', 'Description', 'trim|required');			
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('cms_notification', validation_errors());
				
				redirect($this->agent->referrer());
			}else{
				$cond['mode'] = $post_data['mode'];
				$data = array(
					"title" => $post_data['title'],
					"description" => $post_data['description'],
					"date_added" => time()
				);
				$this->userdata->update_cms_content($cond, $data);
				
				redirect(base_url('admin/'.$post_data['mode']));
			}
		}
		
		public function user_list()
		{
			$like = array();
			parse_str($_SERVER['QUERY_STRING'], $like);
			unset($like['page']);
			
			$search_key = $this->input->get('username');
			if(isset($search_key) && $search_key){
				$this->data['search_key'] = $search_key;
			}else{
				$this->data['search_key'] = '';
			}
			
			$cond["role"] = '1';
			$user_data = $this->userdata->grab_user_details($cond, array(), $like); 
			
			//pagination settings
			$config['base_url'] = site_url('admin/user-list');
			$config['total_rows'] = count($user_data);
			
			$pagination = $this->config->item('pagination');
			
			$pagination = array_merge($config, $pagination);

			$this->pagination->initialize($pagination);
			$this->data['page'] = ($this->input->get('page')) ? $this->input->get('page') : 0;		

			$this->data['pagination'] = $this->pagination->create_links();
			
			$user_paginated_data = $this->userdata->grab_user_details($cond, array(PAGINATION_PER_PAGE, $this->data['page']), $like);			
			
			$this->data['user_details'] = $user_paginated_data;
			
			$this->load->view('admin/user_list', $this->data);
		}
		
		public function user_add(){				
			if($this->session->userdata('has_error')){
				$this->data['user_details'] = (object)$this->session->userdata;
			}
			
			$this->load->view('admin/user_add', $this->data);
		}
		
		public function add_user(){
			$post_data = $this->input->post();
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique['.TABLE_USER.'.username]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique['.TABLE_USER.'.email]');
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('useradd_notification', validation_errors());
				
				redirect($this->agent->referrer());
			}else{
				$data = array(
					"username" => $post_data['username'],
					"password" => base64_encode(hash("sha256", $post_data['password'], True)),
					"original_password" => $post_data['password'],
					"email" => $post_data['email'],
					"user_discount" => $post_data['user_discount'],
					"is_active" => $post_data['is_active'],
					"date_added" => time()
				);
				$this->userdata->insert_user($data);
				
				$this->session->set_userdata('has_error', false);
				
				redirect(base_url('admin/user-list'));
			}
		}
		
		public function user_edit($username){
			if(!$this->session->userdata('has_error')){
				$cond['username'] = $username;
				$user_data = $this->userdata->grab_user_details($cond);
				
				$this->data['user_details'] = $user_data[0];
			}else{
				$this->data['user_details'] = (object)$this->session->userdata;
			}
			
			$this->load->view('admin/user_edit', $this->data);
		}
		
		public function hasSamePassword($pass){
			$username = $this->input->post('old_username');
			$user_data = $this->userdata->grab_user_details(array("original_password" => $pass, "username" => $username));
			if(count($user_data) > 0){
				$this->form_validation->set_message('hasSamePassword', 'Same password given');
				return false;
			}else{
				return true;
			}
		}
		
		public function edit_user(){
			$post_data = $this->input->post();
			
			$this->load->library('form_validation');
			
			if($post_data['username'] != $post_data['old_username']){
				$is_unique =  '|is_unique['.TABLE_USER.'.username]';
			}else{
				$is_unique =  '';
			}			
			$this->form_validation->set_rules('username', 'Username', 'trim|required'.$is_unique);
			
			$this->form_validation->set_rules('reset_password', 'Repeat Password', 'trim|callback_hasSamePassword');
			
			if($post_data['email'] != $post_data['old_email']){	
				$is_unique =  '|is_unique['.TABLE_USER.'.email]';	
			}else{
				$is_unique =  '';
			}
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email'.$is_unique);			
			
			$this->session->unset_userdata($post_data);
			if($this->form_validation->run() == FALSE)
			{	
				$this->session->set_userdata($post_data);
				
				$this->session->set_userdata('has_error', true);
				$this->session->set_userdata('useredit_notification', validation_errors());
				
				redirect($this->agent->referrer());
			}else{
				if($post_data['reset_password']){
					$password = $post_data['reset_password'];
				}else{
					$password = $post_data['password'];
				}
				$cond['user_id'] = $post_data['user_id'];
				$data = array(
					"username" => $post_data['username'],
					"password" => base64_encode(hash("sha256", $password, True)),
					"original_password" => $password,
					"email" => $post_data['email'],
					"user_discount" => $post_data['user_discount'],
					"is_active" => $post_data['is_active'],
					"date_added" => time()
				);
				$this->userdata->update_user_details($cond, $data);
				
				redirect(base_url('admin/user-list'));
			}
		}
		
		public function user_delete($username){			
			$cond['username'] = $username;
			
			if($this->userdata->delete_user($cond)){
				redirect($this->agent->referrer());		
			}
		}
		
		public function logout()
		{
			$this->defaultdata->unsetLoginSession();
			redirect(base_url('admin'));
		}
	}
?>