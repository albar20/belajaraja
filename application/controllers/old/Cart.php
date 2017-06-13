<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart extends MY_Controller {
	
	public function __construct()
	{
			parent::__construct();
			// Your own constructor code
			$this->load->library('cart');	
			$this->load->library('rajaongkir');
			$this->load->helper('string');
			$this->minify();
	}
	
	public function index()
	{	
		$judul				= $this->setting->website_name;

		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/cart/page_content';
		$this->load->view($this->front_folder.$this->themes_folder_name.'/template',$data);
	}
	
	function add_cart()
	{
		$user_id			= $this->session->userdata('id_customer');
		$product_id			= $this->input->post('product_id');
		$qty				= $this->input->post('qty');
		$product			= $this->db->query("select * from product where product_id = '$product_id' limit 1")->row();
		$gambar				= "default.jpg";
		$picture_cover_query= $this->db->query("select * from product_picture where product_id = $product_id and picture_highlight = 'yes' limit 1");
		$picture_query			= $this->db->query("select * from product_picture where product_id = $product_id limit 1");
		$query_size_list		= $this->db->query("select * from product_size_master as p,size_master as s where p.size_id = s.size_id and p.product_id = '$product->product_id'");
		
		$size_list			= array();
		foreach($query_size_list->result() as $row)
		{
			array_push($size_list, $row->size_name);
		}
		
		if($picture_cover_query->num_rows() > 0)
		{
			$gambar		= $picture_cover_query->row()->product_picture;
		}
		elseif($picture_query->num_rows() > 0)
		{
			$gambar		= $picture_query->row()->product_picture;
		}
		
		$size			= json_decode($this->input->post('size'), true);
		
		$size_id		= (empty($_POST['size']) ? "" : $size['size_id']);
		$size_label		= (empty($_POST['size']) ? "" : $size['size_label']);
		
		$data = array(
				'id'	     		=> $product->product_id,
				'qty'   	 		=> $qty,
				'price'  	 		=> $product->price,
				'name'   	 		=> $product->product_name,
				'weight'			=> $product->weight,
				'slug'				=> $product->slug,
				'discount'	 		=> 0,
				'coupon_type'		=> "",
				'coupon_code'		=> "",
				'coupon_amount'		=> 0,
				'coupon_percentage'	=> 0,
				'size_id'			=> $size_id,
				'size_label'		=> $size_label,
				'size_list'		=> $size_list,
				'gambar'			=> $gambar
		);

		$this->cart->insert($data);
		
		$isi_cart	= $this->cart->contents();
		$discount	= 0;
		$html		= "";
		
		foreach($isi_cart as $item)
		{
			$discount		= $discount + $item['discount'];
		
			if($product_id == $item['id'])
			{
				$recently_add = $this->cart->get_item($item['rowid']);
				
				// $this->output
					// ->set_content_type('application/json')
					// ->set_output(json_encode(array(
													//'rowid' 	=> $item['rowid'],
													//'total' 	=> $recently_add['qty'],
													//'price' 	=> $recently_add['qty'],
													//)));
													
				$rowid 		= $item['rowid'];
				$qty 		= $recently_add['qty'];
				$price 		= $recently_add['price'];
				$name		= $recently_add['name'];
				$subtotal	= $recently_add['subtotal'];

				$html 	.= '
					<div class="col-md-12">	
						<h2 class="main-heading text-center">							
						</h2>
						<div class="table-responsive shopping-cart-table">
							<table class="table table-bordered">
								<thead>
									<tr>
										<td class="text-center">
											Image
										</td>
										<td class="text-center">
											Product Details
										</td>							
										<td class="text-center">
											Qty
										</td>
										<td class="text-center">
											Price
										</td>
										<td class="text-center">
											Total
										</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="text-center">
											<a href="'.base_url().'product/'.$product->slug.'">
												<img src="'.base_url().'uploads/product/'.$product_id.'/thumb_'.$gambar.'" alt="Product Name" title="Product Name" class="img-thumbnail" width="50%">
											</a>
										</td>
										<td class="text-center">
											<a href="'.base_url().'product/'.$product->slug.'">'.$name." ".($size_label == "" ? "" : "(".$size_label.")").'</a>
										</td>							
										<td class="text-center">
											<div class="input-group btn-block">
												<strong>'.$qty.'</strong>
											</div>								
										</td>
										<td class="text-center">
											Rp. '.$this->cart->format_number($price).'
										</td>
										<td class="text-center">
											Rp. '.$this->cart->format_number($subtotal).'
										</td>
									</tr>						
								</tbody>
							</table>				
						</div>
					</div>';			
			}
		}
		
		$html		.= '<div class="col-md-12">
					<section class="registration-area">
						<div class="panel panel-smart">
							<div class="panel-heading">
								<h3 class="panel-title">
									Total Items In Cart
								</h3>
							</div>
							<div class="panel-body">
								<dl class="dl-horizontal">
									<dt>Total :</dt>
									<dd>Rp. '.$this->cart->format_number($this->cart->total()).'</dd>
									<dt>Coupon Discount :</dt>
									<dd>Rp. '.$this->cart->format_number($discount).'</dd>
								</dl>
								<hr>
								<dl class="dl-horizontal total">
									<dt>Total (Net):</dt>
									<dd>Rp. '.($this->cart->format_number($this->cart->total() - $discount)).'</dd>
								</dl>
								<hr>
								<div class="text-uppercase clearfix">
									<a class="btn btn-default pull-left" href="#" data-dismiss="modal">
										<span class="hidden-xs">Continue Shopping</span>
										<span class="visible-xs">Continue</span>
									</a>
									<a class="btn btn-default pull-right" href="'.base_url().'cart">		
										View Cart
									</a>
								</div>
							</div>
						</div>
					</section>
					</div>
				';
					
				$this->db->query("delete from wishlists where product_id = '$product_id' and customer_id = '$user_id'");	
					
				echo $html;
	}

	function update()
	{
		$kode 		= $this->uri->segment(3);
	
		if($kode == "")
		{
			redirect("cart");
		}
		else
		{
			$cart		= $this->cart->contents();
			
			$quantity		= $this->input->post('quantity');
			$size			= $this->input->post('size');
			$discount		= $cart[$kode]['discount'] * $quantity;
	
			$data = array(
					'rowid'  	=> $kode,
					'qty'    	=> $quantity,
					'discount'	=> $discount,
					'size_label'	=> $size,
			);
			$this->cart->update($data);
	
			$this->session->set_flashdata("success","Your Cart Successfully Updated");
			redirect('cart');
		}
		
	}
	
	function remove()
	{
		$kode 		= $this->uri->segment(3);
	
		if($kode == "")
		{
			redirect("cart");
		}
		else
		{
			$data = array(
					'rowid'  => $kode,
					'qty'    => 0,
			);
			$this->cart->update($data);
	
			redirect('cart');
		}	
	}
	
	function apply_coupon()
	{
		$coupon		= $this->input->post('coupon_code');
		
		$cek_coupon = $this->db->query("select * from coupon_master,coupon_product where coupon_master.coupon_code = '$coupon' and coupon_master.coupon_master_id = coupon_product.coupon_master_id and coupon_master.coupon_status = 'active' and date(coupon_master.coupon_start_date) <= date(now()) and date(coupon_master.coupon_end_date) >= date(now()) limit 1");
		
		if($cek_coupon->num_rows() > 0)
		{
			$coupon		= $cek_coupon->row();
		
			// Start Cek coupon used maximum
			
			$cek_limit_used		= $this->db->query("select count(*) as total from coupon_used where coupon_id = '$coupon->coupon_master_id'");
			
			if($cek_limit_used->row()->total >= $coupon->use_coupon)
			{
				$this->session->set_flashdata('danger','Coupon is expired or not match to any product in your cart');
				redirect('cart');
			}
			
			//$cek_limit_peruser	= $this->db->query("select count(*) as total from coupon_used where coupon_master_id = '$coupon->coupon_master_id' and customer_id = '$customer_id'")
			
			// End Cek coupon used maximum
		
			// Start Matching product coupon to cart item.
			$isi_cart			= $this->cart->contents();
			$product_id	= $coupon->product_id;
			$match				= 0;	
				
			foreach($isi_cart as $item)
			{
				if($product_id == $item['id'])
				{
					$match = 1;
				
					if($coupon->coupon_type == 'percentage')
					{
						$discount		= ($item['subtotal'] * $coupon->coupon_percentage)/100;
					}
					else
					{
						$discount		= ($coupon->coupon_amount * $item['qty']);
					}
				
					$data = array(
							'rowid'  		=> $item['rowid'],
							'discount'		=> $discount,
							'coupon_type'	=> $coupon->coupon_type,
							'coupon_code' 	=> $coupon->coupon_code,
							'coupon_amount'		=> $coupon->coupon_amount,
							'coupon_percentage'	=> $coupon->coupon_percentage,
					);

					$this->cart->update($data);
				}
			}
			
			if($match == 1)
			{
				$this->session->set_flashdata('success','Success add coupon');
			}
			else
			{
				$this->session->set_flashdata('danger','Coupon is expired or not match to any product in your cart');
			}
			
			redirect('cart');
			
			// End Matching product coupon to cart item.
		}
		else
		{
			$this->session->set_flashdata('danger',"Coupon expired or doesn't exist");
			redirect('cart');
		}
	}
	
	function checkout()
	{
		if($this->session->userdata('login_customer') == true)
		{
			$all_province	= json_decode($this->rajaongkir->all_province(), true);
			$customer_id	= $this->session->userdata('id_customer');
			//$customer_id	= 1;
			
			$judul				= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 		= $judul;
$data['judul'] 		= $data['title'];
			$data['page']		= $this->front_folder.$this->themes_folder_name.'/cart/page_checkout';

			
			$data['province']	= $all_province['rajaongkir']['results'];
			$data['listaddress']= $this->db->query("select * from customer_address where customer_id = '$customer_id'");
			
			if($this->cart->total() <= 0)
			{
				redirect('cart');
			}
		
			$this->load->view($this->front_folder.$this->themes_folder_name.'/template',$data);
		}
		else
		{
			redirect('login');
		}
	}
	
	function add_address()
	{
		if($this->session->userdata('login_customer') == true)
		{
			$customer_id	= $this->session->userdata('id_customer');
			//$customer_id		= 1;
			$data['nama_penerima']		= $this->security->xss_clean($this->input->post('name'));
			$data['no_telepon']			= $this->security->xss_clean($this->input->post('phone'));
			$data['alamat_lengkap']		= $this->security->xss_clean($this->input->post('address'));
			$data['province_id']		= $this->security->xss_clean($this->input->post('province'));
			$data['city_id']			= $this->security->xss_clean($this->input->post('city'));
			$data['kode_pos']			= $this->security->xss_clean($this->input->post('postcode'));
			$data['customer_id']		= $customer_id;
			
			$this->model_utama->insert_data('customer_address',$data);
			
			$listaddress = $this->db->query("select * from customer_address where customer_id = '$customer_id'");
			
			echo '<option value="">-- Choose Address --</option>';
			
			foreach($listaddress->result() as $row)
			{
				echo '<option value="'.$row->customer_address_id.'">'.$row->nama_penerima.' '.$row->alamat_lengkap.'</option>';
			}
		}
		else
		{
			redirect('login');
		}	
	}
	
	function get_city()
	{
		$province	  = $this->security->xss_clean($this->input->post('province_id'));
		
		$all_city	  = json_decode($this->rajaongkir->all_city($province), true);
		$all_city	  = $all_city['rajaongkir']['results'];
		
		echo '<option value="">- Choose City -</option>';
		
		foreach($all_city as $row)
		{
			echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
		}
	}
	
	function shipping_fee()
	{
		$from_city			= $this->model_utama->get_detail('1','setting_id','setting')->row()->shop_location;
		$address		  	= $this->security->xss_clean($this->input->post('address'));
		
		$shipping_city		= $this->db->query("select * from customer_address where customer_address_id = '$address' limit 1")->row();
		$to_city			= $shipping_city->city_id;
		
		$list_courier		= $this->db->query("select * from courier_master where status = '1'");
		$option				= '<option value="">-- Choose Courier --</option>';
		
		$weight				= 0;
		foreach($this->cart->contents() as $item){ 
			$weight		= $weight + $item['weight'];
		}
		
		$service			= array('OKE','REG','YES','ECO','ONS','Surat Kilat Khusus','Express Next Day');
		$number_service		= 0;
		$warning			= "";
		
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
				
					$option  .= "<option value='".json_encode($shipping_fee)."'>".strtoupper($row->courier_name)." (".$row2['service'].") Rp. ".$this->cart->format_number($row2['cost'][0]['value'])." - ".$row2['cost'][0]['etd']." Hari</option>";
					
					$number_service++;
				}	
			} 
		}
		
		if($number_service == 0)
		{
			$option		= '<option value="none">No Result</option>';
			$warning	= "We can't find any courier to reach the address, Please contanct us to resolve this";
		}
		
		//echo $option;
		
		$this->output
			 ->set_content_type('application/json')
			 ->set_output(json_encode(array(
											 'option'  			=> $option,
											 'warning' 			=> $warning,
											 'number_service'	=> $number_service,
										 ))); 
	}
	
	function get_total_cost()
	{
		$discount		= 0;
		foreach($this->cart->contents() as $item){ 
			$discount		= $discount + $item['discount'];
		}	
	
		$shipping_fee	= $this->input->post('shipping_fee');
		$total_cost		= ($this->cart->format_number($this->cart->total() - $discount + $shipping_fee));
		
		$this->output
			 ->set_content_type('application/json')
			 ->set_output(json_encode(array(
											 'total_cost' 	=> 'Rp. '.$total_cost,
											 'shipping_fee'	=> 'Rp. '.($this->cart->format_number($shipping_fee))
										 ))); 
	}
	
	function saving_order()
	{
		if($this->session->userdata('login_customer') == true)
		{
			$customer_address_id		= $this->security->xss_clean($this->input->post('address'));
			$courier					= json_decode($this->security->xss_clean($this->input->post('courier')),true);
			$order_master_id			= "ORD".date('YmdHisu').random_string();
			$order_detail				= array();
			
			$weight				= 0;
			$discount			= 0;
			foreach($this->cart->contents() as $item){ 
				$weight		= $weight + $item['weight'];
				$discount	= $discount + $item['discount'];
				
				$detail_product = array(
											"product_id"		=> $item['id'],
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
			$order_master['customer_id']			= $customer_id	= $this->session->userdata('id_customer');;
			$order_master['customer_address_id']	= $customer_address_id;
			$order_master['order_courier']			= $courier['courier']." ".$courier['service'];
			$order_master['order_shipping_charge']	= $courier['fee'];
			$order_master['order_discount']			= $discount;
			$order_master['order_total']			= ($this->cart->total() - $discount + $courier['fee']);
			$order_master['order_weight']			= $weight;
			$order_master['order_date']				= date("Y-m-d H:i:s");
			
			$this->model_utama->insert_data('order_master',$order_master);
			$this->db->insert_batch('order_products',$order_detail);
			
			$this->cart->destroy();
			
			redirect(base_url().'payment/confirm/'.$order_master_id);
		}
		else
		{
			redirect("login");
		}
	}
	
	function cek_cart()
	{
		foreach($this->cart->contents() as $item){ 
			print_r($item['size_list']);
		}
	}
	
	function test_raja()
	{
		$all_province = json_decode($this->rajaongkir->all_province(), true);
		//print_r($all_province['rajaongkir']['results']);
		
		$all_city	  = json_decode($this->rajaongkir->all_city(1), true);
		//print_r($all_city['rajaongkir']['results']);
		
		$province	  = json_decode($this->rajaongkir->province_detail(1), true);
		//print_r($province);
		
		$city	  = json_decode($this->rajaongkir->city_detail(1), true);
		print_r($all_province);
	
	}
}	