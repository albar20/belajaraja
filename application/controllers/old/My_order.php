<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class My_order extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		if( !$this->session->userdata('login_customer') == true)
		{
			redirect('login', 'refresh');
		}
		$this->minify();
	}


	/*=================================================================
		1.	INSERT CUSTOMER ADDRESS DATA 
		2.	UPDATE CUSTOMER ADDRESS DATA
	=================================================================*/
	public function index()
	{	
	
		$judul				= $this->setting->website_name;
		$data['judul'] 		= 'My Order List | '.$judul;
		$data['title'] 		= $data['judul'];
		$data['header']		= 'My Order List';
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/my_order/my_order';
		$log['user_id']		= $this->session->userdata('id_customer');

		/*=============================================
			1.	GET DATA ( FROM MODEL )
		=============================================*/
		$customer_id = $log['user_id'];
		$this->load->model('my_order_model');
		$my_order_model	 	= $this->my_order_model->index($customer_id);
		$data['pending'] 	= $my_order_model['pending'];
		$data['confirm'] 	= $my_order_model['confirm'];	
		$data['approve'] 	= $my_order_model['approve'];
		$data['cancel'] 	= $my_order_model['cancel'];
	
		$log['activity']		= "lihat my_order";
		$this->model_utama->insert_data('log_user', $log);
		$this->load->view($this->front_end_template, $data);
	}

	public function lihat_pemesanan( $order_id ){

		$user_id 				= $this->session->userdata('id_user');
		$judul					= $this->setting->website_name;
		$data['title'] 			= 'My Order Detail Page | '.$judul;
		$data['heading'] 		= "My Order Detail Page";
		$data['page']			= $this->front_folder.$this->themes_folder_name.'/my_order/lihat_pemesanan';
		
		/*=============================================
			1.	GET DATA ( FROM MODEL )
		=============================================*/
		$this->load->model('my_order_model');
		$my_order_model	 			= $this->my_order_model->lihat_pemesanan( $order_id );
		$data['lihat_pemesanan'] 	= $my_order_model['lihat_pemesanan'];
		$data['raja_ongkir'] 		= $my_order_model['raja_ongkir'];	

		$log['user_id']			= $this->session->userdata('id_customer');
		$log['activity']		= "lihat my_order lihat pemesanan";
		$this->model_utama->insert_data('log_user', $log);
		
		$this->load->view($this->front_end_template, $data);
	}

	


}