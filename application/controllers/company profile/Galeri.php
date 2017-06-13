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
		$limit 			= 9;
		$judul			= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$this->minify();
		$data['judul'] 		= 'Galeri | '.$judul;
		$data['header']		= 'Galeri Foto';
		$data['page']		= 'main/galeri/page_content';
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
				$data['page']		= 'main/galeri/page_content_view';
				$data['galeri_picture_list'] = $this->model_utama->cek_data($galeri->galeri_id,'galeri_id','galeri_picture');
				$log['activity']	= "lihat halaman galeri - $galeri->galeri_title ";
			}
		}


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