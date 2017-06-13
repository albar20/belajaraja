<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class galeri extends MY_Controller {
	
	public function index()
	{	
		$limit 				= 2;
		$judul				= $this->setting->website_name;
		$data['judul'] 		= 'Photo Gallery | '.$judul;
		$data['title'] 		= 'Photo Gallery | '.$judul;
		$data['header']		= 'Photo Gallery';
		$data['page']		= 'main/galeri/galeri';
		$log['activity']	= "lihat halaman galeri ";
		
		$data['galeri_list']	= $this->model_utama->get_order_limit('create_date','desc',$limit,'galeri');

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

		$config['base_url'] 		= base_url().'galeri';
		$config['total_rows'] 		= $this->db->query("select count(*) as total from galeri ")->row()->total;
		$config['per_page'] 		= $limit; 
		$config['uri_segment'] 		= 2;

		$this->pagination->initialize($config); 

		if(is_numeric($this->security->xss_clean($this->uri->segment(2))))
		{
			$start 					= $this->security->xss_clean($this->uri->segment(2));
			$data['galeri_list']	= $this->db->query("select * from galeri order by create_date desc limit $start,$limit");
			$log['activity']		= "lihat halaman galeri halaman ke $start";
		}
		else
		{
			$galeri_slug	= $this->security->xss_clean($this->uri->segment(2));
			$galeri 		= $this->model_utama->cek_data($galeri_slug,'galeri_slug','galeri');

			if($galeri->num_rows() > 0)
			{
				$data['galeri']		= $galeri = $galeri->row();
				$data['judul'] 		= ''.ucwords($galeri->galeri_title).' | '.$judul;
				$data['page']		= 'main/galeri/galeri_single';
				$data['galeri_picture_list'] = $this->model_utama->cek_data($galeri->galeri_id,'galeri_id','galeri_picture');
				$log['activity']	= "lihat halaman galeri - $galeri->galeri_title ";
			}
		}

		$this->minify();
		$this->load->view($this->front_end_template, $data);
		$this->log_visitor($log['activity']);
		
	}

	
	
	
	
}