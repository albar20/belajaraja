<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class Kontak extends MY_Controller {

	
	public function index()
	{	
		$judul				= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['judul'] 		= 'Kontak | '.$judul;
		$data['header']		= 'Kontak';
		$data['page']		= 'main/kontak/page_kontak';
		$data['form_action']	= site_url('kontak/kontak_process');
		$this->minify();

		$data['banner_list']	= $this->model_utama->get_order_limit('banner_id','asc',5,'banner');
		$data['slider_list']	= $this->model_utama->get_order_limit('slider_id','asc',3,'slider');
		
		$data['pages']		= $this->model_utama->cek_data('kontak','page_slug','page')->row();

		$random_number = rand(1,20);
		$random_number2 = rand(1,20);
		$hasil			= $random_number + $random_number2; 
		$this->session->set_userdata('login_captcha', $hasil);

		// store image html code in a variable
		$data['captcha'] = $random_number.' + '.$random_number2.' =';

		$this->load->view('main/template', $data);

		$this->load->library('user_agent');
		
		if ($this->agent->is_referral())
		{
			$log['ip_address']		= $this->input->ip_address();
			$log['activity']		= "lihat halaman Home ";
		    $log['referral']		= $this->agent->referrer();
			$log['browser']			= $this->agent->browser();
			$log['version']			= $this->agent->version();
			$log['mobile']			= $this->agent->mobile();
			$log['robot']			= $this->agent->robot();
			$log['platform']		= $this->agent->platform();
			$this->model_utama->insert_data('log_visitor', $log);
		}
		
	}


	function kontak_process()
	{
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['judul'] 			= 'Kontak | '.$judul;
		$data['page']			= 'main/kontak/page_kontak';
		$data['form_action']	= site_url('kontak/kontak_process');
		$this->minify();

		$this->minify();

		$data['banner_list']	= $this->model_utama->get_order_limit('banner_id','asc',5,'banner');
		$data['slider_list']	= $this->model_utama->get_order_limit('slider_id','asc',3,'slider');
		
		$data['pages']		= $this->model_utama->cek_data(33,'page_id','page')->row();

		$this->form_validation->set_rules('nama', 'Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'min_length[5]');

		if ($this->form_validation->run() == TRUE)
		{
			$captcha_right = true;
			$captcha 		= filter_var($this->input->post('login_equotation'),FILTER_SANITIZE_STRING);
			$captcha  		= $this->security->xss_clean($captcha);
			
			if( $captcha != $this->session->userdata('login_captcha') ){
				$data['captcha_salah']		= true;
				$captcha_right = false; 
				//echo $this->input->post('login_equotation').'<br>';
				//echo $this->session->userdata('login_captcha').'<br>';
				//exit();
			}

			if($captcha_right)
			{
				$weleh['nama'] 			= $this->security->xss_clean(strip_tags(addslashes($this->input->post('nama'))));
				$weleh['email'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('email'))));
				$weleh['message'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('message'))));
				$weleh['phone'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('phone'))));
				$weleh['ip_address']	= $this->input->ip_address();
				$this->model_utama->insert_data('suara',$weleh);

				$this->session->set_flashdata('success', 'Terima kasih, pesan Anda telah berhasil kami simpan.');
				redirect('kontak/', 'refresh');
			}
			else
			{				
				$this->session->set_flashdata('warning', 'Maaf, tapi kata-katanya salah. Silahkan coba lagi.');
				redirect('kontak/', 'refresh');
			}
		}
		else
		{
			$random_number = rand(1,20);
			$random_number2 = rand(1,20);
			$hasil			= $random_number + $random_number2; 
			$this->session->set_userdata('login_captcha', $hasil);

			// store image html code in a variable
			$data['captcha'] = $random_number.' + '.$random_number2.' =';
			$this->load->view('main/template', $data);
		}
	}
	
	
}