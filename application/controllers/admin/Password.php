<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class password extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ganti Password | '.$judul;
			$data['heading'] 		= "Ganti Password";
			$data['page']			= 'admin/password/page_form';
			$data['form_action']	= site_url("admin/password/change");
			$this->load->view('admin/template', $data);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function change()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
		
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "Ubah Password";
			$this->model_utama->insert_data('log_user', $log);
		
			$this->form_validation->set_rules('old_password', 'Password Lama', 'required|max_length[255]');
			$this->form_validation->set_rules('new_password', 'Password Baru', 'required|max_length[255]');
			$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|max_length[255]');
			
			if ($this->form_validation->run() == TRUE)
			{
				$old_password		= md5($this->input->post('old_password'));
				$new_password		= $this->input->post('new_password');
				$confirm_password	= $this->input->post('confirm_password');
			
				$cek_password		= $this->db->query("select * from user where user_id = '$user_id' and password = '$old_password'");
				if($cek_password->num_rows() > 0)
				{
					if($new_password == $confirm_password)
					{
						$data['password']		= md5($new_password);
						
						$this->model_utama->update_data($user_id, 'user_id','user', $data);
					
						$this->session->set_flashdata("success","Password Berhasil Diganti");
						redirect('admin/password');
					}
					else
					{
						$this->session->set_flashdata("danger","Password Baru dan Konfirmasi Password Tidak Sama");
						redirect('admin/password');
					}
				}
				else
				{
					$this->session->set_flashdata("danger","Password Lama Salah");
					redirect('admin/password');
				}
			}	
			else
			{
				$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
				$data['title'] 			= 'Halaman Ganti Password | '.$judul;
				$data['heading'] 		= "Ganti Password";
				$data['page']			= 'admin/password/page_form';
				$data['form_action']	= site_url("admin/password/change");
				$this->load->view('admin/template', $data);
			}
			
		}
		else
		{
			redirect(base_url().'login');
		}
	}
}	