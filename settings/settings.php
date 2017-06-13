<?php
/*
	TABLE OF CONTENTS
	====================================
	1.	AUTHOR
	2.	TIMEZONE
	3.	DATABASE INFORMATION
	4.	URL 
	5.	PATH
	6.	AUTOLOAD
	7.	JS LIBRARY
	
	IS INCLUDED ON, index.php => 8.	CUSTOM SETTING
*/

/*=================================================
	1.	AUTHOR
		
		
=================================================*/
 
/*=======================================================
	2.	TIMEZONE
		USED ON  => "application\config\config.php"
=======================================================*/ 
if ( !defined( 'DEFAULT_TIMEZONE' ) ){
	define( 'DEFAULT_TIMEZONE', 'Asia/Jakarta' );
}

/*=======================================================
	3.	DATABASE INFORMATION
		USED ON  => "application\config\database.php"
		
		1.	DATABASE SERVER
		2.	DATABASE CREDENTIALS
=======================================================*/ 

	/*=======================================================
		1.	DATABASE SERVER
	=======================================================*/
	if ( !defined( 'DATABASE_SERVER' ) ){
		define( 'DATABASE_SERVER', 'mysqli' );
	}
	if( DATABASE_SERVER == 'mysqli' ){
		define( 'DB_DRIVER', 'mysqli' );
		define( 'PCONNECT', TRUE );
	}
	if( DATABASE_SERVER == 'microsoft_SQL_server' ){
		define( 'DB_DRIVER', 'sqlsrv' );
		define( 'PCONNECT', FALSE );
	}
	
	/*=======================================================
		2.	DATABASE CREDENTIALS
	=======================================================*/ 
	if( $_SERVER['HTTP_HOST'] == 'localhost' ){
		define( 'HOSTNAME', 'localhost' );
		//define( 'HOSTNAME', 'AWAH-PC\SQLEXPRESS' );// SQL SERVER
		define( 'DATABASE', 'infongetrip' );
		define( 'USERNAME', 'root' );
		define( 'PASSWORD', '' );
	}else{
		define( 'HOSTNAME', 'localhost' );
		define( 'DATABASE', 'fitinbea_fitinbeauty' );
		define( 'USERNAME', 'fitinbea_albar' );
		define( 'PASSWORD', '=)eQEnDnu$y,' );
	}

/*=======================================================
	4.	URL 
		1.	BASE URL ( on, "application/config" )
=======================================================*/ 
if ( !defined( 'MY_BASE_URL' ) ){
	if( $_SERVER['HTTP_HOST'] == 'localhost' ){
		define( 'MY_BASE_URL', "http://localhost/belajaraja/" );
	}else{
		define( 'MY_BASE_URL', "http://fitinbeauty.com/testing" );
	}
}

/*=======================================================
	5.	PATH
		1.	UPLOADS
		
		LOOK ALSO , on, index.php => 7.	ALL PATH
=======================================================*/ 
if ( !defined( 'UPLOADS_FOLDER' ) ){
	define( 'UPLOADS_FOLDER', FCPATH . 'uploads' );
}

/*=============================================================================
	6.	AUTOLOAD
		1.	HELPER		
		2.	LIBRARIES
		
		( on, "application/config/autoload.php" )
=============================================================================*/ 
global $autoload_helpers; 
global $autoload_libraries; 

	/*=======================================================
		1.	HELPER
	=======================================================*/
	$autoload_helpers 	=  array('form', 'url', 'text', 'string');
	
	/*=======================================================
		2.	LIBRARIES
	=======================================================*/
	$autoload_libraries =  array('database','session','pagination','form_validation','unit_test','cart'); // array('database', 'session', 'xmlrpc');


/*=============================================================================================
	7.	JQUERY LIBRARY
		1.	JQUERY 					( jquery-1.11.2.min.js )
		2.	JQUERY UI 				( jquery-ui-1.10.3.custom.min.js 
									  jquery.easing.1.3.min.js	
									  jquery-ui-extras.min.js 
									  tabs.js
									  )
		2.	BOOTSTRAP 				( bootstrap.min.js )
		3.	GOOGLE PIE CHART		( google-pie-chart.js )
		4.	RANGE SLIDER 			( ion.rangeSlider.min.js )
		5.	PRETTY PHOTO 			( jquery.prettyPhoto.js )
		6.	SIMPLE TIMER			( jquery.simple.timer.js )
		7.	JQUERY INVIEW 			( jquery.inview.min.js )
		8.	JQUERY SCROLL TO 		( jquery.scrollTo.js )
		9.	JQUERY TRANSIT 			( jquery.transit.js )
		10.	JQUERY TIPSY			( jquery.tipsy.js )
		11.	JQUERY FLICKR FEED 		( jflickrfeed.min.js )
		12.	JQUERY TWEET 			( twitter/jquery.tweet.js )
		13.	HEPER					( helper.js )
=============================================================================================*/
?>