<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class product_category extends MY_Controller {
		
		public function __construct()
        {
                parent::__construct();
                // Your own constructor code
				if($this->session->userdata('login_admin') != true){redirect(base_url());}
											
        }
		
		public function index()
		{
			
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Daftar product_category | '.$judul;
			$data['heading'] 		= "Product Category";
			$data['page']			= 'admin/product_category/page_list';
			$data['category_product_list']	= $this->model_utama->get_data('category_product');
			
			$this->load->view($this->admin_template, $data);

			$this->insert_log('lihat data category_product');
		}
		
		function add()
		{			
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah product_category | '.$judul;
			$data['heading'] 		= 'Add Product Category';
			$data['form_action'] 	= site_url('admin/product_category/add_process');
			$data['page']			= 'admin/product_category/page_form';
			$this->load->view($this->admin_template, $data);

			$this->insert_log('lihat form category_product');
		}
		
		function add_process()
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah product_category | '.$judul;
			$data['heading'] 		= 'Add product_category List';
			$data['form_action'] 	= site_url('admin/product_category/add_process');
			$data['page']			= 'admin/product_category/page_form';
		
			$this->form_validation->set_rules('name', 'name', 'required|min_length[3]');	
		
			if ($this->form_validation->run() == TRUE)
			{
				
				$insert_data = array (
		
								'category_product_name'	=> $this->security->xss_clean($this->input->post('name')), 
								'slug'					=> url_title($this->security->xss_clean($this->input->post('name')), 'dash', TRUE),
								'create_date'			=> date("Y-m-d"),
			
								);
				
				$this->model_utama->insert_data('category_product', $insert_data);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$this->insert_log('tambah data category_product');

				redirect('admin/product_category/add', 'refresh');
			}
			else
			{
				$this->load->view($this->admin_template, $data);
			}
		}
		
		function delete($kode)
		{
			$this->insert_log('hapus data category_product dengan id : '.$kode);

			$this->model_utama->delete_data($kode, 'category_product_id','category_product');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/product_category');
		}
		
		function update($kode)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 		= 'Halaman Ubah product_category | '.$judul;
			$data['heading'] 		= 'Update product_category';
			$data['form_action'] 	= site_url('admin/product_category/update_process');
				
			$wew = $this->model_utama->get_detail($kode, 'category_product_id', 'category_product')->row();
			$this->session->set_userdata('kd_update', $wew->category_product_id);
		
			$data['default']['category_product_name']		 	= $wew->category_product_name;	
			
			$data['page']			= 'admin/product_category/page_form';
			$this->load->view($this->admin_template, $data);

			$this->insert_log('klik ubah data category dengan id : '.$kode);
		}
		
		function update_process()
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah product_category | '.$judul;
			$data['heading'] 		= 'Update product_category';
			$data['form_action'] 	= site_url('admin/product_category/update_process');
	
		
			$this->form_validation->set_rules('name', 'name', 'required|min_length[3]');	
		
				
			if ($this->form_validation->run() == TRUE)
			{
				
				$update_data = array (
			
								'category_product_name'	=> $this->security->xss_clean($this->input->post('name')), 
								'slug'					=> url_title($this->security->xss_clean($this->input->post('name')), 'dash', TRUE),
			
								);
					
				$this->model_utama->update_data($this->session->userdata('kd_update'),'category_product_id','category_product',$update_data);

				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']			= $user_id;
				$log['activity']			= 'ubah data category_product dengan id : '.$this->session->userdata('kd_update').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/category/update/'.$this->session->userdata('kd_update'));
				redirect('admin/product_category/update/'.$this->session->userdata('kd_update'));
			}
			else
			{
				$this->session->set_flashdata('danger', 'Data gagal diupdate!');
				redirect('admin/product_category/update/'.$this->session->userdata('kd_update'));
			}
		}
		
		function insert_log($activity)
		{
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= $activity;
			$this->model_utama->insert_data('log_user', $log);
		}
	}	
		