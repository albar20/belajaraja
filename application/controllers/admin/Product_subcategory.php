<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class product_subcategory extends MY_Controller {
		
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
			$data['title'] 			= 'Halaman Daftar Product Subcategory | '.$judul;
			$data['heading'] 		= "Product Subcategory";
			$data['page']			= 'admin/product_subcategory/page_list';
			$data['subcategory_product_list']	= $this->db->query('select * from subcategory_product left join category_product on category_product.category_product_id = subcategory_product.category_product_id');

			$this->load->view($this->admin_template, $data);
			$this->insert_log('lihat data subcategory_product');
		}
		
		function add()
		{			
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 		= 'Halaman Tambah product_subcategory | '.$judul;
			$data['heading'] 		= 'Add Product Subcategory';
			$data['form_action'] 	= site_url('admin/product_subcategory/add_process');
			$data['page']			= 'admin/product_subcategory/page_form';
			$this->load->view($this->admin_template, $data);

			$this->insert_log('lihat form subcategory_product');
		}
		
		function add_process()
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah product_subcategory | '.$judul;
			$data['heading'] 		= 'Add product_subcategory List';
			$data['form_action'] 	= site_url('admin/product_subcategory/add_process');
			$data['page']			= 'admin/product_subcategory/page_form';
		
			$this->form_validation->set_rules('category_product_id', 'category_product_id', 'required');	
		
			$this->form_validation->set_rules('subcategory_product_name', 'subcategory_product_name', 'required|min_length[3]');	
		
			if ($this->form_validation->run() == TRUE)
			{
				
				$insert_data = array (
		
								'category_product_id'					=> $this->security->xss_clean($this->input->post('category_product_id')), 
			
								'subcategory_product_name'				=> $this->security->xss_clean($this->input->post('subcategory_product_name')), 
								
								'slug'									=> url_title($this->security->xss_clean($this->input->post('subcategory_product_name')), 'dash', TRUE),
								
								'create_date'							=> date("Y-m-d"),
			
								);
				
				$this->model_utama->insert_data('subcategory_product', $insert_data);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$this->insert_log('tambah data subcategory_product');

				redirect('admin/product_subcategory/add', 'refresh');
			}
			else
			{
				$this->load->view($this->admin_template, $data);
			}
		}
		
		function delete($kode)
		{
			$this->insert_log('hapus data category_product dengan id : '.$kode);

			$this->model_utama->delete_data($kode, 'subcategory_product_id','subcategory_product');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/product_subcategory');
		}
		
		function update($kode)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 		= 'Halaman Ubah product_subcategory | '.$judul;
			$data['heading'] 		= 'Update product subcategory';
			$data['form_action'] 	= site_url('admin/product_subcategory/update_process');
				
			$wew = $this->model_utama->get_detail($kode, 'subcategory_product_id', 'subcategory_product')->row();
			$this->session->set_userdata('kd_update', $wew->subcategory_product_id);
		
			$data['default']['category_product_id']		 	= $wew->category_product_id;	
			
			$data['default']['subcategory_product_name']		 	= $wew->subcategory_product_name;	
			
			$data['page']			= 'admin/product_subcategory/page_form';
			$this->load->view($this->admin_template, $data);

			$this->insert_log('klik ubah data category dengan id : '.$kode);
			
		}
		
		function update_process()
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah product_subcategory | '.$judul;
			$data['heading'] 		= 'Update product_subcategory';
			$data['form_action'] 	= site_url('admin/product_subcategory/update_process');
	
		
			$this->form_validation->set_rules('category_product_id', 'category_product_id', 'required');	
		
			$this->form_validation->set_rules('subcategory_product_name', 'subcategory_product_name', 'required|min_length[3]');	
		
				
			if ($this->form_validation->run() == TRUE)
			{
				
				$update_data = array (
			
								'category_product_id'					=> $this->security->xss_clean($this->input->post('category_product_id')), 
			
								'subcategory_product_name'				=> $this->security->xss_clean($this->input->post('subcategory_product_name')), 
								
								'slug'									=> url_title($this->security->xss_clean($this->input->post('subcategory_product_name')), 'dash', TRUE),
			
								);
					
				$this->model_utama->update_data($this->session->userdata('kd_update'),'subcategory_product_id','subcategory_product',$update_data);

				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']			= $user_id;
				$log['activity']			= 'ubah data subcategory_product dengan id : '.$this->session->userdata('kd_update').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/category/update/'.$this->session->userdata('kd_update'));
				redirect('admin/product_subcategory/update/'.$this->session->userdata('kd_update'));
			}
			else
			{
				$this->session->set_flashdata('danger', 'Data gagal diupdate!');
				redirect('admin/product_subcategory/update/'.$this->session->userdata('kd_update'));
			}
		}
		
		function insert_log($activity)
		{
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= $activity;
			$this->model_utama->insert_data('log_user', $log);
		}
	}	
		