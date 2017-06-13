<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class additional_info extends MY_Controller {
		
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
			$data['title'] 		= 'Halaman Daftar additional_info | '.$judul;
			$data['heading'] 		= "additional info";
			$data['page']			= 'admin/additional_info/page_list';
			$data['category_specific_information_list']	= $this->db->query("select * from subcategory_specific_information left join subcategory_product on subcategory_product.subcategory_product_id = subcategory_specific_information.subcategory_product_id left join category_product on category_product.category_product_id = subcategory_product.category_product_id");
			
			$this->load->view($this->admin_template, $data);

			$this->insert_log('lihat data category_specific_information');
		}
		
		function add()
		{			
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah additional_info | '.$judul;
			$data['heading'] 		= 'Add additional info';
			$data['form_action'] 	= site_url('admin/additional_info/add_process');
			$data['page']			= 'admin/additional_info/page_form';
			$data['query_tabel']	= $this->db->query("select * from category_product");
			$data['primary_key']	= $this->db->query("SHOW KEYS FROM category_product WHERE Key_name = 'PRIMARY'")->row();
			$this->load->view($this->admin_template, $data);

			$this->insert_log('lihat form category_specific_information');
		}
		
		function add_process()
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 		= 'Halaman Tambah additional_info | '.$judul;
			$data['heading'] 		= 'Add additional_info List';
			$data['form_action'] 	= site_url('admin/additional_info/add_process');
			$data['page']			= 'admin/additional_info/page_form';
		
			$this->form_validation->set_rules('subcategory_product_id', 'subcategory_product_id', 'required');	
		
			$this->form_validation->set_rules('specific_name', 'specific_name', 'required|min_length[3]');	
		
			if ($this->form_validation->run() == TRUE)
			{
				
				$insert_data = array (
		
								'subcategory_product_id'		=> $this->security->xss_clean($this->input->post('subcategory_product_id')), 
								'specific_name'					=> $this->security->xss_clean($this->input->post('specific_name')), 
								'create_date'					=> date("Y-m-d H:i:s")
			
								);
				
				$this->model_utama->insert_data('subcategory_specific_information', $insert_data);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$this->insert_log('tambah data category_specific_information');

				redirect('admin/additional_info/add', 'refresh');
			}
			else
			{
				$this->load->view($this->admin_template, $data);
			}
		}
		
		function delete($kode)
		{
			$this->insert_log('hapus data category_product dengan id : '.$kode);

			$this->model_utama->delete_data($kode, 'subcategory_specific_information_id','subcategory_specific_information');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/additional_info');
		}
		
		function update($kode)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 		= 'Halaman Ubah additional_info | '.$judul;
			$data['heading'] 		= 'Update additional_info';
			$data['form_action'] 	= site_url('admin/additional_info/update_process/'.$kode);
			$data['query_tabel']	= $this->db->query("select * from category_product");
			$data['primary_key']	= $this->db->query("SHOW KEYS FROM category_product WHERE Key_name = 'PRIMARY'")->row();	
				
			$wew = $this->model_utama->get_detail($kode, 'subcategory_specific_information_id', 'subcategory_specific_information')->row();
			$this->session->set_userdata('kd_update', $wew->subcategory_specific_information_id);
			
			$subcategory_product			= $this->db->query("select * from subcategory_product,category_product where subcategory_product.category_product_id = category_product.category_product_id and subcategory_product.subcategory_product_id = '$wew->subcategory_product_id' limit 1");
			$this->session->set_userdata('kd_update', $wew->subcategory_product_id);
		
			$data['default']['category_product_id']				= ($subcategory_product->num_rows() > 0 ? $subcategory_product->row()->category_product_id : "");
		
			$data['default']['category_product_name']				= ($subcategory_product->num_rows() > 0 ? $subcategory_product->row()->category_product_name : "");
			
			$data['default']['subcategory_product_name']				= ($subcategory_product->num_rows() > 0 ? $subcategory_product->row()->subcategory_product_name : "");
		
			$data['default']['subcategory_product_id']		 	= $wew->subcategory_product_id;	
			
			$data['default']['specific_name']		 	= $wew->specific_name;	
			
			$data['page']			= 'admin/additional_info/page_form';
			$this->load->view($this->admin_template, $data);

			$this->insert_log('klik ubah data category dengan id : '.$kode);
			
		}
		
		function update_process($kode)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah additional_info | '.$judul;
			$data['heading'] 		= 'Update additional_info';
			$data['form_action'] 	= site_url('admin/additional_info/update_process');
	
			$this->form_validation->set_rules('subcategory_product_id', 'subcategory_product_id', 'required');	
		
			$this->form_validation->set_rules('specific_name', 'specific_name', 'required|min_length[3]');	
		
				
			if ($this->form_validation->run() == TRUE)
			{
				
				$update_data = array (
								'subcategory_product_id'		=> $this->security->xss_clean($this->input->post('subcategory_product_id')), 
								'specific_name'					=> $this->security->xss_clean($this->input->post('specific_name')), 
								);

				$this->model_utama->update_data($kode,'subcategory_specific_information_id','subcategory_specific_information',$update_data);

				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']			= $user_id;
				$log['activity']			= 'ubah data category_specific_information dengan id : '.$this->session->userdata('kd_update').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/category/update/'.$this->session->userdata('kd_update'));
				redirect('admin/additional_info/update/'.$kode);
			}
			else
			{
				$this->session->set_flashdata('danger', 'Data gagal diupdate!');
				redirect('admin/additional_info/update/'.$this->session->userdata('kd_update'));
			}
		}
		
		function insert_log($activity)
		{
			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= $activity;
			$this->model_utama->insert_data('log_user', $log);
		}
		
		function get_subcategory()
		{
			$category					= $this->input->post("categoryId");
			$list_subcategory			= $this->db->query("select * from subcategory_product where category_product_id = '$category'");
			
			$html		= '<option value="">-- Choose Subcategory --</option>';
			
			foreach($list_subcategory->result() as $row)
			{
				$html	.= '<option value="'.$row->subcategory_product_id.'">'.$row->subcategory_product_name.'</option>';
			}
			
			echo $html;
		}
	}	
		