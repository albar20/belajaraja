<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coupon_api extends API_Controller {

	public function __construct()
	{
		parent::__construct();
	}


	/*=============================================
	
		USING
		=================================
		=>	
			url : http;//ecommerce.babastudio.net/wishlist_api

			POST variables
			=====================

			$_POST['email'] 			= 'kelly@yahoo.com';
			$_POST['password'] 			= 'a';
			$_POST['request_method'] 	= 'index';

			OR
			$_POST['token'] 			= 'sfsdfuywejsdfu';
			$_POST['request_method'] 	= 'index';


		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	CEK COUPON 
		3.	RESPONSE JSON 
	=============================================*/
	
	public function index()
	{
		/*=============================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		=============================================*/
		$data = $this->data_for_all_pages();

		/*=============================================
			2.	CEK COUPON
		=============================================*/
		
		$coupon			= $this->input->post('coupon_code');
		$product_id		= $this->input->post('product_id');
		$subtotal		= $this->input->post('subtotal');
		
		//echo $coupon;
		//exit();
		
		$discount		= 0;
		
		$cek_coupon = $this->db->query("select * from coupon_master,coupon_product where coupon_master.coupon_code = '$coupon' and coupon_master.coupon_master_id = coupon_product.coupon_master_id and coupon_master.coupon_status = 'active' and date(coupon_master.coupon_start_date) <= date(now()) and date(coupon_master.coupon_end_date) >= date(now()) limit 1");
		
		if($cek_coupon->num_rows() > 0)
		{
			$coupon		= $cek_coupon->row();
		
			// Start Cek coupon used maximum
			
			$cek_limit_used		= $this->db->query("select count(*) as total from coupon_used where cp_id = '$coupon->coupon_master_id'");
			
			if($cek_limit_used->row()->total >= $coupon->use_coupon)
			{
				//$this->session->set_flashdata('danger','Coupon is expired or not match to any product in your cart');
				//redirect('cart');
				$coupon_status	= "FAIL";
				$msg			= "Coupon is expired";
			}
			else
			{
			
				//$cek_limit_peruser	= $this->db->query("select count(*) as total from coupon_used where coupon_master_id = '$coupon->coupon_master_id' and customer_id = '$customer_id'")
				
				// End Cek coupon used maximum
			
				// Start Matching product coupon to cart item.
				//$isi_cart			= $this->cart->contents();
				$product_id_coupon			= $coupon->product_id;
				$match						= 0;	
									
				if($product_id == $product_id_coupon)
				{
					$match = 1;
				
					if($coupon->coupon_type == 'percentage')
					{
						$discount		= ($subtotal * $coupon->coupon_percentage)/100;
					}
					else
					{
						$discount		= ($coupon->coupon_amount * $item['qty']);
					}
				
				}
				
				if($match == 1)
				{
					$coupon_status	= "OK";
					$error_msg 		= "";
				}
				else
				{
					$coupon_status	= "FAIL";
					$error_msg		= "Coupon and Product Not Match";
				}
				
				$data['error_msg']			= $error_msg;
				$data['discount']			= $discount;
				
				//redirect('cart');
				
				// End Matching product coupon to cart item.
			}	
		}
		else
		{
			$coupon_status		= "FAIL";
			$error_msg			= "Coupon Doesn't Exist Or Expired";
			$data['error_msg']	= $error_msg;
			$data['discount']	= $discount;
		}
		
		/*=============================================
			3.	RESPONSE JSON 
		=============================================*/
		 $status 	= self::SUCCESS;
		 $message 	= $coupon_status;
		 $token 		= $this->_token;
		 $this->jsonout(	$status,
						 $message, 
						 $data,
						 $token
						 );
	
		/* $response	= $this->output
						->set_content_type('application/json')
						->set_output(json_encode(array(
											'data' 		=> $data,
											'message'	=> $coupon_status
											)));
						
		return $response; */
		
		exit ;
	}

}