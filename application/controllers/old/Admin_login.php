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

class Admin_login extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->minify();
	}	


	public function index()
	{	
		if($this->session->userdata('login_admin') == true){
			redirect('admin/dashboard');
		}
		if($this->session->userdata('login_manager') == true){
			redirect('manager/dashboard');
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
		$data['page'] 			= 'main/admin_login_form';

		$this->load->view($this->front_end_template, $data);
		$this->log_visitor( "lihat halaman login" );
	}
	
	function login_process()
	{
		$judul					= $this->setting->website_name;
		$data['judul'] 			= 'Login | '.$judul;
		$data['title'] 			= 'Login | '.$judul;
		$data['page'] 			= 'main/admin_login_form';

		$this->form_validation->set_rules('signin_username', 'username', 'required');
		$this->form_validation->set_rules('signin_password', 'password', 'required');
			
		if ($this->form_validation->run() == TRUE)
		{
			$user = $this->input->post('signin_username');
			$pass = md5($this->input->post('signin_password'));
			
			$query = $this->model_utama->cek_data2($user,$pass,'username','password','user');		

			if($query->num_rows() > 0)
			{
				$pengguna = $query->row();
				
				if($pengguna->user_status == 'user')
				{
					$sess_data = array(
								   'id_user'  		=> $pengguna->user_id,
								   'login_user' 	=> TRUE
							   );
				}
				elseif($pengguna->user_status == 'admin')
				{
					$sess_data = array(
								   'id_user'  		=> $pengguna->user_id,
								   'login_admin' 	=> TRUE
							   );
				}
				elseif($pengguna->user_status == 'manager')
				{
					$sess_data = array(
								   'id_user'  		=> $pengguna->user_id,
								   'login_user' 	=> TRUE
							   );
				}
				$this->session->set_userdata($sess_data);

				$log['user_id']			= $this->session->userdata('id_user');
				$log['activity']		= 'login';
				$this->model_utama->insert_data('log_user', $log);

				redirect('admin/dashboard', 'refresh');
			}
			else{
				$this->session->set_flashdata('danger', 'Username atau password is wrong!');
				redirect('admin/dashboard', 'refresh');
			}
		}

		$this->load->view($this->front_end_template, $data);
		$this->log_visitor( "lihat halaman login" );
		
	}
 


	function logout()
	{
		$log['user_id']			= $this->session->userdata('id_user');
		$log['activity']		= 'logout';
		$this->model_utama->insert_data('log_user', $log);

		$this->session->sess_destroy();
		redirect('admin', 'refresh');
	}
	
}