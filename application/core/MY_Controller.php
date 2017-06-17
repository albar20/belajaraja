<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//date_default_timezone_set ('Asia/Jakarta');
/*===============================================
    1.  THEMES
    3.  LOG VISITOR         HELPER
    4.  SEND EMAIL          HELPER
    5.  SEND EMAIL          HELPER  
    6.  DATE CONVERTER      HELPER
    7.  SANITIZING          HELPER
    8.  UPLOAD PHOTO 
        & RESIZE IMAGE      HELPER
    
    ECOMMERCE HELPER
    20. CUSTOMER REGISTER   HELPER
    21. CART STRUCTURE      HELPER
    21. BEST SELLER         HELPER
    20. MINIFY              HELPER
    
===============================================*/
class MY_Controller extends CI_Controller {
    
    /*===============================================
        1.  THEMES NAME
    ===============================================*/
    public $themes_name;
    public $front_folder;
    public $themes_folder_name;
    public $admin_template;
    public $setting;
    public $breadcrumb;
    public $banner;
    public $category_product;
    public $subcategory_product;
    public $wishlist_total;


    /*========================================================================
        1.  CONSTRUCT METHOD
            1.  SET TIME ZONE
            2.  SET THEMES NAME
            3.  SET FRONT END TEMPLATE 
            4.  ADMIN TEMPLATE
            4.  SETTING
            5.  BREADCRUMB
            6.  BANNE
            7.  GET CATEGORY PRODUCT 
            8.  GET SUBCATEGORY PRODUCT 
            9.  GET WISHLIST TOTAL
    ========================================================================*/
    public function __construct(){
        parent::__construct();
        //$this->output->enable_profiler(TRUE);
    
        /*===============================================
            1.  SET VARIABLE 
        ===============================================*/
        $this->load->helper('tanggal');
        $this->load->helper('captcha');
        $this->load->library('email');
        
        $this->segment_1                    = $this->security->xss_clean($this->uri->segment(1));
        $this->segment_2                    = $this->security->xss_clean($this->uri->segment(2));
        $this->segment_3                    = $this->security->xss_clean($this->uri->segment(3));
        $this->segment_4                    = $this->security->xss_clean($this->uri->segment(4));

        /*===============================================
            1.  SET TIME ZONE
        ===============================================*/   
        date_default_timezone_set("Asia/Bangkok");

/*===============================================
			1.	FOR ADMIN
		===============================================*/	
		if( $this->segment_1 == 'admin' ){
			// $sql                    =   "SELECT 
	                                        // count(*) AS total_order_confirm
	                                    // FROM order_master
	                                    // WHERE order_status = 'confirm'";
	        // $total_order_confirm    =   $this->db->query($sql)->row();

	      	// $this->total_order_waiting_approval = $total_order_confirm->total_order_confirm;
		}

        /*===============================================
            2.  SET THEMES NAME 
        ===============================================*/   
        $template = $this->db->query("SELECT template_name FROM templates WHERE active='1'")->row();
        $this->themes_folder_name = 'infongetrip_template';

        /*===============================================
            3.  SET FRONT END TEMPLATE 
        ===============================================*/
        $this->front_folder         = 'main/';
        $this->front_end_template   = $this->front_folder . $this->themes_folder_name .'/template';


        /*===============================================
            4.  ADMIN TEMPLATE
        ===============================================*/
        $this->admin_template   = 'admin/template';

        /*===============================================
            4.  SETTING  
        ===============================================*/
        $this->setting = $this->db->query("SELECT * FROM setting")->row();

        /*===============================================
            5.  BREADCRUMB 
        ===============================================*/
        $bread_crumb = array();
        $all_segment = '';
        if( $this->segment_1 != '' ){
            $bread_crumb[0]['name']     = $this->segment_1;
            $all_segment                = base_url() . strtolower($this->segment_1);
            $bread_crumb[0]['url']      = $all_segment;
        }
        if(     $this->segment_2 != '' 
            &&  !is_numeric($this->segment_2)
        ){
            $bread_crumb[1]['name']     = $this->segment_2;
            $all_segment                = $all_segment .'/'. strtolower($this->segment_2);
            $bread_crumb[1]['url']      = $all_segment;
        }
        if(     $this->segment_3 != '' 
            &&  !is_numeric($this->segment_3)
        ){
            $bread_crumb[2]['name']     = $this->segment_3;
            $all_segment                = $all_segment.'/'. strtolower($this->segment_3);
            $bread_crumb[2]['url']      = $all_segment;
        }
        if(     $this->segment_4 != '' 
            &&  !is_numeric($this->segment_4)
        ){
            $bread_crumb[3]['name']     = $this->segment_4;
            $all_segment                = $all_segment .'/'. strtolower($this->segment_4);
            $bread_crumb[3]['url']      = $all_segment;
        }
        $this->breadcrumb = $bread_crumb;

        /*===============================================
            6.  BANNER
        ===============================================*/
        if(     $this->segment_1 != '' 
            &&  $this->segment_1 != 'home'
        ){
            
        }
        $banner_limit = 10;
        // if( $this->themes_folder_name == 'mobile_shoppe_template' ){
        //  $banner_limit = '6';
        // }
        $this->banner_list  = $this->model_utama->get_order_limit('banner_id','asc',$banner_limit,'banner');


        /*===============================================
            7.  GET CATEGORY PRODUCT 
        ===============================================*/
        //$this->category_product     = $this->get_category_product_helper();
    
        /*===============================================
            8.  GET SUBCATEGORY PRODUCT
        ===============================================*/
        //$this->subcategory_product  = $this->get_subcategory_product_helper();      

        /*===============================================
            9.  GET WISHLIST TOTAL
        ===============================================*/
        if( $this->session->userdata('login_customer') == true)
        {
            $customer_id    =   $this->session->userdata('id_customer');
            $this->wishlist_total = $this->db->query("SELECT count(*) as total FROM wishlists WHERE customer_id=".$customer_id)->row(); 
        }


    }

    
    /*===============================================
        3.  LOG VISITOR         HELPER
    ===============================================*/
    function log_visitor($action){
        $this->load->model('model_utama','',TRUE);
        $this->load->helper('date');
        $this->load->library('user_agent');
        $table      = 'log_visitor';
        $array_data =   array(
                            'ip_address'        =>  $_SERVER['HTTP_USER_AGENT'],
                            'activity'          =>  $action,
                            'browser'           =>  $this->agent->browser(), 
                            'version'           =>  $this->agent->version(), 
                            'mobile'            =>  $this->agent->mobile(), 
                            'robot'             =>  $this->agent->robot(),
                            'platform'          =>  $this->agent->platform(),
                            'create_date'       =>  date('Y-m-d H:i:s',now())
                            //'user_id'         =>  $this->session->userdata('user_id')
                            );
        $query = $this->model_utama->insert_data($table,$array_data);
    }

    
    /*===============================================
        4.  SEND EMAIL          HELPER
    ===============================================*/
    function send_email(    $recipient,
                            $subject,
                            $message,
                            $random_hash = ''
    ){

        /*===============================================
            FOR USING ON RESEND EMAIL
        ===============================================*/
        $sess_data = array(
                           'recipient'          => $recipient,
                           'subject'            => $subject,
                           'message'            => $message,
                           'total_resend_email' => '0'
                       );
        $this->session->set_userdata($sess_data);


        /*===============================================
            SEND EMAIL
        ===============================================*/
        $config = Array(
                        'mailtype'  => 'html',
                        'wordwrap' => TRUE,
			'crlf' => "\r\n",
			'newline' => "\r\n"
                        );
        $from   =   'noreply@fitinbeauty.com';
        $name   =   'Fitinbeauty';

        $this->load->library('email',$config);
        $this->email->from($from, $name);
        $this->email->to($recipient);
        $this->email->subject($subject);

        /*===========================================
            FOR CONFIRMATION EMAIL
        ===========================================*/
        if( $random_hash != ''){
            $data['random_hash']    = $random_hash;
            $data['email']          = $recipient;
            $message = $this->load->view('main/html_email',$data,TRUE);
        }
        
        $this->email->message($message);
        if( $this->email->send() ){
            return true;    
        }else{
            return false;   
        }
    }


   /*====================================================
        5.  SEND EMAIL          HELPER  
            1.  SEND EMAIL CONFIRM REGISTER
            2.  SEND EMAIL LOST PASSWORD
    ====================================================*/
    public function send_email_when(    $actions,
                                        $recipient_email,
                                        $random_hash=''
    ){
        $email_registration_subject         =   'Email Registrasi';
        $email_registration_link_text       =   '<span>Silahkan Konfirmasi Registrasi</span>';
        $email_registration_message         =   '<p>Silahkan akfifasi email kamu dengan mengeklik link ini</p>';

        $email_lost_password_subject        =   'Email Ganti Password';
        $email_lost_password_link_text      =   '<span>Silahkan Ubah Password Anda</span>';
        $email_lost_password_message        =   '<p>Silahkan reset password anda dengan mengeklik link ini</p>';


        
        /*====================================
            1.  SEND EMAIL CONFIRM REGISTER
        ====================================*/
        if( $actions == 'confirm_register' ){
            $confirm_registration_link  = site_url() . 'confirm_register/'.$random_hash;
            $subject                    = $email_registration_subject;
            $recipient                  = $recipient_email;
            $message                    = $email_registration_message;
            $message                    .= ' <a href="'.$confirm_registration_link.'">'.$email_registration_link_text.'</a>';

            $result_send                = $this->send_email(    $recipient,
                                                                $subject,
                                                                $message,
                                                                $random_hash
                                                                );
        }   
        
        /*====================================
            2.  SEND EMAIL LOST PASSWORD
        ====================================*/
        if( $actions == 'lost_password' ){
            $lost_password_link         = site_url() . 'reset_password/'.$random_hash;
            $subject                    = $email_lost_password_subject;
            $recipient                  = $recipient_email;
            $message                    = $email_lost_password_message;
            $message                    .= ' <a href="'.$lost_password_link.'">'.$email_lost_password_link_text.'</a>';

            $result_send                = $this->send_email(    $recipient,
                                                                $subject,
                                                                $message
                                                                );
        }
        return $result_send;
    }


    public function resend_email(){

        
        if( $this->session->has_userdata('total_resend_email') ){
            if( $this->session->userdata('total_resend_email') < 3 ){

                    
                /*===============================================
                    FOR USING ON RESEND EMAIL
                ===============================================*/
                $recipient  = $this->session->userdata('recipient');
                $subject    = $this->session->userdata('subject');
                $message    = $this->session->userdata('message');
                $insert_id  = $this->session->userdata('resend_email_customer_id');
                
                $config = Array(
                                'mailtype'  => 'html',
                                'wordwrap' => TRUE,
				'crlf' => "\r\n",
				'newline' => "\r\n"
                                );
                $from   =   'support@ecommerce.babastudio.net';
                $name   =   'babastudio';
                $this->load->library('email',$config);
                $this->email->from($from, $name);
                $this->email->to($recipient);
                $this->email->subject($subject);
                $this->email->message($message);
                if( $this->email->send(FALSE) ){
                    
                    $this->session->set_flashdata('success', 'Email has been sent to your account');
                    //$result['register_process'] = true;
                    $sql = "UPDATE customers SET email_terkirim='1' WHERE customer_id=".$insert_id;
                    $this->db->query($sql);
                }else{
               		echo $this->email->print_debugger();
               		exit();
                    $this->session->set_flashdata('danger', 'Email has not been sent to your account, try again ');
                }

                $sess_data = array(
                                'total_resend_email' => ($this->session->userdata('total_resend_email')-0) + 1
                            );
                $this->session->set_userdata($sess_data);


            }else{
                $array_items = array('recepient', 'subject','message','total_resend_email','resend_email_customer_id');
                $this->session->unset_userdata($array_items);

            }
        }
        redirect( site_url().'register', 'refresh');

    }


    /*======================================================
        6.  DATE CONVERTER      HELPER
    ======================================================*/
    public function date_converter($tanggal,$time='',$format = '1'){
        
        if( $format == '1' ){
            return date('Y-m-d',strtotime($tanggal));
        }
        
        if( $format == '2' ){
            $month      = substr($tanggal,0,2);
            $day        = substr($tanggal,3,2); 
            $year       = substr($tanggal,6,4);
            //$tgl_mulai    = strtotime($day .' '. $month .' '. $year);
            $plus_time = '';
            if( $time ){
                $plus_time = ' 00:00:00';
            }
            return $year.'-'.$month.'-'.$day.$plus_time;
        }

        if( $format == '3' ){
            $day        = substr($tanggal,0,2);
            $month      = substr($tanggal,3,2); 
            $year       = substr($tanggal,6,4);
            //$tgl_mulai    = strtotime($day .' '. $month .' '. $year);
            $plus_time = '';
            if( $time ){
                $plus_time = ' 00:00:00';
            }
            return $year.'-'.$month.'-'.$day.$plus_time;
        }
    }

    /*==============================================================
        7.  SANITIZING          HELPER
    ==============================================================*/
    public function sanitizing($form_element){

        $after_sanitize_element = array();
        foreach( $form_element as $element_info ){
            $element                                        = $this->input->post( $element_info['name'] );
            $element                                        = $this->security->xss_clean($element);
            $after_sanitize_element[$element_info['name']]  = $element;
        }
        /*$tanggal      = filter_var($this->input->post('tanggal'),FILTER_SANITIZE_STRING);
        $nama_kti       = filter_var($this->input->post('nama_kti'),FILTER_SANITIZE_STRING);
        $tipe_kti       = filter_var($this->input->post('tipe_kti'),FILTER_SANITIZE_STRING);
        $deskripsi      = filter_var($this->input->post('deskripsi'),FILTER_SANITIZE_STRING);
        $tanggal        = $this->security->xss_clean($tanggal);
        $nama_kti       = $this->security->xss_clean($nama_kti);
        $tipe_kti       = $this->security->xss_clean($tipe_kti);
        $deskripsi      = $this->security->xss_clean($deskripsi);*/

        return $after_sanitize_element;
    }       


    /*==============================================================
        8.  UPLOAD PHOTO 
            & RESIZE IMAGE      HELPER

            1.  CREATE DIRECTORY
            2.  UPLOAD PHOTO
            3.  RESIZE IMAGE
    ==============================================================*/
    function upload_photo(  $folder_path,
                            $config,
                            $width = '350'
    ){
        /*===============================================================
            1.  CREATE DIRECTORY
        ===============================================================*/
        $all_path = explode('/',$folder_path);
        $x      = 0;
        $path   = '';
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
            2.  UPLOAD PHOTO
        ===============================================================*/   
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload())
        {
            $file_dokumen   = '';
        }
        else
        {
            /*===============================================================
                2.  RESIZE IMAGE
            ===============================================================*/   
            $dokumen        = $this->upload->data();
            $file_dokumen   = $dokumen['file_name'];

            $this->load->library('image_lib');
            $config_resize['image_library']     = 'gd2';
            $config_resize['source_image']      = $dokumen['full_path'];
            $config_resize['new_image']         = './'.$folder_path;
            $config_resize['create_thumb']      = TRUE;
            $config_resize['maintain_ratio']    = TRUE;
            $config_resize['thumb_marker']      = '';
            $config_resize['width']             = $width;
            $config_resize['quality']           = "100%";
            //$dim                              = (intval($dokumen["image_width"]) / intval($dokumen["image_height"])) - ($config_resize['width'] / $config_resize['height']);
            //$config_resize['master_dim']      = ($dim > 0)? "height" : "width";
            $this->image_lib->initialize($config_resize);
            if(!$this->image_lib->resize()){ //Resize image
                echo $this->image_lib->display_errors();
                exit;
            }
        }
        return $file_dokumen;
    }
    



    /*====================================================
        20. CUSTOMER REGISTER   HELPER
            1.  ONLY FOR REGISTER FORM
            1.  VALIDATION
            2.  CHECK EMAIL
            3.  CHECK PASSWORD MATCHES
            3.  UPLOAD IMAGE
            4.  INSERT DATA 
            5.  SEND EMAIL CONFIRM REGISTER
            5.  INSERT LOG
            6.  REDIRECT 
    ====================================================*/
    public function customer_register_helper(   $redirect,
                                                $upload_image = true,
                                                $view,
                                                $data,
                                                $create_by
    ){

            /*echo "<pre>";
                print_r($_POST);
            echo "</pre>";
            die();*/
        
        /*$_POST['customer_fname']                = 'kelly hoo';
        $_POST['customer_lname']                = 'moore';
        $_POST['customer_sex']                  = 'laki';
        $_POST['customer_birthday']             = '2016-08-09';
        $_POST['customer_email']                = 'kellu@yahoo.com';
        $_POST['customer_password']             = 'admin';
        $_POST['customer_password2']            = 'admin';
        $_POST['customer_address']                = 'jalan hello';
        $_POST['customer_state']                  = 'jakarta';
        $_POST['customer_city']                   = 'jakarta';
        $_POST['customer_sub_postal']             = '55555';
        $_POST['customer_phone']                  = '0812222';
        $_POST['customer_mobile']                 = '082388888';*/


        /*====================================================
            1.  VALIDATION
                1.  ONLY FOR REGISTER FORM
                2.  VALIDATION RULES
        ====================================================*/

            /*====================================================
                1.  ONLY FOR REGISTER FORM
            ====================================================*/
            $do_form_validation = true;
            if( isset($_POST['from_register_form']) ){
                if( !isset($_POST['accept_terms_and_condition']) ){
                    $do_form_validation = false;
                    $data['error_term_and_conditions'] = 'Please read and accept our terms and conditions.';
                }
            }

            /*====================================================
                2.  VALIDATION RULES
            ====================================================*/
            $this->form_validation->set_rules('customer_fname', 'Nama Depan', 'required|min_length[5]|max_length[255]');
            $this->form_validation->set_rules('customer_lname', 'Nama Belakang', 'required|min_length[5]|max_length[255]');
            $this->form_validation->set_rules('customer_sex', 'Jenis Kelamin', 'required');
            $this->form_validation->set_rules('customer_birthday', 'Tanggal Lahir', 'required');
            $this->form_validation->set_rules('customer_email', 'Email', 'required');
            $this->form_validation->set_rules('customer_password', 'Password', 'required');
            $this->form_validation->set_rules('customer_password2', 'Re-Password', 'required');
            
            if( $create_by  !=  'customer' ){
                $this->form_validation->set_rules('customer_address', 'Alamat Lengkap', 'required');
                $this->form_validation->set_rules('customer_state', 'Propinsi', 'required');
                $this->form_validation->set_rules('customer_city', 'Kota', 'required');
                $this->form_validation->set_rules('customer_sub_postal', 'Kode Pos', 'required');
                $this->form_validation->set_rules('customer_phone', 'Telepon', 'required');
                $this->form_validation->set_rules('customer_mobile', 'Handphone', 'required');  
            }


            if ($this->form_validation->run() == TRUE)
            {

                if( $do_form_validation ){

        
                    /*====================================================
                        2.  CHECK EMAIL
                    ====================================================*/
                    $email      = $this->input->post('customer_email');
                    $cek_email  = $this->model_utama->cek_data($email,'customer_email','customers');


                    if(count($cek_email->result_array()) <= 0){
                        
                        /*====================================================
                            3.  CHECK PASSWORD MATCHES
                        ====================================================*/
                        $password    =  $this->security->xss_clean($this->input->post('customer_password'));
                        $re_password =  $this->security->xss_clean($this->input->post('customer_password2')); 

                        if( $password == $re_password ){


                            /*====================================================
                                3.  UPLOAD IMAGE
                            ====================================================*/
                            $config['upload_path']      = './uploads/customer/';
                            $config['allowed_types']    = 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
                            
                            $image_folder_path          = 'uploads/customer/thumb';
                            $file_dokumen               = $this->upload_photo(  $image_folder_path,
                                                                                $config );

                            /*====================================================
                                4.  INSERT DATA 
                            ====================================================*/
                            $random_hash        = md5(uniqid(rand(), true));
                            if( $create_by == 'admin' ){
                                $customer_account_status    = '1';
                                $customer_activation_key    = '';   
                            }else{
                                $customer_account_status    = '0';
                                $customer_activation_key    = $random_hash;     
                            }

                            $weleh = array (
                                            'customer_fname'        => $this->security->xss_clean($this->input->post('customer_fname')),
                                            'customer_photo'        => $this->security->xss_clean($file_dokumen),
                                            'customer_lname'        => $this->security->xss_clean($this->input->post('customer_lname')),
                                            'customer_sex'          => $this->security->xss_clean($this->input->post('customer_sex')),
                                            'customer_birthday'     => $this->date_converter($this->security->xss_clean($this->input->post('customer_birthday')),'','1'),
                                            'customer_email'        => $this->security->xss_clean($this->input->post('customer_email')),
                                            'customer_password'     => md5($password),
                                            'customer_account_status'           => $customer_account_status,
                                            'customer_account_activation_key'   => $customer_activation_key,
                                            'create_date'           => date('Y-m-d H:i:s')
                                            );

                            if( $create_by  !=  'customer' ){
                                $weleh['customer_address']      = $this->security->xss_clean($this->input->post('customer_address'));
                                $weleh['customer_state']        = $this->security->xss_clean($this->input->post('customer_state'));
                                $weleh['customer_city']         = $this->security->xss_clean($this->input->post('customer_city'));
                                $weleh['customer_sub_postal']   = $this->security->xss_clean($this->input->post('customer_sub_postal'));
                                $weleh['customer_phone']        = $this->security->xss_clean($this->input->post('customer_phone'));
                                $weleh['customer_mobile']       = $this->security->xss_clean($this->input->post('customer_mobile'));
                            }


                            $query      = $this->model_utama->insert_data('customers', $weleh);
                            $insert_id  = $this->db->insert_id();

                            if( $query ){

                                $sess_data = array(
                                    'resend_email_customer_id' => $insert_id
                                );
                                $this->session->set_userdata($sess_data);

                                
                                /*====================================
                                    5.  SEND EMAIL CONFIRM REGISTER
                                ====================================*/
                                $actions            =   'confirm_register';
                                $recipient_email    =   $this->security->xss_clean($this->input->post('customer_email'));
                                $result_send        =   $this->send_email_when( $actions,
                                                                                $recipient_email,
                                                                                $random_hash
                                                                                );

                                if( $result_send ){
                                    //$result['register_process'] = true;
                                    $sql = "UPDATE customers SET email_terkirim='1' WHERE customer_id=".$insert_id;
                                    $this->db->query($sql);
                                }else{
                                    //$result['register_process'] = false;
                                    $sql = "UPDATE customers SET email_tserkirim='0' WHERE customer_id=".$insert_id;
                                    $this->db->query($sql);
                                }

                                if( $create_by == 'admin'){
                                    $success_message = 'Data berhasil disimpan!';
                                }else{
                                    if( $result_send ){
                                        $success_message = 'Silahkan lakukan Akun Verifikasi dan aktivasi melalui email anda';  
                                    }else{
                                        $success_message = 'Email kamu tidak terkirim , Coba kirim lagi';
                                    }
                                }

                                $this->session->set_flashdata('success', $success_message);
                            }           

                            
                            /*====================================================
                                5.  INSERT LOG
                            ====================================================*/
                            if( $this->session->has_userdata('id_user') ){
                                $user_id                    = $this->session->userdata('id_user');
                                $log['user_id']             = $user_id;
                                $log['activity']            = 'tambah data customer';
                                $this->model_utama->insert_data('log_user', $log);
                            }

                            /*====================================================
                                6.  REDIRECT 
                            ====================================================*/
                            redirect( $redirect, 'refresh');

                        }else{ 
                            $data['password_not_same_message'] = 'Password Anda tidak sama';

                        } // if( $password == $re_password ){


                    }else{ 

                        $this->session->set_flashdata('danger', 'email sudah digunakan!');
                        $this->load->view( $view, $data);
                    }
                
                }// if( $do_form_validation ){
            }

        
        
        $this->load->view( $view, $data);
    }



    /*===============================================
        21. BEST SELLER         HELPER
    ===============================================*/
    public function get_best_seller_helper( $limit = 1 ){

        $sql                    =   "SELECT 
                                        o.product_id,
                                        SUM(o.product_qty) AS total_sales,
                                        p.product_name,
                                        p.description,
                                        p.slug,
                                        p.price,
                                        pp.product_picture
                                    FROM order_products AS o
                                    INNER JOIN product AS p
                                    ON o.product_id = p.product_id
                                    LEFT JOIN product_picture AS pp 
                                    on o.product_id = pp.product_id
                                    GROUP BY o.product_id 
                                    ORDER BY total_sales DESC
                                    LIMIT ".$limit;

        $data['best_seller']    =   $this->db->query($sql); 
        $best_seller            =   $data['best_seller']->result_array();

        /*$product_id           =   $best_seller[0]['product_id'];
        $sql                    =   "SELECT 
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

        $data['best_seller']    =   $this->db->query($sql);         */  

        
        return $data['best_seller'];
    }

    

    /*===============================================
        20. MINIFY              HELPER
    ===============================================*/
    public function minify($empty_cache=false){
        
        /*====================================================
            1.  LOAD LIBRARY
        ====================================================*/
        $this->load->library('carabiner');
        
        $carabiner_config = array(
                                'script_dir' => 'assets/', 
                                'style_dir'  => 'assets/',
                                'cache_dir'  => 'assets/cache/',
                                'base_uri'   => base_url(),
                                'dev'        => false,
                                'combine'    => false,
                                'minify_js'  => false,
                                'minify_css' => false
                            );
        $this->carabiner->config($carabiner_config);
        
        /*====================================================
            2.  CLEAR CACHE
        ====================================================*/
        if( $empty_cache ){
            $this->carabiner->empty_cache();
        }
        
        /*====================================================
            3.  MINIFY CSS
        ====================================================*/
        
        /*====================================================
            4.  MINIFY JS
        ====================================================*/              
    
        /*====================================================
            5.  DISPLAY CSS / JS
                ON , VIEW
                <?php echo $this->carabiner->display('css'); ?>
                <?php echo $this->carabiner->display('js'); ?>
                
                result
                =====================
                <link ... />
        ====================================================*/
    }

    /*===============================================
        22. GET CATEGORY PRODUCT HELPER
    ===============================================*/
    public function get_category_product_helper(){

        $sql                    =   "SELECT 
                                        c.category_product_id,
                                        c.category_product_name,
                                        c.slug
                                    FROM category_product AS c 
                                    INNER JOIN product AS p 
                                    ON p.category_product_id = c.category_product_id
                                    GROUP BY c.category_product_name";

        $data['category_product_list']  =   $this->db->query($sql);     
        return $data['category_product_list'];
    }

    /*===============================================
        23. GET SUB CATEGORY PRODUCT HELPER
    ===============================================*/
    public function get_subcategory_product_helper(){

        $sql                    =   "SELECT 
                                        c.category_product_id,
                                        c.subcategory_product_name,
                                        c.slug
                                    FROM subcategory_product AS c 
                                    RIGHT JOIN product AS p 
                                    ON p.subcategory_product_id = c.subcategory_product_id
                                    GROUP BY c.subcategory_product_name";

        $data['subcategory_product_list']   =   $this->db->query($sql);     
        return $data['subcategory_product_list'];
    }
    
    /*========================================================
        3.  SQL 
    ========================================================*/
    public function tour_sql_helper( $start, 
                                        $limit
    ){
        
        $order_by   = "ORDER BY create_date DESC";
        $filter     = $this->sort_and_limit_filter_helper(  $limit,
                                                            $order_by
                                                            );
        $order_by   = $filter['order_by'];
        $limit      = $filter['limit'];
        

        /*========================================================
            3.  SQL 
        ========================================================*/
        /*$sql    =   "SELECT 
                        p.product_id,
                        p.product_name,
                        p.description,
                        p.slug,
                        p.price,
                        pp.product_picture,
						(select sum(rate) from product_review where product_id = p.product_id) as rate,
						(select count(rate) as jumlah_review from product_review where product_id = p.product_id) as jumlah_review
                    FROM product AS p 
                    LEFT JOIN product_picture AS pp 
                    ON p.product_id = pp.product_id 
                    WHERE p.stock !=0 " 
                    .$order_by. 
                    " LIMIT ".$start.",".$limit;

        return $sql;*/
		
		$sql    =   "SELECT 
                        *,
						(select count(*) as total_review from tour_review where tourism_place_id = tourism_place.tourism_place_id) as total_review,
						(select sum(rate) as nilai_rating from tour_review where tourism_place_id = tourism_place.tourism_place_id) as nilai_rating
                    FROM tourism_place " 
                    .$order_by. 
                    "  LIMIT ".$start.",".$limit;

        return $sql;
    }

    /*========================================================
        1.  SORT PRODUCT
        2.  SHOW TOTAL PRODUCT
    ========================================================*/
    function sort_and_limit_filter_helper(  $limit,
                                            $order_by
    ){

        /*========================================================
            1.  SORT PRODUCT
        ========================================================*/
        $session_sort_product = $this->session->userdata('sort_product');
        if(     isset($session_sort_product) 
            &&  $session_sort_product != ''
        ){
            $sort_product   = $this->security->xss_clean($session_sort_product);
            $order_by       = "ORDER BY p.product_name ".$sort_product;
        }   
        if(     isset($_POST['sort_product']) 
            &&  $_POST['sort_product'] != ''
        ){
            $sort_product   = $this->security->xss_clean($_POST['sort_product']);
            $order_by       = "ORDER BY p.product_name ".$sort_product;
            $this->session->set_userdata('sort_product',$sort_product);
        }   

        /*========================================================
            2.  SHOW TOTAL PRODUCT
        ========================================================*/
        $session_show_total_product = $this->session->userdata('show_total_product');
        if(     isset($session_show_total_product) 
            &&  $session_show_total_product != ''
        ){
            $limit = $this->security->xss_clean($session_show_total_product);
        }   
        if(     isset($_POST['show_total_product']) 
            &&  $_POST['show_total_product'] != ''
        ){
            $limit = $this->security->xss_clean($_POST['show_total_product']);
            $this->session->set_userdata('show_total_product',$limit);
        }

        $filter['order_by']     = $order_by;
        $filter['limit']        = $limit;
        return $filter;
    }

    /*========================================================
        1.  SORT PRODUCT
        2.  SHOW TOTAL PRODUCT
    ========================================================*/  
    function product_single_related_products_helper(    $category_product_id,
                                                        $product_id
    ){
        $sql    =   "SELECT 
                        p.product_id,
                        p.product_name,
                        p.description,
                        p.slug,
                        p.price,
                        pp.product_picture
                    FROM product AS p 
                    LEFT JOIN product_picture AS pp 
                    ON p.product_id = pp.product_id
                    WHERE p.category_product_id =".$category_product_id
                    ." AND p.product_id !=".$product_id
                    ." AND p.stock !=0
                    ORDER BY p.create_date DESC
                    LIMIT 5";
        $data['related_product_list']   =   $this->db->query($sql); 
        return $data['related_product_list'];
    }

    /*========================================================
        1.  SORT PRODUCT
        2.  SHOW TOTAL PRODUCT
    ========================================================*/  
    function product_single_thumbnail_helper($product_id){
        $sql    =   "SELECT 
                        product_picture
                    FROM product_picture
                    WHERE product_id=".$product_id
                    ." LIMIT 5";
        $data['product_picture_list']   =   $this->db->query($sql); 
        return $data['product_picture_list'];
    }

            public function generate_captcha(){
                        $vals = array(
        'word'          => random_string('alpha',6),
        'img_path'      => './captcha/',
        'img_url'       => base_url().'captcha/',
        'img_width'     => '120',
        'img_height'    => 30,
        'expiration'    => 7200,
        'word_length'   => 6,
        'font_size'     => 46,
        'img_id'        => 'Imageid',
        'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

        // White background and border, black text and red grid
        'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 40, 40)
        )
);

return  create_captcha($vals);
        }
    

    
}