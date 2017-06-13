<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class My_order_api extends API_Controller {

	public function __construct()
	{
		parent::__construct();
	}


	/*=============================================
	
		USING
		=================================
		=>	
			url : http;//ecommerce.babastudio.net/my_order_api
			$_POST['request_method'] 	= 'index';
			$_POST['token'] 			= 'sfsdfuywejsdfu';


		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	GET DATA ( FROM MODEL )
		3.	RESPONSE JSON 
	=============================================*/
	public function index()
	{

		/*=============================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		=============================================*/
		$data = $this->data_for_all_pages();

		/*=============================================
			1.	GET DATA ( FROM MODEL )
		=============================================*/
		$customers = $this->db->query("SELECT * FROM customers where token='".$this->security->xss_clean($this->input->post('token'))."'")->row();
		$this->load->model('my_order_model');
		$my_order_model	 	= $this->my_order_model->index($customers->customer_id);
		$data['pending'] 	= $my_order_model['pending']->result_array();
		$data['confirm'] 	= $my_order_model['confirm']->result_array();
		$data['approve'] 	= $my_order_model['approve']->result_array();
		$data['cancel'] 	= $my_order_model['cancel']->result_array();

		/*=============================================
			3.	RESPONSE JSON 
		=============================================*/
		$status 	= self::SUCCESS;
		$message 	= $this->_success_message;
		$this->jsonout(	$status,
						$message, 
						$data
						);
		exit ;
	}


	/*===============================================
		
		USING
		=================================
		=>	
			url : http;//ecommerce.babastudio.net/my_order_api/lihat_pemesanan/$order_id
			$_POST['request_method'] 	= 'lihat_pemesanan';
			$_POST['token'] 			= 'sfsdfuywejsdfu';
			$_POST['order_id'] 			= 'ORD20160916071449000000CFJlRXiE';
		
	===============================================*/	
	public function lihat_pemesanan(){


		if( isset($_POST['order_id']) ){

			/*=============================================
				1.	DATA FOR ALL PAGE ( FROM api_controller )
			=============================================*/
			$data = $this->data_for_all_pages();

			/*=============================================
				1.	GET DATA ( FROM MODEL )
			=============================================*/
			$order_id = $this->security->xss_clean($this->input->post('order_id'));
			$this->load->model('my_order_model');
			$my_order_model	 			= $this->my_order_model->lihat_pemesanan( $order_id );
			$data['lihat_pemesanan'] 	= $my_order_model['lihat_pemesanan']->result_array();
			$data['raja_ongkir'] 		= $my_order_model['raja_ongkir'];	

			/*=============================================
				3.	JSON DATA 
			=============================================*/
			$status 	= self::SUCCESS;
			$message 	= $this->_success_message;
			
		}else{
			
			/*=============================================
				3.	JSON DATA 
			=============================================*/
			$status 		= self::ERROR;
			$message 		= $this->_post_variable_not_complete_message;
		}
		
		/*=============================================
			3.	RESPONSE JSON 
		=============================================*/
		$this->jsonout(	$status,
						$message, 
						$data
						);

		exit ;
	}

}