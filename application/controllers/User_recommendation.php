<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_recommendation extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->minify();
		//if($this->session->userdata('logged_in_user') != TRUE)
		//{
		//	redirect(base_url());
		//}
	}

	public function index()
	{
		$judul				= $this->setting->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/tour/page_tour_list';
		$start				= 0;
		$limit 				= 9;
		
		/*====================================================
			1.	Get Tour
		====================================================*/
		
		$sql = $this->tour_sql_helper(	$start, 
												$limit );

		$data['tour_list']	= $this->db->query($sql);		
												
		/*====================================================
			2.	PAGINATION STRUCTURE
		====================================================*/

		$base_url 		= 	base_url().'tour/page';
		$total_row 		=	$this->db->query("select count(*) as total from tourism_place")->row()->total;
		$uri_segment	= 	3;

		$this->tour_pagination_helper(	$limit,
											$base_url,
											$total_row,
											$uri_segment		
											);										
		
		//$data['best_seller'] 	= $this->get_best_seller_helper($limit);

		$this->load->view($this->front_end_template, $data);
		$this->log_visitor('lihat halaman home');		
	}
	
	public function add()
	{
		$judul				= $this->setting->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/user_recommendation/page_add';
		$data['form_action']= site_url('rekomendasi/add_process');
		$data['province']		= $this->db->query("select * from location_provinces");
		
		$this->load->view($this->front_end_template, $data);
		$this->log_visitor('lihat halaman home');
	}
	
	function add_process()
	{
		//$user_id		= $this->session->userdata('user_id_user');
		$user_id		= 1;
		$judul				= $this->setting->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/user_recommendation/page_add';
		$data['form_action'] 	= site_url('admin/tourism_place/add_process');

		$this->form_validation->set_rules('nama', 'nama', 'required|min_length[3]');
		$this->form_validation->set_rules('province_id', 'Propinsi', 'required');	
		$this->form_validation->set_rules('city_id', 'Kota', 'required');			
	
		if ($this->form_validation->run() == TRUE)

		{
			$slug				= url_title($this->security->xss_clean($this->input->post('nama')), 'dash', TRUE);
		
			$upload_path		= 	'./uploads/wisata_rekomendasi/'.$slug;
			$allowed_types		=	'gif|jpg|png|jpeg';
			$file_dokumen1 		= 	$this->upload_files($upload_path,$allowed_types,'gambar1');
			$file_dokumen2 		= 	$this->upload_files($upload_path,$allowed_types,'gambar2');
			$file_dokumen3 		= 	$this->upload_files($upload_path,$allowed_types,'gambar3');
			
			$insert_data = array (
							'user_recommendation_id'	=> $user_id.uniqid().date("Ymdhisu"),
							'tour_name'	=> $this->input->post('nama'), 
							'tour_description' => $this->input->post('deskripsi'),
							'user_id'	=> $user_id,
							'province_id' => $this->input->post('province_id'),
							'city_id' => $this->input->post('city_id'),
							'slug'		=> $slug,
							'picture_1'	=> $file_dokumen1,
							'picture_2'	=> $file_dokumen2,
							'picture_3'	=> $file_dokumen3,
							'rate' => $this->input->post('nilai_rating'),
							'judul_review' => $this->input->post('judul'),
							'isi_review' => $this->input->post('isi'),
							'create_date' => date("Y-m-d H:i:s")
							);

			//print_r($insert_data);

			 $this->model_utama->insert_data('user_recommendation', $insert_data);

			$this->session->set_flashdata('success', 'Terima kasih, tempat wisata rekomendasi anda telah tersimpan dan akan diproses. Status rekomendasi anda dapat dilihat <a href="'.base_url().'rekomendasi">disini</a>');
			// $this->insert_log('tambah data category_product');

			redirect('rekomendasi/add', 'refresh');
		}
		else
		{
			$this->session->set_flashdata("danger",validation_errors());
			redirect(base_url().'rekomendasi/add');
		}
	}
	
	public function edit()
	{
		//$user_id		= $this->session->userdata('user_id_user');
		$user_id		= 1;
	
		$id_rekomendasi		= $this->uri->segment(3);
		$rekomendasi		= $this->db->query("select * from user_recommendation 
												LEFT JOIN city
												ON user_recommendation.city_id = city.city_id
												WHERE user_recommendation.user_recommendation_id= '$id_rekomendasi'
												limit 1");
		
		if($id_rekomendasi == "" || $rekomendasi->num_rows() == 0)
		{
			redirect(base_url());
		}
	
		$judul				= $this->setting->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/user_recommendation/page_add';
		$data['form_action']= site_url('rekomendasi/add_process');
		$data['province']		= $this->db->query("select * from location_provinces");
		$data['rekomendasi']	= $rekomendasi->row();
		
		$this->load->view($this->front_end_template, $data);
		$this->log_visitor('lihat halaman home');
	}
	
	public function page()
	{
		$judul				= $this->setting->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/tour/page_tour_list';
		$start				= $this->uri->segment(3);
		if($start == "")
		{
			$start = 0 ;
		}
		$limit 				= 9;
		
		/*====================================================
			1.	Get Tour
		====================================================*/
		
		$sql = $this->tour_sql_helper(	$start, 
												$limit );

		$data['tour_list']	= $this->db->query($sql);										
												
		/*====================================================
			2.	PAGINATION STRUCTURE
		====================================================*/

		$base_url 		= 	base_url().'tour/page';
		$total_row 		=	$this->db->query("select count(*) as total from tourism_place")->row()->total;
		$uri_segment	= 	3;

		$this->tour_pagination_helper(	$limit,
											$base_url,
											$total_row,
											$uri_segment		
											);										
												
		$data['tour_list']	= $this->db->query($sql);
		
		//$data['best_seller'] 	= $this->get_best_seller_helper($limit);

		$this->load->view($this->front_end_template, $data);
		$this->log_visitor('lihat halaman home');	
	}

	public function tour_pagination_helper(	$limit,
												$base_url,
												$total_row,
												$uri_segment
	){
		$session_show_total_product = $this->session->userdata('show_total_product');
		if( 	isset($session_show_total_product) 
			&& 	$session_show_total_product != ''
		){
			$limit = $this->security->xss_clean($session_show_total_product);
		}	

		$this->load->library('pagination');
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
		$config['base_url'] 		= $base_url;
		$config['total_rows'] 		= $total_row;
		$config['per_page'] 		= $limit; 
		$config['uri_segment'] 		= $uri_segment;

		$this->pagination->initialize($config); 

	}
	
	function ambil_kota($id)
	{
		$tampil		= '<option value="">-- Pilih Kota --</option>';
		
		$kota		= $this->db->query("select * from location_city where province_id = '$id'")->result();
		
		foreach($kota as $row)
		{
			$tampil		.= '<option value="'.$row->id.'">'.$row->name.'</option>';
		}
		
		echo $tampil;
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
	
}