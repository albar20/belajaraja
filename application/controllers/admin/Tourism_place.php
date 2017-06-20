<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



	class Tourism_place extends MY_Controller {

		

		public function __construct()

        {

                parent::__construct();

                // Your own constructor code

				if($this->session->userdata('login_admin') != true){redirect(base_url());}

											

        }



		public function index()

		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Daftar Tempat Wisata | '.$judul;
			$data['heading'] 		= "Tourism Place";
			$data['page']			= 'admin/tourism_place/page_list';
			$data['tourism_place_list']	= $this->model_utama->get_data('tourism_place');

			$this->load->view($this->admin_template, $data);

			$this->insert_log('lihat data tourism place');
		}

		

		function add()

		{			

			$user_id 				= $this->session->userdata('id_user');

			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 			= 'Halaman Tambah  | '.$judul;
			$data['heading'] 		= 'Add Tourism Place';
			$data['form_action'] 	= site_url('admin/tourism_place/add_process');
			$data['page']			= 'admin/tourism_place/page_form';
			$data['province']		= $this->db->query("select * from location_provinces");

			$this->load->view($this->admin_template, $data);

			$this->insert_log('lihat form Tourism Place');

		}

		

		function add_process()

		{
			$user_id 				= $this->session->userdata('id_user');

			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;

			$data['title'] 			= 'Halaman Tambah product_category | '.$judul;
			$data['heading'] 		= 'Add product_category List';
			$data['form_action'] 	= site_url('admin/tourism_place/add_process');
			$data['page']			= 'admin/tourism_place/page_form';

			$this->form_validation->set_rules('name', 'name', 'required|min_length[3]');	
			$this->form_validation->set_rules('description', 'description', 'required|min_length[3]');
		
			if ($this->form_validation->run() == TRUE)

			{
				$slug				= url_title($this->security->xss_clean($this->input->post('name')), 'dash', TRUE);
			
				$upload_path		= 	'./uploads/wisata/'.$slug;
				$allowed_types		=	'gif|jpg|png|jpeg';
				$file_dokumen1 		= 	$this->upload_files($upload_path,$allowed_types,'picture_1');
				$file_dokumen2 		= 	$this->upload_files($upload_path,$allowed_types,'picture_2');
				$file_dokumen3 		= 	$this->upload_files($upload_path,$allowed_types,'picture_3');
				$file_dokumen4 		= 	$this->upload_files($upload_path,$allowed_types,'picture_4');
				$file_dokumen5 		= 	$this->upload_files($upload_path,$allowed_types,'picture_5');
				
				$insert_data = array (
								'name'	=> $this->input->post('name'), 
								'description' => $this->input->post('description'),
								'province_id' => $this->input->post('province_id'),
								'city_id' => $this->input->post('city_id'),
								'slug'		=> $slug,
								'picture_1'	=> $file_dokumen1,
								'picture_2'	=> $file_dokumen2,
								'picture_3'	=> $file_dokumen3,
								'picture_4'	=> $file_dokumen4,
								'picture_5'	=> $file_dokumen5
								);

				//print_r($insert_data);

				 $this->model_utama->insert_data('tourism_place', $insert_data);

				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
				// $this->insert_log('tambah data category_product');

				redirect('admin/tourism_place/add', 'refresh');
			}
			else
			{
				$this->load->view($this->admin_template, $data);
			}
		}

		function delete($kode)
		{
			$this->insert_log('hapus data category_product dengan id : '.$kode);
			$this->model_utama->delete_data($kode, 'category_product_id','category_product');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/product_category');
		}

		function update($kode)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah tourism_place | '.$judul;
			$data['heading'] 		= 'Update tourism_place';
			$data['form_action'] 	= site_url('admin/tourism_place/update_process');

			//$wew = $this->model_utama->get_detail($kode, 'tourism_place_id', 'tourism_place')->row();
			$data['province']		= $this->db->query("select * from location_provinces");
			$wew = $this->db->query("select *,tp.name as tour_name,lc.name as city_name from tourism_place as tp
									LEFT JOIN location_provinces as lp
									ON tp.province_id = lp.id
									LEFT JOIN location_city as lc
									ON tp.city_id = lc.id
			")->row();

			$this->session->set_userdata('kd_update', $wew->tourism_place_id);
			$data['tour']		 	= $wew;	
			$data['page']			= 'admin/tourism_place/page_form';

			$this->load->view($this->admin_template, $data);

			$this->insert_log('klik ubah wisata dengan id : '.$kode);
		}

		

		function update_process()
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah product_category | '.$judul;
			$data['heading'] 		= 'Update product_category';
			$data['form_action'] 	= site_url('admin/product_category/update_process');

			$this->form_validation->set_rules('name', 'name', 'required|min_length[3]');	
			$this->form_validation->set_rules('description', 'description', 'required|min_length[3]');

			if ($this->form_validation->run() == TRUE)
			{
				$tour_id			= $this->input->post('tour_id');
				$slug				= url_title($this->security->xss_clean($this->input->post('name')), 'dash', TRUE);
				
				$tour				= $this->db->query("select * from tourism_place where tourism_place_id = '$tour_id' limit 1");
			
				$upload_path		= 	'./uploads/wisata/'.$slug;
				$allowed_types		=	'gif|jpg|png|jpeg';
				$file_dokumen1 		= 	$this->upload_files($upload_path,$allowed_types,'picture_1');
				$file_dokumen2 		= 	$this->upload_files($upload_path,$allowed_types,'picture_2');
				$file_dokumen3 		= 	$this->upload_files($upload_path,$allowed_types,'picture_3');
				$file_dokumen4 		= 	$this->upload_files($upload_path,$allowed_types,'picture_4');
				$file_dokumen5 		= 	$this->upload_files($upload_path,$allowed_types,'picture_5');
				
				$update_data = array (
								'name'	=> $this->input->post('name'), 
								'description' => $this->input->post('description'),
								'province_id' => $this->input->post('province_id'),
								'city_id' => $this->input->post('city_id'),
								'slug'		=> $slug,
								);

				if( $file_dokumen1 != '' ){	
					$update_data['picture_1']		= $file_dokumen1;
					$this->delete_tour_picture($tour->row()->picture_1,$slug);
				}
				if( $file_dokumen2 != '' ){	
					$update_data['picture_2']		= $file_dokumen2;
					$this->delete_tour_picture($tour->row()->picture_2,$slug);
				}
				if( $file_dokumen3 != '' ){	
					$update_data['picture_3']		= $file_dokumen3;
					$this->delete_tour_picture($tour->row()->picture_3,$slug);
				}
				if( $file_dokumen4 != '' ){	
					$update_data['picture_4']		= $file_dokumen4;
					$this->delete_tour_picture($tour->row()->picture_4,$slug);
				}
				if( $file_dokumen5 != '' ){	
					$update_data['picture_5']		= $file_dokumen5;
					$this->delete_tour_picture($tour->row()->picture_5,$slug);
				}

				$this->model_utama->update_data($tour_id,'tourism_place_id','tourism_place',$update_data);

				$this->session->set_flashdata('success', 'Data berhasil diupdate!');

				$this->insert_log('ubah wisata dengan id : '.$tour_id);

				redirect('admin/tourism_place/update/'.$tour_id);

			}

			else

			{

				$this->session->set_flashdata('danger', 'Data gagal diupdate!');

				redirect('admin/product_category/update/'.$this->session->userdata('kd_update'));

			}

		}

		

		function insert_log($activity)

		{

			$log['user_id']			= $this->session->userdata('id_user');

			$log['activity']		= $activity;

			$this->model_utama->insert_data('log_user', $log);

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
		
		function ambil_kota($id)
		{
			$tampil		= '<option value="">-- Choose City --</option>';
			
			$kota		= $this->db->query("select * from location_city where province_id = '$id'")->result();
			
			foreach($kota as $row)
			{
				$tampil		.= '<option value="'.$row->id.'">'.$row->name.'</option>';
			}
			
			echo $tampil;
		}
		
		function delete_tour_picture($nama_gambar,$slug)
		{
			$Path 	= './uploads/wisata/'.$slug.'/'.$nama_gambar;
			$Path2 	= './uploads/wisata/'.$slug.'/thumb/thumb_'.$nama_gambar;
			if(file_exists($Path)){	
				unlink($Path);
			}
			if(file_exists($Path)){			
				unlink($Path2);
			}
		}
		
	}	

		