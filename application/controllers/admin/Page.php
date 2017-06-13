<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class page extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola page | '.$judul;
			$data['heading'] 		= "page list";
			$data['page']			= 'admin/page/page_list';
			$data['page_list']	= $this->model_utama->get_order('create_date','desc','page');
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat page";
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
			$data['title'] 			= 'Halaman Tambah page | '.$judul;
			$data['heading'] 		= 'Add page List';
			$data['form_action'] 	= site_url('admin/page/add_process');
			$data['page_list']	= $this->model_utama->get_order('create_date','desc','page');
			$data['page']			= 'admin/page/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data page';
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
			$data['title'] 			= 'Halaman Tambah page | '.$judul;
			$data['heading'] 		= 'Add page List';
			$data['page_list']		= $this->model_utama->get_order('create_date','desc','page');
			$data['form_action'] 	= site_url('admin/page/add_process');
			$data['page']			= 'admin/page/page_form';

			
			$this->form_validation->set_rules('page_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('page_subtitle', 'Subtitle', 'min_length[5]');
			$this->form_validation->set_rules('page_description', 'Description', 'min_length[5]');
			// $this->form_validation->set_rules('page_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('page_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('page_link', 'Link', 'min_length[1]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$page_slug 					= url_title($this->input->post('page_title'), 'dash', TRUE);
				$config['upload_path'] 		= './uploads/page/'.$page_slug;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
				
				$image_folder_path 			= 'uploads/page/'.$page_slug.'/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );
				$weleh = array (
								'page_title' 			=> $this->security->xss_clean($this->input->post('page_title')),
								'page_subtitle' 		=> $this->security->xss_clean($this->input->post('page_subtitle')),
								'user_id'	 			=> $user_id,
								'page_slug' 			=> $page_slug,
								'page_link' 			=> $this->security->xss_clean($this->input->post('page_link')),
								'page_picture' 			=> $file_dokumen,
								'page_description' 		=> $this->security->xss_clean($this->input->post('page_description')),
								'page_type' 			=> $this->security->xss_clean($this->input->post('page_type')),
								// 'page_date' 			=> date('Y-m-d',strtotime($this->input->post('page_date')))
								);
				
				$this->model_utama->insert_data('page', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data page';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/page/add', 'refresh');
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
			$log['activity']			= 'hapus data page dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'page_id','page');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/page');
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
			$data['title'] 			= 'Halaman Ubah page | '.$judul;
			$data['heading'] 		= 'Update page';
			$data['form_action'] 	= site_url('admin/page/update_process');

			$wew = $this->model_utama->get_detail($kode, 'page_id', 'page')->row_array();
			$this->session->set_userdata('kd_weleh', $wew['page_id']);
			
			$data['default'] 		= $wew;
			
			$data['page']			= 'admin/page/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data page dengan id : '.$kode;
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
			$data['title'] 			= 'Halaman Ubah page | '.$judul;
			$data['heading'] 		= 'Update page';
			$data['form_action'] 	= site_url('admin/page/update_process');

			$this->form_validation->set_rules('page_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('page_subtitle', 'Subtitle', 'min_length[5]');
			$this->form_validation->set_rules('page_description', 'Description', 'min_length[5]');
			// $this->form_validation->set_rules('page_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('page_type', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('page_link', 'Link', 'min_length[1]');
			
			if ($this->form_validation->run() == TRUE)
			{

				$wew 						=  $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'page_id', 'page')->row();	
				$page_slug 					=  url_title( $this->security->xss_clean($this->input->post('page_title')), 'dash', TRUE);
				
				$page_slug 					= url_title($this->input->post('page_title'), 'dash', TRUE);
				$config['upload_path'] 		= './uploads/page/'.$page_slug;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
				
				$image_folder_path 			= 'uploads/page/'.$page_slug.'/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );
				$weleh = array (		
								'page_title' 		=> $this->security->xss_clean($this->input->post('page_title')),
								'page_subtitle' 	=> $this->security->xss_clean($this->input->post('page_subtitle')),
								'user_id'	 		=> $user_id,
								'page_slug' 		=> $page_slug,
								'page_link' 		=> $this->security->xss_clean($this->input->post('page_link')),
								'page_description' 	=> $this->security->xss_clean($this->input->post('page_description')),
								'page_type' 		=> $this->security->xss_clean($this->input->post('page_type')),
								// 'page_date' 		=> date('Y-m-d',strtotime($this->input->post('page_date')))
								);
				if( $file_dokumen != '' ){
					$weleh['page_picture']	= $file_dokumen;
				}
				
				$this->model_utama->update_data($this->input->post('page_id'),'page_id','page',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data page dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/page/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/page/update/'.$this->input->post('page_id'));
			}
			else
			{
				$data['page']			= 'admin/page/page_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	

}
