<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Seller extends MY_Controller {
	
	public function __construct()
    {
            parent::__construct();
            // Your own constructor code
			$this->load->library('rajaongkir');
			if($this->session->userdata('login_admin') != true){redirect(base_url());}
										
    }
	
	public function index()
	{
		$this->update();
	}
	
	function update()
	{
		$setting				= $this->model_utama->get_data('setting');
		$kode					= $setting->row()->setting_id;
		$user_id 				= $this->session->userdata('id_user');
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$all_province			= json_decode($this->rajaongkir->all_province(), true);
		$city					= json_decode($this->rajaongkir->city_detail($setting->row()->shop_location), true);

		
		$data['title'] 			= 'Halaman Ubah Seller | '.$judul;
		$data['heading'] 		= 'Update Seller';
		$data['form_action'] 	= site_url('admin/seller/update_process');
		$data['province']		= $all_province['rajaongkir']['results'];
		$data['courier']		= $this->db->query("select * from courier_master");
		$data['city']	 		= $city['rajaongkir']['results'];

		$wew = $this->model_utama->get_detail($kode, 'setting_id', 'setting')->row();
		$this->session->set_userdata('kd_update', $wew->setting_id);
	
		$data['default']['shop_location']		 	= $wew->shop_location;	
		
		$data['page']			= 'admin/seller/page_form';
		$this->load->view($this->admin_template, $data);

		$this->insert_log('klik ubah data category dengan id : '.$kode);
		
	}
	
	function update_process()
	{
		$user_id 				= $this->session->userdata('id_user');
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['title'] 			= 'Halaman Ubah Seller | '.$judul;
		$data['heading'] 		= 'Update Seller';
		$data['form_action'] 	= site_url('admin/seller/update_process');

	
		$this->form_validation->set_rules('city', 'city', 'required');	
	
			
		if ($this->form_validation->run() == TRUE)
		{
			
			$update_data = array (
		
							'shop_location'					=> $this->input->post('city'), 
		
							);
				
			$this->model_utama->update_data($this->session->userdata('kd_update'),'setting_id','setting',$update_data);

			if(!empty($_POST['check_list'])) {
				foreach($_POST['check_list'] as $check) {
					$update_courier['status']		= 1;
					
					$this->model_utama->update_data($check,'courier_id','courier_master',$update_courier);
				}

			}
			else
			{
				$this->session->set_flashdata('danger', 'Data gagal diupdate!');
				redirect('admin/seller/update/');

			}
			
			$this->session->set_flashdata('success', 'Data berhasil diupdate!');
			
			$log['user_id']			= $user_id;
			$log['activity']			= 'ubah data setting dengan id : '.$this->session->userdata('kd_update').'  ';
			$this->model_utama->insert_data('log_user', $log);

			// redirect('admin/category/update/'.$this->session->userdata('kd_update'));
			redirect('admin/seller/');
		}
		else
		{
			$this->session->set_flashdata('danger', 'Data gagal diupdate!');
			redirect('admin/seller/update/'.$this->session->userdata('kd_update'));
		}
	}
	
	function insert_log($activity)
	{
		$log['user_id']			= $this->session->userdata('id_user');
		$log['activity']		= $activity;
		$this->model_utama->insert_data('log_user', $log);
	}
}	
	
