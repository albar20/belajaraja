<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */
class galeri_category extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola Kategori Galeri | '.$judul;
			$data['heading'] 		= "Kategori Galeri";
			$data['page']			= 'admin/galeri_category/page_list';
			$data['galeri_category_list']	= $this->model_utama->get_order('create_date','desc','galeri_category');
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat galeri_category";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	
	
	function add()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah Kategori Galeri | '.$judul;
			$data['heading'] 		= 'Add Kategori Galeri List';
			$data['form_action'] 	= site_url('admin/galeri_category/add_process');
			$data['galeri_category_list']	= $this->model_utama->get_order('create_date','desc','galeri_category');
			$data['page']			= 'admin/galeri_category/page_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data galeri_category';
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function add_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah Kategori Galeri | '.$judul;
			$data['heading'] 		= 'Add Kategori Galeri List';
			$data['galeri_category_list']	= $this->model_utama->get_order('create_date','desc','galeri_category');
			$data['form_action'] 	= site_url('admin/galeri_category/add_process');
			$data['page']			= 'admin/galeri_category/page_form';
			
			$this->form_validation->set_rules('galeri_category_title', 'Title', 'required|min_length[3]|max_length[30]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				
				$weleh = array (
								'galeri_category_title' 		=> $this->security->xss_clean($this->input->post('galeri_category_title')),
								'galeri_category_slug' 			=> url_title($this->security->xss_clean($this->input->post('galeri_category_title')), 'dash', TRUE)
								);
				
				$this->model_utama->insert_data('galeri_category', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data galeri_category';
				$this->model_utama->insert_data('log_user', $log);
				redirect('admin/galeri_category/add', 'refresh');
			}
			else
			{
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	
	function delete($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'hapus data galeri_category dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);
			$this->model_utama->delete_data($kode, 'galeri_category_id','galeri_category');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/galeri_category');
		}
		else
		{
			redirect('login');
		}
	}
	
	function update($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah Kategori Galeri | '.$judul;
			$data['heading'] 		= 'Update Kategori Galeri';
			$data['form_action'] 	= site_url('admin/galeri_category/update_process');
			$wew = $this->model_utama->get_detail($kode, 'galeri_category_id', 'galeri_category')->row();
			$this->session->set_userdata('kd_weleh', $wew->galeri_category_id);
			
			$data['default']['galeri_category_title'] 		= $wew->galeri_category_title;		
			$data['default']['galeri_category_id'] 			= $wew->galeri_category_id;
			
			$data['page']			= 'admin/galeri_category/page_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data galeri_category dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function update_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah Kategori Galeri | '.$judul;
			$data['heading'] 		= 'Update Kategori Galeri';
			$data['form_action'] 	= site_url('admin/galeri_category/update_process');
			
			$this->form_validation->set_rules('galeri_category_title', 'Title', 'required|min_length[3]|max_length[30]');
			
			if ($this->form_validation->run() == TRUE)
			{
				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'galeri_category_id', 'galeri_category')->row();	
				
				$weleh = array ('galeri_category_title' 		=> $this->security->xss_clean($this->input->post('galeri_category_title')),
								'galeri_category_slug' 			=> url_title($this->security->xss_clean($this->input->post('galeri_category_title')), 'dash', TRUE),
								);
				
				$this->model_utama->update_data($this->input->post('galeri_category_id'),'galeri_category_id','galeri_category',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data galeri_category dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/galeri_category/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/galeri_category/update/'.$this->input->post('galeri_category_id'));
			}
			else
			{
				$data['page']			= 'admin/galeri_category/page_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	
}
