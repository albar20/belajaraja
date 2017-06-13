<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*===============================================
	1.	CONSTRUCT METHOD
	2.	USER STILL CAN DO THE TEST
	3.	LOG VISITOR
	4.	SEND EMAIL
===============================================*/
class MY_Controller extends CI_Controller {
	
	/*===============================================
		1.	CONSTRUCT METHOD
	===============================================*/
	public function __construct(){
		parent::__construct();
		$session = true;
		
		if( $session ){
			$enable_access = false;
			$file_admin = array(
							'admin',	
							'admin_bulk_delete',
							'admin_murid',
							'admin_murid/tambah',
							'admin_murid/tambah_ajax',
							'admin_murid/edit',
							'admin_murid/trash',
							'delete/delete_process'
							);
			
			$file_super_admin = array(
									'admin_category',
									'admin_category/tambah',
									'admin_category/tambah_ajax',
									'admin_category/edit',
									'admin_category/trash',
									'admin_tipe_test',
									'admin_tipe_test/tambah',
									'admin_tipe_test/tambah_ajax',
									'admin_tipe_test/edit',
									'admin_tipe_test/trash',
									'admin_tipe_soal',
									'admin_tipe_soal/tambah',
									'admin_tipe_soal/tambah_ajax',
									'admin_tipe_soal/edit',
									'admin_tipe_soal/trash',
									'admin_occupations',
									'admin_occupations/tambah',
									'admin_occupations/tambah_ajax',
									'admin_occupations/edit',
									'admin_occupations/trash',
									'admin_soal',
									'admin_soal/tambah',
									'admin_soal/tambah_ajax',
									'admin_soal/edit',
									'admin_soal/trash',
										'admin_soal/power_test',
										'admin_soal/power_test/tambah',
										'admin_soal/power_test/tambah_ajax',
										'admin_soal/power_test/edit',
										'admin_soal/power_test/trash',
										'admin_soal/personality_test',
										'admin_soal/personality_test/tambah',
										'admin_soal/personality_test/tambah_ajax',
										'admin_soal/personality_test/edit',
										'admin_soal/personality_test/trash'
									);
			
			$file_admin_murid = array(
									'profil',	
									'test',
									'test/power_test',
									'test/test_ajax',
									'test/personality_test',
									'test/hasil',
									'test/log',
									'test/create_session_pr_test'
								);
			
			if( $this->session->userdata('logged_in') ){
				
				if(		$this->session->userdata('login_status') == 'admin' 
					||	$this->session->userdata('login_status') == 'super_admin'
				){
					if(	$this->session->userdata('login_status') == 'super_admin' ){
						$file_admin = array_merge( $file_admin, $file_super_admin);
					}
					$redirect_to = 'admin';	
				}
				
				
				if(	$this->session->userdata('login_status') == 'murid' ){
					$file_admin = $file_admin_murid;
					$redirect_to = 'profil';	
				}
				
				foreach( $file_admin as $file ){
					
				
					if( current_url() == base_url() . $file ){
						$enable_access = true;
						break;
					}
					$pattern_array= array(
											'/.(admin_murid)/i',
											'/.(admin_category)/i',
											'/.(admin_tipe_test)/i',
											'/.(admin_tipe_soal)/i',
											'/.(admin_soal)/i',
											'/.(admin_occupations)/i'
										  );
					foreach( $pattern_array as $pattern ){
						
						$subject = current_url();
						preg_match($pattern, $subject, $matches);
						
						if( count( $matches ) > 0 ){
							if( $matches[1] == $file ){
								$enable_access = true;
								//break 2;
							}
						}
					}
				}	
				
				if( !$enable_access ){
					if(  current_url() != base_url() . 'logout' ){
						redirect( base_url() . $redirect_to, 'refresh');
					}
				}	
				
			}else{
				$enable_access = true;
				$file_admin = array_merge( $file_admin, $file_super_admin,$file_admin_murid );
				foreach( $file_admin as $file ){
					if( current_url() == base_url() . $file ){
						$enable_access = false;
						break;
					}
				}
				if( !$enable_access ){
					$redirect_to = 'login';	
					redirect( base_url() . $redirect_to, 'refresh');
				}	
			} // if( $this->session->userdata('logged_in') ){

		} // if( $session ){
		
	} // public function __construct(){
		
		
	/*===============================================
		2.	USER STILL CAN DO THE TEST
			1.	CHECK HAD USER DONE THE TEST
			2.	CHECK HAD USER DONE THE LOGOUT
			3.	CHECK USER LOGIN TIMES
	===============================================*/
	public function is_user_can_do_test(){
		
		$can_do_test = true;
		/*====================================================
			1.	CHECK HAS USER DONE THE TEST
		====================================================*/
		$this->db->where('user_id', $this->session->userdata('user_id') );
		$hasil = $this->model_utama->get_data('hasil_test');
		if( count($hasil->result()) > 0 ){
			$can_do_test = false;
		}
		
		/*====================================================
			2.	CHECK HAD USER DONE THE LOGOUT
		====================================================*/
		$this->db->where('user_id', $this->session->userdata('user_id') );
		$this->db->where('activity', 'logout' );
		$is_logout = $this->model_utama->get_data('log_visitor');
		if( count($is_logout->result()) > 0 ){
			$can_do_test = false;
		}
		
		/*====================================================
			3.	CHECK USER LOGIN TIMES
		====================================================*/
		$this->db->where('user_id', $this->session->userdata('user_id') );
		$this->db->where('activity', 'login' );
		$is_login = $this->model_utama->get_data('log_visitor');
		if( count($is_login->result()) > 5 ){
			$can_do_test = false;
		}
		
		if( !$can_do_test ){
			$this->session->set_userdata('can_follow_test',FALSE);
			redirect('murid/profil', 'refresh');
		}
	}
	
	
	/*===============================================
		3.	LOG VISITOR
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
							'create_date'		=> 	date('Y-m-d H:i:s',now()),
							'user_id'			=> 	$this->session->userdata('user_id')
							);
		$query = $this->model_utama->insert_data($table,$array_data);
	}
	
	
	/*===============================================
		4.	SEND EMAIL
	===============================================*/
	function send_email($recipient,$subject,$link,$action){
		
		$config = Array(
						'mailtype'  => 'html'
						);
		
		$this->load->library('email',$config);
		$this->email->from('wahsidintjandra@gmail.com', 'Wahsidin');
		$this->email->to($recipient);
		$this->email->subject($subject);
		
		if( $action == 'registrasi'){
			$this->email->message('<p>Silahkan akfifasi email kamu dengan mengeklik link ini <a href="'.$link.'">Aktifasi Account</a></p>');
		}else{
			$this->email->message('<p>Silahkan reset password anda dengan mengeklik link ini <a href="'.$link.'">Aktifasi Account</a></p>');
		}
		
		
		if( $this->email->send() ){
			return true;	
		}else{
			return false;	
		}
	}
}