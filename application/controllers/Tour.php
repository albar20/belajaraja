<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tour extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->minify();
	}

	public function index()
	{
		$judul				= $this->setting->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/tour/page_tour_list';
		$start				= 0;
		$limit 				= 9;
		$data['prov']		= $this->db->get('location_provinces')->result();
		/*====================================================
			1.	Get Tour
		====================================================*/
		//echo $_POST['provinsi'];

		if (isset($_GET['find']) && isset($_GET['provinsi']) && $_GET['provinsi']>0) {
			$provinsi = $_GET['provinsi'];
			$search =  $_GET['name_tour'];
			$kota = $_GET['kota'];

			if ($_GET['cari'] == 'provinsi') {
			 $sql    =   "SELECT 
                        *,
						(select count(*) as total_review from tour_review where tourism_place_id = tourism_place.tourism_place_id) as total_review,
						(select sum(rate) as nilai_rating from tour_review where tourism_place_id = tourism_place.tourism_place_id) as nilai_rating
                    FROM tourism_place WHERE name LIKE '%$search%' AND province_id =".$_GET['provinsi']
                    ." ORDER BY create_date DESC". 
                    "  LIMIT ".$start.",".$limit;
               $sql_numrows = "WHERE name LIKE '%$search%' AND province_id =".$_GET['provinsi'];
              }elseif ($_GET['cari'] == 'kota') {
	         	$sql    =   "SELECT *, (select count(*) as total_review from tour_review where tourism_place_id = tourism_place.tourism_place_id) as 
	         	total_review, (select sum(rate) as nilai_rating from tour_review where tourism_place_id = tourism_place.tourism_place_id) as nilai_rating FROM
	         	 tourism_place WHERE name LIKE '%$search%' AND province_id =$provinsi AND city_id = $kota ORDER BY create_date DESC LIMIT $start,$limit ";
	         	$sql_numrows = "WHERE name LIKE '%$search%' AND province_id =$provinsi AND city_id = $kota";
              }

		} elseif (isset($_GET['find'])) {
			$search =  $_GET['name_tour'];

		$sql    =   "SELECT 
                        *,
						(select count(*) as total_review from tour_review where tourism_place_id = tourism_place.tourism_place_id) as total_review,
						(select sum(rate) as nilai_rating from tour_review where tourism_place_id = tourism_place.tourism_place_id) as nilai_rating
                    FROM tourism_place WHERE name LIKE '%$search%' "
                    ." ORDER BY create_date DESC". 
                    "  LIMIT ".$start.",".$limit;
            $sql_numrows = "WHERE name LIKE '%$search%'";
		}else{

			$sql = $this->tour_sql_helper(	$start,$limit );
			$sql_numrows = "";			
		}



		$data['tour_list']	= $this->db->query($sql);		
												
		/*====================================================
			2.	PAGINATION STRUCTURE
		====================================================*/
		$sqlr = "select count(*) as total from tourism_place ".$sql_numrows;
		$base_url 		= 	base_url().'tour/page';
		$total_row 		=	$this->db->query($sqlr)->row()->total;
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
	
	public function detail()
	{
		$judul				= $this->setting->website_name;
		$data['judul'] 		= ''.$judul;
		$data['title'] 		= $data['judul'];
		$data['page']		= $this->front_folder.$this->themes_folder_name.'/tour/page_tour_detail';
		
		$tour				= $this->uri->segment(3);
		$data['tour']		= $tour = $this->db->query("select * from tourism_place where slug = '$tour' limit 1");
		$data['user_id'] 	= $this->session->userdata('user_id_user');
		
		if($data['tour']->num_rows() == 0)
		{
			redirect(base_url().'tour','refresh');
		}
		
		$data['tour']		= $tour = $data['tour']->row();
		$data['related']	= $this->db->query("select *,
												(select count(*) as total_review from tour_review where tourism_place_id = tourism_place.tourism_place_id) as total_review,
												(select sum(rate) as nilai_rating from tour_review where tourism_place_id = tourism_place.tourism_place_id) as nilai_rating 
												from tourism_place where city_id = '$tour->city_id' order by rand() limit 3");
		
		$all_review				= $this->db->query("select count(*) as total_review, sum(rate) as nilai_rating from tour_review where tourism_place_id = '$tour->tourism_place_id'")->row();
		$list_review			= $this->db->query("select *,tour_review.create_date as tanggal_review, 
													(select count(*) from tour_review_like where tour_review_id = tour_review.tour_review_id) as total_like,
													(select count(*) from tour_review where user_id = user.user_id) as total_review													
													from tour_review
													LEFT JOIN user
													ON tour_review.user_id = user.user_id
													WHERE tourism_place_id = '$tour->tourism_place_id'
													ORDER BY tour_review.create_date");
		
		$tour_rating			= ($all_review->nilai_rating == "" ? 0 : $all_review->nilai_rating)/($all_review->total_review == 0 ? 1 : $all_review->total_review);
		
		$data['tour_rating']	= round($tour_rating,1);
		$data['list_review']	= $list_review;

		//$this->load->model('home_model');
		//$home_model = $this->home_model->index();
		//$data['category'] 		= $home_model['category'];
		//$data['product_new'] 		= $home_model['product_new'];		$data['product_top'] 		= $home_model['product_top'];
		//$data['slider_list'] 		= $home_model['slider_list'];

		//$limit 					= 4;
		
		//$data['best_seller'] 	= $this->get_best_seller_helper($limit);

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
		
		$sql = "SELECT 
                        *,
						(select count(*) as total_review from tour_review where tourism_place_id = tourism_place.tourism_place_id) as total_review,
						(select sum(rate) as nilai_rating from tour_review where tourism_place_id = tourism_place.tourism_place_id) as nilai_rating
                    FROM tourism_place";
         $order = " ORDER BY create_date DESC"."  LIMIT ".$start.",".$limit;


		if (isset($_GET['find']) && isset($_GET['provinsi']) && $_GET['provinsi']>0) {
			$provinsi = $_GET['provinsi'];
			$search =  $_GET['name_tour'];
			$kota = $_GET['kota'];

			if ($_GET['cari'] == 'provinsi') {
			 $sql    = $sql." WHERE name LIKE '%$search%' AND province_id =".$_GET['provinsi']." ".$order;
             $sql_numrows = "WHERE name LIKE '%$search%' AND province_id =".$_GET['provinsi'];
              }elseif ($_GET['cari'] == 'kota') {
	         	$sql    =  $sql." WHERE name LIKE '%$search%' AND province_id =$provinsi AND city_id = $kota ".$order;
	         	$sql_numrows = "WHERE name LIKE '%$search%' AND province_id =$provinsi AND city_id = $kota";
              }

		} elseif (isset($_GET['find'])) {
			$search =  $_GET['name_tour'];

		$sql    =   $sql." WHERE name LIKE '%$search%' ".$order;
        $sql_numrows = "WHERE name LIKE '%$search%'";
		}else{
			
			$sql = $this->tour_sql_helper(	$start,$limit );
			$sql_numrows = "";			
		}

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
		$config['first_url'] = $config['base_url'].'?'.http_build_query($_GET);
		if (count($_GET) > 0) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
		$this->pagination->initialize($config); 

	}

	public function show_provinsi(){
		$prov = $this->db->get_where('location_city',array('province_id'=>$this->input->post('id_provinsi')))->result();
		foreach ($prov as $row) {
			echo "<option value='$row->id'> $row->name  </option>";
		}
	}

	public function show_desa(){
			$desa = $this->db->get_where('location_districts',array('regency_id'=>$this->input->post('id_kota')))->result();
		foreach ($desa as $row) {
			echo "<option value='$row->id'> $row->name  </option>";
		}
	}
	
}