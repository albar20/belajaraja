<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*=========================================================================
	@author	M.Fadli Prathama (09081003031)
 	email : m.fadliprathama@gmail.com
	
	DOCUMENTATION 
	=================================
	1.	Documentation
		=>	developer_documentation.php
		=>	5.	DATE CONVERTER 				LIBRARY

=========================================================================*/

/*======================================================
	1.	VARIABLES
	2.	CONSTRUCT
======================================================*/
class Date_converter_library{
   

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
	}

	public function convert(	$tanggal,
								$time 	='',
								$format = '1'
	){	
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

	

}