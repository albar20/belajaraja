<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class post extends MY_Controller {
	
	public function index($kode)
	{	
		$limit 				= 6;
		$judul				= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$this->minify();
		$data['judul'] 		= 'Blog | '.$judul;
		$data['header']		= 'Daftar Blog';
		$data['page']		= 'main/blog/page_content';
		$log['activity']	= "lihat halaman blog ";
		
		$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
		$data['blog_list']		= $this->model_utama->cek_order_limit(1,'category_id','create_date','desc',$limit,'blog');
		$total_list 			= $this->model_utama->cek_data(1,'category_id','blog');

		$data['popular_blog_list'] = $this->db->query("select substring(activity,22) as judul_blog, count(*) as total from log_visitor where activity like '%lihat halaman blog - %' group by activity order by total desc");

		$this->load->library('pagination');

		$config['full_tag_open'] 	= '<ul class="page">';
		$config['full_tag_close'] 	= '<ul>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li><a class="active">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$config['base_url'] 		= site_url('blog');		 
		$config['uri_segment'] 		= 2;

		if(is_numeric($this->security->xss_clean($kode)))
		{
			$start 					= $this->security->xss_clean($kode);
			$data['blog_list']		= $this->db->query("select * from blog where category_id = '1' order by create_date desc limit $start,$limit");
			$log['activity']		= "lihat halaman blog halaman ke $start";
		}
		else
		{
				$blog_slug		= $this->security->xss_clean($kode);
				$blog 			= $this->model_utama->cek_data($blog_slug,'blog_slug','blog');

				if($blog->num_rows() > 0)
				{
					$this->load->library('recaptcha');
					$data['blog']		= $blog = $blog->row();
					$this->form_validation->set_rules('namalengkap', 'Nama lengkap', 'required|min_length[1]');
					$this->form_validation->set_rules('email_add', 'Email', 'valid_email|required|min_length[1]');
					$this->form_validation->set_rules('content', 'Pesan', 'min_length[1]');

					if ($this->form_validation->run() == TRUE)
					{
						$weleh['comment_name'] 		= $this->input->post('namalengkap');
						$weleh['comment_email'] 	= $this->input->post('email_add');
						$weleh['comment_content	'] 	= $this->input->post('content');
						$weleh['blog_id']			= $blog->blog_id;
						$weleh['create_date']		= date('Y-m-d H:i:s');

						// Mendapatkan input recaptcha dari user
						$captcha_answer = $this->input->post('g-recaptcha-response');
						 
						// Verifikasi input recaptcha dari user
						$response = $this->recaptcha->verifyResponse($captcha_answer);
						 
						// Proses
						if ($response['success']) {
						    // Code jika sukses							
							$this->model_utama->insert_data('comment',$weleh);	
							$this->session->set_flashdata('success', 'Data berhasil disimpan!');
						}
						else {							
							echo 'captcha salah';
							die();
						}	


						redirect($this->uri->uri_string(), 'refresh');

					}
					else
					{	
						$data['header']		= $blog->blog_title;
						$data['previous']	= $this->db->query("select * from blog where blog_id < '$blog->blog_id' order by blog_id desc limit 1");
						$data['next']		= $this->db->query("select * from blog where blog_id > '$blog->blog_id'  order by blog_id asc limit 1");
						$data['comment_list'] 	= $this->db->query("select * from comment where blog_id = '$blog->blog_id'  order by create_date desc");
						$data['comment_count']	= $this->db->query("select count(*) as total from comment where blog_id = '$blog->blog_id'")->row()->total;
						$data['judul'] 		= ''.ucwords($blog->blog_title).' | '.$judul;
						$data['page']		= 'main/blog/page_content_view';
						$log['activity']	= "lihat halaman blog - $blog->blog_title";
						// $data['page_view']	= $this->db->query("select * from log_visitor where activity = 'lihat halaman blog - $blog->blog_title ' group by ip_address");
						$data['page_view']	= $this->db->query("select * from log_visitor where activity = 'lihat halaman blog - $blog->blog_title '");
					}
				}
				
		}

		
		$config['total_rows'] 		= $total_list->num_rows();
		$config['per_page'] 		= $limit;

		$this->pagination->initialize($config); 


		$this->load->view('main/template', $data);

		$this->load->library('user_agent');
		if ($this->agent->is_referral())
		{
			$log['ip_address']		= $this->input->ip_address();
		    $log['referral']		= $this->agent->referrer();
			$log['browser']			= $this->agent->browser();
			$log['version']			= $this->agent->version();
			$log['mobile']			= $this->agent->mobile();
			$log['robot']			= $this->agent->robot();
			$log['platform']		= $this->agent->platform();
			$this->model_utama->insert_data('log_visitor', $log);
		}
		
	}

	

}