<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	require APPPATH . '/libraries/REST_Controller.php';
	use Restserver\Libraries\REST_Controller;
	
	class Product extends REST_Controller {

		function __construct()
		{
			// Construct the parent class
			parent::__construct();
			
			$this->load->model('productdata');

			// Configure limits on our controller methods
			// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
			$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
			$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
			$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
		}
		
		public function _group_by($array, $key) {
			$return = array();
			foreach($array as $k => $val) {
				$arr = $val = (array)$val;				
				unset($arr[$key]);
				
				if($arr['url']){
					$arr['url'] = UPLOAD_PATH.$arr['url'];
				}
				$return[$val[$key]][] = $arr;
			}
			return $return;
		}
		
		// fetch all products
		public function products_get(){
			
			// check for existense
			$product_data = $this->productdata->grab_product_join_category_all(array(), array());
			
			if(!empty($product_data)){
				$final_arr = $this->_group_by($product_data, 'cat_code');
				$response = array(
					"status" => true,
					"message" => "Products fetched successfully",
					"data" => $final_arr
				);
				$this->set_response($response, REST_Controller::HTTP_OK);
			}else{
				$response = array(
					"status" => false,
					"message" => "No product added yet"
				);
				$this->set_response($response, REST_Controller::HTTP_OK);
			}
		}
	}
?>
