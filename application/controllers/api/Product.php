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
		
		// fetch all product details
		public function products_get(){
			$table_row_count = $this->db->count_all(TABLE_PRODUCT);
			
			// check for existense
			$product_data = $this->productdata->grab_product_join_category(array(), array(), array($table_row_count, 0));
			
			if(!empty($product_data)){
				$cnt = 0;
				foreach($product_data as $data){
					$product_details[$cnt]['description'] = $data->description;
					$product_details[$cnt]['code'] = $data->code;
					$product_details[$cnt]['imagename'] = $data->imagename;
					$product_details[$cnt]['price'] = $data->price;
					$product_details[$cnt]['order_id'] = $data->order_id;
					$product_details[$cnt]['caption'] = $data->productname;
					$product_details[$cnt]['url'] = UPLOAD_PATH.$data->imagepathname;
					
					$final_arr[$data->cat_code] = $product_details;
					
					$cnt++;
				}
				
				/*echo "<pre>";
				print_r($product_details);
				die();*/
				
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
