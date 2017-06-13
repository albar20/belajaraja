<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class subcategory extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola subcategory | '.$judul;
			$data['heading'] 		= "subcategory list";
			$data['page']			= 'admin/subcategory/page_list';
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat subcategory";
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
			$data['title'] 			= 'Halaman Tambah subcategory | '.$judul;
			$data['heading'] 		= 'Add subcategory List';
			$data['form_action'] 	= site_url('admin/subcategory/add_process');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['page']			= 'admin/subcategory/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data subcategory';
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
			$data['title'] 			= 'Halaman Tambah subcategory | '.$judul;
			$data['heading'] 		= 'Add subcategory List';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['form_action'] 	= site_url('admin/subcategory/add_process');
			$data['page']			= 'admin/subcategory/page_form';

			
			$this->form_validation->set_rules('subcategory_title', 'Title', 'required|min_length[3]|max_length[30]');
			$this->form_validation->set_rules('category_id', 'category id', 'required');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				

				$weleh = array (
								'subcategory_title' 	=> $this->security->xss_clean($this->input->post('subcategory_title')),
								'subcategory_slug' 		=> url_title($this->security->xss_clean($this->input->post('subcategory_title')), 'dash', TRUE),
								'category_id' 			=> $this->security->xss_clean($this->input->post('category_id')),
								);
				
				$this->model_utama->insert_data('subcategory', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data subcategory';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/subcategory/add', 'refresh');
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
			$log['activity']			= 'hapus data subcategory dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'subcategory_id','subcategory');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/subcategory');
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
			$data['title'] 			= 'Halaman Ubah subcategory | '.$judul;
			$data['heading'] 		= 'Update subcategory';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['form_action'] 	= site_url('admin/subcategory/update_process');

			$wew = $this->model_utama->get_detail($kode, 'subcategory_id', 'subcategory')->row();
			$this->session->set_userdata('kd_weleh', $wew->subcategory_id);
			
			$data['default']['subcategory_title'] 		= $wew->subcategory_title;		
			$data['default']['category_id']				= $wew->category_id;	
			$data['default']['subcategory_id'] 			= $wew->subcategory_id;
			
			$data['page']			= 'admin/subcategory/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data subcategory dengan id : '.$kode;
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
			$data['title'] 			= 'Halaman Ubah subcategory | '.$judul;
			$data['heading'] 		= 'Update subcategory';
			$data['form_action'] 	= site_url('admin/subcategory/update_process');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			
			$this->form_validation->set_rules('subcategory_title', 'Title', 'required|min_length[3]|max_length[30]');
			$this->form_validation->set_rules('category_id', 'category id', 'required');
			
			if ($this->form_validation->run() == TRUE)
			{

				$weleh = array ('subcategory_title' 	=> $this->security->xss_clean($this->input->post('subcategory_title')),
								'subcategory_slug' 		=> url_title($this->security->xss_clean($this->input->post('subcategory_title')), 'dash', TRUE),
								'category_id' 			=> $this->security->xss_clean($this->input->post('category_id'))
								);
				
				$this->model_utama->update_data($this->input->post('subcategory_id'),'subcategory_id','subcategory',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data subcategory dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/subcategory/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/subcategory/update/'.$this->input->post('subcategory_id'));
			}
			else
			{
				$data['page']			= 'admin/subcategory/page_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	

}

