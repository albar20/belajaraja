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
		$judul				= $this->setting->website_name;
		$user_id 			= $this->session->userdata('user_id_user');
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/page_review';
		$config['base_url'] = base_url().'review/page';
		$sql_all 			= "SELECT * FROM tour_review WHERE user_id = $user_id";
		$config['total_rows'] = $this->db->query($sql_all)->num_rows();
		$config['per_page']	= 1;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['attributes'] = array('class' => 'page-numbers');
		$config['full_tag_open'] 	= '<ul class="page-numbers">';
		$config['full_tag_close'] 	= '<ul>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li><span class="page-numbers current">';
		$config['cur_tag_close'] 	= '</span></li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';
		$data['total_rows'] = $this->db->query($sql_all)->num_rows();
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$sql 				= "SELECT tour_review.*,tourism_place.picture_1,tourism_place.slug FROM tour_review LEFT JOIN tourism_place ON tour_review.tourism_place_id = tourism_place.tourism_place_id WHERE tour_review.user_id = $user_id LIMIT $page,".$config['per_page'];
		$sql_total 				= "SELECT tour_review.*,tourism_place.picture_1,tourism_place.slug FROM tour_review LEFT JOIN tourism_place ON tour_review.tourism_place_id = tourism_place.tourism_place_id WHERE tour_review.user_id = $user_id ";
		$sql_user 			= "SELECT user.*,location_provinces.name FROM
								user LEFT JOIN location_provinces ON user.city_id = location_provinces.id WHERE user.user_id = $user_id
								";
		$data['user']       = $this->db->query($sql_user)->row();		
		$data['review']     = $this->db->query($sql)->result();
		$data['total_review']     = $this->db->query($sql_total)->num_rows();
		$data['page_menu']		= 'main/infongetrip_template/review_page';

		$this->load->view($this->front_end_template, $data);
	}


	function page(){
		$this->load->library('pagination');
		$judul				= $this->setting->website_name;
		$user_id 			= $this->session->userdata('user_id_user');
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/page_review';
		$config['base_url'] = base_url().'review/page';
		$sql_all 			= "SELECT * FROM tour_review WHERE user_id = $user_id";
		$config['total_rows'] = $this->db->query($sql_all)->num_rows();
		$data['total_rows'] = $this->db->query($sql_all)->num_rows();
		$config['per_page']	= 1;
		$config['uri_segment'] = 3;
		$config['num_links'] = 2;
		$config['attributes'] = array('class' => 'page-numbers');
		$config['full_tag_open'] 	= '<ul class="page-numbers">';
		$config['full_tag_close'] 	= '<ul>';
		$config['first_tag_open'] 	= '<li>';
		$config['first_tag_close'] 	= '</li>';
		$config['last_tag_open'] 	= '<li>';
		$config['last_tag_close'] 	= '</li>';
		$config['next_tag_open'] 	= '<li>';
		$config['next_tag_close'] 	= '</li>';
		$config['prev_tag_open'] 	= '<li>';
		$config['prev_tag_close'] 	= '</li>';
		$config['cur_tag_open'] 	= '<li><span class="page-numbers current">';
		$config['cur_tag_close'] 	= '</span></li>';
		$config['num_tag_open'] 	= '<li>';
		$config['num_tag_close'] 	= '</li>';

		$this->pagination->initialize($config);
		$page 				= ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$sql 				= "SELECT tour_review.*,tourism_place.picture_1,tourism_place.slug FROM tour_review LEFT JOIN tourism_place ON tour_review.tourism_place_id = tourism_place.tourism_place_id WHERE tour_review.user_id = $user_id LIMIT $page,".$config['per_page'];		
		$data['review']     = $this->db->query($sql)->result();
		$sql_total 				= "SELECT tour_review.*,tourism_place.picture_1,tourism_place.slug FROM tour_review LEFT JOIN tourism_place ON tour_review.tourism_place_id = tourism_place.tourism_place_id WHERE tour_review.user_id = $user_id ";
		$data['total_review']     = $this->db->query($sql_total)->num_rows();
		$sql_user 			= "SELECT user.*,location_provinces.name FROM
								user LEFT JOIN location_provinces ON user.city_id = location_provinces.id WHERE user.user_id = $user_id
								";
		$data['user']       = $this->db->query($sql_user)->row();
		$data['page_menu']		= 'main/infongetrip_template/review_page';

		$this->load->view($this->front_end_template, $data);
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
			$data['slug']		= $tour_slug;
			
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
		
			$upload_path		= 	'./uploads/review/'.$slug;
			$allowed_types		=	'gif|jpg|png|jpeg';
			$file_dokumen1 		= 	$this->upload_files($upload_path,$allowed_types,'gambar1');
			$file_dokumen2 		= 	$this->upload_files($upload_path,$allowed_types,'gambar2');
			$file_dokumen3 		= 	$this->upload_files($upload_path,$allowed_types,'gambar3');
		
			$data['tour_review_id']		= $user_id.uniqid().date("Ymdhis");
			$data['judul']				= $this->security->xss_clean($this->input->post('judul'));
			$data['review']				= $this->security->xss_clean($this->input->post('isi'));
			$data['rate']				= $this->input->post('nilai_rating');
			$data['user_id']			= $user_id;
			$data['tourism_place_id']	= $tour_id;
			$data['tanggal_berkunjung']	= date("Y-m-d", strtotime($this->input->post('tanggal_berkunjung')));
			$data['create_date']		= date("Y-m-d");
			
			$cek_review_sebelum		= $this->db->query("select * from tour_review where user_id = '$user_id' and tourism_place_id = '$tour_id' limit 1");
			
			if( $file_dokumen1 != '' ){	
				$data['picture_1']		= $file_dokumen1;
				$this->delete_tour_picture($cek_review_sebelum->row()->picture_1,$slug);
			}
			if( $file_dokumen2 != '' ){	
				$data['picture_2']		= $file_dokumen2;
				$this->delete_tour_picture($cek_review_sebelum->row()->picture_2,$slug);
			}
			if( $file_dokumen3 != '' ){	
				$data['picture_3']		= $file_dokumen3;
				$this->delete_tour_picture($cek_review_sebelum->row()->picture_3,$slug);
			}
			
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
	
	function upload_files($upload_path,$allowed_types,$file_name,$remove_space=''){
	
			//if($this->session->userdata('login_pelaksana') == true ){

				$config['upload_path'] 		= $upload_path;
				$config['allowed_types'] 	= $allowed_types;
				if( $remove_space != '' ){
					$config['remove_spaces'] 	= $remove_space;	
				}
				$this->load->library('upload', $config);
				
				if( !is_dir($upload_path) ){
					mkdir($upload_path, 0777, true);
					mkdir($upload_path.'/thumb', 0777, true);
				}
				
				if ( !$this->upload->do_upload($file_name) ){
					$file_dokumen	= '';
				}else{
					$dokumen		= $this->upload->data();
					$file_dokumen	= $dokumen['file_name'];
				}

				if( 	$file_dokumen != ''
					&&	( stripos($file_dokumen,'jpg') > 0	||	stripos($file_dokumen,'png') > 0 )
				){
					$config_array = array(
											'upload_path'	=>	$upload_path,
											'image_name'	=>	$file_dokumen	
										);
					$this->image_manipulation($config_array);
				}
				return $file_dokumen;
			//}
			//else
			//{
			//	redirect('login');
			//}
		}
		
		function image_manipulation($config_array){


			$this->load->library('image_lib');
	 

			$config['image_library']    = 'gd2';
			$config['source_image']     = $config_array['upload_path'].'/'.$config_array['image_name'];
			$config['new_image']        = $config_array['upload_path'].'/thumb/thumb_'.$config_array['image_name'];
			$config['create_thumb'] 	= TRUE;
			$config['maintain_ratio']   = TRUE;
			$config['width']            = 360;
			$config['quality'] 			= 60;
			$config['thumb_marker'] 	= '';
			$this->image_lib->initialize($config);
			$this->image_lib->resize();
			$this->image_lib->clear();

		}
		
		function delete_tour_picture($nama_gambar,$slug)
		{
			$Path 	= './uploads/review/'.$slug.'/'.$nama_gambar;
			$Path2 	= './uploads/review/'.$slug.'/thumb/thumb_'.$nama_gambar;
			if(file_exists($Path)){	
				unlink($Path);
			}
			if(file_exists($Path)){			
				unlink($Path2);
			}
		}
}	