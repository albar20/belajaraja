<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */
class Kontak_api extends API_Controller {

	public function __construct()
	{
		parent::__construct();
	}


	/*=====================================================================================
		
		USING
		=================================
		=>	
			url : http://localhost/asiaedu/kontak_api
			$_POST['request_method'] 	= 'index';

	=====================================================================================*/	
	public function index()
	{	
		/*===================================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
				1.	CAPTCHA
		===================================================*/
		$data 				= $this->data_for_all_pages();	
		$data['pages']		= $this->model_utama->cek_data('kontak','page_slug','page')->row();
		
			/*===================================================
				1.	CAPTCHA
					is being handled by mobile application
			===================================================*/
			/*$random_number 		= rand(1,20);
			$random_number2 	= rand(1,20);
			$hasil				= $random_number + $random_number2; 
			$this->session->set_userdata('login_captcha', $hasil);
			// store image html code in a variable
			$data['captcha'] = $random_number.' + '.$random_number2.' =';*/

		$status 		= self::SUCCESS;
		$message 		= '';
		$this->jsonout(	$status,
						$message, 
						$data
						);
		exit ;		
	}



	/*=====================================================================================
		USING
		=================================
		=>	
			url : http://localhost/asiaedu/kontak_process
			$_POST['request_method'] 	= 'kontak_process';
			$_POST['nama'] 				= '';
			$_POST['email'] 			= '';
			$_POST['message'] 			= '';
			$_POST['phone'] 			= '';
			$_POST['ip_address'] 		= '';

	=====================================================================================*/	
	function kontak_process()
	{
		/*===================================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		===================================================*/
		$data 				= $this->data_for_all_pages();	
		$data['pages']		= $this->model_utama->cek_data('kontak','page_slug','page')->row();

		if( isset($_POST['submit_button']) ){


			$this->form_validation->set_rules('nama', 'Name', 'required');
			//$this->form_validation->set_rules('phone', 'Phone', 'numeric');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('message', 'Message', 'min_length[5]');

			if( $this->form_validation->run() == TRUE )
			{
								
				$weleh['nama'] 			= $this->security->xss_clean(strip_tags(addslashes($this->input->post('nama'))));
				$weleh['email'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('email'))));
				$weleh['message'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('message'))));
				$weleh['phone'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('phone'))));
				$weleh['ip_address']	= $this->input->ip_address();
				$this->model_utama->insert_data('suara',$weleh);


				/*====================================================
					SUCESS JSON RESPONSE
				====================================================*/	
				$status 	= self::SUCCESS;
				$message 	= $this->_success_message ;
				$validation = true;	

			}else{
				$validation = false;
			}

			if( !$validation ){
				$status 		= self::ERROR;
				$message 		= $this->_validation_failed_message;
				$data['validation_error_message'] 	= $this->form_validation->error_array();
			}

		}else{
			$status 		= self::ERROR;
			$message 		= $this->_post_variable_not_complete_message;
		}

		$this->jsonout(		$status,
							$message, 
							$data
						);
		exit ;
	}
	
}