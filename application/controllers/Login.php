<?php 
/**
* 
*/
class Login extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->minify();
	}
	public function index(){
		$judul				= $this->setting->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/page_login';
		$limit 				= 4;
		$this->load->view($this->front_end_template, $data);
		$this->log_visitor('lihat halaman login');		
	}	
	function do_login(){
		$this->form_validation->set_rules('user','user','required');
		$this->form_validation->set_rules('password','password','required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('form_error',validation_errors());
			redirect('login');
		}else{
			 $user = $this->input->post('user');
			 $pass =  md5($this->input->post('password'));
			$log_user = $this->db->get_where('user',array('username'=>$user,'password'=>$pass));
			$log_email = $this->db->get_where('user',array('email'=>$user,'password'=>$pass));;			
			if ($log_user->num_rows() > 0) {
				$log_user = $log_user->row();
				$data = array(
					'username_user' => $log_user->username,
					'user_id_user' => $log_user->user_id,
					'logged_in_user' => TRUE 
					);
				$this->session->set_userdata($data);
				redirect('');
			}elseif($log_email->num_rows() > 0){
				$log_email = $log_email->row();
				$data = array(
					'username_user' => $log_email->username,
					'user_id_user' => $log_email->user_id,
					'logged_in_user' => TRUE 
					);
				$this->session->set_userdata($data);
				redirect('');
			}else{
				$this->index();
				$this->session->set_flashdata('error_login_user','Wrong username or password !');
			}
		}
	}
	function logout(){
		$data = array(
			'username_user',
					'user_id_user',
					'logged_in_user'
			);
		$this->session->unset_userdata($data);
		redirect('');
	}
}
 ?>