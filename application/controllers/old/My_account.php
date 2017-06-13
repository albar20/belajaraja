<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class My_account extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		if( !$this->session->userdata('login_customer') == true)
		{
			redirect('login', 'refresh');
		}
		$this->load->library('rajaongkir');
		$this->minify();
	}


	/*=================================================================
		1.	INSERT CUSTOMER ADDRESS DATA 
		2.	UPDATE CUSTOMER ADDRESS DATA
	=================================================================*/
	public function index()
	{		
		$judul				= $this->setting->website_name;
		$data['judul'] 		= 'My Account | '.$judul;
		$data['title'] 		= $data['judul'];
		$data['header']		= 'My Account';
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/my_account/my_account';


		$customer_id   =   $this->session->userdata('id_customer');
		$this->load->model('my_account_model');
		$my_account_model	 		= $this->my_account_model->index($customer_id);
		$data['customer'] 			= $my_account_model['customer'];
		$data['customer_address'] 	= $my_account_model['customer_address'];	
		$data['province'] 			= $my_account_model['province'];

		if(isset($_POST['nama_penerima']) ){
	
			$this->form_validation->set_rules('nama_penerima', 'Recipient Name', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('alamat_lengkap', 'Full Address', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('kode_pos', 'Post Code', 'required');
			$this->form_validation->set_rules('no_telepon', 'Telephone', 'required');
			$this->form_validation->set_rules('province_id', 'Province', 'required');
			$this->form_validation->set_rules('city_id', 'City', 'required');

			if ($this->form_validation->run() == TRUE)
			{	
				$weleh 		= array (
									'nama_penerima' 		=> $this->security->xss_clean($this->input->post('nama_penerima')),
									'alamat_lengkap' 		=> $this->security->xss_clean($this->input->post('alamat_lengkap')),
									'kode_pos' 				=> $this->security->xss_clean($this->input->post('kode_pos')),
									'no_telepon' 			=> $this->security->xss_clean($this->input->post('no_telepon')),
									'province_id' 			=> $this->security->xss_clean($this->input->post('province_id')),
									'city_id' 				=> $this->security->xss_clean($this->input->post('city_id')),
									'customer_id' 			=> $customer_id
									);
				/*=================================================================
					2.	INSERT CUSTOMER ADDRESS DATA 
				=================================================================*/
				$customer_address_id = $this->security->xss_clean($this->input->post('customer_address_id'));

				if( $this->input->post('customer_address_id') == '' ){
					$weleh['customer_id'] = $customer_id;
					$this->model_utama->insert_data('customer_address', $weleh);
					$this->session->set_flashdata('success', 'Your New Address is added Successfully');
					redirect( base_url().'my_account', 'refresh');

				/*=================================================================
					2.	UPDATE CUSTOMER ADDRESS DATA 
				=================================================================*/
				}else{
				
					$this->model_utama->update_data($customer_address_id,'customer_address_id','customer_address',$weleh);
					$this->session->set_flashdata('success', 'Address is changed');
					redirect( base_url().'my_account', 'refresh');
				}
				
			}else{
				$data['validation_false']		= true;

			}


		}

		$this->load->view($this->front_end_template, $data);
	}

	public function edit_customer( $customer_id)
	{	

		$judul					= $this->setting->website_name;
		$data['judul'] 			= 'Edit My Account | '.$judul;
		$data['title'] 			= $data['judul'];
		$data['header']			= 'Edit My Account ';
		$data['page']			= $this->front_folder.$this->themes_folder_name.'/my_account/my_account_form';
		$customer_id   			= $this->session->userdata('id_customer');
		$data['form_action']	= base_url().'my_account/edit_customer/'.$customer_id;

		$data['breadcrumb'][]['my_account'] 		= base_url().'my_account';
		$data['breadcrumb'][]['ubah_my_account'] 	= 'active';
	

		if(isset($_POST['customer_fname']) ){

			$this->form_validation->set_rules('customer_fname', 'First Name', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('customer_lname', 'Last Name', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('customer_sex', 'Gender', 'required');
			$this->form_validation->set_rules('customer_birthday', 'Birthday', 'required');
				
			if ($this->form_validation->run() == TRUE)
			{

				/*====================================================
					3.	CHECK PASSWORD MATCHES
				====================================================*/
				$password 	 = 	$this->security->xss_clean($this->input->post('customer_password'));
				$re_password = 	$this->security->xss_clean($this->input->post('customer_password2')); 

				if( $password == $re_password ){

					/*====================================================
						3.	UPLOAD IMAGE
					====================================================*/
					$config['upload_path'] 		= './uploads/customer/';
					$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
					
					$image_folder_path 			= 'uploads/customer/thumb';
					$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																		$config );

					$password = md5( $this->security->xss_clean($this->input->post('customer_password')) );
					$weleh = array (
									'customer_fname' 		=> $this->security->xss_clean($this->input->post('customer_fname')),
									'customer_lname' 		=> $this->security->xss_clean($this->input->post('customer_lname')),
									'customer_sex' 			=> $this->security->xss_clean($this->input->post('customer_sex')),
									'customer_birthday' 	=> $this->date_converter($this->security->xss_clean($this->input->post('customer_birthday')))
									);

					if( $password != '' ){
						$weleh['customer_password' ] = $password;
					}


					if( $file_dokumen != '' ){
						$weleh['customer_photo' ] = $file_dokumen;
					}

					$this->model_utama->update_data($customer_id,'customer_id','customers',$weleh);
					$this->session->set_flashdata('success', 'Data is changed Successfully!');

					$log['user_id']				= $customer_id;
					$log['activity']			= 'tambah edit profile';
					$this->model_utama->insert_data('log_user', $log);

					redirect('my_account', 'refresh');

				}else{
					$data['password_not_same_message'] = 'Password not same';
				}
			}

		}else{
			
			$this->load->model('my_account_model');
			$my_account_model	 	= $this->my_account_model->edit_customer($customer_id);
			$data['default']['customer_fname']      = $my_account_model['default']['customer_fname'];
	        $data['default']['customer_lname']      = $my_account_model['default']['customer_lname'];
	        $data['default']['customer_sex']        = $my_account_model['default']['customer_sex'];
	        $data['default']['customer_birthday']   = $my_account_model['default']['customer_birthday'];
	        $data['default']['customer_photo']      = $my_account_model['default']['customer_photo'];
		}	

		$this->load->view($this->front_end_template, $data);

	}

	public function hapus_alamat( $customer_address_id ){	


		/*$log['user_id']				= $this->session->userdata('id_user');
		$log['activity']			= 'hapus data customer address dengan id : '.$customer_address_id.'  ';
		$this->model_utama->insert_data('log_user', $log);*/

		$this->model_utama->delete_data($customer_address_id, 'customer_address_id','customer_address');
		$this->session->set_flashdata('success', 'Data is deleted!');
		redirect('my_account');

	}


	public function get_customer_address_data( )
	{	

		$customer_address_id 	= 	$this->security->xss_clean($this->input->post('customer_address_id'));
		$this->load->model('my_account_model');
		$my_account_model	= $this->my_account_model->get_customer_address_data($customer_address_id);
		$data['customer_address'] 	= $my_account_model['customer_address'];
	
		$customer_address 		= $data['customer_address']->result_array();
		$city_id 				= $customer_address[0]['city_id'];
		$province_id 			= $customer_address[0]['province_id'];
		$province				= json_decode($this->rajaongkir->city_detail($city_id), true);
		$province_name 			= $province['rajaongkir']['results']['province'];
		$city_name 			 	= $province['rajaongkir']['results']['city_name'];
		$customer_address[0]['province'] 	= $province_name;
		$customer_address[0]['city_name'] 	= $city_name;
		echo json_encode($customer_address);

	}	

	public function set_default_customer_address( )
	{
		$customer_id 	= 	$this->session->userdata('id_customer');
		$weleh = array (
						'default_column' 		=> '0'
						);
		$this->model_utama->update_data($customer_id,'customer_id','customer_address',$weleh);
		
		$customer_address_id = $this->security->xss_clean($this->input->post('customer_address_id'));
		$weleh = array (
						'default_column'	=> '1'
						);
		$this->model_utama->update_data($customer_address_id,'customer_address_id','customer_address',$weleh);
	}


}