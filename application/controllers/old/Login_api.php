<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class Login_api extends API_Controller {

	public function __construct()
	{
		parent::__construct();
	}


	/*=============================================
	
		USING
		=================================
		=>	
			url : http;//ecommerce.babastudio.net/login_api

			POST variables
			=====================
			$_POST['request_method'] 	= 'index';

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


	/*=============================================
	
		USING
		=================================
		=>	
			url : http;//ecommerce.babastudio.net/login_api/login_process

			POST variables
			=====================
			$_POST['request_method'] 		= 'login_process';
			$_POST['customer_email'] 		= 'kelly@yahoo.com';
			$_POST['customer_password'] 	= 'a';
		

		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	AUTHENTICATION
		3.	RESPONSE JSON 
	=============================================*/
	public function login_process()
	{
		/*=============================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		=============================================*/
		$data = $this->data_for_all_pages();


		/*=============================================
			2.	AUTHENTICATION
		=============================================*/
		if( 	isset($_POST['customer_email']) 
			&&	isset($_POST['customer_password']) 

		){
			$this->form_validation->set_rules('customer_email', 'Email', 'required');
			$this->form_validation->set_rules('customer_password', 'Password', 'required');
				
			if( $this->form_validation->run() == TRUE )
			{
				$customer_email 	= $this->security->xss_clean($this->input->post('customer_email'));
				$password 			= md5( $this->security->xss_clean($this->input->post('customer_password')) );
				$query 				= $this->model_utama->cek_data2($customer_email,$password,'customer_email','customer_password','customers');		
				if($query->num_rows() > 0)
				{	
					$customer = $query->row();

					/*=================================================================
						1.	CREATE TOKEN
					=================================================================*/	
					$token 			= md5(uniqid(rand(), true));
					$sql 			= "UPDATE customers SET token='".$token."' WHERE customer_id=".$customer->customer_id;

					$status 		= self::SUCCESS;
					$message 		= $this->_login_success_message;
					$this->_token 	= $token;
				}else{
					$status 		= self::ERROR;
					$message 		= $this->_login_unsuccess_message;
					$token 			= '';
				}
			}
		
		}else{

			/*=============================================
				3.	JSON DATA 
			=============================================*/
			$status 		= self::ERROR;
			$message 		= $this->_post_variable_not_complete_message;
			$token 			= '';

		}

		/*=============================================
			3.	RESPONSE JSON 
		=============================================*/
		$this->jsonout(	$status,
						$message, 
						$data,
						$token
						);
		exit ;
	}


	/*=============================================
	
		USING
		=================================
		=>	
			url : http;//ecommerce.babastudio.net/login_api/register_form

			POST variables
			=====================
			$_POST['request_method'] 					= 'register_form';
			$_POST['submit_button'] 					= 'true';
			$_POST['accept_terms_and_condition'] 		= '';
			$_POST['customer_fname'] 					= '';
			$_POST['customer_lname'] 					= '';
			$_POST['customer_sex'] 						= '';
			$_POST['customer_birthday'] 				= '';
			$_POST['customer_email'] 					= '';
			$_POST['customer_password'] 				= '';
			$_POST['customer_password2'] 				= '';
			$_POST['customer_photo'] 					= '';


		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	AUTHENTICATION
		3.	RESPONSE JSON 
	=============================================*/
	public function register_form()
	{
		/*====================================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		====================================================*/
		$data = $this->data_for_all_pages();
		
		/*====================================================
			2.	VALIDATION
		====================================================*/
		$email_exist 			= false;
		$password_not_same  	= false;
		$accept_term_not_check	= false;

		if( isset($_POST['submit_button']) ){

			$do_form_validation = true;
			if( !isset($_POST['accept_terms_and_condition']) ){
				$do_form_validation 	= false;
				$validation 			= false;
				$accept_term_not_check 	= true;
			}

			/*====================================================
				2.	VALIDATION RULES
			====================================================*/
			$this->form_validation->set_rules('customer_fname', 'Nama Depan', 'required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('customer_lname', 'Nama Belakang', 'required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('customer_sex', 'Jenis Kelamin', 'required');
			$this->form_validation->set_rules('customer_birthday', 'Tanggal Lahir', 'required');
			$this->form_validation->set_rules('customer_email', 'Email', 'required');
			$this->form_validation->set_rules('customer_password', 'Password', 'required');
			$this->form_validation->set_rules('customer_password2', 'Re-Password', 'required');

			if ($this->form_validation->run() == TRUE)
			{

				if( $do_form_validation ){

					/*====================================================
						2.	CHECK EMAIL
					====================================================*/
					$email 		= $this->input->post('customer_email');
					$cek_email	= $this->model_utama->cek_data($email,'customer_email','customers');


					if(count($cek_email->result_array()) <= 0){
							
						/*====================================================
							3.	CHECK PASSWORD MATCHES
						====================================================*/
						$password 	 = 	$this->security->xss_clean($this->input->post('customer_password'));
						$re_password = 	$this->security->xss_clean($this->input->post('customer_password2')); 

						if( $password == $re_password ){

								/*====================================================
									3.	UPLOAD IMAGE
								====================================================*/
								$config['upload_path'] 		= './uploads/customer/';
								$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
								
								$image_folder_path 			= 'uploads/customer/thumb';
								$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																					$config );

								/*====================================================
									4.	INSERT DATA 
								====================================================*/
								$random_hash 				= md5(uniqid(rand(), true));
								$customer_account_status  	= '0';
								$customer_activation_key 	= $random_hash;		

								$weleh = array (
												'customer_fname' 		=> $this->security->xss_clean($this->input->post('customer_fname')),
												'customer_photo' 		=> $this->security->xss_clean($file_dokumen),
												'customer_lname' 		=> $this->security->xss_clean($this->input->post('customer_lname')),
												'customer_sex' 			=> $this->security->xss_clean($this->input->post('customer_sex')),
												'customer_birthday' 	=> $this->date_converter($this->security->xss_clean($this->input->post('customer_birthday')),'','1'),
												'customer_email' 		=> $this->security->xss_clean($this->input->post('customer_email')),
												'customer_password' 				=> md5($password),
												'customer_account_status' 			=> $customer_account_status,
												'customer_account_activation_key' 	=> $customer_activation_key,
												'create_date'						=> date('Y-m-d H:i:s')
												);

								$query 		= $this->model_utama->insert_data('customers', $weleh);
								$insert_id 	= $this->db->insert_id();

								if( $query ){

									$sess_data = array(
								   		'resend_email_customer_id' => $insert_id
							   		);
									$this->session->set_userdata($sess_data);

									
									/*====================================
										5.	SEND EMAIL CONFIRM REGISTER
									====================================*/
									$actions 			=	'confirm_register';
									$recipient_email	= 	$this->security->xss_clean($this->input->post('customer_email'));			
									$result_send 		=	$this->send_email_when( $actions,
																					$recipient_email,
																					$random_hash
																					);
									if( $result_send ){
										//$result['register_process'] = true;
										$sql = "UPDATE customers SET email_terkirim='1' WHERE customer_id=".$insert_id;
										$this->db->query($sql);
									}else{
										//$result['register_process'] = false;
										$sql = "UPDATE customers SET email_terkirim='0' WHERE customer_id=".$insert_id;
										$this->db->query($sql);
									}

								}		

							/*====================================================
								SUCESS JSON RESPONSE
							====================================================*/	
							$status 	= self::SUCCESS;
							$message 	= $this->_register_success_message;
							$validation = true;	
							
						}else{ 
							$validation 		= false;
							$password_not_same 	= true;
							
						} // if( $password == $re_password ){


					}else{ 

						/*=============================================
							3.	JSON DATA 
						=============================================*/
						$validation 	= false;
						$email_exist 	= true;

					} // if(count($cek_email->result_array()) <= 0){
					
				}// if( $do_form_validation ){
				

			}else{ // if ($this->form_validation->run() == TRUE)
				$validation = false;
			}

			if( !$validation ){
				$status 		= self::ERROR;
				$message 		= $this->_validation_failed_message;

				$data['validation_error_message'] 	= $this->form_validation->error_array();
				if( $email_exist ){
					$data['validation_error_message']['email_exist'] 		=  $this->_email_exist_message;
				}
				if( $password_not_same ){
					$data['validation_error_message']['password_not_same'] 	=  $this->_password_not_same_message;
				}
				if( $accept_term_not_check ){
					$data['validation_error_message']['error_term_and_conditions'] 	= $this->_error_term_and_conditions;
				}
			}

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
		exit;
	}


	/*=============================================
	
		USING
		=================================
		=>	
			url : 	http://ecommerce.babastudio.net/login_api/forget_password

			POST variables
			=====================
			$_POST['request_method'] 			= 'forget_password';
			$_POST['submit_button'] 			= 'true';
			$_POST['customer_fname'] 			= '';
			$_POST['customer_lname'] 			= '';
			

		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	GET DATA ( FROM MODEL )
		3.	RESPONSE JSON 
	=============================================*/
	public function forget_password(){
		
		$account_not_exist 		= false;

		/*====================================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		====================================================*/
		$data = $this->data_for_all_pages();

		/*====================================================
			2.	VALIDATION
		====================================================*/
		if( 	isset($_POST['submit_button']) 
			&&	isset($_POST['customer_fname']) 
			&&	isset($_POST['customer_email']) 
		){

			$this->form_validation->set_rules('customer_fname', 'Nama Depan', 'required');
			$this->form_validation->set_rules('customer_email', 'Email', 'required');
				
			if ($this->form_validation->run() == TRUE)
			{
				$form_element = array(
									array(
										'name'					=> 'customer_fname',
										'label' 				=> 'Nama Depan',
										'validation_rules' 		=> 'required'
										),
									array(
										'name'					=> 'customer_email',
										'label' 				=> 'Email',
										'validation_rules' 		=> 'required|valid_email'
										)
								);

				/*============================================
					3.	SANITIZING
				============================================*/
				$after_sanitize_element 	= $this->sanitizing( $form_element );
					
				/*====================================
					2.	VERIFICAITON 
				====================================*/
				$table 	= 'customers';
				$this->db->where('customer_fname',$after_sanitize_element['customer_fname']);
				$this->db->where('customer_email', $after_sanitize_element['customer_email']);
				$this->db->where('customer_account_status', '1');
				$query = $this->db->get($table);
				
				if( count( $query->result() ) > 0 ){
						
					/*====================================
						3.	SAVING DATA
					====================================*/
					$this->load->model('model_utama','',TRUE);
						
					$field 			= 	'customer_email';
					$value 			= 	$after_sanitize_element['customer_email'];
					$random_hash 	= 	md5(uniqid(rand(), true));
					$datas 			= 	array(
											'customer_account_activation_key' => $random_hash
										);
					$query	 		= 	$this->model_utama->update_data($value,$field,$table,$datas);
						
					/*====================================
						4.	SEND EMAIL LOST PASSWORD
					====================================*/
					$forget_password['forget_password_process'] = false;
					if( $query ){
						
						$actions 			=	'lost_password';
						$recipient_email	= 	$after_sanitize_element['customer_email'];
						$result_send 		=	$this->send_email_when( $actions,
																		$recipient_email,
																		$random_hash
																		);
						if( $result_send ){
							$forget_password['forget_password_process'] = true;
						}else{
							$field = 'customer_email';
							$value = $after_sanitize_element['customer_email'];
							$datas = array(
										'customer_account_activation_key' => ''
										);
							$query = $this->model_utama->update_data($value,$field,$table,$datas);
							$forget_password['forget_password_process'] = false;
						}
					}

					if( $forget_password['forget_password_process'] ){
						/*====================================================
							SUCCESS JSON RESPONSE
						====================================================*/	
						$status 		= self::SUCCESS;
						$message 		= $this->_success_message;
						$validation 	= true;

					}else{

						/*====================================================
							FAILED JSON RESPONSE
						====================================================*/	
						$status 		= self::ERROR;
						$message 		= $this->_reset_password_failed_message;
						$validation 	= true;
					}

				}else{
					$account_not_exist 	= true;
					$validation 		= false;
				}

			}else{
				$validation 	= false;
			}

			if( !$validation ){
				$status 		= self::ERROR;
				$message 		= "validation false";
				$data['validation_error_message'] 	= $this->form_validation->error_array();
				if( $account_not_exist ){
					$data['validation_error_message']['account_not_exist'] 	=  $this->_account_not_exist_message;
				}
			}

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



	/*=============================================
	
		USING
		=================================
		=>	
			url : http;//ecommerce.babastudio.net/login_api/reset_passsword/$key
			url : http;//ecommerce.babastudio.net/login_api/reset_passsword/3454hfs87dh3

			POST variables
			=====================
			$_POST['request_method'] 			= 'reset_password';
			$_POST['customer_password'] 		= '';
			$_POST['customer_password2'] 		= '';
	

		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	GET DATA ( FROM MODEL )
		3.	RESPONSE JSON 
	=============================================*/
	public function reset_password( $key='' ){
		
		$password_not_same 	= false;
		$key 				= $this->security->xss_clean($this->segment_3);


		/*====================================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		====================================================*/
		$data = $this->data_for_all_pages();

		/*====================================================
			2.	VALIDATION
		====================================================*/
		if( $key != '' ){	
			
			/*====================================================
				1.	CHECK IF RESET PASSWORK KEY EXIST 
			====================================================*/
			$this->load->model('model_utama','',TRUE);
			$field = 'customer_account_activation_key';
			$table = 'customers';
			$this->db->where($field ,$key);
			$query = $this->db->get($table);


			if( count( $query->result() ) > 0 ){
				
				$data['allow_reset_password'] = true;	

				if( 	isset($_POST['customer_password']) 
					&&	isset($_POST['customer_password2']) 
				){
					$value = $key;

					$this->form_validation->set_rules('customer_password', 'New password', 'required');
					$this->form_validation->set_rules('customer_password2', 'New re-password', 'required');
						
					if ($this->form_validation->run() == TRUE)
					{
						$customer_password 		= $this->security->xss_clean($this->input->post('customer_password'));
						$customer_password2 	= $this->security->xss_clean($this->input->post('customer_password2'));

						if( $customer_password != $customer_password2  ){
							$validation 			= false;
							$password_not_same 		= true;
						}else{

							$datas = array(
									'customer_password' 				=> md5($customer_password),
									'customer_account_activation_key' 	=> ''
									);
							$query = $this->model_utama->update_data($value,$field,$table,$datas);
							if( $query ){
						

								/*====================================================
									SUCCESS JSON RESPONSE
								====================================================*/	
								$status 		= self::SUCCESS;
								$message 		= $this->_success_message;
								$validation 	= true;

							}else{
								$status 		= self::ERROR;
								$message 		= $this->_reset_password_failed_message;
								$validation 	= true;
							}
						}
					
					}else{
						$validation 		= false;
					}

					if( !$validation ){
						$status 		= self::ERROR;
						$message 		= "validation false";
						$data['validation_error_message'] 	= $this->form_validation->error_array();
						if( $password_not_same ){
							$data['validation_error_message']['password_not_same'] 	=  $this->_password_not_same_message;
						}
					}
				}else{
					$status 		= self::ERROR;
					$message 		= $this->_post_variable_not_complete_message;
				}

			}else{
				$status 	= self::ERROR;
				$message 	= $this->_reset_password_failed_message;
			}
		
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
		$token 			= '';
		$this->jsonout(	$status,
						$message, 
						$data
						);

		exit ;
	}


	/*=============================================
	
		USING
		=================================
		=>	
			url : http;//ecommerce.babastudio.net/login_api/logout

			POST variables
			=====================
			$_POST['token'] 			= '';
	

		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	GET DATA ( FROM MODEL )
		3.	RESPONSE JSON 
	=============================================*/
	function logout()
	{
		/*====================================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		====================================================*/
		$data = $this->data_for_all_pages();

		if( isset($_POST['token']) ){

			$token = $this->security->xss_clean($this->input->post('token'));

			//$result['register_process'] = false;
			$sql = "UPDATE customers SET token='' WHERE token='".$token."'";
			$this->db->query($sql);

			/*=============================================
				3.	JSON DATA 
			=============================================*/
			$status 		= self::SUCCESS;
			$message 		= $this->_logout_success_message;

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
		$token 			= '';
		$this->jsonout(	$status,
						$message, 
						$data
						);
		exit ;
	}


}