<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*=========================================================================
	@author	M.Fadli Prathama (09081003031)
 	email : m.fadliprathama@gmail.com
	
	DOCUMENTATION 
	=================================
	1.	Documentation
		=>	developer_documentation.php
		=>	4.	LOG 						LIBRARY

=========================================================================*/

/*======================================================
	1.	VARIABLES
	1.	LOG EXECUTION
	2.	CONSTRUCT
	3.	LOG USER 
	4.	LOG USER ACTIVITY
	5.	LOG VISITOR
	6.	VISITOR COUNTER
======================================================*/
class Log_library{
   

    /*======================================================
		1.	VARIABLES
	======================================================*/
    private $CI;
    private $login_member;

    /*======================================================
		2.	CONSTRUCT
	======================================================*/
	public function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->model('model_utama','',TRUE);
		$this->login_member = $this->CI->session->userdata('login_member');

	}

	/*======================================================
		1.	LOG EXECUTION
	======================================================*/
	public function log_excution(){
		if(	$this->login_member ){
			$this->log_user();
		}else{
			$this->log_visitor();
		}
	}

	/*===============================================
		3.	LOG USER 
			FOR LOG ALL THE LOGIN USER ACTIVITY
			on, MY_Controller.php 
	===============================================*/
	public function log_user(){
		
		$id_user 				= 	$this->CI->session->userdata('id_user');
		$url 					= 	$this->CI->safety_url();
		$log['activity']		= 	$url;

		if( 	stripos($url,"delete") > 0 
			|| 	stripos($url,"edit") > 0
			|| 	stripos($url,"add") > 0
		){

		}else{
			$table 				= 	'log_user';
			$log['user_id']		= 	$id_user;
			//$log['user_id']		= 	1;
			$this->CI->model_utama->insert_data(	$table, 
													$log );
		}
	}

	/*===============================================
		4.	LOG USER ACTIVITY
	===============================================*/
	function log_user_activity( $message= '' ){
		
		$id_user = '';
		if( $this->CI->session->has_userdata('id_user') ){
			$id_user 				= 	$this->CI->session->userdata('id_user');
		}
		if( $this->CI->session->has_userdata('user_id') ){
			$id_user 				= 	$this->CI->session->userdata('user_id');
		}	

		if( $message == '' ){
			$url 					= 	$this->CI->safety_url();
			$log['activity']		= 	$url . ' oleh id '.$id_user;

		}else{
			$log['activity']		= 	$message;	
		}

		$table 					= 	'log_user_activity';
		$log['user_id']			= 	$id_user;
		$this->CI->model_utama->insert_data(	$table, 
										 		$log );
	}


	/*===============================================
		5.	LOG VISITOR
			on, MY_Controller.php 
	===============================================*/
	public function log_visitor(){
		$this->CI->load->library('user_agent');
		$url 					= $this->CI->safety_url();
		$log['ip_address']		= $this->CI->input->ip_address();
		$log['activity']		= $url;
		$log['browser']			= $this->CI->agent->browser();
		$log['version']			= $this->CI->agent->version();
		$log['mobile']			= $this->CI->agent->mobile();
		$log['robot']			= $this->CI->agent->robot();
		$log['platform']		= $this->CI->agent->platform();
		$log['create_date']		= date('Y-m-d H:i:s');

		if( $this->CI->agent->is_referral() ){
			 $log['referral']		= $this->CI->agent->referrer();
		}else{
			 $log['referral']		= '';
		}
		$table 					= 'log_visitor';
		$this->CI->model_utama->insert_data(	$table, 
										 		$log );
	}

	public function visitor_counter(){

		$sql = 	"SELECT 
					COUNT(*) AS page_views,
					(	SELECT sum(test) AS total 
						FROM (	SELECT COUNT(DISTINCT(ip_address)) AS test 
								FROM log_visitor 
								GROUP BY DATE(create_date)
							) AS t ) AS kunjungan
				FROM log_visitor
				";
		$visitor_counter = $this->CI->db->query($sql)->result_array();
		return $visitor_counter;
	}

	public function show_log_visitor( $date ){
	
		$sql = 	"SELECT  
					activity,
					ip_address,
					referral,
					browser,
					version,
					mobile,
					robot,
					platform
				FROM log_visitor"
				." WHERE create_date >='".$date." 00:00:00'"
				." AND create_date <='".$date." 23:59:59'";

		$data['log_visitor'] = $this->CI->db->query($sql)->result_array();
		return $data['log_visitor'];
	}

	public function show_log_user( 	$date,
									$user_id 	= ''
	){

		$where = '';
		if( $user_id != '' ){
			$where .= " AND a.user_id=".$user_id;
		}

		$sql = 	"SELECT 
					a.activity, 
					b.username,
					b.user_status,
					b.user_id
				FROM log_user a 
				LEFT JOIN user b
				ON a.user_id=b.user_id"
				." WHERE a.create_date >='".$date." 00:00:00'"
				." AND a.create_date <='".$date." 23:59:59'"
				.$where;

		$data['log_user'] = $this->CI->db->query($sql)->result_array();
		return $data['log_user'];
	}


	public function show_log_user_activity(		$date,
												$user_id 	= '',
												$activity 	= ''
	){

		$where = '';
		if( $user_id != '' ){
			$where .= " AND a.user_id=".$user_id;
		}
		if( $activity != '' ){
			$where .= " AND a.activity LIKE '%".$activity."%'";
		}
		$sql = 	"SELECT 
					a.activity, 
					b.username,
					b.user_status
				FROM log_user a 
				LEFT JOIN user b
				ON a.user_id=b.user_id"
				." WHERE a.create_date >='".$date." 00:00:00'"
				." AND a.create_date <='".$date." 23:59:59'"
				.$where;
		$data['log_user_activity'] = $this->CI->db->query($sql)->result_array();

		return $data['log_user_activity'];

	}


	/*==========================================================
		1.	log_visitor
		2.	log_user
		3.	log_user_activity
	==========================================================*/
	public function create_table()
	{	
		/*================================================================
			1.	log_visitor			
		================================================================*/		
		$tables['log_visitor']				=	"CREATE TABLE IF NOT EXISTS log_visitor(
													log_visitor_id INT NOT NULL AUTO_INCREMENT,
												 	activity VARCHAR(150) NOT NULL,
												 	ip_address VARCHAR(150) NOT NULL,
												 	referral VARCHAR(150) NOT NULL,
												 	browser VARCHAR(150) NOT NULL,
												 	version VARCHAR(150) NOT NULL,
												 	mobile VARCHAR(150) NOT NULL,
												 	robot VARCHAR(150) NOT NULL,
												 	platform VARCHAR(150) NOT NULL,
													create_date DATETIME NOT NULL,
												   	update_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
												   	PRIMARY KEY ( log_visitor_id )
												)";											
		
		/*================================================================
			2.	log_user	
		================================================================*/			
		$tables['log_user']					=	"CREATE TABLE IF NOT EXISTS log_user(
													id INT NOT NULL AUTO_INCREMENT,
												 	user_id INT(11) NOT NULL,
												 	activity VARCHAR(250) NOT NULL,
													create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
													PRIMARY KEY ( id ),
												   	CONSTRAINT fk_user_id_on_lu
												   	FOREIGN KEY ( user_id ) 
												   		REFERENCES user ( user_id )
												   		ON DELETE NO ACTION
														ON UPDATE NO ACTION	   		
												)";	

		/*================================================================
			3.	log_user_activity
		================================================================*/	
		$tables['log_user_activity']			=	"CREATE TABLE IF NOT EXISTS log_user_activity(
													id_log_user_activity INT NOT NULL AUTO_INCREMENT,
												 	user_id INT(11) NOT NULL,
												 	activity VARCHAR(250) NOT NULL,
													create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
													PRIMARY KEY ( id_log_user_activity ),
												   	CONSTRAINT fk_user_id_on_lua
												   	FOREIGN KEY ( user_id ) 
												   		REFERENCES user ( user_id )
												   		ON DELETE NO ACTION
														ON UPDATE NO ACTION	   		
												)";		
		
		return $tables;
		
	}

	/*===================================================
		1.	create_date_on_log_visitor
		2.	create_index_on_log_user

	===================================================*/
	public function create_index()
	{
		/*============================================
			1.	create_date_on_log_visitor
		============================================*/		
		$sql = "CREATE INDEX create_date_on_log_visitor ON log_visitor (create_date)";	
		$index = $this->CI->db->query( $sql );

		/*============================================
			2.	create_index_on_log_user
		============================================*/		
		$sql = "CREATE INDEX create_date_on_log_user ON log_user (create_date)";	
		$index = $this->CI->db->query( $sql );

		/*============================================
			3.	log_user_activity
		============================================*/		
		$sql = "CREATE INDEX create_date_on_log_user_activity ON log_user_activity (create_date)";	
		$index = $this->CI->db->query( $sql );

	}

}