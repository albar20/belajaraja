<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */
class video extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola video | '.$judul;
			$data['heading'] 		= "video list";
			$data['page']			= 'admin/page_video';
			$data['video_list']	= $this->model_utama->get_order('create_date','desc','video');
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat video";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	
	
	function add()
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah video | '.$judul;
			$data['heading'] 		= 'Add video List';
			$data['form_action'] 	= site_url('admin/video/add_process');
			$data['video_list']	= $this->model_utama->get_order('create_date','desc','video');
			$data['page']			= 'admin/page_video_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data video';
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function add_process()
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah video | '.$judul;
			$data['heading'] 		= 'Add video List';
			$data['video_list']		= $this->model_utama->get_order('create_date','desc','video');
			$data['form_action'] 	= site_url('admin/video/add_process');
			$data['page']			= 'admin/page_video_form';
			
			$this->form_validation->set_rules('video_title', 'Title', 'required|min_length[3]');
			$this->form_validation->set_rules('video_description', 'Description', 'required|min_length[5]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$weleh = array (
								'video_title' 			=> $this->security->xss_clean($this->input->post('video_title')),
								'video_slug' 			=> url_title($this->security->xss_clean($this->input->post('video_title')), 'dash', TRUE),
								'video_link' 			=> $this->security->xss_clean($this->input->post('video_link')),
								'video_description' 	=> $this->security->xss_clean($this->input->post('video_description'))
								);
				
				$this->model_utama->insert_data('video', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data video';
				$this->model_utama->insert_data('log_user', $log);
				redirect('admin/video/add', 'refresh');
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
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true)
		{
			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'hapus data video dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);
			$this->model_utama->delete_data($kode, 'video_id','video');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/video');
		}
		else
		{
			redirect('login');
		}
	}
	
	function update($kode)
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah video | '.$judul;
			$data['heading'] 		= 'Update video';
			$data['form_action'] 	= site_url('admin/video/update_process');
			$wew = $this->model_utama->get_detail($kode, 'video_id', 'video')->row();
			$this->session->set_userdata('kd_weleh', $wew->video_id);
			
			$data['default']['video_title'] 			= $wew->video_title;		
			$data['default']['video_description']		= $wew->video_description;	
			$data['default']['video_link']			= $wew->video_link;	
			$data['default']['video_type']			= $wew->video_type;	
			$data['default']['video_picture'] 		= $wew->video_picture;
			$data['default']['video_id'] 				= $wew->video_id;
			
			$data['page']			= 'admin/page_video_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data video dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function update_process()
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah video | '.$judul;
			$data['heading'] 		= 'Update video';
			$data['form_action'] 	= site_url('admin/video/update_process');
			
			$this->form_validation->set_rules('video_title', 'Title', 'required|min_length[3]');
			$this->form_validation->set_rules('video_description', 'Description', 'required|min_length[5]');
			
			if ($this->form_validation->run() == TRUE)
			{
				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'video_id', 'video')->row();	
				
				$weleh = array ('video_title' 			=> $this->security->xss_clean($this->input->post('video_title')),
								'video_slug' 			=> url_title($this->security->xss_clean($this->input->post('video_title')), 'dash', TRUE),
								'video_link' 			=> $this->security->xss_clean($this->input->post('video_link')),
								'video_description' 	=> $this->security->xss_clean($this->input->post('video_description'))
								);
				
				$this->model_utama->update_data($this->input->post('video_id'),'video_id','video',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data video dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/video/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/video/update/'.$this->input->post('video_id'));
			}
			else
			{
				$data['page']			= 'admin/page_video_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	function video_list($kode)
	{	
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$wew = $this->model_utama->get_detail($kode, 'video_id', 'video')->row();
			$this->session->set_userdata('kd_weleh', $wew->video_id);
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola video '.ucwords($wew->video_title).' | '.$judul;
			$data['heading'] 		= 'Kelola video '.ucwords($wew->video_title);
			$data['form_action'] 	= site_url('admin/video/add_list_process');
			
			
			$data['default']['video_title'] 	= $wew->video_title;	
			$data['default']['video_slug']		= $wew->video_slug;
			$data['default']['video_id'] 		= $wew->video_id;
			$data['default']['video_type'] 	= $wew->video_type;
			$data['default']['video_link'] 	= $wew->video_link;
			$data['video_list_list']	= $this->model_utama->cek_data($wew->video_id,'video_id','video_list');
			
			$data['page']			= 'admin/video/page_video_list_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data video dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function add_list_process()
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true)
		{
			$user_id 					= $this->session->userdata('id_user');
			$judul						= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 				= 'Halaman Tambah video | '.$judul;
			$data['heading'] 			= 'Add video List';
			$data['video_list_list']	= $this->model_utama->cek_data($this->input->post('video_id'),'video_id','video_list');
			$data['form_action'] 		= site_url('admin/video/add_list_process');
			$data['page']				= 'admin/video/page_video_list_form';
			$wew = $this->model_utama->get_detail($this->input->post('video_id'), 'video_id', 'video')->row();
			
			$this->form_validation->set_rules('video_list_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('video_list_link', 'Link', 'max_length[255]');
			$this->form_validation->set_rules('video_list_type', 'Type', 'max_length[255]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$weleh = array (
								'video_list_title' 		=> $this->security->xss_clean($this->input->post('video_list_title')),
								'video_list_slug' 		=> url_title($this->security->xss_clean($this->input->post('video_list_title')), 'dash', TRUE),
								'video_list_link' 		=> $this->security->xss_clean($this->input->post('video_list_link')),
								'video_id' 				=> $this->security->xss_clean($this->input->post('video_id'))
								);
				
				$this->model_utama->insert_data('video_list', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data video_list';
				$this->model_utama->insert_data('log_user', $log);
				redirect('admin/video/video_list/'.$this->input->post('video_id'), 'refresh');
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
	function delete_list($kode)
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true)
		{
			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'hapus data video dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);
			$this->model_utama->delete_data($kode, 'video_list_id','video_list');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/video/video_list/'.$this->session->userdata('kd_weleh'));
		}
		else
		{
			redirect('login');
		}
	}
	function update_list($kode)
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah Gambar | '.$judul;
			$data['heading'] 		= 'Ubah Gambar';
			$data['form_action'] 	= site_url('admin/video/update_list_process/'.$kode);
			$wew = $this->model_utama->get_detail($kode, 'video_list_id', 'video_list')->row();
			$this->session->set_userdata('kd_weleh', $wew->video_id);
			$video = $this->model_utama->get_detail($wew->video_id, 'video_id', 'video')->row();
			
			$data['default']['video_list_title'] 	= $wew->video_list_title;		
			$data['default']['video_list_id'] 		= $wew->video_list_id;	
			$data['default']['video_id'] 				= $wew->video_id;
			// $data['default']['video_list_type'] 	= $wew->video_list_type;
			$data['default']['video_list_link'] 	= $wew->video_list_link;
			// $data['default']['video_list_list'] 	= $wew->video_list_list;
			$data['default']['video_slug'] 			= $video->video_slug;
			$data['video_list_list']	= $this->model_utama->cek_data($wew->video_id,'video_id','video_list');
			
			$data['page']			= 'admin/video/page_video_list_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data sub video lv 1 dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	function update_list_process($kode)
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah Gambar | '.$judul;
			$data['heading'] 		= 'Update Gambar';
			$data['form_action'] 	= site_url('admin/video/update_list_process');
			
			$this->form_validation->set_rules('video_list_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('video_list_link', 'Link', 'required|max_length[255]');
			$this->form_validation->set_rules('video_list_type', 'Type', 'max_length[255]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$wew = $this->model_utama->get_detail($this->input->post('video_list_id'), 'video_list_id', 'video_list')->row();
				$video = $this->model_utama->get_detail($this->input->post('video_id'), 'video_id', 'video')->row();
				
				$weleh = array (
								'video_list_title' 		=> $this->security->xss_clean($this->input->post('video_list_title')),
								'video_list_slug' 		=> url_title($this->security->xss_clean($this->input->post('video_list_title')), 'dash', TRUE),
								'video_list_link' 		=> $this->security->xss_clean($this->input->post('video_list_link'))
								);
				
				$this->model_utama->update_data($this->security->xss_clean($this->input->post('video_list_id')),'video_list_id','video_list',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data video dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/video/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/video/update_list/'.$kode);
			}
			else
			{
				$data['page']			= 'admin/video/page_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	
}
