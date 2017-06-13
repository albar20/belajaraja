<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */
class galeri extends MY_Controller {
	
	public function index()
	{	

		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola galeri | '.$judul;
			$data['heading'] 		= "galeri list";
			$data['page']			= 'admin/page_galeri';
			$data['galeri_list']	= $this->model_utama->get_order('create_date','desc','galeri');
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat galeri";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function add()
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah galeri | '.$judul;
			$data['heading'] 		= 'Add galeri List';
			$data['form_action'] 	= site_url('admin/galeri/add_process');
			$data['galeri_list']	= $this->model_utama->get_order('create_date','desc','galeri');
			$data['galeri_category_list']	= $this->model_utama->get_order('galeri_category_title','asc','galeri_category');
			$data['page']			= 'admin/page_galeri_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data galeri';
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function add_process()
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah galeri | '.$judul;
			$data['heading'] 		= 'Add galeri List';
			$data['galeri_list']	= $this->model_utama->get_order('create_date','desc','galeri');
			$data['galeri_category_list']	= $this->model_utama->get_order('galeri_category_title','asc','galeri_category');
			$data['form_action'] 	= site_url('admin/galeri/add_process');
			$data['page']			= 'admin/page_galeri_form';
			
			$this->form_validation->set_rules('galeri_title', 'Title', 'required|min_length[3]');
			$this->form_validation->set_rules('galeri_description', 'Description', 'required|min_length[5]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$galeri_slug 				= url_title($this->input->post('galeri_title'), 'dash', TRUE);
				$config['upload_path'] 		= './uploads/galeri/'.$galeri_slug;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
				
				$image_folder_path 			= 'uploads/galeri/'.$galeri_slug.'/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );

				$weleh = array (
								'galeri_title' 			=> $this->security->xss_clean($this->input->post('galeri_title')),
								'galeri_category_id' 	=> $this->security->xss_clean($this->input->post('galeri_category_id')),
								'galeri_slug' 			=> $galeri_slug,
								'galeri_link' 			=> $this->security->xss_clean($this->input->post('galeri_link')),
								'galeri_picture' 		=> $this->security->xss_clean($file_dokumen),
								'galeri_description' 	=> $this->security->xss_clean($this->input->post('galeri_description')),
								'galeri_type' 			=> $this->security->xss_clean($this->input->post('galeri_type'))
								);
				
				$this->model_utama->insert_data('galeri', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data galeri';
				$this->model_utama->insert_data('log_user', $log);
				redirect('admin/galeri/', 'refresh');
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
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'hapus data galeri dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);
			$this->model_utama->delete_data($kode, 'galeri_id','galeri');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/galeri');
		}
		else
		{
			redirect('login');
		}
	}
	
	function update($kode)
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah galeri | '.$judul;
			$data['heading'] 		= 'Update galeri';
			$data['galeri_category_list']	= $this->model_utama->get_order('galeri_category_title','asc','galeri_category');
			$data['form_action'] 	= site_url('admin/galeri/update_process');
			$wew = $this->model_utama->get_detail($kode, 'galeri_id', 'galeri')->row();
			$this->session->set_userdata('kd_weleh', $wew->galeri_id);
			
			$data['default']['galeri_title'] 			= $wew->galeri_title;		
			$data['default']['galeri_description']		= $wew->galeri_description;	
			$data['default']['galeri_link']				= $wew->galeri_link;	
			$data['default']['galeri_type']				= $wew->galeri_type;	
			$data['default']['galeri_picture'] 			= $wew->galeri_picture;
			$data['default']['galeri_category_id']		= $wew->galeri_category_id;
			$data['default']['galeri_id'] 				= $wew->galeri_id;
			
			$data['page']			= 'admin/page_galeri_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data galeri dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function update_process()
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah galeri | '.$judul;
			$data['heading'] 		= 'Update galeri';
			$data['galeri_category_list']	= $this->model_utama->get_order('galeri_category_title','asc','galeri_category');
			$data['form_action'] 	= site_url('admin/galeri/update_process');
			
			$this->form_validation->set_rules('galeri_title', 'Title', 'required|min_length[3]');
			$this->form_validation->set_rules('galeri_description', 'Description', 'required|min_length[5]');
			
			if ($this->form_validation->run() == TRUE)
			{
				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'galeri_id', 'galeri')->row();	
				
				$galeri_slug 				= url_title($wew->galeri_title, 'dash', TRUE);
				$config['upload_path'] 		= './uploads/galeri/'.$folder_name;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
				
				$image_folder_path 			= 'uploads/galeri/'.$folder_name.'/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );
				$weleh = array (
								'galeri_title' 			=> $this->security->xss_clean($this->input->post('galeri_title')),
								'galeri_category_id' 	=> $this->security->xss_clean($this->input->post('galeri_category_id')),
								'galeri_slug' 			=> $galeri_slug,
								'galeri_link' 			=> $this->security->xss_clean($this->input->post('galeri_link')),
								'galeri_description' 	=> $this->security->xss_clean($this->input->post('galeri_description')),
								'galeri_type' 			=> $this->security->xss_clean($this->input->post('galeri_type'))
								);

				if( $file_dokumen != '' ){
					$weleh['galeri_picture']	= $file_dokumen;
				}
				 
				$this->model_utama->update_data($this->security->xss_clean($this->input->post('galeri_id')),'galeri_id','galeri',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data galeri dengan id : '.$this->security->xss_clean($this->session->userdata('kd_weleh')).'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/galeri/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/galeri/update/'.$this->input->post('galeri_id'));
				
			}
			else
			{
				$data['page']			= 'admin/page_galeri_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	function download($kode)
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah galeri | '.$judul;
			$data['heading'] 		= 'Update galeri';
			$data['form_action'] 	= site_url('admin/galeri/update_process');
			$wew = $this->model_utama->get_detail($kode, 'galeri_id', 'galeri')->row();
			$this->session->set_userdata('kd_weleh', $wew->galeri_id);
			
			$data['default']['galeri_title'] 		= $wew->galeri_title;		
			$data['default']['galeri_description']	= $wew->galeri_description;	
			$data['default']['galeri_link']			= $wew->galeri_link;	
			$data['default']['galeri_type']			= $wew->galeri_type;	
			$data['default']['galeri_picture'] 		= $wew->galeri_picture;
			$data['default']['galeri_id'] 			= $wew->galeri_id;
			
			$this->load->library('zip');
			$folder_name 	= url_title($wew->galeri_title, 'dash', TRUE);
			$path			= 'uploads/galeri/'.$folder_name.'/';
			$this->zip->read_dir($path,true);
			// Download the file to your desktop. Name it "my_backup.zip"
			$this->zip->download('galeri-'.$folder_name.'.zip'); 
			echo $path;
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik download data galeri dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function picture($kode)
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$wew = $this->model_utama->get_detail($kode, 'galeri_id', 'galeri')->row();
			$this->session->set_userdata('kd_weleh', $wew->galeri_id);
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola Galeri '.ucwords($wew->galeri_title).' | '.$judul;
			$data['heading'] 		= 'Kelola Galeri '.ucwords($wew->galeri_title);
			$data['form_action'] 	= site_url('admin/galeri/add_picture_process');
			
			
			$data['default']['galeri_title'] 	= $wew->galeri_title;	
			$data['default']['galeri_slug']		= $wew->galeri_slug;
			$data['default']['galeri_id'] 		= $wew->galeri_id;
			$data['default']['galeri_type'] 	= $wew->galeri_type;
			$data['default']['galeri_link'] 	= $wew->galeri_link;
			$data['galeri_picture_list']	= $this->model_utama->cek_data($wew->galeri_id,'galeri_id','galeri_picture');
			
			$data['page']			= 'admin/galeri/page_galeri_picture_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data galeri dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function add_picture_process()
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$user_id 					= $this->session->userdata('id_user');
			$judul						= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 				= 'Halaman Tambah galeri | '.$judul;
			$data['heading'] 			= 'Add galeri List';
			$data['galeri_picture_list']	= $this->model_utama->cek_data($this->input->post('galeri_id'),'galeri_id','galeri_picture');
			$data['form_action'] 		= site_url('admin/galeri/add_picture_process');
			$data['page']				= 'admin/galeri/page_galeri_picture_form';
			$wew = $this->model_utama->get_detail($this->input->post('galeri_id'), 'galeri_id', 'galeri')->row();
			
			$this->form_validation->set_rules('galeri_picture_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('galeri_picture_link', 'Link', 'max_length[255]');
			$this->form_validation->set_rules('galeri_picture_type', 'Type', 'max_length[255]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$folder_name 				= url_title($wew->galeri_title, 'dash', TRUE);
				$config['upload_path'] 		= './uploads/galeri/'.$folder_name;
				$config['remove_spaces'] 	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
			
				$image_folder_path 			= 'uploads/galeri/'.$folder_name.'/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );
				$weleh = array (
								'galeri_picture_title' 		=> $this->security->xss_clean($this->input->post('galeri_picture_title')),
								'galeri_picture_slug' 		=> url_title($this->security->xss_clean($this->input->post('galeri_picture_title')), 'dash', TRUE),
								'galeri_picture_link' 		=> $this->security->xss_clean($this->input->post('galeri_picture_link')),
								'galeri_picture_type' 		=> $this->security->xss_clean($this->input->post('galeri_picture_type')),
								'galeri_picture_picture' 	=> $this->security->xss_clean($file_dokumen),
								'galeri_id' 				=> $this->security->xss_clean($this->input->post('galeri_id'))
								);
				
				$this->model_utama->insert_data('galeri_picture', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data galeri_picture';
				$this->model_utama->insert_data('log_user', $log);
				redirect('admin/galeri/picture/'.$this->input->post('galeri_id'), 'refresh');
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
	function delete_picture($kode)
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$log['user_id']				= $this->security->xss_clean($this->session->userdata('id_user'));
			$log['activity']			= 'hapus data galeri dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);
			$this->model_utama->delete_data($kode, 'galeri_picture_id','galeri_picture');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/galeri/picture/'.$this->session->userdata('kd_weleh'));
		}
		else
		{
			redirect('login');
		}
	}
	function update_picture($kode)
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah Gambar | '.$judul;
			$data['heading'] 		= 'Ubah Gambar';
			$data['form_action'] 	= site_url('admin/galeri/update_picture_process');
			$wew = $this->model_utama->get_detail($kode, 'galeri_picture_id', 'galeri_picture')->row();
			$this->session->set_userdata('kd_weleh', $wew->galeri_id);
			$galeri = $this->model_utama->get_detail($wew->galeri_id, 'galeri_id', 'galeri')->row();
			
			$data['default']['galeri_picture_title'] 	= $wew->galeri_picture_title;		
			$data['default']['galeri_picture_id'] 		= $wew->galeri_picture_id;	
			$data['default']['galeri_id'] 				= $wew->galeri_id;
			$data['default']['galeri_picture_type'] 	= $wew->galeri_picture_type;
			$data['default']['galeri_picture_link'] 	= $wew->galeri_picture_link;
			$data['default']['galeri_picture_picture'] 	= $wew->galeri_picture_picture;
			$data['default']['galeri_slug'] 			= $galeri->galeri_slug;
			$data['galeri_picture_list']	= $this->model_utama->cek_data($wew->galeri_id,'galeri_id','galeri_picture');
			
			$data['page']			= 'admin/galeri/page_galeri_picture_form';
			$this->load->view($this->admin_template, $data);
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data sub galeri lv 1 dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	function update_picture_process()
	{
		if($this->session->userdata('login_admin') == true or $this->session->userdata('login_editor') == true or $this->session->userdata('login_content') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah Gambar | '.$judul;
			$data['heading'] 		= 'Update Gambar';
			$data['form_action'] 	= site_url('admin/galeri/update_picture_process');
			
			$this->form_validation->set_rules('galeri_picture_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('galeri_picture_link', 'Link', 'max_length[255]');
			$this->form_validation->set_rules('galeri_picture_type', 'Type', 'max_length[255]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$wew = $this->model_utama->get_detail($this->input->post('galeri_picture_id'), 'galeri_picture_id', 'galeri_picture')->row();
				$galeri = $this->model_utama->get_detail($this->input->post('galeri_id'), 'galeri_id', 'galeri')->row();
				
				$folder_name 				= url_title($galeri->galeri_title, 'dash', TRUE);	
				$config['upload_path'] 		= './uploads/galeri/'.$folder_name;
				$config['remove_spaces'] 	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
				
				$image_folder_path 			= 'uploads/galeri/'.$folder_name.'/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );
				$weleh = array (
								'galeri_picture_title' 		=> $this->security->xss_clean($this->input->post('galeri_picture_title')),
								'galeri_picture_slug' 		=> url_title($this->security->xss_clean($this->input->post('galeri_picture_title')), 'dash', TRUE),
								'galeri_picture_link' 		=> $this->security->xss_clean($this->input->post('galeri_picture_link')),
								'galeri_picture_type' 		=> $this->security->xss_clean($this->input->post('galeri_picture_type'))
								);

				if( $file_dokumen != '' ){
					$weleh['galeri_picture_picture']	= $this->security->xss_clean($file_dokumen);
				}
				
				$this->model_utama->update_data($this->input->post('galeri_picture_id'),'galeri_picture_id','galeri_picture',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data galeri dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/galeri/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/galeri/update_picture/'.$this->input->post('galeri_picture_id'));
			}
			else
			{
				$data['page']				= 'admin/galeri/page_galeri_picture_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}

	
}
