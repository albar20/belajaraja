<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class berita extends MY_Controller {
	
	public function index()
	{	
		$limit 				= 6;
		$judul				= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$this->minify();
		$data['judul'] 		= 'Berita | '.$judul;
		$data['header']		= 'Daftar Berita';
		$data['page']		= 'main/blog/page_content';
		$log['activity']	= "lihat halaman berita ";
		
		$data['category_list']	= $this->model_utama->get_order_limit('create_date','desc',3,'category');
		$data['blog_list']		= $this->model_utama->cek_order_limit(6,'category_id','create_date','desc',$limit,'blog');
		$total_list 			= $this->model_utama->cek_data(6,'category_id','blog');

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
		$config['base_url'] 		= site_url('berita');		 
		$config['uri_segment'] 		= 2;

		if(is_numeric($this->security->xss_clean($this->uri->segment(2))))
		{
			$start 					= $this->security->xss_clean($this->uri->segment(2));
			$data['blog_list']		= $this->db->query("select * from blog order by create_date desc limit $start,$limit");
			$log['activity']		= "lihat halaman berita halaman ke $start";
		}
		else
		{
				$blog_slug		= $this->security->xss_clean($this->uri->segment(2));
				$blog 			= $this->model_utama->cek_data($blog_slug,'blog_slug','blog');

				if($blog->num_rows() > 0)
				{
					$data['blog']		= $blog = $blog->row();
					$data['header']		= $blog->blog_title;
					$data['previous']	= $this->db->query("select * from blog where blog_id < '$blog->blog_id' order by blog_id desc limit 1");
					$data['next']		= $this->db->query("select * from blog where blog_id > '$blog->blog_id'  order by blog_id asc limit 1");
					$data['comment_list'] 	= $this->db->query("select * from comment where blog_id = '$blog->blog_id'  order by create_date desc");
					$data['comment_count']	= $this->db->query("select count(*) as total from comment where blog_id = '$blog->blog_id'")->row()->total;
					$data['judul'] 		= ''.ucwords($blog->blog_title).' | '.$judul;
					$data['page']		= 'main/blog/page_content_view';
					$log['activity']	= "lihat halaman berita - $blog->blog_title";
					// $data['page_view']	= $this->db->query("select * from log_visitor where activity = 'lihat halaman blog - $blog->blog_title ' group by ip_address");
					$data['page_view']	= $this->db->query("select * from log_visitor where activity = 'lihat halaman blog - $blog->blog_title '");
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