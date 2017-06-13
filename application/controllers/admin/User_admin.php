<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */
class user_admin extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola Pengguna Website | '.$judul;
			$data['heading'] 		= "Pengguna Website";
			$data['page']			= 'admin/user_admin/page_list';
			$data['user_list']		= $this->db->query("select * from user where user_id not in (select user_id from user_detail) order by create_date desc");
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat user";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	
	
	function add()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah Pengguna Website | '.$judul;
			$data['heading'] 		= 'Add Pengguna Website List';
			$data['form_action'] 	= site_url('index.php/admin/user_admin/add_process');
			$data['user_list']		= $this->model_utama->get_order('create_date','desc','user');
			$data['page']			= 'admin/user_admin/page_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data user';
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function add_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah Pengguna Website | '.$judul;
			$data['heading'] 		= 'Add Pengguna Website List';
			$data['user_list']	= $this->model_utama->get_order('create_date','desc','user');
			$data['form_action'] 	= site_url('index.php/admin/user_admin/add_process');
			$data['page']			= 'admin/user_admin/page_form';
			$this->form_validation->set_rules('user_name', 'Title', 'required|min_length[3]|max_length[255]');
				
			if ($this->form_validation->run() == TRUE)
			{
				$cek_username = $this->model_utama->cek_data($this->input->post('username'),'username','user');
				
				if($cek_username->num_rows() > 0) : 
					$this->session->set_flashdata('warning', 'Username sudah digunakan, silahkan gunakan username lain.');
					redirect('admin/user_admin/add','refresh');
				endif;
				$weleh = array (
								'user_name' 		=> $this->security->xss_clean($this->input->post('user_name')),
								'user_status' 		=> $this->security->xss_clean($this->input->post('user_status')),
								'username' 			=> $this->security->xss_clean($this->input->post('username')),
								'password' 			=> md5($this->security->xss_clean($this->input->post('password')))
								);
				$this->model_utama->insert_data('user', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data user';
				$this->model_utama->insert_data('log_user', $log);
				redirect('admin/user_admin/add', 'refresh');
			}
			else
			{
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function delete($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'hapus data user dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);
			$this->model_utama->delete_data($kode, 'user_id','user');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/user');
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function update($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah Pengguna Website | '.$judul;
			$data['heading'] 		= 'Update Pengguna Website';
			$data['form_action'] 	= site_url('index.php/admin/user_admin/update_process');
			$wew = $this->model_utama->get_detail($kode, 'user_id', 'user')->row();
			$this->session->set_userdata('kd_weleh', $wew->user_id);	
			$data['default']['user_name'] 	= $wew->user_name;	
			$data['default']['user_status'] = $wew->user_status;	
			$data['default']['username'] 	= $wew->username;
			$data['default']['password'] 	= '';		
			$data['default']['user_id'] 	= $wew->user_id;
			$data['page']			= 'admin/user_admin/page_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data user dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function update_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah Pengguna Website | '.$judul;
			$data['heading'] 		= 'Update Pengguna Website';
			$data['form_action'] 	= site_url('index.php/admin/user_admin/update_process');
			
			$this->form_validation->set_rules('user_name', 'Title', 'required|min_length[3]|max_length[255]');
			
			if ($this->form_validation->run() == TRUE)
			{
				$wew = $this->model_utama->get_detail($this->input->post('user_id'), 'user_id', 'user')->row();	
				if($this->input->post('password') == '')
				{
					$pass = $wew->password;
				}
				else
				{
					$pass = md5($this->security->xss_clean($this->input->post('password')));
				}
				$weleh = array (
								'user_name' 		=> $this->security->xss_clean($this->input->post('user_name')),
								'user_status' 		=> $this->security->xss_clean($this->input->post('user_status')),
								'username' 			=> $this->security->xss_clean($this->input->post('username')),
								'password' 			=> $pass
								);
				
				$this->model_utama->update_data($this->input->post('user_id'),'user_id','user',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data user dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/user_admin/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/user_admin/');
			}
			else
			{
				$data['page']			= 'admin/user_admin/page_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
}
