<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->minify();
		//if($this->session->userdata('logged_in_user') != TRUE)
		//{
		//	redirect(base_url());
		//}
	}
	
	function index()
	{
		redirect(base_url());
	}
	
	function add($tour_slug="")
	{
		//$user_id		= $this->session->userdata('user_id_user');
		$user_id		= 1;
	
		$tour_slug		= $this->uri->segment(3);
		$tour			= $this->db->query("select * from tourism_place where slug = '$tour_slug' limit 1");
		if($tour->num_rows() > 0)
		{
			$judul				= $this->setting->website_name;
			$data['judul'] 		= ''.$judul;
			$data['title'] 		= $data['judul'];
			$data['tour']		= $tour = $tour->row();
			
			$cek_review_sebelum		= $this->db->query("select * from tour_review where user_id = '$user_id' and tourism_place_id = '$tour->tourism_place_id' limit 1");
			$all_review				= $this->db->query("select count(*) as total_review, sum(rate) as nilai_rating from tour_review where tourism_place_id = '$tour->tourism_place_id'")->row();
			
			$tour_rating			= ($all_review->nilai_rating == "" ? 0 : $all_review->nilai_rating)/($all_review->total_review == 0 ? 1 : $all_review->total_review);
			$data['tour_rating']	= round($tour_rating,1);
			
			if($cek_review_sebelum->num_rows() > 0)
			{
				$data['my_review']	= $cek_review_sebelum->row();
			}
			
			$data['page']		= $this->front_folder.$this->themes_folder_name.'/review/page_form_review';
			$this->load->view($this->front_end_template, $data);
			$this->log_visitor('lihat halaman home');	
		}
	}
	
	function add_process()
	{
		//$user_id		= $this->session->userdata('user_id_user');
		$user_id		= 1;
		$tour_id		= $this->input->post('tour_id');
		$slug			= $this->input->post('tour_slug');
		
		$this->form_validation->set_rules('judul','judul','required|min_length[5]|max_length[50]');
		$this->form_validation->set_rules('isi','isi','required|min_length[10]');
		$this->form_validation->set_rules('nilai_rating','nilai_rating','required');
		if ($this->form_validation->run() == TRUE) {
			$data['tour_review_id']		= $user_id.uniqid().date("Ymdhis");
			$data['judul']				= $this->input->post('judul');
			$data['review']				= $this->input->post('isi');
			$data['rate']				= $this->input->post('nilai_rating');
			$data['user_id']			= $user_id;
			$data['tourism_place_id']	= $tour_id;
			$data['create_date']		= date("Y-m-d");
			
			$cek_review_sebelum		= $this->db->query("select * from tour_review where user_id = '$user_id' and tourism_place_id = '$tour_id' limit 1");
			
			if($cek_review_sebelum->num_rows() > 0)
			{
				$this->model_utama->update_data2($user_id,$tour_id,'user_id','tourism_place_id','tour_review',$data);
			}
			else
			{
				$this->model_utama->insert_data('tour_review',$data);
			}
			
			$this->session->set_flashdata("success","Review anda telah disimpan");
			redirect(base_url().'review/add/'.$slug);
		}
		else
		{
			$this->session->set_flashdata("danger",validation_errors());
			redirect(base_url().'review/add/'.$slug);
		}
	}
	
	function terimakasih()
	{
		$tour_id = $this->input->post("tour_id");
		//$user_id		= $this->session->userdata('user_id_user');
		$user_id		= 1;
		
		$data 	= array(
						'tour_review_like_id'	=> $user_id.uniqid().date('Ymdhisu'),
						'tour_review_id'		=> $tour_id,
						'user_id'				=> $user_id,
						'create_date'			=> date("Y-m-d H:i:s")
					);
					
		$this->model_utama->insert_data('tour_review_like',$data);

		$like_sekarang		= $this->db->query("select count(*) as total_like from tour_review_like where tour_review_id = '$tour_id'")->row()->total_like;
		
		echo $like_sekarang;
	}
}	