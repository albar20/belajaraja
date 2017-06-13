<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class kontak extends MY_Controller {

	public $front_page;


	public function __construct()
	{
		parent::__construct();
		$this->minify();
		// $this->front_contact_page = 'main/contact/contact';
		// if( 	$this->themes_folder_name == 'fashion_template' 
		// 	||	$this->themes_folder_name == 'shoppe_template' 
		// 	||	$this->themes_folder_name == 'sports_template' 
		// 	||	$this->themes_folder_name == 'mobile_shoppe_template' 
		// 	||	$this->themes_folder_name == 'kitchen_template'	
		// 	||	$this->themes_folder_name == 'game_zone_template'	
		// 	||	$this->themes_folder_name == 'grocery_template'	
		// 	||	$this->themes_folder_name == 'furniture_template'	
		// 	||	$this->themes_folder_name == 'jewellery_template'
		// 	||	$this->themes_folder_name == 'digi_template'		
		// ){
			
		// }

		$this->front_contact_page = $this->front_folder.$this->themes_folder_name.'/contact/contact';

	}

	public function index()
	{	
		
		$judul					= $this->setting->website_name;
		$data['judul'] 			= 'Contact Us | '.$judul;
		$data['title'] 			= $data['judul'];
		$data['header']			= 'Contact Us';
		$data['page']			= $this->front_contact_page;
		$data['form_action']	= site_url('kontak');
		$data['pages']			= $this->model_utama->cek_data('kontak','page_slug','page')->row();
		$data['banner_list']	= $this->model_utama->get_order_limit('banner_id','asc',5,'banner');
		$data['slider_list']	= $this->model_utama->get_order_limit('slider_id','asc',3,'slider');

	
		if( isset($_POST['submit_button']) ){
			$this->form_validation->set_rules('nama', 'Name', 'required');
			//$this->form_validation->set_rules('phone', 'Phone', 'numeric');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('message', 'Message', 'required|min_length[5]');

			if ($this->form_validation->run() == TRUE)
			{
				$captcha_right 	= true;
				$captcha 		= filter_var($this->input->post('login_equotation'),FILTER_SANITIZE_STRING);
				$captcha  		= $this->security->xss_clean($captcha);
				
				if( $captcha != $this->session->userdata('login_captcha') ){
					$data['captcha_salah']		= true;
					$captcha_right 				= false; 
				}

				if($captcha_right)
				{
					$weleh['nama'] 			= $this->security->xss_clean(strip_tags(addslashes($this->input->post('nama'))));
					$weleh['email'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('email'))));
					$weleh['message'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('message'))));
					$weleh['subject'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('subject'))));
					$weleh['ip_address']	= $this->input->ip_address();
					$this->model_utama->insert_data('suara',$weleh);

					$this->session->set_flashdata('success', 'Thank you, your message have been sent to us.');
					redirect('kontak/', 'refresh');
				}
				else
				{				
					$this->session->set_flashdata('warning', 'Sorry, your answer for total number calculation is still wrong. Please try again.');
					$data['captcha']	= $this->refresh_captcha();
					
				}
			
			}else{
				
				$data['captcha']	= $this->refresh_captcha();
				
			}

		}else{
			$data['captcha'] 		= $this->refresh_captcha();
		}

		$this->load->view($this->front_end_template, $data);
		$this->log_visitor('lihat halaman kontak');		
		
	}

	function refresh_captcha(){

		$random_number 	= rand(1,20);
		$random_number2 = rand(1,20);
		$hasil			= $random_number + $random_number2; 
		$this->session->set_userdata('login_captcha', $hasil);

		// store image html code in a variable
		$captcha 		= $random_number.' + '.$random_number2.' =';
		return $captcha;
	}

}