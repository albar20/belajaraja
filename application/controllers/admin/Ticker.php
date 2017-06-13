<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class ticker extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola ticker | '.$judul;
			$data['heading'] 		= "ticker list";
			$data['page']			= 'admin/ticker/page_list';
			$data['ticker_list']	= $this->model_utama->get_order('create_date','desc','ticker');
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat ticker";
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
			$data['title'] 			= 'Halaman Tambah ticker | '.$judul;
			$data['heading'] 		= 'Add ticker List';
			$data['form_action'] 	= site_url('admin/ticker/add_process');
			$data['ticker_list']	= $this->model_utama->get_order('ticker_id','asc','ticker');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['page']			= 'admin/ticker/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data ticker';
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
			$data['title'] 			= 'Halaman Tambah ticker | '.$judul;
			$data['heading'] 		= 'Add ticker List';
			$data['ticker_list']		= $this->model_utama->get_order('create_date','desc','ticker');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/ticker/add_process');
			$data['page']			= 'admin/ticker/page_form';

			
			$this->form_validation->set_rules('ticker_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('ticker_description', 'Description', 'min_length[5]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$config['upload_path'] 		= './uploads/ticker';
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$file_dokumen	= '';
				}
				else
				{
					$dokumen		= $this->upload->data();
					$file_dokumen	= $dokumen['file_name'];
				}

				$weleh = array (
								'ticker_title' 			=> $this->input->post('ticker_title'),
								'ticker_slug' 			=> url_title($this->input->post('ticker_title'), 'dash', TRUE),
								'user_id'	 			=> $user_id,
								'ticker_picture' 		=> $file_dokumen,
								'ticker_description' 	=> $this->input->post('ticker_description')
								);
				
				$this->model_utama->insert_data('ticker', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data ticker';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/ticker/add', 'refresh');
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
			$log['activity']			= 'hapus data ticker dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'ticker_id','ticker');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/ticker');
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
			$data['title'] 			= 'Halaman Ubah ticker | '.$judul;
			$data['heading'] 		= 'Update ticker';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/ticker/update_process');

			$wew = $this->model_utama->get_detail($kode, 'ticker_id', 'ticker')->row();
			$this->session->set_userdata('kd_weleh', $wew->ticker_id);
			
			$data['default']['ticker_title'] 		= $wew->ticker_title;		
			$data['default']['ticker_description']	= $wew->ticker_description;	
			$data['default']['ticker_picture'] 		= $wew->ticker_picture;
			$data['default']['ticker_id'] 			= $wew->ticker_id;
			
			$data['page']			= 'admin/ticker/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data ticker dengan id : '.$kode;
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
			$data['title'] 			= 'Halaman Ubah ticker | '.$judul;
			$data['heading'] 		= 'Update ticker';
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/ticker/update_process');

			
			$this->form_validation->set_rules('ticker_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('ticker_description', 'Description', 'min_length[5]');
			
			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->session->userdata('kd_weleh'), 'ticker_id', 'ticker')->row();	
				
				$config['upload_path'] 		= './uploads/ticker';
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload())
				{
					$file_dokumen	= $wew->ticker_picture;
				}
				else
				{
					$dokumen		= $this->upload->data();
					$file_dokumen	= $dokumen['file_name'];
				}

				$weleh = array ('ticker_title' 			=> $this->input->post('ticker_title'),
								'ticker_slug' 			=> url_title($this->input->post('ticker_title'), 'dash', TRUE),
								'user_id'	 			=> $user_id,
								'ticker_picture' 		=> $file_dokumen,
								'ticker_description' 	=> $this->input->post('ticker_description')
								);
				
				$this->model_utama->update_data($this->input->post('ticker_id'),'ticker_id','ticker',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data ticker dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/ticker/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/ticker/');
			}
			else
			{
				$data['page']			= 'admin/ticker/page_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	

}

