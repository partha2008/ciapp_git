<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller {
		
		public $data = array();
		
		public function __construct(){
			parent::__construct();
		}
		
		public function index()
		{
			$this->load->view('home', $this->data); 
		}
	}
?>