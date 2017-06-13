<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class video extends MY_Controller {
	
	public function index()
	{	
		$limit 				= 2;
		$judul				= $this->setting->website_name;
		$data['judul'] 		= 'Video Gallery | '.$judul;
		$data['title'] 		= 'Video Gallery | '.$judul;
		$data['header']		= 'Video Gallery';
		$data['page']		= 'main/video/video';
		$log['activity']	= "lihat halaman video ";

		$data['video_list']	= $this->model_utama->get_order_limit('create_date','desc',$limit,'video');

		$this->load->library('pagination');
		$config['full_tag_open'] 	= '<ul class="page"> ';
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

		$config['base_url'] 		= base_url().'video';
		$config['total_rows'] 		= $this->db->query("select count(*) as total from video ")->row()->total;
		$config['per_page'] 		= $limit; 
		$config['uri_segment'] 		= 2;
		$this->pagination->initialize($config); 

		if(is_numeric($this->security->xss_clean($this->uri->segment(2))))
		{
			$start 					= $this->security->xss_clean($this->uri->segment(2));
			$data['video_list']		= $this->db->query("select * from video order by create_date desc limit $start,$limit");
			$log['activity']		= "lihat halaman video halaman ke $start";
		}
		else
		{
			$video_slug	= $this->security->xss_clean($this->uri->segment(2));
			$video 		= $this->model_utama->cek_data($video_slug,'video_slug','video');

			if($video->num_rows() > 0)
			{
				$data['video']		= $video = $video->row();
				$data['judul'] 		= ''.ucwords($video->video_title).' | '.$judul;
				$data['page']		= 'main/video/video_single';
				$data['video_list_list'] = $this->model_utama->cek_data($video->video_id,'video_id','video_list');
				$data['video_list']	= $this->db->query("select * from video where video_id != '$video->video_id' order by create_date desc limit 3");
				$log['activity']	= "lihat halaman video - $video->video_title ";
			}
		}


		$this->minify();
		$this->load->view($this->front_end_template, $data);
		$this->log_visitor($log['activity']);
	}
	
	
	
}