<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class coupon extends MY_Controller {
		
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
			$data['title'] 		= 'Halaman Daftar coupon | '.$judul;
			$data['heading'] 		= "coupon";
			$data['page']			= 'admin/coupon/page_list';
			$data['coupon_master_list']	= $this->model_utama->get_data('coupon_master');
			
			$this->load->view($this->admin_template, $data);

			$this->insert_log('lihat data coupon_master');
		}
		
		function add()
		{			
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 		= 'Halaman Tambah coupon | '.$judul;
			$data['heading'] 		= 'Add coupon List';
			$data['form_action'] 	= site_url('admin/coupon/add_process');
			$data['page']			= 'admin/coupon/page_form';
			$data['category_product']= $this->model_utama->get_data('category_product');
			$this->load->view($this->admin_template, $data);

			$this->insert_log('lihat form coupon_master');
		}
		
		function add_process()
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 		= 'Halaman Tambah coupon | '.$judul;
			$data['heading'] 		= 'Add coupon List';
			$data['form_action'] 	= site_url('admin/coupon/add_process');
			$data['page']			= 'admin/coupon/page_form';
		
			$coupon_code			= $this->input->post('coupon_code');
			$cek_coupon_code		= $this->db->query("select * from coupon_master where coupon_code = '$coupon_code' limit 1");
			if($cek_coupon_code->num_rows() > 0)
			{
				$this->session->set_flashdata('danger','Coupon Code is Already Exist');
				redirect('admin/coupon/add');
			}
		
			$this->form_validation->set_rules('coupon_code', 'coupon_code', 'required|min_length[3]');	
		
			$this->form_validation->set_rules('coupon_type', 'coupon_type', 'required|min_length[3]');	
		
			$this->form_validation->set_rules('coupon_percentage', 'coupon_percentage', 'required|numeric');	
		
			$this->form_validation->set_rules('coupon_amount', 'coupon_amount', 'required|numeric');	
		
			$this->form_validation->set_rules('coupon_start_date', 'coupon_start_date', 'required|min_length[3]');	
		
			$this->form_validation->set_rules('coupon_end_date', 'coupon_end_date', 'required|min_length[3]');	
		
			$this->form_validation->set_rules('use_coupon', 'use_coupon', 'required|numeric');	
		
			$this->form_validation->set_rules('use_customer', 'use_customer', 'required|numeric');	
		
			$this->form_validation->set_rules('coupon_status', 'coupon_status', 'required|min_length[3]');	
		
			if ($this->form_validation->run() == TRUE)
			{
				
				$insert_data = array (
		
								'coupon_code'					=> $this->security->xss_clean($this->input->post('coupon_code')), 
			
								'coupon_type'					=> $this->security->xss_clean($this->input->post('coupon_type')), 
			
								'coupon_percentage'				=> $this->security->xss_clean($this->input->post('coupon_percentage')), 
			
								'coupon_amount'					=> $this->security->xss_clean($this->input->post('coupon_amount')), 
			
								'coupon_start_date'				=> date("Y-m-d", strtotime($this->security->xss_clean($this->input->post('coupon_start_date')))), 
			
								'coupon_end_date'				=> date("Y-m-d", strtotime($this->security->xss_clean($this->input->post('coupon_end_date')))),
			
								'use_coupon'					=> $this->security->xss_clean($this->input->post('use_coupon')), 
			
								'use_customer'					=> $this->security->xss_clean($this->input->post('use_customer')), 
			
								'coupon_status'					=> $this->security->xss_clean($this->input->post('coupon_status')), 
			
								);
				
				$this->model_utama->insert_data('coupon_master', $insert_data);
				
				$coupon_code						= $this->input->post('coupon_code');
				
				$coupon_id							= $this->db->query("select * from coupon_master where coupon_code = '$coupon_code' limit 1")->row()->coupon_master_id;
				$coupon_product['product_id']		= $this->input->post('product_id');
				$coupon_product['coupon_master_id']	= $coupon_id;
				$coupon_product['create_date']		= date("Y-m-d H:i:s");
				
				$this->model_utama->insert_data('coupon_product',$coupon_product);
				
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$this->insert_log('tambah data coupon_master');

				redirect('admin/coupon/add', 'refresh');
			}
			else
			{
				$this->load->view($this->admin_template, $data);
			}
		}
		
		function delete($kode)
		{
			$this->insert_log('hapus data category_product dengan id : '.$kode);

			$this->model_utama->delete_data($kode, 'coupon_master_id','coupon_master');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/coupon');
		}
		
		function update($kode)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 		= 'Halaman Ubah coupon | '.$judul;
			$data['heading'] 		= 'Update coupon';
			$data['form_action'] 	= site_url('admin/coupon/update_process');
			$data['category_product']= $this->model_utama->get_data('category_product');
			
			$wew = $this->db->query("select * from coupon_master left join coupon_product on coupon_master.coupon_master_id = coupon_product.coupon_master_id left join product on coupon_product.product_id = product.product_id left join subcategory_product on subcategory_product.subcategory_product_id = product.subcategory_product_id where coupon_master.coupon_master_id = '$kode'")->row();	
			//$wew = $this->model_utama->get_detail($kode, 'coupon_master_id', 'coupon_master')->row();
			$this->session->set_userdata('kd_update', $wew->coupon_master_id);
		
			$data['default']['coupon_code']		 	= $wew->coupon_code;	
			
			$data['default']['coupon_type']		 	= $wew->coupon_type;	
			
			$data['default']['coupon_percentage']		 	= $wew->coupon_percentage;	
			
			$data['default']['coupon_amount']		 	= $wew->coupon_amount;	
			
			$data['default']['coupon_start_date']		 	= $wew->coupon_start_date;	
			
			$data['default']['coupon_end_date']		 	= $wew->coupon_end_date;	
			
			$data['default']['use_coupon']		 	= $wew->use_coupon;	
			
			$data['default']['use_customer']		 	= $wew->use_customer;	
			
			$data['default']['coupon_status']		 	= $wew->coupon_status;	
			
			$data['default']['product_id']				= $wew->product_id;
			
			$data['default']['product_name']			= $wew->product_name;
			
			$data['default']['category_id']				= $wew->category_product_id;
			
			$data['default']['subcategory_id']			= $wew->subcategory_product_id;
			
			$data['default']['subcategory_name']		= $wew->subcategory_product_name;
			
			$data['page']			= 'admin/coupon/page_form';
			$this->load->view($this->admin_template, $data);

			$this->insert_log('klik ubah data category dengan id : '.$kode);
			
		}
		
		function update_process()
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah coupon | '.$judul;
			$data['heading'] 		= 'Update coupon';
			$data['form_action'] 	= site_url('admin/coupon/update_process');
	
		
			$this->form_validation->set_rules('coupon_code', 'coupon_code', 'required|min_length[3]');	
		
			$this->form_validation->set_rules('coupon_type', 'coupon_type', 'required|min_length[3]');	
		
			$this->form_validation->set_rules('coupon_percentage', 'coupon_percentage', 'required|numeric');	
		
			$this->form_validation->set_rules('coupon_amount', 'coupon_amount', 'required|numeric');	
		
			$this->form_validation->set_rules('coupon_start_date', 'coupon_start_date', 'required|min_length[3]');	
		
			$this->form_validation->set_rules('coupon_end_date', 'coupon_end_date', 'required|min_length[3]');	
		
			$this->form_validation->set_rules('use_coupon', 'use_coupon', 'required|numeric');	
		
			$this->form_validation->set_rules('use_customer', 'use_customer', 'required|numeric');	
		
			$this->form_validation->set_rules('coupon_status', 'coupon_status', 'required|min_length[3]');	
		
				
			if ($this->form_validation->run() == TRUE)
			{
				
				$update_data = array (
			
								'coupon_code'					=> $this->security->xss_clean($this->input->post('coupon_code')), 
			
								'coupon_type'					=> $this->security->xss_clean($this->input->post('coupon_type')), 
			
								'coupon_percentage'				=> $this->security->xss_clean($this->input->post('coupon_percentage')), 
			
								'coupon_amount'					=> $this->security->xss_clean($this->input->post('coupon_amount')), 
			
								'coupon_start_date'				=> date("Y-m-d", strtotime($this->security->xss_clean($this->input->post('coupon_start_date')))), 
			
								'coupon_end_date'				=> date("Y-m-d", strtotime($this->security->xss_clean($this->input->post('coupon_end_date')))), 
			
								'use_coupon'					=> $this->security->xss_clean($this->input->post('use_coupon')), 
			
								'use_customer'					=> $this->security->xss_clean($this->input->post('use_customer')), 
			
								'coupon_status'					=> $this->security->xss_clean($this->input->post('coupon_status')), 
			
								);
					
				$this->model_utama->update_data($this->session->userdata('kd_update'),'coupon_master_id','coupon_master',$update_data);

				$coupon_id							= $this->session->userdata('kd_update');
				$coupon_product['product_id']		= $this->input->post('product_id');
				$coupon_product['coupon_master_id']	= $coupon_id;
				
				$this->model_utama->update_data($coupon_id,'coupon_master_id','coupon_product',$coupon_product);
				
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']			= $user_id;
				$log['activity']			= 'ubah data coupon_master dengan id : '.$this->session->userdata('kd_update').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/category/update/'.$this->session->userdata('kd_update'));
				redirect('admin/coupon/');
			}
			else
			{
				$this->session->set_flashdata('danger', 'Data gagal diupdate!');
				redirect('admin/coupon/update/'.$this->session->userdata('kd_update'));
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
			$kategori		= $this->input->post("kategori");
			$subkategori	= $this->db->query("select * from subcategory_product where category_product_id = '$kategori'");
			
			$html			= '<option value="">-- Choose Subcategory --</option>';
			
			foreach($subkategori->result() as $row)
			{
				$html		.= '<option value="'.$row->subcategory_product_id.'">'.ucwords($row->subcategory_product_name).'</option>';
			}
			
			echo $html;
		}
		
		function get_product()
		{
			$subkategori	= $this->input->post("subkategori");
			$product		= $this->db->query("select * from product where subcategory_product_id = '$subkategori'");
			
			$html			= '<option value="">-- Choose Product --</option>';
			
			foreach($product->result() as $row)
			{
				$html		.= '<option value="'.$row->product_id.'">'.ucwords($row->product_name).'</option>';
			}
			
			echo $html;
		}
	}	
		