<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class category extends MY_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->minify();
	}


	public function index($kode)
	{	
		$limit 				= 6;
		$judul				= $this->setting->website_name;
		$data['judul'] 		= 'Category Page | '.$judul;
		$data['title'] 		= $judul;
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
			$data['judul'] 		= 'Page Not Found - Error 404 | '.$judul;
			$data['page']		= 'main/page_404';
			$this->load->view('main/template', $data);
		}				

		$this->log_visitor($log['activity']);
		
	}
	
	function product()
	{
		$nama_category		= $this->uri->segment(3);
		if($nama_category == "")
		{
			redirect(base_url());
		}
		else
		{
			$category		= $this->db->query("select * from category_product where slug='$nama_category' limit 1");
			if($category->num_rows() == 0)
			{
				redirect(base_url());
			}
			else
			{	
				$category	= $category->row()->category_product_id;
				$product	= $this->db->query("select * from product where category_product_id = '$category'");
				
				$data['judul'] 		= 'Category Page | '.$judul;
				$data['page']		= 'main/product/page_content';
				$data['product']	= $product;
				
				$this->load->view('main/template',$data);
			}
		}
	}
}