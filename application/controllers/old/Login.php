<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


/*=======================================================

	
	10.	SEND EMAIL
=======================================================*/

class login extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->minify();
	}	


	public function index()
	{	
		if($this->session->userdata('login_customers') == true)
		{
			redirect('dashboard');
		}else{
			$this->login_form();
		}
	}

	function error_404()
	{
		$judul					= $this->setting->website_name;
		$data['title'] 			= 'Page Not Found - Error 404 | '.$judul;
		$data['heading'] 		= 'Error 404 ';
		$this->load->view($this->front_end_template.'/page_404', $data);
	}

	
	function login_form()
	{	
	
		$judul					= $this->setting->website_name;	
		$data['judul'] 			= 'Login | '.$judul;
		$data['title'] 			= 'Login | '.$judul;
		$data['page'] 			= 'main/login_form';

		$this->load->view($this->front_end_template, $data);
		$this->log_visitor( "lihat halaman login" );
		
	}
	
	function login_process()
	{
		$judul					= $this->setting->website_name;	
		$data['judul'] 			= 'Login | '.$judul;
		$data['title'] 			= 'Login | '.$judul;
		$data['page'] 			= 'main/login_form';

		$this->form_validation->set_rules('customer_email', 'Email', 'required');
		$this->form_validation->set_rules('customer_password', 'Password', 'required');
			
		if ($this->form_validation->run() == TRUE)
		{
			$customer_email 	= $this->security->xss_clean($this->input->post('customer_email'));
			$password 			= md5( $this->security->xss_clean($this->input->post('customer_password')) );
			$query 				= $this->model_utama->cek_data2($customer_email,$password,'customer_email','customer_password','customers');		

			if($query->num_rows() > 0)
			{
				$customer = $query->row();
				
				$sess_data = array(
								   'id_customer'  		=> $customer->customer_id,
								   'login_customer' 	=> TRUE
							   );
				$this->session->set_userdata($sess_data);

				/*$log['user_id']			= $this->session->userdata('id_customer');
				$log['activity']		= 'login';
				$this->model_utama->insert_data('log_user', $log);*/
				redirect('my_account', 'refresh');
			}
			else{
				$this->session->set_flashdata('danger', 'the username and password you entered did not match our records. Please double-check and try again');
				redirect('login', 'refresh');
			}
		}

		$this->load->view($this->front_end_template, $data);
		$this->log_visitor( "lihat halaman login" );
		
	}
 

	/*=====================================================
		1.	REGISTER PROCESS
		2.	LOG VISITOR
	=====================================================*/
	function register_form()
	{
		
		$judul					= $this->setting->website_name;	
		$data['judul'] 			= 'Register | '.$judul;
		$data['title'] 			= $data['judul'];
		$data['page'] 			= 'main/register_form';	
		$data['form_action'] 	= 'register';

		/*===================================================
			1.	REGISTER PROCESS
		===================================================*/
		$redirect		=	'register';
		$upload_image 	= 	true;
		$view			= 	$this->front_end_template;
		$create_by		= 	'customer';
		$this->customer_register_helper(	$redirect,
											$upload_image,
											$view,
											$data,
											$create_by	
										);

		$this->log_visitor( "lihat halaman register" );
	}


	public function confirm_register( $key = ''){	


		if( $key == '' ){
			redirect('login', 'refresh');
		}

		$judul					= $this->setting->website_name;	
		$data['judul'] 			= 'Konfirmasi Registrasi | '.$judul;
		$data['title'] 			= $data['judul'];
		$data['page'] 			= 'main/confirm_register_form';
		$key 					=  $this->security->xss_clean( $key );

		$confirm_register = false;
		//$key = filter_var( $key, FILTER_SANITIZE_STRING);
		$this->db->where('customer_account_activation_key',$key);
		$query = $this->db->get('customers');
	
		if( count( $query->result() ) > 0 ){
			$datas = array(
							'customer_account_activation_key' 		=> '',
							'customer_account_status' 				=> '1'
					);
			$this->db->where('customer_account_activation_key', $key);
			$update_process  = $this->db->update('customers', $datas);
			if( $update_process ){
				$confirm_register = true;
			}
		}else{
			$confirm_register = false;
		}
		
		if( $confirm_register ){
			$this->session->set_flashdata('success', 'Your account is activated <a href="'.base_url().'login">Please Login</a>');
		}else{
			$this->session->set_flashdata('warning', 'Sorry Registration Failed, <a href="'.base_url().'register">Please Register again</a>');
		}

		$this->load->view( $this->front_end_template, $data);
	}	


	/*====================================================
		6.	FORGET PASSWORD
			1.	VARIABLE
			2.	VERIFICAITON 
			3.	SAVING DATA
			4.	SEND EMAIL LOST PASSWORD
	====================================================*/
	public function forget_password(){
		


		$judul					= $this->setting->website_name;	
		$data['judul'] 			= 'Forget Password | '.$judul;
		$data['page'] 			= 'main/forget_password_form';	
		$data['form_action'] 	= 'forget_password';
		$data['message'] 		= '';	


		$this->form_validation->set_rules('customer_fname', 'Nama Depan', 'required');
		$this->form_validation->set_rules('customer_email', 'Email', 'required');
			
		if ($this->form_validation->run() == TRUE)
		{
			if( isset($_POST['customer_fname']) ){


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
				$table = 'customers';
				$this->db->where('customer_fname',$after_sanitize_element['customer_fname']);
				$this->db->where('customer_email', $after_sanitize_element['customer_email']);
				$this->db->where('customer_account_status', '1');
				$query = $this->db->get($table);
				
				if( count( $query->result() ) > 0 ){
						
					/*====================================
						3.	SAVING DATA
					====================================*/
					$this->load->model('model_utama','',TRUE);
						
					$field = 'customer_email';
					$value = $after_sanitize_element['customer_email'];
					$random_hash = md5(uniqid(rand(), true));
					$datas = array(
								'customer_account_activation_key' => $random_hash
								);
					$query = $this->model_utama->update_data($value,$field,$table,$datas);
						
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
						$data['message'] =  'Reset password telah dikirimkan ke email anda';
					}else{
						$this->session->set_flashdata('warning', 'Sorry Reset Password Failed, Please Try Again !');
						$data['message'] =  'Sorry Reset Password Failed, Please Try Again !';
					}

				}else{
					$data['message'] =  'Sorry, This account is not exist !';
				}
			} // if( isset($_POST['customer_fname']) ){

		}

		$this->load->view( $this->front_end_template, $data);
		$this->log_visitor( "lihat halaman forget password" );
	}


	/*====================================================
		7.	RESET PASSWORD
			1.	CHECK IF RESET PASSWORK KEY EXIST 
	====================================================*/
	public function reset_password( $key = '' ){
		
		$judul							= $this->setting->website_name;	
		$data['judul'] 					= 'Reset Password | '.$judul;
		$data['page'] 					= 'main/reset_password_form';	
		$data['form_action'] 			= base_url().'reset_password/'.$key;	
		$data['allow_reset_password'] 	= false;
		$data['message']  				= '';

		if( $key == '' ){
			redirect('login', 'refresh');
		}
	
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


			if( isset($_POST['customer_password']) ){
				$value = $key;

				$this->form_validation->set_rules('customer_password', 'New password', 'required');
				$this->form_validation->set_rules('customer_password2', 'New re-password', 'required');
					
				if ($this->form_validation->run() == TRUE)
				{
					$customer_password 		= $this->security->xss_clean($this->input->post('customer_password'));
					$customer_password2 	= $this->security->xss_clean($this->input->post('customer_password2'));


					if( $customer_password != $customer_password2  ){
						$this->session->set_flashdata('warning', 'Password is not same !');
						$data['message'] 	= 'password is not same'; 	
					}else{

						$datas = array(
								'customer_password' 				=> md5($customer_password),
								'customer_account_activation_key' 	=> ''
								);
						$query = $this->model_utama->update_data($value,$field,$table,$datas);
						if( $query ){
							$data['message'] 	= 'your password is changed <a href="'.base_url().'login">Please Login</a>'; 	
						}else{
							$data['message'] 	= 'Sorry Reset Password Failed <a href="'.base_url().'forget_password">Please Try again</a>'; 	
						}
					}
				}

			}

		}

		$this->load->view( $this->front_end_template, $data);
	}


	function resend_emails()
	{
		$this->resend_email();
	}




	function logout()
	{
		if( $this->session->userdata('id_customer') ){
			$log['user_id']			= $this->session->userdata('id_customer');
		}else{
			$log['user_id']			= $this->session->userdata('id_user');
		}
		$log['activity']			= 'logout';
		$this->model_utama->insert_data('log_user', $log);
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}

	
}