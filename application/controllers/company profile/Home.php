<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class Home extends MY_Controller {

	
	public function index()
	{	
		$judul				= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['judul'] 		= ''.$judul;
		$data['page']		= 'main/home/page_content';
		$this->minify();

		$data['banner_list']	= $this->model_utama->get_order_limit('banner_id','asc',5,'banner');
		$data['slider_list']	= $this->model_utama->get_order_limit('slider_id','asc',3,'slider');


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


	// For new image on click refresh button.
	public function captcha_refresh()
	{
		$this->load->helper('captcha');
		$vals = array(
		    'img_path'	=> './uploads/captcha/',
		    'img_url'	=> base_url().'uploads/captcha/'
		);

		$cap = create_captcha($vals);

		$data_capt = array(
		    'captcha_time'	=> $cap['time'],
		    'ip_address'	=> $this->input->ip_address(),
		    'word'			=> $cap['word']
		    );

		$query = $this->db->insert_string('captcha', $data_capt);
		$this->db->query($query);

		// $data['cap'] = $cap;
		echo $cap['image'];

	}


	function suara_process()
	{
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['judul'] 			= 'Beranda | '.$judul;
		$data['page']			= 'main/home/page_home';
		$data['form_action']	= site_url('home/suara_process');
		$this->minify();

		$data['category_list']	= $this->model_utama->get_order_limit('create_date','desc',3,'category');
		$data['slider_list']	= $this->model_utama->get_order_limit('slider_id','asc',3,'slider');

		$data['produk_hukum_list']		= $this->model_utama->get_order_limit('create_date','desc',5,'produk_hukum');
		$data['produk_organisasi_list']	= $this->model_utama->get_order_limit('create_date','desc',5,'produk_organisasi');
		$data['berita_list']			= $this->model_utama->cek_order_limit('6','category_id','create_date','desc',5,'blog');
		$data['kegiatan_list']			= $this->model_utama->cek_order_limit('7','category_id','create_date','desc',5,'blog');
		$data['abstrak_list']			= $this->model_utama->cek_order_limit('5','category_id','create_date','desc',5,'blog');
		$data['slider_list']			= $this->model_utama->get_order_limit('create_date','desc',5,'slider');
		$data['ticker_list']			= $this->model_utama->get_order_limit('create_date','desc',1,'ticker');

		$this->form_validation->set_rules('nama', 'Name', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'required|min_length[5]');

		if ($this->form_validation->run() == TRUE)
		{
			// First, delete old captchas
			$expiration = time()-7200; // Two hour limit
			$this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);	

			// Then see if a captcha exists:
			$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
			$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
			$query = $this->db->query($sql, $binds);
			$row = $query->row();

			if ($row->count == 0)
			{
				$this->session->set_flashdata('warning', 'Maaf, tapi kata-katanya salah. Silahkan coba lagi.');
				redirect('home/', 'refresh');
			}
			else
			{
				$weleh['nama'] 			= $this->security->xss_clean(strip_tags(addslashes($this->input->post('nama'))));
				$weleh['email'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('email'))));
				$weleh['message'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('message'))));
				$weleh['phone'] 		= $this->security->xss_clean(strip_tags(addslashes($this->input->post('phone'))));
				$weleh['ip_address']	= $this->input->ip_address();
				$this->model_utama->insert_data('suara',$weleh);

				$this->session->set_flashdata('success', 'Terima kasih, pesan Anda telah berhasil kami simpan.');
				redirect('home/', 'refresh');
			}
		}
		else
		{
			$this->load->helper('captcha');
			$vals = array(
			    'img_path'	=> './uploads/captcha/',
			    'img_url'	=> base_url().'uploads/captcha/'
			);

			$cap = create_captcha($vals);

			$data_capt = array(
			    'captcha_time'	=> $cap['time'],
			    'ip_address'	=> $this->input->ip_address(),
			    'word'			=> $cap['word']
			    );

			$query = $this->db->insert_string('captcha', $data_capt);
			$this->db->query($query);

			$data['cap'] = $cap;
			$this->load->view('main/template', $data);
		}
	}
	
	function free_course()
	{
		$this->load->view('main/free_course');
	}	

	function save()
	{
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
			$nama = $this->security->xss_clean(strip_tags($this->input->post('nama')));
			$email = $this->security->xss_clean(strip_tags($this->input->post('email')));
			$telp = $this->security->xss_clean(strip_tags($this->input->post('telp')));
			$tinggal = $this->security->xss_clean(strip_tags($this->input->post('tinggal')));
			$materi = $this->security->xss_clean(strip_tags($this->input->post('materi')));

			$length		= 6;
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}

			$data['nama']       	= $nama;
	        $data['no_hp']      	= $telp;
	        $data['email']      	= $email;
	        $data['tinggal']		= $tinggal;
	        $data['materi']			= $materi;
	        $data['ip_address'] 	= $this->input->ip_address();
	        $data['create_date'] 	= $today = date("Y-m-d H:i:s");

	        $cek_trial = $this->model_utama->cek_data2($nama,$telp,'nama','no_hp','popup_trial');

	        if($cek_trial->num_rows() > 0)
	        {
	        	$this->model_utama->update_data($cek_trial->row()->popup_trial_id,'popup_trial_id','popup_trial',$data);
	        }
	        else
	        {
	        	$this->db->insert("popup_trial", $data);
		    }

	        $this->session->set_userdata('nama_bro',$nama);
	        $this->session->set_userdata('hp_bro',$telp);
	        $this->session->set_userdata('materi',$materi);
	        $this->session->set_userdata('email_bro',$email);

	        

			$this->load->helper('url');
		
			$url = 'http://www.babastudio.com/member/login/register_curl';
			$fields_string = '';
			
			$fields = array(
								'namalengkap' 	=> urlencode($nama),
								'email' 		=> urlencode($email),
								'telp' 			=> urlencode($telp),
								'materi' 		=> urlencode($materi)
						);

			//url-ify the data for the POST
			foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
			rtrim($fields_string, '&');

			//open connection
			$ch = curl_init();

			//set the url, number of POST vars, POST data
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch,CURLOPT_POST, count($fields));
			curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

			//execute post
			$result = curl_exec($ch);

			//close connection
			curl_close($ch);
		}
	}
	
	function save_bbm()
	{
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
			$data['pin_bb']       	= $this->security->xss_clean(strip_tags($this->input->post('pin_bbm')));

	        $cek_trial = $this->model_utama->cek_data2($this->session->userdata('nama_bro'),$this->session->userdata('hp_bro'),'nama','no_hp','popup_trial');

	        if($cek_trial->num_rows() > 0)
	        {
	        	$this->model_utama->update_data($cek_trial->row()->popup_trial_id,'popup_trial_id','popup_trial',$data);
	        }
        }
    }

	function save_finish()
	{
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
        	$nama = $this->security->xss_clean(strip_tags($this->input->post('nama')));
			$email = $this->security->xss_clean(strip_tags($this->input->post('email')));
			$telp = $this->security->xss_clean(strip_tags($this->input->post('telp')));

			$data['nama']       	= $nama;
	        $data['no_hp']      	= $telp;
	        $data['email']      	= $email;

	        $cek_trial = $this->model_utama->cek_data2($this->session->userdata('nama_bro'),$this->session->userdata('hp_bro'),'nama','no_hp','popup_trial');

	        if($cek_trial->num_rows() > 0)
	        {
	        	$this->model_utama->update_data($cek_trial->row()->popup_trial_id,'popup_trial_id','popup_trial',$data);
	        }


        }
    }

    function save_beconnected()
    {
    	$this->load->library('recaptcha');
    	
    	$this->form_validation->set_rules('nama', 'Nama lengkap', 'required|min_length[1]');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required|min_length[1]');
		$this->form_validation->set_rules('telp', 'Pesan', 'min_length[1]');
		$this->form_validation->set_rules('tinggal', 'Pesan', 'min_length[1]');
		$this->form_validation->set_rules('karya', 'Pesan', 'min_length[1]');
		$this->form_validation->set_rules('link_karya', 'Pesan', 'min_length[1]');

		if ($this->form_validation->run() == TRUE)
		{
			$weleh['nama'] 				= $this->input->post('nama');
			$weleh['email'] 			= $this->input->post('email');
			$weleh['telp'] 				= $this->input->post('telp');
			$weleh['domisili'] 			= $this->input->post('tinggal');
			$weleh['pilihan_karya'] 	= $this->input->post('karya');
			$weleh['link_karya'] 		= $this->input->post('link_karya');
			$weleh['create_date']		= date('Y-m-d H:i:s');
	    	// Mendapatkan input recaptcha dari user
			$captcha_answer = $this->input->post('g-recaptcha-response');
			 
			// Verifikasi input recaptcha dari user
			$response = $this->recaptcha->verifyResponse($captcha_answer);
			 
			// Proses
			if ($response['success']) {
			    // Code jika sukses							
				$this->model_utama->insert_data('registrasi_beconnected',$weleh);	
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
			}
			else {							
				echo 'captcha salah';
				die();
			}	

			redirect('terima-kasih-telah-mendaftar-beconnected', 'refresh');
		}
		else
		{
			$this->session->set_flashdata('danger', 'Silahkan isi data dengan benar');
			redirect($this->uri->uri_string(), 'refresh');
		}
    }


}