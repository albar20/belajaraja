<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
date_default_timezone_set ('Asia/Jakarta');
/*===============================================
	1.	THEMES
	3.	LOG VISITOR
	4.	SEND EMAIL
	6.	MINIFY
===============================================*/
class MY_Controller extends CI_Controller {
	
	/*===============================================
		1.	THEMES NAME
	===============================================*/
	public $themes_name;


	/*========================================================================
		1.	CONSTRUCT METHOD
			1.	SET TIME ZONE
			2.	CREATE PHP TEMPLATE FROM HTML FILE
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
			2.	CREATE PHP TEMPLATE FROM HTML FILE
		===============================================*/
		$this->load->library('create_template_library');
		$this->create_template_library->index();

	

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

	/*======================================================
		6.	DATE CONVERTER ( FOR USING ON DATABASE )
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

	/*===============================================
		6.	MINIFY
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
								'combine'	 => true,
								'minify_js'  => true,
								'minify_css' => TRUE
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
		$this->carabiner->css('plugins/bootstrap/css/bootstrap.min.css');
		$this->carabiner->css('plugins/font-awesome/css/font-awesome.css');
		$this->carabiner->css('plugins/pe-icon-7-stroke/css/pe-icon-7-stroke.css');
		$this->carabiner->css('plugins/animate-css/animate.min.css');
		$this->carabiner->css('plugins/flexslider/flexslider.css');
		$this->carabiner->css('tempo/css/styles-3.css');

		/*====================================================
			4.	MINIFY JS
		====================================================*/
		$this->carabiner->js('plugins/jquery-1.12.3.min.js','','false');
		$this->carabiner->js('plugins/bootstrap/js/bootstrap.min.js','','false');
		/*$this->carabiner->js('bttrlazyload.js','','false');
		$this->carabiner->js('bttrlazyload-init.js','','false');*/
		$this->carabiner->js('plugins/bootstrap-hover-dropdown.min.js','','false');
		$this->carabiner->js('plugins/jquery-inview/jquery.inview.min.js','','false');
		$this->carabiner->js('plugins/isMobile/isMobile.min.js','','false');
		$this->carabiner->js('plugins/back-to-top.js','','false');
		$this->carabiner->js('plugins/jquery-placeholder/jquery.placeholder.js','','false');
		$this->carabiner->js('plugins/FitVids/jquery.fitvids.js','','false');
		$this->carabiner->js('plugins/flexslider/jquery.flexslider-min.js','','false');
		$this->carabiner->js('tempo/js/main.js','','false');


		// $this->carabiner->js('plugins/jquery-1.12.3.min.js');
		// $this->carabiner->js('plugins/bootstrap/js/bootstrap.min.js');
		// $this->carabiner->js('plugins/bootstrap-hover-dropdown.min.js');	
		// $this->carabiner->js('plugins/jquery-inview/jquery.inview.min.js');
		// $this->carabiner->js('plugins/isMobile/isMobile.min.js');
		// $this->carabiner->js('plugins/back-to-top.js');
		// $this->carabiner->js('plugins/jquery-placeholder/jquery.placeholder.js');
		// $this->carabiner->js('plugins/FitVids/jquery.fitvids.js');
		// $this->carabiner->js('plugins/flexslider/jquery.flexslider-min.js');
		// $this->carabiner->js('js/main.js');

		// ie fix
		// $array_js 	= array('ie/html5shiv.min.js','ie/respond.min.js','ie/selectivizr-min.js');
		// $array_css 	= array();
		// $this->carabiner->group('iefix',array('js' => $array_js, 'css' => $array_css));


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