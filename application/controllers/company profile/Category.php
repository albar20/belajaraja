<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class category extends MY_Controller {
	
	public function index($kode)
	{	
		$limit 			= 6;
		$judul			= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$this->minify();
		$data['judul'] 		= 'Halaman Kategori | '.$judul;
		$data['page']		= 'main/blog/page_content';
		$log['activity']	= "lihat halaman blog ";
		
		$data['category_list']	= $this->model_utama->get_order_limit('create_date','desc',3,'category');

		$category_slug	= $this->security->xss_clean($kode);
		$category 		= $this->model_utama->cek_data($category_slug,'category_slug','category');

		$this->load->library('pagination');

		$config['full_tag_open'] 	= '<ul class="pagination pagination-sm"> ';
		$config['full_tag_close'] 	= '</ul>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li class="active"><a href="">';
		$config['cur_tag_close'] 	= '</a></li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';

		if($category->num_rows() > 0)
		{
			$category = $category->row();

			$data['judul'] 		= ucwords($category->category_title).' | '.$judul;
			$data['header']		= 'Daftar '.ucwords($category->category_title);
			$data['page']		= 'main/blog/page_content';
			$log['activity']	= "lihat halaman $category->category_title";

			$limit 					= 6;
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			$data['blog_list']		= $this->model_utama->cek_order_limit($category->category_id,'category_id','create_date','desc',$limit,'blog');
			$total_list 			= $this->model_utama->cek_data($category->category_id,'category_id','blog');

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
			$config['base_url'] 		= site_url($category->category_slug);		 
			$config['uri_segment'] 		= 2;

			if(is_numeric($this->security->xss_clean($this->uri->segment(2))))
			{
				$start 					= $this->security->xss_clean($this->uri->segment(2));
				$data['blog_list']		= $this->db->query("select * from blog where category_id = '$category->category_id' order by create_date desc limit $start,$limit");
				$log['activity']		= "lihat halaman $category->category_title halaman ke $start";
			}

			$config['total_rows'] 		= $total_list->num_rows();
			$config['per_page'] 		= $limit;

			$this->pagination->initialize($config); 

			$this->load->view('main/template', $data);
		}
		else
		{
			$data['judul'] 		= 'Halaman tidak ditemukan | '.$judul;
			$data['page']		= 'main/page_404';
			$this->load->view('main/template', $data);
		}				

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