<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class Customer extends MY_Controller {
	
	public function index()
	{

		/*for( $x= 0; $x<=5; $x++ ){
			
			

				$weleh = array (
								'customer_fname' 		=> 'kelly',
								'customer_lname' 		=> 'moore',
								'customer_sex' 			=> 'laki',
								'customer_birthday' 	=> '2016-08-09',
								'customer_email' 		=> 'kelly@yahoo.com',
								'customer_password' 	=> '21232f297a57a5a743894a0e4a801fc3',
								'customer_address' 		=> 'jalan hello',
								'customer_state' 		=> 'jakarta',
								'customer_city' 		=> 'jakarta',
								'customer_sub_postal' 	=> '55555',
								'customer_phone' 		=> '0812222',
								'customer_mobile' 		=> '082388888',
								'customer_account_status' 			=> '1',
								'customer_account_activation_key' 	=> '8888777',
								'create_date'			=> date('Y-m-d H:i:s')
								);
				$this->model_utama->insert_data('customers', $weleh);




		}

		die();*/

		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola user | '.$judul;
			$data['heading'] 		= "customer list";
			$data['page']			= 'admin/customer/page_list';
			$data['customer_list']	= $this->db->query("SELECT * FROM customers ORDER BY create_date DESC");

			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat customer";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	

	function add()
	{	

		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah Customer | '.$judul;
			$data['heading'] 		= 'Add Customer List';
			$data['form_action'] 	= site_url('index.php/admin/customer/add_process');
			$data['user_list']		= $this->model_utama->get_order('create_date','desc','customers');
			$data['page']			= 'admin/customer/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $user_id;
			$log['activity']		= 'klik tambah data customer';
			$this->model_utama->insert_data('log_user', $log);

		}
		else
		{
			redirect(base_url().'login');
		}
	}
	

	/*===================================================
		1.	REGISTER PROCESS
	===================================================*/
	function add_process()
	{	
		
		if($this->session->userdata('login_admin') == true)
		{

			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah customer | '.$judul;
			$data['heading'] 		= 'Add customer List';
			$data['customer_list']	= $this->model_utama->get_order('create_date','desc','customers');
			$data['form_action'] 	= site_url('index.php/admin/customer/add_process');
			$data['page']			= 'admin/customer/page_form';

			/*===================================================
				1.	REGISTER PROCESS
			===================================================*/
			$redirect				=	'admin/customer/add';
			$upload_image 			= 	true;
			$view					= 	'template';
			$create_by 				= 	'admin';
			$this->customer_register_helper(	$redirect,
												$upload_image,
												$view,
												$data,
												$create_by	
											);

		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function delete($kode)
	{

		if($this->session->userdata('login_admin') == true)
		{

			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'hapus data customer dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'customer_id','customers');
			// $this->model_utama->delete_data($kode, 'user_id','user_detail');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/customer');
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function update($kode)
	{
	

		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah customer | '.$judul;
			$data['heading'] 		= 'Update customer';
			
			$data['form_action'] 	= site_url('index.php/admin/customer/update_process');
			$wew = $this->db->query("SELECT * FROM customers WHERE customer_id = '$kode'")->row();
			$this->session->set_userdata('kd_weleh', $wew->customer_id);
			
			$data['default']['customer_fname'] 				= $wew->customer_fname;	
			$data['default']['customer_lname'] 				= $wew->customer_lname;	
			$data['default']['customer_sex'] 				= $wew->customer_sex;	
			$data['default']['userfile'] 					= $wew->customer_birthday;	
			$data['default']['customer_email'] 				= $wew->customer_email;	
			$data['default']['customer_address'] 			= $wew->customer_address;	
			$data['default']['customer_state'] 				= $wew->customer_state;	
			$data['default']['customer_birthday'] 			= $wew->customer_birthday;	
			$data['default']['customer_city'] 				= $wew->customer_city;	
			$data['default']['customer_sub_postal'] 		= $wew->customer_sub_postal;	
			$data['default']['customer_phone'] 				= $wew->customer_phone;	
			$data['default']['customer_mobile'] 			= $wew->customer_mobile;	
			$data['default']['customer_photo'] 				= $wew->customer_photo;
			$data['default']['customer_id'] 				= $wew->customer_id;


			$data['page']			= 'admin/customer/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data customer dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function update_process()
	{	

		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah customer | '.$judul;
			$data['heading'] 		= 'Update customer';
			$data['page']			= 'admin/customer/page_form';
			$data['form_action'] 	= site_url('index.php/admin/customer/update_process');


			$this->form_validation->set_rules('customer_fname', 'nama depan', 'required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('customer_lname', 'nama belakang', 'required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('customer_sex', 'jenis kelamin', 'required');
			$this->form_validation->set_rules('customer_birthday', 'tanggal lahir', 'required');
			$this->form_validation->set_rules('customer_email', 'email', 'required');
			$this->form_validation->set_rules('customer_address', 'alamat', 'required');
			$this->form_validation->set_rules('customer_state', 'propinsi', 'required');
			$this->form_validation->set_rules('customer_city', 'kota', 'required');
			$this->form_validation->set_rules('customer_sub_postal', 'kode pos', 'required');
			$this->form_validation->set_rules('customer_phone', 'telepon', 'required');
			$this->form_validation->set_rules('customer_mobile', 'handphone', 'required');
			
			if ($this->form_validation->run() == TRUE)
			{
				$password = md5($this->security->xss_clean($this->input->post('password')));

				if($this->input->post('password') == '') {
					$cek_pass = $this->model_utama->cek_data($this->input->post('customer_id'),'customer_id','customers');
				
					if($cek_pass->num_rows() > 0)
					{
						$password = $cek_pass->row()->password;
					}
				}

				$config['upload_path'] 		= './uploads/customer/';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
				
				$image_folder_path 			= 'uploads/customer/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );

				$customer_birthday 			= $this->security->xss_clean( $this->input->post('customer_birthday') );
				$this->load->library('date_converter_library');
				$customer_birthday 			= $this->date_converter_library->convert( $customer_birthday );

				$weleh = array (
								'customer_fname' 		=> $this->security->xss_clean($this->input->post('customer_fname')),
								'customer_lname' 		=> $this->security->xss_clean($this->input->post('customer_lname')),
								'customer_sex' 			=> $this->security->xss_clean($this->input->post('customer_sex')),
								'customer_birthday' 	=> $customer_birthday,
								'customer_email' 		=> $this->security->xss_clean($this->input->post('customer_email')),
								'customer_password' 	=> $password,
								'customer_address' 		=> $this->security->xss_clean($this->input->post('customer_address')),
								'customer_state' 		=> $this->security->xss_clean($this->input->post('customer_state')),
								'customer_city' 		=> $this->security->xss_clean($this->input->post('customer_city')),
								'customer_sub_postal' 	=> $this->security->xss_clean($this->input->post('customer_sub_postal')),
								'customer_phone' 		=> $this->security->xss_clean($this->input->post('customer_phone')),
								'customer_mobile' 		=> $this->security->xss_clean($this->input->post('customer_mobile'))
								);

				if( $file_dokumen != '' ){
					$weleh['customer_photo']			= $file_dokumen;
				}


				
				$this->model_utama->update_data($this->security->xss_clean($this->input->post('customer_id')),'customer_id','customers',$weleh);

				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data customer dengan id : '.$this->security->xss_clean($this->input->post('customer_id')).'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/user/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/customer/update/'.$this->input->post('customer_id'));
			}
			else
			{
				$data['page']			= 'admin/customer/page_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}


	function purchase_history($client_id=0){
		/*$data['act_id']=8;
		$data['st_date']='';
		$data['end_date']='';
		
		$where = "where client_id = ".$client_id;
		
		if(isset($_POST['btnsearch'])) {
			if($this->input->post('st_date') && $this->input->post('end_date')){
				$data['st_date']= $this->input->post('st_date');
				$data['end_date']= $this->input->post('end_date');
				$where .=" AND DATE(order_date) BETWEEN '".$data['st_date']."' AND '".$data['end_date']."'";
			}
			elseif($this->input->post('st_date')){
				$data['st_date']= $this->input->post('st_date');
				$data['end_date']= date("Y-m-d");
			$where .=" AND DATE(order_date) BETWEEN '".$data['st_date']."' AND '".$data['end_date']."'";
			}
		}
		
		$where.=" order by order_date desc";
		
		$data['customer']=$this->common->getOneRecField("client_fname, client_lname",'allera_client_master',"where client_id = ".$client_id);
		
		$data['num_row'] = $current_num_row = $this->common->numRow('allera_order_master',$where);
		$data['order_history'] = $this->common->getAllRow('allera_order_master',$where); 
		$data['client_id']=$client_id;
		$this->load->view("webmaster/customer_order_history",$data);*/
	}

	

}

