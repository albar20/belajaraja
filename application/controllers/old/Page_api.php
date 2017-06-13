<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class Page_api extends API_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/*=============================================
	
		USING
		=================================
		=>	
			url : http;//ecommerce.babastudio.net/page_api
			$_POST['request_method'] 	= 'detail';
			$_POST['page_slug'] 		= 'privacy-policy';

		
		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	GET DATA ( FROM MODEL )
		3.	RESPONSE JSON 
	=============================================*/
	public function detail()
	{
		/*=============================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		=============================================*/
		$data = $this->data_for_all_pages();


		if( isset($_POST['page_slug']) ){


			/*=============================================
				1.	GET DATA ( FROM MODEL )
			=============================================*/
			$page_slug			= $this->security->xss_clean($_POST['page_slug']);
			$data['segment_1']	= $page_slug;
			$page 				= $this->model_utama->cek_data($page_slug,'page_slug','page');
			
			if($page->num_rows() > 0){	
				$data['pages']		= $page = $page->row();
			}else{

				$data['pages'] 		= null;
			}

			/*=============================================
				3.	JSON DATA 
			=============================================*/
			$status 	= self::SUCCESS;
			$message 	= '';
		
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