<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*===============================================
	1.	PROTECTED VARIABLE
	1.	CONSTRUCT METHOD
	
		USING
		=================================
		=>	
			url : http;//helvme.com/login

			POST variables
			=====================
			api_key            	: 111
			request_method   	: index
			email              	: kelly@yahoo.com
			password            : a
			token 				: 	


		REQUEST API ( USING FIDDLER )
		=======================================
		1.	on composer tab 
			1.	on parsed tab 
				add, Content-type: application/x-www-form-urlencoded

		2.	request body
			email=kelly@yahoo.com&password=a&request_method=index&submit_button=true





	
===============================================*/
class API_Controller extends MY_Controller {
	
	public $_allow        						= array();
	public $_content_type 						= "application/json";
	public $_request      						= array();
	public $_api_is_request_by 					= 'website'; 
	public $_success_message 					= 'success';
	public $_delete_success_message 			= 'delete success';
	public $_update_success_message 			= 'update success';
	public $_insert_success_message 			= 'insert success';
	public $_login_success_message  			= 'login success';
	public $_login_unsuccess_message  			= 'login failed';
	public $_logout_success_message  			= 'logout sucess';
	public $_register_success_message 			= 'register success';
	public $_account_not_exist_message 			= 'Sorry, This account is not exist';
	public $_reset_password_failed_message 		= 'Sorry Reset Password Failed, Please Try Again';
	public $_validation_failed_message 			= 'validation failed';
	public $_error_term_and_conditions 			= 'Please read and accept our terms and conditions';
	public $_email_exist_message 				= 'email exist';
	public $_password_not_same_message 			= 'password not same';
	
	public $_authorization_failed_message 		= 'authorization failed';
	public $_post_variable_not_complete_message = 'other required variable not found';
	public $_request_method_not_found_message 	= 'request method not found';
	public $_data_not_exist_message 			= 'data not exist';
	public $_token;
	public $_limit 								= 5;

	private $_method      		= "";		
	private $_code        		= 200;

	const SUCCESS 				= 'SUCCESS';
	const ERROR  				= 'ERROR';

	/*===============================================
		1.	CONSTRUCT METHOD
	===============================================*/
	public function __construct(){
		parent::__construct();
		$this->inputs();
		$this->processApi();

	} // public function __construct(){
		
	public function get_referer(){
		return $_SERVER['HTTP_REFERER'];
	}
	
	public function response($data,$status){
		$this->_code = ($status)?$status:200;
		$this->set_headers();
		echo $data;
		exit;
	}

	private function get_status_message(){
		$status = array(
					100 => 'Continue',  
					101 => 'Switching Protocols',  
					200 => 'OK',
					201 => 'Created',  
					202 => 'Accepted',  
					203 => 'Non-Authoritative Information',  
					204 => 'No Content',  
					205 => 'Reset Content',  
					206 => 'Partial Content',  
					300 => 'Multiple Choices',  
					301 => 'Moved Permanently',  
					302 => 'Found',  
					303 => 'See Other',  
					304 => 'Not Modified',  
					305 => 'Use Proxy',  
					306 => '(Unused)',  
					307 => 'Temporary Redirect',  
					400 => 'Bad Request',  
					401 => 'Unauthorized',  
					402 => 'Payment Required',  
					403 => 'Forbidden',  
					404 => 'Not Found',  
					405 => 'Method Not Allowed',  
					406 => 'Not Acceptable',  
					407 => 'Proxy Authentication Required',  
					408 => 'Request Timeout',  
					409 => 'Conflict',  
					410 => 'Gone',  
					411 => 'Length Required',  
					412 => 'Precondition Failed',  
					413 => 'Request Entity Too Large',  
					414 => 'Request-URI Too Long',  
					415 => 'Unsupported Media Type',  
					416 => 'Requested Range Not Satisfiable',  
					417 => 'Expectation Failed',  
					500 => 'Internal Server Error',  
					501 => 'Not Implemented',  
					502 => 'Bad Gateway',  
					503 => 'Service Unavailable',  
					504 => 'Gateway Timeout',  
					505 => 'HTTP Version Not Supported');
		return ($status[$this->_code])?$status[$this->_code]:$status[500];
	}
	
	public function get_request_method(){
		return $_SERVER['REQUEST_METHOD'];
	}
	
	private function inputs(){
		
		switch($this->get_request_method()){
			case "POST":
				$this->_request = $this->cleanInputs($_POST);
				break;
			case "GET":
			case "DELETE":
				$this->_request = $this->cleanInputs($_GET);
				break;
			case "PUT":
				parse_str(file_get_contents("php://input"),$this->_request);
				$this->_request = $this->cleanInputs($this->_request);
				break;
			default:
				$this->response('',406);
				break;
		}

	}		
	
	private function cleanInputs($data){
		$clean_input = array();
		if(is_array($data)){
			foreach($data as $k => $v){
				$clean_input[$k] = $this->cleanInputs($v);
			}
		}else{
			/*if(get_magic_quotes_gpc()){
				$data = trim(stripslashes($data));
			}
			$data = strip_tags($data);
			$clean_input = trim($data);*/
			$clean_input = $this->security->xss_clean($data);
		}
		return $clean_input;
	}		
	
	private function set_headers(){
		header("HTTP/1.1 ".$this->_code." ".$this->get_status_message());
		header("Access-Control-Allow-Orgin: *"); 		// 	1.	Enable "CORS" on header 
		header("Access-Control-Allow-Methods: *"); 		//	1.	allow for any HTTP method to be accepted.
		header("Content-Type:".$this->_content_type);     
	}



	/*=================================================================
		1.	TEST CALL API
		2.	TOKEN AUTHENTICATION
		3.	CHECK IF REQUEST METHOD EXIST
		4.	API CALL SUCCESS 
		5.	API CALL FAILED 
	=================================================================*/
	public function processApi() {


		//$_POST['customer_email'] 			= 'kelly@yahoo.com';
		// $_POST['request_method'] 			= 'reset_password';
		// $_POST['customer_password'] 		= 'a';
		// $_POST['customer_password2'] 		= 'b';

	
		$api_call_success 		= false;
		$failed_message 		= '';
		$token_authentication	= false;

		/*=================================================================
			2.	TOKEN AUTHENTICATION
				1.	PAGES NEEED TO BE AUTHENTICATED 
		=================================================================*/
			
			/*=================================================================
				1.	PAGES NO NEED TO BE AUTHENTICATED 
					1.	login_api
					2.	my_account_api
					3.	my_order_api
					4.	wishlist_api
			=================================================================*/
			if( 	$this->segment_1 != 'home_api' 
				&&	$this->segment_1 != 'product_api'
				&& 	$this->segment_1 != 'kontak_api'
				&& 	$this->segment_1 != 'page_api'
				&& 	$this->segment_1 != 'login_api'
				
			){

				if( 	isset( $_POST['token'] )
					&& 	$_POST['token'] != '' 
				){

					$token 		= 	$this->security->xss_clean( $this->input->post('token') );
					$sql 		= 	"SELECT
										token
									FROM customers
									WHERE token='".$token."'"; 
					$customer 	= 	$this->db->query($sql)->result_array();
					if( count($customer)>0 ){
						$token = $customer[0]['token'];
						$api_call_success 		= true;
						$token_authentication 	= true;
					}else{
						$failed_message 		= $this->_authorization_failed_message;
						$token_authentication 	= false;
					}
				}else{
					$token_authentication 	= false;
					$failed_message 		= $this->_post_variable_not_complete_message;	
					$api_call_success 		= false;
				}
			}else{
				
				$token_authentication 	= true;
			}

		/*=================================================================
			3.	CHECK IF REQUEST METHOD EXIST
		=================================================================*/	
		if( $token_authentication ){
			if( isset($_POST['request_method']) ){
	
				if( $token_authentication ){
					$func 	= strtolower(trim(str_replace("/", "", $_POST['request_method'])));
					$state 	= method_exists($this, $func);
					if ((int)$state > 0){
						/*=================================================================
							4.	API CALL SUCCESS 
						=================================================================*/	
						$this -> $func();
						$api_call_success = true;

					}else{
						$failed_message = $this->_request_method_not_found_message;
						$api_call_success = false;
					}
				}

			}else{
				$failed_message = $this->_request_method_not_found_message;
				$api_call_success = false;
			}
		}

	
		/*=================================================================
			5.	API CALL FAILED 
		=================================================================*/
		if( !$api_call_success ){
			$data = null;
			$this -> jsonout( 	self::ERROR,
								$failed_message, 
								$data
							);
			exit ;
		}

	}

	/*========================================================
		1.	DATA FOR ALL PAGE ( FROM my_controller )
	========================================================*/
	public function data_for_all_pages() {
		$limit 							= 10;
		$data['best_seller'] 			= $this->get_best_seller_helper($limit)->result();
		$data['banner_list'] 			= $this->banner_list->result();
		$data['category_product'] 		= $this->category_product->result();
		$data['subcategory_product'] 	= $this->subcategory_product->result();
		$data['wishlist_total'] 		= $this->wishlist_total;
		$data['setting'] 				= $this->setting;
		return $data;
	}



	/*public function auth() {
			
		
	
	}*/

	public function jsonout(	$status,
								$msg, 
								$data,
								$token = '',
								$status_code = 200
	){
		if( $status == 'SUCCESS' ){
			$success = true;
		}elseif( $status == 'ERROR' ){
			$success = false;
		}

		if( $token != '' ){
			$ret 	= array(
					//'status' 	=> $status,
					'success'	=> $success,
					'message' 	=> $msg, 
					'token' 	=> $token,	
					'data' 		=> $data
					);
		}else{
			$ret 	= array(
					'success'	=> $success,
					'message' 	=> $msg,
					'data' 		=> $data
					);
		}
		
		$this -> response(	json_encode($ret), 
							$status_code
						);
		exit ;
	}	

}