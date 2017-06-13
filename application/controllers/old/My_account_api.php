<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class My_account_api extends API_Controller {

	public function __construct()
	{
		parent::__construct();
	}


	/*=============================================
	
		USING
		=================================
		=>	
			1.	all 

				url : http://localhost/asiaedu/my_account_api
				$_POST['token'] 			= 'sfsdfuywejsdfu';
				$_POST['request_method'] 	= 'index';


			2.	ACCESS MY ACCOUNT 
				
				POST variables
				=====================
				

			3.	INSERT & UPDATE ADDRESS
				
				POST variables
				=====================
				$_POST['submit_button'] 	= true;
				$_POST['nama_penerima'] 	= 'kelly';
				$_POST['alamat_lengkap']	= 'babastudio ';	 	
				$_POST['kode_pos']			= '338';	 	
				$_POST['no_telepon']		= '33337777';	 	
				$_POST['province_id']		= '1';	 
				$_POST['city_id']				= '';	
				
			4.	UPDATE ADDRESS

				$_POST['customer_address_id']	= '';	 		




		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	DISPLAYING MY ACCOUNT PAGE
			1.	GET DATA ( FROM MODEL )
		3.	INSERT & UPDATE CUSTOMER ADDRESS 
		3.	RESPONSE JSON 
	=============================================*/
	public function index()
	{

		/*===================================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		===================================================*/
		$data = $this->data_for_all_pages();

		/*=============================================
			2.	DISPLAYING MY ACCOUNT PAGE
		=============================================*/

			/*=============================================
				1.	GET DATA ( FROM MODEL )
			=============================================*/
			$customers = $this->db->query("SELECT * FROM customers where token='".$this->security->xss_clean($this->input->post('token'))."'")->row();
			$this->load->model('my_account_model');
			$my_account_model	 		= $this->my_account_model->index($customers->customer_id);
			$data['customer'] 			= $my_account_model['customer']->result_array();
			$data['customer_address'] 	= $my_account_model['customer_address']->result_array();	
			$data['province'] 			= $my_account_model['province'];
			$message  					= '';

		/*=============================================
			3.	INSERT & UPDATE CUSTOMER ADDRESS 
		=============================================*/	
		if(isset($_POST['submit_button']) ){

			$this->form_validation->set_rules('nama_penerima', 'Recipient Name', 'required');
			$this->form_validation->set_rules('alamat_lengkap', 'Full Address', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('kode_pos', 'Post Code', 'required');
			$this->form_validation->set_rules('no_telepon', 'Telephone', 'required');
			$this->form_validation->set_rules('province_id', 'Province', 'required');
			$this->form_validation->set_rules('city_id', 'City', 'required');

			if ($this->form_validation->run() == TRUE){	

				$customers 		= $this->db->query("SELECT * FROM customers where token='".$this->security->xss_clean($this->input->post('token'))."'")->row();
				$customer_id 	= $customers->customer_id;
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
					$status 		= self::SUCCESS;
					$message 		= $this->_insert_success_message;

				/*=================================================================
					2.	UPDATE CUSTOMER ADDRESS DATA 
				=================================================================*/
				}else{
					$this->model_utama->update_data($customer_address_id,'customer_address_id','customer_address',$weleh);
					$status 		= self::SUCCESS;
					$message 		= $this->_update_success_message;
				}

			}else{
				$status 		= self::ERROR;
				$message 		= $this->_validation_failed_message;
				$data['validation_errors'] = $this->form_validation->error_array();
			}

		}else{
			$status 	= self::SUCCESS;
			$message 	= '';
		}

		/*=============================================
			3.	RESPONSE JSON 
		=============================================*/
		$this->jsonout(		$status,
							$message, 
							$data
						);
		exit ;
	}


	/*=================================================================
		
		USING
		=================================
		=>	
			url : http://localhost/asiaedu/my_account_api
			$_POST['token'] 				= 'sfsdfuywejsdfu';
			$_POST['request_method'] 		= 'edit_customer';
			$_POST['submit_button'] 		= 'true';
			$_POST['customer_fname'] 		= 'true';
			$_POST['customer_lname'] 		= 'true';
			$_POST['customer_sex'] 			= 'true';
			$_POST['customer_birthday'] 	= 'true';

	=================================================================*/	
	public function edit_customer()
	{	

		/*===================================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		===================================================*/
		$data = $this->data_for_all_pages();

		/*=============================================
			1.	GET DATA ( FROM MODEL )
		=============================================*/
		$customers 		= $this->db->query("SELECT * FROM customers where token='".$this->security->xss_clean($this->input->post('token'))."'")->row();
		$customer_id 	= $customers->customer_id;
		$this->load->model('my_account_model');
		$my_account_model	 		= $this->my_account_model->index($customer_id);
		$data['customer'] 			= $my_account_model['customer'];
		$data['customer_address'] 	= $my_account_model['customer_address'];	
		$data['province'] 			= $my_account_model['province'];

		if(isset($_POST['submit_button']) ){

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
					$status 				= self::SUCCESS;
					$message 				= 'success';
					$token 					= $this->_token;	
					$data['update'] 		= 'update sucess';
					
				}else{
					$status 					= self::ERROR;
					$message 					= 'validation false';
					$data['password_not_same_message'] = 'Password not same';
				}

			}else{
				$status 					= self::ERROR;
				$message 					= 'validation false';
				$data['validation_false']	= true;
			}

		}else{
			
			$status 				= self::SUCCESS;
			$message 				= $this->_post_variable_not_complete_message;
			$this->load->model('my_account_model');
			$my_account_model	 	= $this->my_account_model->edit_customer($customer_id);
			$data['default']['customer_fname']      = $my_account_model['default']['customer_fname'];
	        $data['default']['customer_lname']      = $my_account_model['default']['customer_lname'];
	        $data['default']['customer_sex']        = $my_account_model['default']['customer_sex'];
	        $data['default']['customer_birthday']   = $my_account_model['default']['customer_birthday'];
	        $data['default']['customer_photo']      = $my_account_model['default']['customer_photo'];
		}	

		/*=============================================
			3.	RESPONSE JSON 
		=============================================*/
		$this->jsonout(	$status,
						$message, 
						$data
						);
		exit ;
	}


	/*=================================================================
		
		USING
		=================================
		=>	
			url : http://localhost/asiaedu/my_account_api/hapus_alamat
			$_POST['token'] 				= 'sfsdfuywejsdfu';
			$_POST['request_method'] 		= 'hapus_alamat';
			$_POST['customer_address_id'] 	= '5';

	=================================================================*/	
	public function hapus_alamat(){	

	
		if( isset($_POST['customer_address_id']) ){
			$customer_address_id = $this->security->xss_clean($this->input->post('customer_address_id'));
			$delete = $this->model_utama->delete_data($customer_address_id, 'customer_address_id','customer_address');
			if( $delete ){
				$status 		= self::SUCCESS;
				$message 		= $this->_delete_success_message;
			}
		}else{
			$status 		= self::ERROR;
			$message 		= $this->_post_variable_not_complete_message;
		}

		$data =  null;
		$this->jsonout(	$status,
						$message, 
						$data
						);
		exit ;
	}


	/*=====================================================================================
		IS BEING CALLED USING AJAX

		USING
		=================================
		=>	
			url : http://localhost/asiaedu/my_account_api/get_customer_address_data
			$_POST['token'] 				= 'sfsdfuywejsdfu';
			$_POST['request_method'] 		= 'get_customer_address_data';
			$_POST['customer_address_id'] 	= 'get_customer_address_data';

	=====================================================================================*/	
	public function get_customer_address_data( )
	{	
		if( isset($_POST['customer_address_id']) ){

			$customer_address_id 	= 	$this->security->xss_clean($this->input->post('customer_address_id'));
			$this->load->model('my_account_model');
			$my_account_model		= $this->my_account_model->get_customer_address_data($customer_address_id);
			$customer_address 		= $my_account_model['customer_address'];
			$customer_address 		= $customer_address->result_array();

			if( count($customer_address) > 0 ){

				$city_id 				= $customer_address[0]['city_id'];
				$province_id 			= $customer_address[0]['province_id'];
				$province				= json_decode($this->rajaongkir->city_detail($city_id), true);
				$province_name 			= $province['rajaongkir']['results']['province'];
				$city_name 			 	= $province['rajaongkir']['results']['city_name'];
							
				$status 				= self::SUCCESS;
				$message 				= $this->_success_message;
				$data[0]['province'] 	= $province_name;
				$data[0]['city_name'] 	= $city_name;
			}else{

				$status 		= self::ERROR;
				$message 		= $this->_data_not_exist_message;
				$data 			= null;	
			}

		}else{
			$status 		= self::ERROR;
			$message 		= $this->_post_variable_not_complete_message;
			$data 			= null;
		}	

		$this->jsonout(	$status,
						$message, 
						$data
						);
		exit ;
	}	


	/*=====================================================================================
		
		IS BEING CALLED USING AJAX

		USING
		=================================
		=>	
			url : http://localhost/asiaedu/my_account_api/set_default_customer_address
			$_POST['token'] 				= 'sfsdfuywejsdfu';
			$_POST['request_method'] 		= 'set_default_customer_address';
			$_POST['customer_address_id'] 	= 'get_customer_address_data';

	=====================================================================================*/	
	public function set_default_customer_address( )
	{	
		if( isset($_POST['customer_address_id']) ){

			$customers = $this->db->query("SELECT * FROM customers where token='".$this->security->xss_clean($this->input->post('token'))."'")->row();
			$weleh 	= 	array (
								'default_column' 		=> '0'
						);
			$this->model_utama->update_data($customers->customer_id,'customer_id','customer_address',$weleh);
			
			$customer_address_id = $this->security->xss_clean($this->input->post('customer_address_id'));
			$weleh 	= 	array (
								'default_column'	=> '1'
						);
			$this->model_utama->update_data($customer_address_id,'customer_address_id','customer_address',$weleh);

			$status 		= self::SUCCESS;
			$message 		= $this->_update_success_message;
			$data 			= null;

		}else{	
			$status 		= self::ERROR;
			$message 		= $this->_post_variable_not_complete_message;
			$data 			= null;
		}

		$this->jsonout(	$status,
						$message, 
						$data
						);
		exit ;
	}



}