<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*=========================================================================
	@author	M.Fadli Prathama (09081003031)
 	email : m.fadliprathama@gmail.com
	
	1.	USING


	1.	USING
	=========================================
	wwww.yoursite.com/admin/	


=========================================================================*/
class Log extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		if(	$this->session->userdata('login_admin') == true ){	
			
		}else{
			redirect(base_url().'login');
		}
	}

	/*==============================================================
		1.	GET DATA
	==============================================================*/
	public function index()
	{	
		redirect( base_url().'admin/log_visitor_admin/log_visitor', 'refresh');
	}

	public function log_visitors()
	{	
		$user_id 				= $this->session->userdata('id_user');
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['title'] 			= 'Halaman Log Visitor | '.$judul;
		$data['judul'] 	 		= $data['title'];
		$data['heading'] 		= "Log";	
		$data['page']			= 'admin/log/log_visitor';	
		$data['form_action']	= base_url().'admin/log/log_visitor';

		if( isset($_POST['create_date']) ){
			$date 					= $this->security->xss_clean( $_POST['create_date'] );
			
			$this->load->library('date_converter_library');
			$date 	= $this->date_converter_library->convert( $date );
			$this->load->library('log_library');
			$data['log_visitor'] 	= $this->log_library->show_log_visitor( $date );


		}
		$this->load->view($this->admin_template, $data);
	}


	public function log_user()
	{	
		$user_id 				= $this->session->userdata('id_user');
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['title'] 			= 'Halaman Log User | '.$judul;
		$data['judul'] 	 		= $data['title'];
		$data['heading'] 		= "Log";	
		$data['page']			= 'admin/log/log_user_admin';	
		$data['form_action']	= base_url().'admin/log/log_user';

		$sql = 	"SELECT
					user_id, 
					username
				FROM user";
		$data['user'] = $this->db->query($sql)->result_array();	
		foreach( $data['user'] as $u ){
			$user[$u['user_id']]	= $u['username'];
		}
		$data['user'] = $user;	

		if( isset($_POST['create_date']) ){
			$date 					= $this->security->xss_clean( $_POST['create_date'] );
			$user_id 				= $this->security->xss_clean( $_POST['user_id'] );
			
			$this->load->library('date_converter_library');
			$date 	= $this->date_converter_library->convert( $date );
			$this->load->library('log_library');
			$data['log_user'] 	= $this->log_library->show_log_user( 	$date,
																		$user_id
																	);

		}
		$this->load->view($this->admin_template, $data);
	}
	

	public function log_user_activity()
	{	
		$user_id 				= $this->session->userdata('id_user');
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['title'] 			= 'Halaman Log User Activity | '.$judul;
		$data['judul'] 	 		= $data['title'];
		$data['heading'] 		= "Log";	
		$data['page']			= 'admin/log/log_user_activity';	
		$data['form_action']	= base_url().'admin/log/log_user_activity';

		$sql = 	"SELECT
					user_id, 
					username
				FROM user";
		$data['user'] = $this->db->query($sql)->result_array();	
		foreach( $data['user'] as $u ){
			$user[$u['user_id']]	= $u['username'];
		}
		$data['user'] = $user;	


		if( isset($_POST['create_date']) ){
			$date 					= $this->security->xss_clean( $_POST['create_date'] );
			$user_id 				= $this->security->xss_clean( $_POST['user_id'] );
			$activity 				= $this->security->xss_clean( $_POST['activity'] );

			$this->load->library('date_converter_library');
			$date 	= $this->date_converter_library->convert( $date );
			$this->load->library('log_library');
			$data['log_user_activity'] 	= $this->log_library->show_log_user_activity( 	$date,
																						$user_id,
																						$activity	
																					);
		}
		$this->load->view($this->admin_template, $data);
	}


}