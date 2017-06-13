<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class Page extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->minify();
	}

	public function index($kode)
	{	
		$limit 				= 2;
		$judul				= $this->setting->website_name;
		$data['judul'] 		= 'Page List | '.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= 'main/page/page';
		$log['activity']	= "";
	
		$page_slug			= $this->security->xss_clean($kode);
		$page 				= $this->model_utama->cek_data($page_slug,'page_slug','page');
		if($page->num_rows() > 0)
		{
			$data['pages']		= $page = $page->row();
			$data['judul'] 		= ''.ucwords($page->page_title).' | '.$judul;
			$data['header']		= ucwords($page->page_title);
			$data['page']		= 'main/page/page';
			$log['activity'] 	= 'lihat halaman '.$page->page_title;
		}
		else
		{
			$data['judul'] 		= 'Halaman tidak ditemukan | '.$judul;
			$data['page']		= 'main/page_404';
		}

		$this->load->view($this->front_end_template, $data);
		if( $log['activity'] != '' ){
			$this->log_visitor( $log['activity'] );	
		}
	}

	/*===============================================================
		1.	GET DATA
	===============================================================*/
	function detail()
	{	
		$limit 				= 2;
		$judul				= $this->setting->website_name;
		$log['activity']	= "";
		$this->load->library('recaptcha');

		/*===============================================================
			1.	GET DATA
		===============================================================*/
		$page_slug			= $this->security->xss_clean($this->uri->segment(1));
		$data['segment_1']	= $page_slug;
		$page 				= $this->model_utama->cek_data($page_slug,'page_slug','page');
		$category			= $this->model_utama->cek_data($page_slug,'category_slug','category');

		if($page->num_rows() > 0)
		{
			$data['pages']		= $page = $page->row();
			$data['judul'] 		= ''.ucwords($page->page_title).' | '.$judul;
			$data['title'] 		= $data['judul'];
			$data['header']		= ucwords($page->page_title);
			$data['page']		= 'main/page/page';
			$log['activity']	= "lihat halaman page - $page->page_title ";


		}
		elseif($category->num_rows() > 0)
		{	
			$today 		= date('Y-m-d');
			$category 	= $category->row();
			$data['judul'] 		= ucwords($category->category_title).' | '.$judul;
			$data['title'] 		= $data['judul'];
			$data['header']		= ucwords($category->category_title) .' List';
			$data['page']		= 'main/blog/blog';
			$log['activity']	= "lihat halaman $category->category_title";

			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['blog_list']		= $this->db->query("select * from blog where date(blog_date) <= '$today' and blog_hide = 'no' and category_id = '$category->category_id' order by create_date desc limit $limit");
			$total_list 			= $this->db->query("select * from blog where date(blog_date) <= '$today' and blog_hide = 'no' and category_id = '$category->category_id' order by create_date desc");
			$data['popular_blog_list'] = $this->db->query("select substring(activity,22) as judul_blog, count(*) as total from log_visitor where activity like '%lihat halaman blog - %' group by activity order by total desc limit 5");

			$category_slug = str_replace(' ','-', $page_slug);
			$sql = "SELECT 
						b.blog_title,
						DATE_FORMAT(b.blog_date,'%d %b %Y') as blog_date 
					FROM 
						blog AS b
					INNER JOIN category AS c 
					ON b.category_id = c.category_id
					WHERE c.category_slug ='".$category_slug."'"
					." ORDER BY b.blog_date DESC 
					LIMIT 5";		
			$data['recent_post_list'] = $this->db->query($sql);


			if(is_numeric($this->security->xss_clean($this->uri->segment(2))))
			{
				$start 					= $this->security->xss_clean($this->uri->segment(2));
				$data['blog_list']		= $this->db->query("select * from blog where date(blog_date) <= '$today' and blog_hide = 'no' and category_id = '$category->category_id' order by create_date desc limit $start,$limit");
				$log['activity']		= "lihat halaman $category->category_title halaman ke $start";
			}
			else
			{
				$blog_slug		= $this->security->xss_clean($this->uri->segment(2));
				$blog 			= $this->model_utama->cek_data($blog_slug,'blog_slug','blog');

				if($blog->num_rows() > 0)
				{
				

					$this->form_validation->set_rules('comment_name', 'Name', 'required|min_length[1]');
					$this->form_validation->set_rules('comment_email', 'Email', 'valid_email|required|min_length[1]');
					$this->form_validation->set_rules('comment_content', 'comment', 'min_length[10]');

					$data['blog']		= $blog = $blog->row();

					if ($this->form_validation->run() == TRUE)
					{
						$weleh['comment_name'] 		= $this->input->post('comment_name');
						$weleh['comment_email'] 	= $this->input->post('comment_email');
						$weleh['comment_content	'] 	= $this->input->post('comment_content');
						$weleh['blog_id']			= $blog->blog_id;
						$weleh['create_date']		= date('Y-m-d H:i:s');

						$captcha_enable = false;
						if( $captcha_enable ){
							// Mendapatkan input recaptcha dari user
							$captcha_answer = $this->input->post('g-recaptcha-response');
							 
							// Verifikasi input recaptcha dari user
							$response = $this->recaptcha->verifyResponse($captcha_answer);
						}else{
							$response['success'] = true;		
						}

						// Proses
						if ($response['success']) {
						    // Code jika sukses							
							$this->model_utama->insert_data('comment',$weleh);	
							$this->session->set_flashdata('success', 'Data berhasil disimpan!');
							redirect($this->uri->uri_string(), 'refresh');
						}
						else {		
							$this->session->set_flashdata('warning', 'Captcha Salah!');					
							//echo 'captcha salah';
							//die();
						}

					}
					else
					{						
						
						$data['header']			= $blog->blog_title;
						$data['previous']		= $this->db->query("select * from blog where blog_id < '$blog->blog_id' order by blog_id desc limit 1");
						$data['next']			= $this->db->query("select * from blog where blog_id > '$blog->blog_id'  order by blog_id asc limit 1");
						$data['comment_list'] 	= $this->db->query("select * from comment where blog_id = '$blog->blog_id'  order by create_date desc");
						$data['comment_count']	= $this->db->query("select count(*) as total from comment where blog_id = '$blog->blog_id'")->row()->total;
						$data['judul'] 			= ''.ucwords($blog->blog_title).' | '.$judul;
						$data['title'] 			= $data['judul'];
						$data['page']			= 'main/blog/blog_single';
						$log['activity']		= "lihat halaman blog - $blog->blog_title";
						// $data['page_view']	= $this->db->query("select * from log_visitor where activity = 'lihat halaman blog - $blog->blog_title ' group by ip_address");
						$data['page_view']		= $this->db->query("select * from log_visitor where activity = 'lihat halaman blog - $blog->blog_title '");

					}
				}
			}


			$this->load->library('pagination');

			$class = "";
			$this->load->library('pagination');
			$config['full_tag_open'] 	= '<ul>';
			$config['full_tag_close'] 	= '</ul>';
			$config['first_tag_open'] 	= '<li class="pagination-first '.$class.'">';
			$config['first_tag_close'] 	= '</li>';
			$config['last_tag_open'] 	= '<li class="pagination-last '.$class.'">';
			$config['last_tag_close'] 	= '</li>';
			$config['prev_tag_open'] 	= '<li class="page-prev '.$class.'">';
			$config['prev_tag_close'] 	= '</li>';
			$config['next_tag_open'] 	= '<li class="page-next '.$class.'">';
			$config['next_tag_close'] 	= '</i></a></li>';
			$config['cur_tag_open'] 	= '<li class="active '.$class.'"><a href="#">';
			$config['cur_tag_close'] 	= '</a></li>';
			$config['num_tag_open'] 	= '<li class="'.$class.'">';
			$config['num_tag_close'] 	= '</li>';
			$config['base_url'] 		= site_url($category->category_slug);		 
			$config['uri_segment'] 		= 2;
			$config['total_rows'] 		= $total_list->num_rows();
			$config['per_page'] 		= $limit;
			$this->pagination->initialize($config); 
		}
		else
		{
			$data['judul'] 		= 'Page Not Found - Error 404 | '.$judul;
			$data['title'] 		= $data['judul'];
			$data['page']		= 'main/page_404';
		}

		$this->load->view($this->front_end_template, $data);
		if( $log['activity'] != '' ){
			$this->log_visitor( $log['activity'] );	
		}
	}

	function category($kode)
	{
		$limit 				= 5;
		$judul				= $this->setting->website_name;
		$log['activity']	= "";


		$category	= $this->model_utama->cek_data($kode,'category_slug','category');
		if($category->num_rows() > 0)
		{
			$category = $category->row();

			$data['judul'] 		= ucwords($category->category_title).' | '.$judul;
			$data['header']		= ucwords($category->category_title).' List';
			$data['page']		= 'main/blog/blog';
			$log['activity']	= "lihat halaman $category->category_title";

			$limit 					= 6;
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['blog_list']		= $this->model_utama->cek_order_limit2('no',$category->category_id,'blog_hide','category_id','create_date','desc',$limit,'blog');
			$total_list 			= $this->model_utama->cek_data2('no',$category->category_id,'blog_hide','category_id','blog');

			$data['popular_blog_list'] = $this->db->query("select substring(activity,22) as judul_blog, count(*) as total from log_visitor where activity like '%lihat halaman blog - %' group by activity order by total desc limit 5");

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
			$config['base_url'] 		= site_url($category->category_slug);		 
			$config['uri_segment'] 		= 2;
			
			$config['total_rows'] 		= $total_list->num_rows();
			$config['per_page'] 		= $limit;

			$this->pagination->initialize($config); 
		}
		else
		{
			$data['judul'] 		= 'Page Not Found - Error 404 | '.$judul;
			$data['page']		= 'main/page_404';
		}

		$this->load->view($this->front_end_template, $data);
		if( $log['activity'] != '' ){
			$this->log_visitor( $log['activity'] );	
		}

	}
	
}