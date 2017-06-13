<?php 
/**
* 
*/
class Regis_user extends MY_Controller
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
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/page_regis_user';
		$data['error']  	= "";
		$limit 				= 4;
		$this->load->view($this->front_end_template, $data);
		$this->log_visitor('lihat halaman Register User');		
	}
	public function save_user(){
		$this->form_validation->set_rules('name','Full Name','required');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','required|min_length[6]');
		$this->form_validation->set_rules('repassword','Retype Password','required|matches[password]|min_length[6]');
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		}else{
		   	 	$config['upload_path']          = './uploads/infongetrip/user/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 700;
                $config['max_height']           = 400;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('fileToUpload'))
                {
                     $data['error'] 	=  $this->upload->display_errors();
                      $judul 			= $this->setting->website_name;
					$data['judul'] 		= ''.$judul;
					$data['title'] 		= $data['judul'];
					$data['page']		= $this->front_folder.$this->themes_folder_name.'/page_regis_user';
					$this->load->view($this->front_end_template, $data);
                }else{
                	$data_user = array(
					'user_name' => $this->input->post('name'),
					'username' => $this->input->post('username'),
					'password' => md5($this->input->post('password')),
					'email' => $this->input->post('email'),
					'picture' => $_FILES["fileToUpload"]["name"],
					'email_code' => random_string('alpha',20)
					);
                	$this->db->insert('user',$data_user);
                	$this->session->set_flashdata('success_save_user','Success Save User, Lets Login!');
                	redirect('login');

     //            	$this->email->from('tugaskomputer8a@gmail.com','Info Ngetrip');
     //            	$this->email->to($this->input->post('email'));
					// $this->email->subject('Test email from CI and Gmail');
					// $this->email->message('This is a test.');
					// if ( ! $this->email->send())
					// {
			 	// show_error($this->email->print_debugger());       // Generate error
					// }

			}
				}}

		public function lost_password(){
		$judul				= $this->setting->website_name;
		$data['captcha']	= $this->generate_captcha();
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/page_lost_password';
		$data['error']  	= "";
		$limit 				= 4;
		$this->load->view($this->front_end_template, $data);
		$this->log_visitor('lihat halaman Lost Password');	

		}	
		public function do_lost_password(){
			$cap = str_replace(' ', '', $this->input->post('captcha'));
			$tex = str_replace(' ', '', $this->input->post('text_cap'));
		
		if ($cap ==  $tex ) {
			$this->form_validation->set_rules('email','email','required|valid_email');
			$email = $this->input->post('email');
			$cek = $this->db->get_where('user',array('email'=>$email))->num_rows();
		if ($this->form_validation->run() == FALSE) {
			$this->lost_password();
		}elseif (empty($cek)) {
			$this->session->set_flashdata('not_found_email','Email Not Found!');
			redirect('regis_user/lost_password');
		}
		else{
			
			$get_code = $this->db->get_where('user',array('email' => $email))->row();
			$email_code =  $get_code->email_code;
	        $this->email->from('tugaskomputer8a@gmail.com','Info Ngetrip');
        	$this->email->to($email);
			$this->email->subject('Verfication Email');
			$link = base_url()."regis_user/reset_password/";
			$this->email->message('Please Follow this link '.$link.$email_code);
			if ( ! $this->email->send())
					{
		 	show_error($this->email->print_debugger());       // Generate error
					}else{
						$this->session->set_flashdata('success_send','Please check your email , We\'ll send link for update password');
						redirect('regis_user/lost_password');	
					}
				}
			}else{
				$this->session->set_flashdata('wrong_captcha','Text Captcha is Wrong?? Please Check again');
				redirect('regis_user/lost_password');

			}
			}

		public function reset_password($email_code){
		$judul				= $this->setting->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/page_reset_password';
		$limit 				= 4;
		$data['name']		= $this->db->get_where('user',array('email_code' => $email_code))->row();
		$this->load->view($this->front_end_template, $data);
		$this->log_visitor('lihat halaman reset Password');	
		}
		public function do_reset_password(){
		$email_code = $this->input->post('email_code');
		$this->form_validation->set_rules('password','Password','required|min_length[6]');
		$this->form_validation->set_rules('repassword','Retype Password','required|matches[password]|min_length[6]');
		if ($this->form_validation->run() == FALSE) {
			$this->reset_password($email_code);
		}else{
			$data = array(
				'password' => md5($this->input->post('password')),
				'email_code' => random_string('alpha',20)
				);
			$this->db->where('email_code',$this->input->post('email_code'));
			$this->db->update('user',$data);
			$this->session->set_flashdata('success_set_password','Password already change , Please Login again?');
			redirect('login');
		}	 
		}



}
 ?>
