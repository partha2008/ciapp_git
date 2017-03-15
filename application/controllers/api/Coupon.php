<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	require APPPATH . '/libraries/REST_Controller.php';
	use Restserver\Libraries\REST_Controller;
	
	class Coupon extends REST_Controller {

		function __construct()
		{
			// Construct the parent class
			parent::__construct();
			
			$this->load->model('coupondata');

			// Configure limits on our controller methods
			// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
			$this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
			$this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
			$this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
		}
		
		// check for existense & fetch coupon details
		public function generate_post(){
			$coupon_code = $this->post('coupon_code');
			
			// check for existense
			$coupon_data = $this->coupondata->grab_coupon(array("coupon_code" => $coupon_code, "is_active" => '1'));
			if(!empty($coupon_data)){
				$data['coupon_code'] = $coupon_data[0]->coupon_code;
				$data['discount'] = $coupon_data[0]->discount;
				$response = array(
					"status" => true,
					"message" => "Coupon code fetched succesfully",
					"data" => $data
				);
				$this->set_response($response, REST_Controller::HTTP_OK);
			}else{
				$response = array(
					"status" => false,
					"message" => "Coupon code not found"
				);
				$this->set_response($response, REST_Controller::HTTP_OK);
			}
		}
	}
?>
