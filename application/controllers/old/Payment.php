<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payment extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		// Your own constructor code
		$this->load->library('cart');	
		$this->load->helper('string');

		if($this->session->userdata('login_customer') != true){ redirect('login'); };
		$this->minify();
	}
	
	public function index()
	{	
		$judul				= $this->setting->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/payment/page_content';
		
		$this->load->view($this->front_folder.$this->themes_folder_name.'/template',$data);
	}
	
	function confirm( $order_id = 0)
	{
		$order_id			= $this->uri->segment(3);
		$order_list			= $this->db->query("select *,order_products.price as subtotal from order_master,order_products,product where order_master.order_id = order_products.order_id and order_products.product_id = product.product_id and order_master.order_id = '$order_id'");
		
		$this->session->set_userdata('order_id',$order_id);
		
		if($this->uri->segment(3) == "" || $order_list->num_rows() == 0)
		{
			redirect(base_url());
		}
		
		if($order_list->row()->order_status != "pending")
		{
			redirect(base_url()."payment/transaction/".$order_id);
		}
		
		$address			= $order_list->row()->customer_address_id;
		
		$shipping_address	= $this->db->query("select * from customer_address where customer_address_id = '$address' limit 1");
		
		$judul				= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['bank']		= $this->db->query("select * from bank");
		$data['address']	= $shipping_address;
		$data['order']		= $order_list;
		$data['order_id']	= $order_id;
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/payment/page_confirm';
		
		$this->load->view($this->front_folder.$this->themes_folder_name.'/template',$data);
	}
	
	function confirm_process()
	{
		$bank				= $this->security->xss_clean($this->input->post('bank'));
		$name				= $this->security->xss_clean($this->input->post('name'));
		$amount				= $this->security->xss_clean($this->input->post('transfer_amount'));

		$sess_data = array(
						    'customer_account_name'  	=> $name,
						    'customer_bank' 	     	=> $bank,
							'customer_amount_transfer' 	=> $amount
					   );
		$this->session->set_userdata($sess_data);

		$order_id			= $this->security->xss_clean($this->input->post('order_id'));
		
		$filecheck 			= basename($_FILES['transfer_receipt']['name']);		
		$ext 				= strtolower(substr($filecheck, strrpos($filecheck, '.') + 1));		
		if ( 	!(
					($ext == "jpg" || $ext == "jpeg" || $ext == "png") 
					&& 	(		$_FILES["transfer_receipt"]["type"] == "image/jpeg" 
							|| 	$_FILES["transfer_receipt"]["type"] == "image/jpg" 
							|| 	$_FILES["transfer_receipt"]["type"] == "image/png" ) 
					&& 	(	$_FILES["transfer_receipt"]["size"] < 2120000 )	
				)
		){			
			$this->session->set_flashdata("danger","File Format must be in JPG, JPEG, or PNG with Maximum File Size 2MB");			
			redirect("payment/confirm/".$order_id);		
		}

		//$folder_name 		= 	url_title($user->row()->user_, 'dash', TRUE);
		$upload_path		= 	'./uploads/bukti_pembayaran/';
		$allowed_types		=	'gif|jpg|png|jpeg';
		$file_name			= 	'transfer_receipt'; 
		$file_dokumen 		= 	$this->upload_files($upload_path,$allowed_types,$file_name);
		
		$insert_data		= array(
								
								'order_id'		=> $order_id,
								
								'bank_id'		=> $bank,
								
								'nama_pengirim'	=> $name,
								
								'payment_amount'=> $amount,
								
								'payment_date'	=> date("Y-m-d H:i:s"),
								
								'customer_id'	=> $this->session->userdata('id_customer')
		);
		
		if( $file_dokumen != '' ){
			$insert_data['bukti_transfer'] = $file_dokumen;
		}
		
		$this->model_utama->insert_data('payment_master',$insert_data);
		
		$order_master['order_confirm_date']	= date("Y-m-d H:i:s");
		$order_master['order_status']		= "confirm";
		
		$this->model_utama->update_data($order_id,'order_id','order_master',$order_master);
		
		$coupon_list		= $this->db->query("select * from order_products,coupon_master where order_products.coupon_code = coupon_master.coupon_code and order_products.order_id = '$order_id'");
		
		foreach($coupon_list->result() as $row)
		{
			$coupon_used['coupon_id']			= $row->coupon_master_id;
			$coupon_used['order_id']			= $order_id;
			$coupon_used['create_date']			= date("Y-m-d");
		
			$this->model_utama->insert_data('coupon_used', $coupon_used);
		}
		
		$sess_data = array(
						    'customer_account_name',
						    'customer_bank',
							'customer_amount_transfer'
					   );
		$this->session->unset_userdata($sess_data);

		redirect(base_url().'payment/transaction/'.$order_id);
	}
	
	function transaction( $order_id = 0)
	{
		$order_id			= $this->uri->segment(3);
		$order_list			= $this->db->query("select *,order_products.price as subtotal from order_master,order_products,product where order_master.order_id = order_products.order_id and order_products.product_id = product.product_id and order_master.order_id = '$order_id'");
		$payment			= $this->db->query("select * from payment_master where order_id = '$order_id' limit 1");
	
		if($this->uri->segment(3) == "" || $order_list->num_rows() == 0)
		{
			redirect(base_url());
		}
		elseif($payment->num_rows() == 0)
		{
			redirect(base_url()."payment/confirm/".$order_id);
		}
	
		$address			= $order_list->row()->customer_address_id;
		$bank_id			= $payment->row()->bank_id;
		$shipping_address	= $this->db->query("select * from customer_address where customer_address_id = '$address' limit 1");
	
		$judul				= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['bank']		= $this->db->query("select * from bank where bank_id = '$bank_id' limit 1");
		$data['address']	= $shipping_address;
		$data['order']		= $order_list;
		$data['payment']	= $payment->row();
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/payment/page_transaction';
		
		$this->load->view($this->front_folder.$this->themes_folder_name.'/template',$data);
	}
	
	function upload_files($upload_path,$allowed_types,$file_name,$remove_space=''){
	
		$config['upload_path'] 		= $upload_path;
		$config['allowed_types'] 	= $allowed_types;
		if( $remove_space != '' ){
			$config['remove_spaces'] 	= $remove_space;	
		}
		$this->load->library('upload', $config);
		
		if( !is_dir($upload_path) ){
			mkdir($upload_path, 0777, true);
			
		}
		
		if ( !$this->upload->do_upload($file_name) ){
			$file_dokumen	= '';
		}else{
			$dokumen		= $this->upload->data();
			$file_dokumen	= $dokumen['file_name'];
		}

		if( 	$file_dokumen != ''
			&&	( stripos($file_dokumen,'jpg') > 0	||	stripos($file_dokumen,'png') > 0 )
		){
			$config_array = array(
									'upload_path'	=>	$upload_path,
									'image_name'	=>	$file_dokumen	
								);
			$this->image_manipulation($config_array);
		}
		return $file_dokumen;
	}
	
	function image_manipulation($config_array){


		$this->load->library('image_lib');
 
		// CONFIGURE IMAGE LIBRARY
		$config['image_library']    = 'gd2';
		$config['source_image']     = $config_array['upload_path'].'/'.$config_array['image_name'];
		$config['new_image']        = $config_array['upload_path'].'/thumb_'.$config_array['image_name'];
		$config['create_thumb'] 	= TRUE;
		$config['maintain_ratio']   = false;
		$config['width']            = 375;
		$config['height']           = 375;
		$config['quality'] 			= 60;
		$config['thumb_marker'] 	= '';
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();

	}

}	