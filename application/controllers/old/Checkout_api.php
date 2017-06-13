<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Checkout_api extends API_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('rajaongkir');
		$this->load->helper('string');
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
		
		$customer_address_id		= $this->security->xss_clean($this->input->post('address'));
		//$courier					= $this->input->post('courier');
		parse_str($this->input->post('courier'), $courier);
		
		$order_master_id			= "ORD".date('YmdHisu').random_string();
		$order_detail				= array();
		//$list_product				= $this->input->post('product');
		parse_str($this->input->post('product'), $list_product);
		$customer_id				= $this->input->post('customer_id');
		$total						= $this->input->post('total_price');
		
		$weight				= 0;
		$discount			= 0;

		//print_r($this->input->post('product'));
		//parse_str($list_product, $output);
		//print_r($list_product);
		//exit();
		
		if($list_product == "")
		{
			$message		= "Product Is Empty";
		}
		elseif($customer_id == "")
		{
			$message		= "costumer_id is Empty";
		}
		elseif(isset($list_product[0]) && (array_key_exists('product_id', $list_product[0])
											&& array_key_exists('qty', $list_product[0])
											&& array_key_exists('price', $list_product[0])
											&& array_key_exists('coupon_code', $list_product[0])
											&& array_key_exists('discount', $list_product[0])
											&& array_key_exists('size_label', $list_product[0])
											&& array_key_exists('weight', $list_product[0])
											&& array_key_exists('discount', $list_product[0])
											&& array_key_exists('courier', $courier)
											&& array_key_exists('service', $courier)
											&& array_key_exists('fee', $courier)
		)) 
		{
			foreach($list_product as $item){ 
				$weight		= $weight + $item['weight'];
				$discount	= $discount + $item['discount'];
				
				$detail_product = array(
											"product_id"		=> $item['product_id'],
											"order_id"			=> $order_master_id,
											"product_qty"		=> $item['qty'],
											"price"				=> $item['price'],
											"coupon_code"		=> $item['coupon_code'],
											"discount"			=> $item['discount'],
											"size_label"		=> $item['size_label']
				);
				
				array_push($order_detail,$detail_product); 
				
			}
			
			$order_master['order_id']				= $order_master_id;
			$order_master['customer_id']			= $customer_id;
			$order_master['customer_address_id']	= $customer_address_id;
			$order_master['order_courier']			= $courier['courier']." ".$courier['service'];
			$order_master['order_shipping_charge']	= $courier['fee'];
			$order_master['order_discount']			= $discount;
			$order_master['order_total']			= ($total - $discount + $courier['fee']);
			$order_master['order_weight']			= $weight;
			$order_master['order_date']				= date("Y-m-d H:i:s");
			
			$this->model_utama->insert_data('order_master',$order_master);
			$this->db->insert_batch('order_products',$order_detail);
		
			
		
			/* $response	= $this->output
							->set_content_type('application/json')
							->set_output(json_encode(array(
												'message'	=> $message,
												)));
							
			return $response; */
		
			$message	= "Data Berhasil Disimpan";
		}	
		else
		{
			$message		= "Invalid Array for Product and Courier ";
		}
			
		$status 	= self::SUCCESS;
		 $message 	= $message;
		 $token 		= $this->_token;
		 $this->jsonout(	$status,
							 $message, 
							 $data,
							 $token
							 );
		
		exit;
	}
	
	public function province()
	{
		$this->load->library('rajaongkir');
	
		$data = $this->data_for_all_pages();
	
		/* $response	= $this->output
						->set_content_type('application/json')
						->set_output($this->rajaongkir->all_province());
		
		return $response; */
		
		$response				= json_decode($this->rajaongkir->all_province());
		$data['all_province']	= $response;
		
		$status 	= self::SUCCESS;
		 $message 	= "";
		 $token 		= $this->_token;
		 $this->jsonout(	$status,
							 $message, 
							 $data,
							 $token
							 );
		
		exit;
	}
	
	public function city()
	{
		$this->load->library('rajaongkir');
	
		$data = $this->data_for_all_pages();
	
		$province	= $this->input->post('province');
	
		/* $response	= $this->output
						->set_content_type('application/json')
						->set_output($this->rajaongkir->all_city($province));
		
		return $response; */
		
		$status 				= self::SUCCESS;
		$message 				= "";
		$data['list_city']		= json_decode($this->rajaongkir->all_city($province));
		
		$token 		= $this->_token;
		$this->jsonout(	$status,
							 $message, 
							 $data,
							 $token
							 );
		
		exit;
	}
	
	public function shipping()
	{
		$this->load->library('rajaongkir');
	
		$data = $this->data_for_all_pages();
	
		$from_city			= $this->model_utama->get_detail('1','setting_id','setting')->row()->shop_location;
		$address		  	= $this->security->xss_clean($this->input->post('address'));
		$weight				= $this->security->xss_clean($this->input->post('weight'));
		$message			= "";
		
		$shipping_city		= $this->db->query("select * from customer_address where customer_address_id = '$address' limit 1");
		
		if($address == "" or $weight == "")
		{
			$message		= "Parameter address or weight is empty";
		}
		else if($shipping_city->num_rows() == 0)
		{
			$message		= "addres is invalid";
		}
		else
		{
			$shipping_city		= $shipping_city->row();
			$to_city			= $shipping_city->city_id;
			
			$list_courier		= $this->db->query("select * from courier_master where status = '1'");
			
			$service			= array('OKE','REG','YES','ECO','ONS','Surat Kilat Khusus','Express Next Day');
			$number_service		= 0;
			$warning			= "";
			$list_shipping		= array();
			$message			= "";
			
			if($list_courier->num_rows() == 0)
			{
				$message		= "Courier is Empty";
			}
			else
			{
				foreach($list_courier->result() as $row)
				{
					$list_ongkir		= json_decode($this->rajaongkir->getOngkir($from_city,$to_city,$row->courier_name,$weight), true);
					
					$list_ongkir		= $list_ongkir['rajaongkir']['results'][0]['costs'];
					
					// echo $from_city."<br>";
					// echo $to_city."<br>";
					// echo $row->courier_name."<br>";
					//print_r($list_ongkir);
					//exit();
					foreach($list_ongkir as $row2)
					{
					
						if($row2['cost'][0]['value'] < 0 or $row2['cost'][0]['value'] == "")
						{
							break;
						}
						
						if(in_array($row2['service'], $service))
						{
							$shipping_fee		= array(
																"info" => strtoupper($row->courier_name).' ('.$row2['service'].') '.$row2['cost'][0]['value'].' '.$row2['cost'][0]['etd'].' Hari',
																"fee"  => $row2['cost'][0]['value'],
																"courier" => $row->courier_name,
																"service" => $row2['service']
														);
														
							//print_r(json_encode($shipping_fee));
						
							//{ \'shippingInfo\' : \''.ucwords($row->courier_name).' '.$row2['service'].' '.$row2['cost'][0]['value'].' '.$row2['cost'][0]['etd'].' Hari\',  \'shippingFee\' : \''.$row2['cost'][0]['value'].'\'};
						
							//$option  .= "<option value='".json_encode($shipping_fee)."'>".strtoupper($row->courier_name)." (".$row2['service'].") Rp. ".$this->cart->format_number($row2['cost'][0]['value'])." - ".$row2['cost'][0]['etd']." Hari</option>";
							
							array_push($list_shipping, $shipping_fee);
							
							$number_service++;
						}	
					} 
					
					if($number_service == 0)
					{
						$message	= "Empty Result";
					}
				}
			}	
		}	
		
		/* $response	= $this->output
						->set_content_type('application/json')
						->set_output(json_encode(array(
											'listshipping'		=> $list_shipping,
						)));
		
		return $response;  */
		
		$data['list_shipping']		= $list_shipping;

		
		$status 	= self::SUCCESS;
		$message 	= $message;
		$token 		= $this->_token;
		$this->jsonout(	$status,
							 $message, 
							 $data,
							 $token
							 );
		
		//print_r($list_shipping);
		
		exit;
		
	}
}