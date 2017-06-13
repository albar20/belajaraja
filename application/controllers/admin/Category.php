<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class category extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola Kategori | '.$judul;
			$data['heading'] 		= "Kategori";
			$data['page']			= 'admin/category/page_list';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat category";
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
			$data['title'] 			= 'Halaman Tambah Kategori | '.$judul;
			$data['heading'] 		= 'Add Kategori List';
			$data['form_action'] 	= site_url('admin/category/add_process');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['page']			= 'admin/category/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data category';
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
			$data['title'] 			= 'Halaman Tambah Kategori | '.$judul;
			$data['heading'] 		= 'Add Kategori List';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['form_action'] 	= site_url('admin/category/add_process');
			$data['page']			= 'admin/category/page_form';

			
			$this->form_validation->set_rules('category_title', 'Title', 'required|min_length[3]|max_length[30]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				
				$weleh = array (
								'category_title' 			=> $this->security->xss_clean($this->input->post('category_title')),
								'category_slug' 			=> url_title($this->security->xss_clean($this->input->post('category_title')), 'dash', TRUE)
								);
				
				$this->model_utama->insert_data('category', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data category';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/category/add', 'refresh');
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
			$log['activity']			= 'hapus data category dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'category_id','category');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/category');
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
			$data['title'] 			= 'Halaman Ubah Kategori | '.$judul;
			$data['heading'] 		= 'Update Kategori';
			$data['form_action'] 	= site_url('admin/category/update_process');

			$wew = $this->model_utama->get_detail($kode, 'category_id', 'category')->row();
			$this->session->set_userdata('kd_weleh', $wew->category_id);
			
			$data['default']['category_title'] 		= $wew->category_title;		
			$data['default']['category_id'] 			= $wew->category_id;
			
			$data['page']			= 'admin/category/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data category dengan id : '.$kode;
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
			$data['title'] 			= 'Halaman Ubah Kategori | '.$judul;
			$data['heading'] 		= 'Update Kategori';
			$data['form_action'] 	= site_url('admin/category/update_process');

			
			$this->form_validation->set_rules('category_title', 'Title', 'required|min_length[3]|max_length[30]');
			
			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'category_id', 'category')->row();	
				
				$weleh = array ('category_title' 			=> $this->security->xss_clean($this->input->post('category_title')),
								'category_slug' 			=> $this->security->xss_clean(url_title($this->input->post('category_title')), 'dash', TRUE),
								);
				
				$this->model_utama->update_data($this->input->post('category_id'),'category_id','category',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data category dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/category/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/category/update/'.$this->input->post('category_id'));
			}
			else
			{
				$data['page']			= 'admin/category/page_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	

}

