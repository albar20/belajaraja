<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//date_default_timezone_set ('Asia/Jakarta');
/*===============================================
	1.	THEMES
	3.	LOG VISITOR 		HELPER
	4.	SEND EMAIL 			HELPER
	5.	SEND EMAIL 			HELPER	
	6.	DATE CONVERTER 		HELPER
	7.	SANITIZING 			HELPER
	8.	UPLOAD PHOTO 
		& RESIZE IMAGE 		HELPER
	
	ECOMMERCE HELPER
	20.	CUSTOMER REGISTER 	HELPER
	21.	CART STRUCTURE 		HELPER
	21.	BEST SELLER 		HELPER
	
	20.	MINIFY 				HELPER
	
===============================================*/
class MY_Controller extends CI_Controller {
	
	/*===============================================
		1.	THEMES NAME
	===============================================*/
	public $themes_name;
	public $themes_folder_name;
	public $setting;


	/*========================================================================
		1.	CONSTRUCT METHOD
			1.	SET VARIABLE 
			1.	SET TIME ZONE
			2.	SET THEMES NAME
			3.	SET FRONT END TEMPLATE 

	========================================================================*/
	public function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
	
		/*===============================================
			1.	SET VARIABLE 
		===============================================*/
		$this->segment_1 					= $this->security->xss_clean($this->uri->segment(1));
		$this->segment_2 					= $this->security->xss_clean($this->uri->segment(2));
		$this->segment_3 					= $this->security->xss_clean($this->uri->segment(3));

		/*===============================================
			1.	SET TIME ZONE
		===============================================*/	
		date_default_timezone_set("Asia/Bangkok");

		/*===============================================
			2.	SET THEMES NAME 
		===============================================*/	
		$template = $this->db->query("SELECT template_name FROM templates WHERE active='1'")->row();
		$this->themes_folder_name = $template->template_name;

		/*===============================================
			3.	SET FRONT END TEMPLATE 
		===============================================*/
		$this->front_end_template = 'main/'.$this->themes_folder_name.'/template';

		/*===============================================
			4.	SETTING  
		===============================================*/
		$this->setting = $this->db->query("SELECT * FROM setting")->row();

	}

	
	/*===============================================
		3.	LOG VISITOR 		HELPER
	===============================================*/
	function log_visitor($action){
		$this->load->model('model_utama','',TRUE);
		$this->load->helper('date');
		$this->load->library('user_agent');
		$table 		= 'log_visitor';
		$array_data = 	array(
							'ip_address'		=> 	$_SERVER['HTTP_USER_AGENT'],
							'activity'			=> 	$action,
							'browser'			=> 	$this->agent->browser(), 
  							'version'			=> 	$this->agent->version(), 
							'mobile'			=> 	$this->agent->mobile(), 
							'robot'				=>	$this->agent->robot(),
							'platform'			=>  $this->agent->platform(),
							'create_date'		=> 	date('Y-m-d H:i:s',now())
							//'user_id'			=> 	$this->session->userdata('user_id')
							);
		$query = $this->model_utama->insert_data($table,$array_data);
	}

	
	/*===============================================
		4.	SEND EMAIL 			HELPER
	===============================================*/
	function send_email($from,$recipient,$subject,$message){
		
		$config = Array(
						'mailtype'  => 'html'
						);
		
		$this->load->library('email',$config);
		$this->email->from($from, 'Babastudio');
		$this->email->to($recipient);
		$this->email->subject($subject);
		
		$this->email->message($message);
		
		
		if( $this->email->send() ){
			return true;	
		}else{
			return false;	
		}
	}


	/*====================================================
		5.	SEND EMAIL 			HELPER	
			1.	SEND EMAIL CONFIRM REGISTER
			2.	SEND EMAIL LOST PASSWORD
	====================================================*/
	public function send_email_when( 	$actions,
										$recipient_email,
										$random_hash=''
	){
		$email_registration_subject 		= 	'Email Registrai';
		$email_registration_link_text		= 	'<span>Silahkan Konfirmasi Registrasi</span>';
		$email_registration_message			= 	'<p>Silahkan akfifasi email kamu dengan mengeklik link ini</p>';

		$email_lost_password_subject 		=	'Email Ganti Password';
		$email_lost_password_link_text		= 	'<span>Silahkan Ubah Password Anda</span>';
		$email_lost_password_message 		=	'<p>Silahkan reset password anda dengan mengeklik link ini</p>';


		
		/*====================================
			1.	SEND EMAIL CONFIRM REGISTER
		====================================*/
		if( $actions == 'confirm_register' ){
			$confirm_registration_link 	= site_url() . 'confirm_register/'.$random_hash;
			$subject 					= $email_registration_subject;
			$recipient					= $recipient_email;
			$message 					= $email_registration_message;
			$message 					.= ' <a href="'.$confirm_registration_link.'">'.$email_registration_link_text.'</a>';

			$result_send 				= $this->send_email(	$recipient,
																$subject,
																$confirm_registration_link,
																$message
																);
		}	
		
		/*====================================
			2.	SEND EMAIL LOST PASSWORD
		====================================*/
		if( $actions == 'lost_password' ){
			$lost_password_link 		= site_url() . 'reset_password/reset/'.$random_hash;
			$subject 					= $email_lost_password_subject;
			$recipient					= $recipient_email;
			$message 					= $email_lost_password_message;
			$result_send 				= $this->send_email(	$recipient,
																$subject,
																$lost_password_link,
																$message
																);
		}
		return $result_send;
	}	

	/*======================================================
		6.	DATE CONVERTER 		HELPER
	======================================================*/
	public function date_converter($tanggal,$time='',$format = '1'){
		
		if( $format == '1' ){
			return date('Y-m-d',strtotime($tanggal));
		}
		
		if( $format == '2' ){
			$month		= substr($tanggal,0,2);
			$day 		= substr($tanggal,3,2);	
			$year 		= substr($tanggal,6,4);
			//$tgl_mulai 	= strtotime($day .' '. $month .' '. $year);
			$plus_time = '';
			if( $time ){
				$plus_time = ' 00:00:00';
			}
			return $year.'-'.$month.'-'.$day.$plus_time;
		}

		if( $format == '3' ){
			$day		= substr($tanggal,0,2);
			$month 		= substr($tanggal,3,2);	
			$year 		= substr($tanggal,6,4);
			//$tgl_mulai 	= strtotime($day .' '. $month .' '. $year);
			$plus_time = '';
			if( $time ){
				$plus_time = ' 00:00:00';
			}
			return $year.'-'.$month.'-'.$day.$plus_time;
		}
	}

	/*==============================================================
		7.	SANITIZING 			HELPER
	==============================================================*/
	public function sanitizing($form_element){

		$after_sanitize_element = array();
		foreach( $form_element as $element_info ){
			$element										= $this->input->post( $element_info['name'] );
			$element 										= $this->security->xss_clean($element);
			$after_sanitize_element[$element_info['name']]	= $element;
		}
		/*$tanggal 		= filter_var($this->input->post('tanggal'),FILTER_SANITIZE_STRING);
		$nama_kti 		= filter_var($this->input->post('nama_kti'),FILTER_SANITIZE_STRING);
		$tipe_kti 		= filter_var($this->input->post('tipe_kti'),FILTER_SANITIZE_STRING);
		$deskripsi 		= filter_var($this->input->post('deskripsi'),FILTER_SANITIZE_STRING);
		$tanggal		= $this->security->xss_clean($tanggal);
		$nama_kti		= $this->security->xss_clean($nama_kti);
		$tipe_kti 		= $this->security->xss_clean($tipe_kti);
		$deskripsi 		= $this->security->xss_clean($deskripsi);*/

		return $after_sanitize_element;
	}		


	/*==============================================================
		8.	UPLOAD PHOTO 
			& RESIZE IMAGE 		HELPER

			1.	CREATE DIRECTORY
			2.	UPLOAD PHOTO
			3.	RESIZE IMAGE
	==============================================================*/
	function upload_photo( 	$folder_path,
							$config
	){

		/*===============================================================
			1.	CREATE DIRECTORY
		===============================================================*/
		$all_path = explode('/',$folder_path);
		$x 		= 0;
		$path 	= '';
		foreach( $all_path as $fp ){
			$separator = '/';
			if( $x == 0 ){
				$separator = '';
			}
			$path = $path . $separator . $fp; 	
			if (!is_dir($path)){
		        mkdir('./'.$path.'/', 0777, true);
		    }
		    $x++;
		}

	    /*===============================================================
			2.	UPLOAD PHOTO
		===============================================================*/	
	    $this->load->library('upload', $config);
		if ( ! $this->upload->do_upload())
		{
			$file_dokumen	= '';
		}
		else
		{
			/*===============================================================
				2.	RESIZE IMAGE
			===============================================================*/	
			$dokumen		= $this->upload->data();
			$file_dokumen	= $dokumen['file_name'];

			$this->load->library('image_lib');
			$config_resize['image_library'] 	= 'gd2';
			$config_resize['source_image']		= $dokumen['full_path'];
			$config_resize['new_image']			= './'.$folder_path;
			$config_resize['create_thumb'] 		= TRUE;
			$config_resize['maintain_ratio'] 	= TRUE;
			$config_resize['thumb_marker'] 		= '';
			$config_resize['width']	 			= 150;
			$config_resize['height']			= 150;
			$config_resize['quality'] 			= "100%";
			$dim 								= (intval($dokumen["image_width"]) / intval($dokumen["image_height"])) - ($config_resize['width'] / $config_resize['height']);
			$config_resize['master_dim'] 		= ($dim > 0)? "height" : "width";
			$this->image_lib->initialize($config_resize);
			if(!$this->image_lib->resize()){ //Resize image
			    echo $this->image_lib->display_errors();
			    exit;
			}
		}

		return $file_dokumen;
	}
	



	/*====================================================
		20.	CUSTOMER REGISTER 	HELPER
			1.	ONLY FOR REGISTER FORM
			1.	VALIDATION
			2.	CHECK EMAIL
			3.	CHECK PASSWORD MATCHES
			3.	UPLOAD IMAGE
			4.	INSERT DATA 
			5.	SEND EMAIL CONFIRM REGISTER
			5.	INSERT LOG
			6.	REDIRECT 
	====================================================*/
	public function customer_register_helper(	$redirect,
												$upload_image = true,
												$view,
												$data,
												$create_by
	){

			/*echo "<pre>";
				print_r($_POST);
			echo "</pre>";
			die();*/
		
		/*$_POST['customer_fname']                  = 'kelly hoo';
		$_POST['customer_lname']                  = 'moore';
		$_POST['customer_sex']                    = 'laki';
		$_POST['customer_birthday']               = '2016-08-09';
		$_POST['customer_email']                  = 'kellyy@yahoo.com';
		$_POST['customer_password']               = 'admin';
		$_POST['customer_password2']               = 'admin';
		$_POST['customer_address']                = 'jalan hello';
		$_POST['customer_state']                  = 'jakarta';
		$_POST['customer_city']                   = 'jakarta';
		$_POST['customer_sub_postal']             = '55555';
		$_POST['customer_phone']                  = '0812222';
		$_POST['customer_mobile']                 = '082388888';*/


		/*====================================================
			1.	VALIDATION
				1.	ONLY FOR REGISTER FORM
				2.	VALIDATION RULES
		====================================================*/

			/*====================================================
				1.	ONLY FOR REGISTER FORM
			====================================================*/
			$do_form_validation = true;
			if( isset($_POST['from_register_form']) ){
				if( !isset($_POST['accept_terms_and_condition']) ){
					$do_form_validation = false;
					$data['error_term_and_conditions'] = 'Please read and accept our terms and conditions.';
				}
			}

			/*====================================================
				2.	VALIDATION RULES
			====================================================*/
			$this->form_validation->set_rules('customer_fname', 'Nama Depan', 'required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('customer_lname', 'Nama Belakang', 'required|min_length[5]|max_length[255]');
			$this->form_validation->set_rules('customer_sex', 'Jenis Kelamin', 'required');
			$this->form_validation->set_rules('customer_birthday', 'Tanggal Lahir', 'required');
			$this->form_validation->set_rules('customer_email', 'Email', 'required');
			$this->form_validation->set_rules('customer_password', 'Password', 'required');
			$this->form_validation->set_rules('customer_password2', 'Re-Password', 'required');
			$this->form_validation->set_rules('customer_address', 'Alamat Lengkap', 'required');
			$this->form_validation->set_rules('customer_state', 'Propinsi', 'required');
			$this->form_validation->set_rules('customer_city', 'Kota', 'required');
			$this->form_validation->set_rules('customer_sub_postal', 'Kode Pos', 'required');
			$this->form_validation->set_rules('customer_phone', 'Telepon', 'required');
			$this->form_validation->set_rules('customer_mobile', 'Handphone', 'required');

			
		if( $do_form_validation ){
			
			if ($this->form_validation->run() == TRUE)
			{
		
				/*====================================================
					2.	CHECK EMAIL
				====================================================*/
				$email 		= $this->input->post('customer_email');
				$cek_email	= $this->model_utama->cek_data($email,'customer_email','customers');

				if(count($cek_email->result_array()) <= 0){
					
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

						/*====================================================
							4.	INSERT DATA 
						====================================================*/
						$random_hash 		= md5(uniqid(rand(), true));
						if( $create_by == 'admin' ){
							$customer_account_status  	= '1';
							$customer_activation_key 	= '';	
						}else{
							$customer_account_status  	= '0';
							$customer_activation_key 	= $random_hash;		
						}
						
						$weleh = array (
										'customer_fname' 		=> $this->security->xss_clean($this->input->post('customer_fname')),
										'customer_photo' 		=> $this->security->xss_clean($file_dokumen),
										'customer_lname' 		=> $this->security->xss_clean($this->input->post('customer_lname')),
										'customer_sex' 			=> $this->security->xss_clean($this->input->post('customer_sex')),
										'customer_birthday' 	=> $this->date_converter($this->security->xss_clean($this->input->post('customer_birthday')),'','1'),
										'customer_email' 		=> $this->security->xss_clean($this->input->post('customer_email')),
										'customer_password' 	=> md5($password),
										'customer_address' 		=> $this->security->xss_clean($this->input->post('customer_address')),
										'customer_state' 		=> $this->security->xss_clean($this->input->post('customer_state')),
										'customer_city' 		=> $this->security->xss_clean($this->input->post('customer_city')),
										'customer_sub_postal' 	=> $this->security->xss_clean($this->input->post('customer_sub_postal')),
										'customer_phone' 		=> $this->security->xss_clean($this->input->post('customer_phone')),
										'customer_mobile' 		=> $this->security->xss_clean($this->input->post('customer_mobile')),
										'customer_account_status' 			=> $customer_account_status,
										'customer_account_activation_key' 	=> $customer_activation_key,
										'create_date'			=> date('Y-m-d H:i:s')
										);

						$query 		= $this->model_utama->insert_data('customers', $weleh);
						$insert_id 	= $this->db->insert_id();
						
						
						if( $query ){
							
							/*====================================
								5.	SEND EMAIL CONFIRM REGISTER
							====================================*/
							$actions 			=	'confirm_register';
							$recipient_email	= 	$this->security->xss_clean($this->input->post('customer_email'));
							$result_send 		=	$this->send_email_when( $actions,
																			$recipient_email,
																			$random_hash
																			);
							if( $result_send ){
								$result['register_process'] = true;
							}else{
								$table = 'customer';
								$this->CI->db->delete($table, array('id_user' => $insert_id));
								$result['register_process'] = false;
							}

							if( $create_by == 'admin'){
								$success_message = 'Data berhasil disimpan!';
							}else{
								$success_message = 'Silahkan lakukan Akun Verifikasi dan aktivasi melalui email anda';	
							}

							$this->session->set_flashdata('success', $success_message);
						}			

						
						/*====================================================
							5.	INSERT LOG
						====================================================*/
						if( $this->session->has_userdata('id_user') ){
							$user_id 					= $this->session->userdata('id_user');
							$log['user_id']				= $user_id;
							$log['activity']			= 'tambah data customer';
							$this->model_utama->insert_data('log_user', $log);
						}

						/*====================================================
							6.	REDIRECT 
						====================================================*/
						redirect( $redirect, 'refresh');

					}else{ 
						$data['password_not_same_message'] = 'Password Anda tidak sama';

					} // if( $password == $re_password ){


				}else{ 

					$this->session->set_flashdata('danger', 'email sudah digunakan!');
					$this->load->view( $view, $data);
				}
			}
		
		}
		
		$this->load->view( $view, $data);
	}


	/*===============================================
		21.	BEST SELLER 		HELPER
	===============================================*/
	public function get_best_seller_helper( $limit = 1 ){

		$sql 					= 	"SELECT 
										product_id,
										SUM(product_qty) AS total_sales
									FROM order_products
									GROUP BY product_id
									ORDER BY total_sales DESC
									LIMIT ".$limit;

		$data['best_seller']	= 	$this->db->query($sql);	
		$best_seller 			=	$data['best_seller']->result_array();


		$product_id 			= 	$best_seller[0]['product_id'];
		$sql 					= 	"SELECT 
										p.product_id,
										p.product_name,
										p.description,
										p.slug,
										p.price,
										pp.product_picture
									FROM product AS p 
									LEFT JOIN product_picture AS pp 
									ON p.product_id = pp.product_id
									WHERE pp.product_id=".$product_id
									." AND p.stock !=0";

		$data['best_seller']	= 	$this->db->query($sql);				
		return $data['best_seller'];
	}

	

	/*===============================================
		20.	MINIFY 				HELPER
	===============================================*/
	public function minify($empty_cache=false){
		
		/*====================================================
			1.	LOAD LIBRARY
		====================================================*/
		$this->load->library('carabiner');
		
		$carabiner_config = array(
								'script_dir' => 'assets/front_page/', 
								'style_dir'  => 'assets/front_page/',
								'cache_dir'  => 'assets/cache/',
								'base_uri'	 => base_url(),
								'dev' 		 => false,
								'combine'	 => false,
								'minify_js'  => false,
								'minify_css' => false
							);
		$this->carabiner->config($carabiner_config);
		
		/*====================================================
			2. 	CLEAR CACHE
		====================================================*/
		if( $empty_cache ){
			$this->carabiner->empty_cache();
		}
		
		/*====================================================
			3.	MINIFY CSS
		====================================================*/
		
																
														
														/*START MINIFY CSS START*/
												
											if( 	$this->segment_1 == "video"
												&&	$this->segment_2 == ""
											){
										
												$this->carabiner->css("devstudio/plugins/bootstrap/css/bootstrap.min.css");
												$this->carabiner->css("devstudio/plugins/font-awesome/css/font-awesome.css");
												$this->carabiner->css("devstudio/plugins/elegant_font/css/style.css");
												$this->carabiner->css("devstudio/css/styles.css");
										}
												
												
											if( 	$this->segment_1 == "video"
												&&	$this->segment_2 != ""
											){
										
												$this->carabiner->css("devstudio/plugins/bootstrap/css/bootstrap.min.css");
												$this->carabiner->css("devstudio/plugins/font-awesome/css/font-awesome.css");
												$this->carabiner->css("devstudio/plugins/elegant_font/css/style.css");
												$this->carabiner->css("devstudio/plugins/rrssb/css/rrssb.css");
												$this->carabiner->css("devstudio/css/styles.css");
										}
												
												
        								if( 	$this->segment_1 != "" 
        									&&	$this->segment_1 != "home"
        									&&	$this->segment_1 != "index" 
        									&&	$this->segment_1 != "index"
							 			   	&&	$this->segment_1 != "blog-single"
							 			   	&&	$this->segment_1 != "blog"
							 			   	&&	$this->segment_1 != "galeri-single"
							 			   	&&	$this->segment_1 != "galeri"
							 			   	&&	$this->segment_1 != "kontak"
							 			   	&&	$this->segment_1 != "page"
							 			   	&&	$this->segment_1 != "video-single"
							 			   	&&	$this->segment_1 != "video"
							 			   
										 ){
												$this->carabiner->css("devstudio/plugins/bootstrap/css/bootstrap.min.css");
												$this->carabiner->css("devstudio/plugins/font-awesome/css/font-awesome.css");
												$this->carabiner->css("devstudio/plugins/elegant_font/css/style.css");
												$this->carabiner->css("devstudio/css/styles.css");
										}
												
												
											if( 	$this->segment_1 == "kontak"
												&&	$this->segment_2 == ""
											){
										
												$this->carabiner->css("devstudio/plugins/bootstrap/css/bootstrap.min.css");
												$this->carabiner->css("devstudio/plugins/font-awesome/css/font-awesome.css");
												$this->carabiner->css("devstudio/plugins/elegant_font/css/style.css");
												$this->carabiner->css("devstudio/css/styles.css");
										}
												
												
											if( 	$this->segment_1 == "galeri"
												&&	$this->segment_2 == ""
											){
										
												$this->carabiner->css("devstudio/plugins/bootstrap/css/bootstrap.min.css");
												$this->carabiner->css("devstudio/plugins/font-awesome/css/font-awesome.css");
												$this->carabiner->css("devstudio/plugins/elegant_font/css/style.css");
												$this->carabiner->css("devstudio/css/styles.css");
										}
												
												
											if( 	$this->segment_1 == "galeri"
												&&	$this->segment_2 != ""
											){
										
												$this->carabiner->css("devstudio/plugins/bootstrap/css/bootstrap.min.css");
												$this->carabiner->css("devstudio/plugins/font-awesome/css/font-awesome.css");
												$this->carabiner->css("devstudio/plugins/elegant_font/css/style.css");
												$this->carabiner->css("devstudio/plugins/rrssb/css/rrssb.css");
												$this->carabiner->css("devstudio/css/styles.css");
										}
												
												
											if( 	$this->segment_1 == "blog"
												&&	$this->segment_2 == ""
											){
										
												$this->carabiner->css("devstudio/plugins/bootstrap/css/bootstrap.min.css");
												$this->carabiner->css("devstudio/plugins/font-awesome/css/font-awesome.css");
												$this->carabiner->css("devstudio/plugins/elegant_font/css/style.css");
												$this->carabiner->css("devstudio/css/styles.css");
										}
												
												
											if( 	$this->segment_1 == "blog"
												&&	$this->segment_2 != ""
											){
										
												$this->carabiner->css("devstudio/plugins/bootstrap/css/bootstrap.min.css");
												$this->carabiner->css("devstudio/plugins/font-awesome/css/font-awesome.css");
												$this->carabiner->css("devstudio/plugins/elegant_font/css/style.css");
												$this->carabiner->css("devstudio/plugins/rrssb/css/rrssb.css");
												$this->carabiner->css("devstudio/css/styles.css");
										}
												
												
											if( 	$this->segment_1 == ""
												||	$this->segment_1 == "home"
												||	$this->segment_1 == "index"
												||	$this->segment_1 == "login"
												||	$this->segment_1 == "register_form"
												||	$this->segment_1 == "lost_password"
											){

										
												$this->carabiner->css("devstudio/plugins/bootstrap/css/bootstrap.min.css");
												$this->carabiner->css("devstudio/plugins/font-awesome/css/font-awesome.css");
												$this->carabiner->css("devstudio/plugins/elegant_font/css/style.css");
												$this->carabiner->css("devstudio/plugins/flexslider/flexslider.css");
												$this->carabiner->css("devstudio/plugins/owl-carousel/owl.carousel.css");
												$this->carabiner->css("devstudio/plugins/owl-carousel/owl.theme.css");
												$this->carabiner->css("devstudio/css/styles.css");
										}
												

														 /*START MINIFY CSS END*/

			if( $this->segment_1 == "register" ){
				$this->carabiner->css("bootstrap-datepicker.min.css");
			}
			$this->carabiner->css("custom_search/custom_search.css");




		/*====================================================
			4.	MINIFY JS
		====================================================*/
		
													
		
													
													/*START MINIFY JS START*/
											
										if( 	$this->segment_1 == "video"
											&&	$this->segment_2 == ""
										){
									
												$this->carabiner->js("devstudio/plugins/jquery-1.11.3.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap/js/bootstrap.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap-hover-dropdown.min.js","","false");
												$this->carabiner->js("devstudio/plugins/back-to-top.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-placeholder/jquery.placeholder.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-match-height/jquery.matchHeight-min.js","","false");
												$this->carabiner->js("devstudio/plugins/FitVids/jquery.fitvids.js","","false");
												$this->carabiner->js("devstudio/js/main.js","","false");
												$this->carabiner->js("devstudio/plugins/imagesloaded.pkgd.min.js","","false");
												$this->carabiner->js("devstudio/plugins/isotope.pkgd.min.js","","false");
												$this->carabiner->js("devstudio/js/isotope-custom.js","","false");
												$this->carabiner->js("devstudio/js/demo/style-switcher.js","","false");
									}
											
											
										if( 	$this->segment_1 == "video"
											&&	$this->segment_2 != ""
										){
									
												$this->carabiner->js("devstudio/plugins/jquery-1.11.3.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap/js/bootstrap.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap-hover-dropdown.min.js","","false");
												$this->carabiner->js("devstudio/plugins/back-to-top.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-placeholder/jquery.placeholder.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-match-height/jquery.matchHeight-min.js","","false");
												$this->carabiner->js("devstudio/plugins/FitVids/jquery.fitvids.js","","false");
												$this->carabiner->js("devstudio/js/main.js","","false");
												$this->carabiner->js("devstudio/plugins/rrssb/js/rrssb.min.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery.validate.min.js","","false");
												$this->carabiner->js("devstudio/js/form-validation-custom.js","","false");
												$this->carabiner->js("devstudio/plugins/isMobile/isMobile.min.js","","false");
												$this->carabiner->js("devstudio/js/form-mobile-fix.js","","false");
												$this->carabiner->js("devstudio/js/demo/style-switcher.js","","false");
									}
											
											
    								if( 	$this->segment_1 != "" 
    									&&	$this->segment_1 != "home"
    									&&	$this->segment_1 != "index" 
    									&&	$this->segment_1 != "index"
									   	&&	$this->segment_1 != "blog-single"
									   	&&	$this->segment_1 != "blog"
									   	&&	$this->segment_1 != "galeri-single"
									   	&&	$this->segment_1 != "galeri"
									   	&&	$this->segment_1 != "kontak"
									   	&&	$this->segment_1 != "page"
									   	&&	$this->segment_1 != "video-single"
									   	&&	$this->segment_1 != "video"
									   
									 ){
												$this->carabiner->js("devstudio/plugins/jquery-1.11.3.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap/js/bootstrap.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap-hover-dropdown.min.js","","false");
												$this->carabiner->js("devstudio/plugins/back-to-top.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-placeholder/jquery.placeholder.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-match-height/jquery.matchHeight-min.js","","false");
												$this->carabiner->js("devstudio/plugins/FitVids/jquery.fitvids.js","","false");
												$this->carabiner->js("devstudio/js/main.js","","false");
												$this->carabiner->js("devstudio/js/demo/style-switcher.js","","false");
									}
											
											
										if( 	$this->segment_1 == "kontak"
											&&	$this->segment_2 == ""
										){
									
												$this->carabiner->js("devstudio/plugins/jquery-1.11.3.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap/js/bootstrap.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap-hover-dropdown.min.js","","false");
												$this->carabiner->js("devstudio/plugins/back-to-top.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-placeholder/jquery.placeholder.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-match-height/jquery.matchHeight-min.js","","false");
												$this->carabiner->js("devstudio/plugins/FitVids/jquery.fitvids.js","","false");
												$this->carabiner->js("devstudio/js/main.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery.validate.min.js","","false");
												$this->carabiner->js("devstudio/js/form-validation-custom.js","","false");
												$this->carabiner->js("devstudio/plugins/isMobile/isMobile.min.js","","false");
												$this->carabiner->js("devstudio/js/form-mobile-fix.js","","false");
												$this->carabiner->js("devstudio/js/demo/style-switcher.js","","false");
									}
											
											
										if( 	$this->segment_1 == "galeri"
											&&	$this->segment_2 == ""
										){
									
												$this->carabiner->js("devstudio/plugins/jquery-1.11.3.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap/js/bootstrap.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap-hover-dropdown.min.js","","false");
												$this->carabiner->js("devstudio/plugins/back-to-top.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-placeholder/jquery.placeholder.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-match-height/jquery.matchHeight-min.js","","false");
												$this->carabiner->js("devstudio/plugins/FitVids/jquery.fitvids.js","","false");
												$this->carabiner->js("devstudio/js/main.js","","false");
												$this->carabiner->js("devstudio/plugins/imagesloaded.pkgd.min.js","","false");
												$this->carabiner->js("devstudio/plugins/isotope.pkgd.min.js","","false");
												$this->carabiner->js("devstudio/js/isotope-custom.js","","false");
												$this->carabiner->js("devstudio/js/demo/style-switcher.js","","false");
									}
											
											
										if( 	$this->segment_1 == "galeri"
											&&	$this->segment_2 != ""
										){
									
												$this->carabiner->js("devstudio/plugins/jquery-1.11.3.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap/js/bootstrap.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap-hover-dropdown.min.js","","false");
												$this->carabiner->js("devstudio/plugins/back-to-top.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-placeholder/jquery.placeholder.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-match-height/jquery.matchHeight-min.js","","false");
												$this->carabiner->js("devstudio/plugins/FitVids/jquery.fitvids.js","","false");
												$this->carabiner->js("devstudio/js/main.js","","false");
												$this->carabiner->js("devstudio/plugins/rrssb/js/rrssb.min.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery.validate.min.js","","false");
												$this->carabiner->js("devstudio/js/form-validation-custom.js","","false");
												$this->carabiner->js("devstudio/plugins/isMobile/isMobile.min.js","","false");
												$this->carabiner->js("devstudio/js/form-mobile-fix.js","","false");
												$this->carabiner->js("devstudio/js/demo/style-switcher.js","","false");
									}
											
											
										if( 	$this->segment_1 == "blog"
											&&	$this->segment_2 == ""
										){
									
												$this->carabiner->js("devstudio/plugins/jquery-1.11.3.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap/js/bootstrap.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap-hover-dropdown.min.js","","false");
												$this->carabiner->js("devstudio/plugins/back-to-top.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-placeholder/jquery.placeholder.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-match-height/jquery.matchHeight-min.js","","false");
												$this->carabiner->js("devstudio/plugins/FitVids/jquery.fitvids.js","","false");
												$this->carabiner->js("devstudio/js/main.js","","false");
												$this->carabiner->js("devstudio/js/demo/style-switcher.js","","false");
									}
											
											
										if( 	$this->segment_1 == "blog"
											&&	$this->segment_2 != ""
										){
									
												$this->carabiner->js("devstudio/plugins/jquery-1.11.3.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap/js/bootstrap.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap-hover-dropdown.min.js","","false");
												$this->carabiner->js("devstudio/plugins/back-to-top.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-placeholder/jquery.placeholder.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-match-height/jquery.matchHeight-min.js","","false");
												$this->carabiner->js("devstudio/plugins/FitVids/jquery.fitvids.js","","false");
												$this->carabiner->js("devstudio/js/main.js","","false");
												$this->carabiner->js("devstudio/plugins/rrssb/js/rrssb.min.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery.validate.min.js","","false");
												$this->carabiner->js("devstudio/js/form-validation-custom.js","","false");
												$this->carabiner->js("devstudio/plugins/isMobile/isMobile.min.js","","false");
												$this->carabiner->js("devstudio/js/form-mobile-fix.js","","false");
												$this->carabiner->js("devstudio/js/demo/style-switcher.js","","false");
									}
											
											
										if( 	$this->segment_1 == ""
											||	$this->segment_1 == "home"
											||	$this->segment_1 == "index"
										){
									
												$this->carabiner->js("devstudio/plugins/jquery-1.11.3.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap/js/bootstrap.min.js","","false");
												$this->carabiner->js("devstudio/plugins/bootstrap-hover-dropdown.min.js","","false");
												$this->carabiner->js("devstudio/plugins/back-to-top.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-placeholder/jquery.placeholder.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery-match-height/jquery.matchHeight-min.js","","false");
												$this->carabiner->js("devstudio/plugins/FitVids/jquery.fitvids.js","","false");
												$this->carabiner->js("devstudio/js/main.js","","false");
												$this->carabiner->js("devstudio/plugins/flexslider/jquery.flexslider-min.js","","false");
												$this->carabiner->js("devstudio/js/flexslider-custom.js","","false");
												$this->carabiner->js("devstudio/plugins/jquery.validate.min.js","","false");
												$this->carabiner->js("devstudio/js/form-validation-custom.js","","false");
												$this->carabiner->js("devstudio/plugins/isMobile/isMobile.min.js","","false");
												$this->carabiner->js("devstudio/js/form-mobile-fix.js","","false");
												$this->carabiner->js("devstudio/plugins/owl-carousel/owl.carousel.js","","false");
												$this->carabiner->js("devstudio/js/owl-custom.js","","false");
												$this->carabiner->js("devstudio/js/demo/style-switcher.js","","false");
									}
											

													 /*START MINIFY JS END*/

									if( $this->segment_1 == "register" ){
										$this->carabiner->js("bootstrap-datepicker.js","","false");
										$this->carabiner->js("bootstrap-init.js","","false");
									}
									$this->carabiner->js("custom_search/custom_search.js");

	
		/*====================================================
			5.	DISPLAY CSS / JS
				ON , VIEW
				<?php echo $this->carabiner->display('css'); ?>
				<?php echo $this->carabiner->display('js'); ?>
				
				result
				=====================
				<link ... />
		====================================================*/
	}
	

	
}