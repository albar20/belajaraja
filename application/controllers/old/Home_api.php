<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class Home_api extends API_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/*=========================================================
		USING
		=================================
		=>	
			url : http;//ecommerce.babastudio.net/home_api
			$_POST['request_method'] 	= 'index';

				

		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	GET DATA ( FROM MODEL )
		3.	RESPONSE JSON 
	=========================================================*/
	public function index()
	{
		/*=============================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		=============================================*/
		$data = $this->data_for_all_pages();

		/*=============================================
			1.	GET DATA ( FROM MODEL )
		=============================================*/
		$this->load->model('home_model');
		$home_model = $this->home_model->index();
		$data['product'] 				= $home_model['product']->result();
		$data['slider_list'] 			= $home_model['slider_list']->result();
		
		/*=============================================
			3.	RESPONSE JSON 
		=============================================*/
		$status 	= self::SUCCESS;
		$message 	= '';
		$this->jsonout(	$status,
						$message, 
						$data
						);
		exit ;
	}

}