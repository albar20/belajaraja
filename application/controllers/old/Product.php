<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class product extends MY_Controller {

	public $limit;

	public function __construct(){

		parent::__construct();
		$this->limit = 2;
		$this->minify();
	}





	/*====================================================


		1.	GET DATA


		2.	PAGINATION STRUCTURE

	====================================================*/


	public function index( )
	{	
		$limit 					= $this->limit;
		$judul					= $this->setting->website_name;
		$data['judul'] 			= 'Product | '.$judul;
		$data['title'] 			= 'Product | '.$judul;
		$data['header']			= 'Product';
		$data['page']			= $this->front_folder.$this->themes_folder_name.'/product/product';
		$log['activity'] 		= 'lihat halaman product';

		/*====================================================

			1.	GET DATA
				1. 	PRODUCT 
				2.	CATEGORY
				3.	BEST SELLER
				4.	IF PAGINATION EXIST
				5.	FOR SINGLE PRODUCT

		====================================================*/

			/*====================================================
				1. 	PRODUCT 
			====================================================*/

			$start 	= 	0;
			$sql = $this->product_sql_helper(	$start, 
												$limit );

			$data['product_list']	= $this->db->query($sql);

			/*====================================================
				2.	CATEGORY
			====================================================*/

			//$data['category_product_list'] = $this->get_category_product_helper();

			/*====================================================
				3.	SUB CATEGORY
			====================================================*/

			//$data['sub_category_product_list'] = $this->get_subcategory_product_helper();

			/*====================================================
				3.	BEST SELLER
			====================================================*/

			$data['best_seller'] = $this->get_best_seller_helper();

			/*====================================================
				4.	IF PAGINATION EXIST
			====================================================*/

			if(is_numeric($this->security->xss_clean($this->uri->segment(2))))
			{
				$start 					= $this->security->xss_clean($this->uri->segment(2));
				$sql 					= $this->product_sql_helper(	$start, 
																		$limit );

				$data['product_list']	= $this->db->query($sql);
				$log['activity']		= "lihat halaman product halaman ke $start";

			/*====================================================
				5.	FOR SINGLE PRODUCT
			====================================================*/		

			}else{

				$product_slug	= $this->security->xss_clean($this->uri->segment(2));
				$product 		= $this->model_utama->cek_data($product_slug,'slug','product');
				if($product->num_rows() > 0)
				{
					$data['product_list']	= $product = $product->row();
					$query_rating		= $this->db->query("select sum(rate) as rating, count(rate) as jumlah_review from product_review where product_id = '$product->product_id'")->row();
					$jumlah_review		= ($query_rating->jumlah_review == 0 ? 1 : $query_rating->jumlah_review);
					$rating				= ($query_rating->rating/$jumlah_review);
					$this->load->model('product_model');
					$product_model	 			= $this->product_model->additional_info_and_size($product);
					$data['additional_info'] 	= $product_model['additional_info'];
					$data['customer_review']	= $this->db->query("select *,(select count(*) as totalvote from product_review_vote where product_review_id = product_review.product_review_id) as totalvote from product_review,customers where product_review.user_id = customers.customer_id and product_review.product_id = '$product->product_id' order by product_review.create_date desc limit 5");
					$data['rating']				= round($rating,1);
					$data['size'] 				= $product_model['size'];
					$data['judul'] 			= ''.ucwords($product->product_name).' | '.$judul;
					$data['title'] 			= $data['judul']; 
					$data['header']			= 'Product';
					$data['page']			= $this->front_folder.$this->themes_folder_name.'/product/product-single';
					$log['activity'] 		= 'lihat halaman product - '.$product->product_name;
					
					$data['related_products'] 	= $this->product_single_related_products_helper(	$data['product_list']->category_product_id,
																							$data['product_list']->product_id );

					$data['product_thumnails']	= $this->product_single_thumbnail_helper($data['product_list']->product_id);

				}
			}

		/*====================================================
			2.	PAGINATION STRUCTURE
		====================================================*/

		$base_url 		= 	base_url().'product';
		$total_row 		=	$this->db->query("select count(*) as total from product WHERE stock !=0 ")->row()->total;
		$uri_segment	= 	2;

		$this->product_pagination_helper(	$limit,
											$base_url,
											$total_row,
											$uri_segment		
											);

		$this->load->view($this->front_end_template, $data);

		$this->log_visitor($log['activity']);

	}

	/*====================================================
		1.	GET DATA
		2.	PAGINATION
	====================================================*/

	public function category(	$subcategory_product_slug = '', 
								$start = 0
	){

		if( $subcategory_product_slug == '' ){
			redirect('product', 'refresh');
		}

		$judul					= $this->setting->website_name;
		$data['judul'] 			= 'Product Category | '.$judul;
		$data['title'] 			= $data['judul'];
		$data['header']			= 'Product Category';
		$data['page']			= $this->front_folder.$this->themes_folder_name.'/product/product';
		$log['activity'] 		= 'lihat halaman product category';

		/*====================================================
			1.	GET DATA
				1. 	PRODUCT 
				2.	CATEGORY
		====================================================*/
			/*====================================================
				1. 	PRODUCT
					1.	FILTER
					2.	GET PRODUCT DATA 
			====================================================*/
				if( $this->uri->segment(4) != '' ){
					$start = $this->uri->segment(4);	
				}

				$limit 					= $this->limit;
				$order_by  				= "ORDER BY p.create_date DESC";

				/*====================================================
					1.	FILTER
				====================================================*/

				$filter 	= $this->sort_and_limit_filter_helper(	$limit,
																	$order_by
																	);

				$order_by 	= $filter['order_by'];

				$limit		= $filter['limit'];

				/*====================================================
					2.	GET PRODUCT DATA 
				====================================================*/
				$this->load->model('product_model');
				$product_model	 			= $this->product_model->get_product_by_category(	$subcategory_product_slug,
																								$order_by,
																								$start,
																								$limit	
																							);
																							
				$data['product_list'] 		= $product_model['product_list'];

			/*====================================================
				3.	BEST SELLER
			====================================================*/
			$data['best_seller'] = $this->get_best_seller_helper();

		/*====================================================
			2.	PAGINATION
		====================================================*/

		$base_url 		= 	base_url().'product/category/'.$subcategory_product_slug;

		$sql 			= 	"SELECT 
								count(*) AS total
							FROM product AS p 
							LEFT JOIN subcategory_product AS c 
							ON p.subcategory_product_id = c.subcategory_product_id
							WHERE c.slug='".$subcategory_product_slug
							."' AND p.stock !=0";

		$total_row 		=	$this->db->query($sql)->row()->total;	

		$uri_segment	= 	4;

		$this->product_pagination_helper(	$limit,
											$base_url,
											$total_row,
											$uri_segment		
										);

		$this->load->view($this->front_end_template, $data);
		$this->log_visitor($log['activity']);
	}

	/*========================================================
		1.	SORT PRODUCT
		2.	SHOW TOTAL PRODUCT
	========================================================*/

	function set_grid_or_list_view(	$display_format ){

		$referrer = $this->security->xss_clean($_SERVER['HTTP_REFERER']);
		$display_format = $this->security->xss_clean($display_format);
		$this->session->set_userdata('display_format',$display_format);
		redirect($referrer);
	}

	public function product_pagination_helper(	$limit,
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
		$config['full_tag_open'] 	= '<ul class="pagination">';
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
		$config['base_url'] 		= $base_url;
		$config['total_rows'] 		= $total_row;
		$config['per_page'] 		= $limit; 
		$config['uri_segment'] 		= $uri_segment;

		$this->pagination->initialize($config); 

	}	

	function review()
	{
		if($this->session->userdata("login_customer") == true)
		{
			$product_id					= $this->uri->segment(3);
			if($product_id == "")
			{
				redirect(base_url()."product");
			}
			else
			{
				$cek_product = $this->db->query("select * from product where product_id = '$product_id' limit 1");
				if($cek_product->num_rows() == 0)
				{
					redirect(base_url()."product");
				}
				else
				{
					$judul					= $this->setting->website_name;
					$customer_id			= $this->session->userdata("id_customer");
				
					$cek_review				= $this->db->query("select * from product_review where product_id = '$product_id' and user_id = '$customer_id' limit 1");
					
					if($cek_review->num_rows() > 0)
					{
						$data['already_review'] = "Your Already Review This Product, This Will Overwrite Your Last Review";
						$data['my_review']		= $cek_review; 
					}
				
					$data['judul'] 			= 'Product | '.$judul;
					$data['title'] 			= 'Product | '.$judul;
					$data['header']			= 'Product';
					$data['product_id']		= $product_id;
					$data['page']			= $this->front_folder.$this->themes_folder_name.'/product/review';
				
					$data['product_list']	= $product = $cek_product->row();

					$this->load->model('product_model');
					
					$log['activity'] 			= 'lihat halaman product - '.$cek_product->row()->product_id;
					
					$product_model	 			= $this->product_model->additional_info_and_size($product);
					
					$data['related_products'] 	= $this->product_single_related_products_helper(	$data['product_list']->category_product_id,

																								$data['product_list']->product_id );

					$data['product_thumnails']	= $this->product_single_thumbnail_helper($data['product_list']->product_id);
					
					$this->load->view($this->front_end_template, $data);

					$this->log_visitor($log['activity']);
				}
			}
		}
		else
		{
			redirect(base_url()."login");
		}
	}
	
	function add_review()
	{
		if($this->session->userdata("login_customer") == true)
		{
			$this->form_validation->set_rules('review', 'Review', 'required|min_length[5]|max_length[6000]');
			$this->form_validation->set_rules('product_id', 'Product', 'required');
			//$this->form_validation->set_rules('user_id', 'User', 'required');
			
			$data['product_id']			= $product_id = $this->input->post('product_id');
			$product					= $this->db->query("select * from product where product_id = '$product_id'")->row();
			$customer_id				= $this->session->userdata('id_customer');
			
			if ($this->form_validation->run() == TRUE)
			{
				$cek_review				= $this->db->query("select * from product_review where product_id = '$product_id' and user_id = '$customer_id' limit 1");
				
				if($cek_review->num_rows() > 0)
				{
					$review_id					= $cek_review->row()->product_review_id;
				
					$data['review']				= $this->security->xss_clean($this->input->post('review'));
					$data['rate']				= $this->input->post('nilai_rating');
					$data['price']				= $this->input->post('price_rating');
					$data['packaging']			= $this->input->post('packaging_rating');
					$data['create_date']		= date("Y-m-d H:i:s");
					$data['edited']				= 1;
					//$data['product_review_id']	= "REV".$product_id.date("Ymdhis").rand();
					
					$this->model_utama->update_data($review_id,"product_review_id","product_review",$data);
					
					$this->session->set_flashdata("success","Your Review Already Saved");
					
					redirect(base_url()."product/".$product->slug); 
				}
				else
				{			
					$data['user_id']			= $this->session->userdata('id_customer');
					$data['review']				= $this->security->xss_clean($this->input->post('review'));
					$data['rate']				= $this->input->post('nilai_rating');
					$data['price']				= $this->input->post('price_rating');
					$data['packaging']			= $this->input->post('packaging_rating');
					$data['create_date']		= date("Y-m-d H:i:s");
					$data['product_review_id']	= "REV".$product_id.date("Ymdhis").rand();
					
					$this->model_utama->insert_data("product_review",$data);
					
					$this->session->set_flashdata("success","Your Review Already Saved");
					
					redirect(base_url()."product/".$product->slug); 
				}
			}
			else
			{
				$this->session->set_flashdata("danger","Your review is too short");
			
				redirect(base_url()."product/review/".$product->product_id);
			}
		}
		else
		{
			redirect(base_url()."login");
		} 
	}
	
	function favourite()
	{
		if($this->session->userdata("login_customer") == true)
		{
			 $review_id			= $this->input->post('review_id');
			 $user_id			= $this->session->userdata('id_customer');
			 
			 $cek_review		= $this->db->query("select * from product_review_vote where product_review_id = '$review_id' and user_id = '$user_id' limit 1");
			 
			 if($cek_review->num_rows() == 0)
			 {
				$data	= array(
							'product_review_vote_id'=> "VOTE".date("Ymdhisu").$user_id,
							'product_review_id'		=> $review_id,
							'user_id'				=> $user_id,
							'create_date'			=> date("Y-m-d H:i:s")
				);
				
				$this->model_utama->insert_data("product_review_vote", $data);
			 }
			 else
			 {
				$this->db->query("delete from product_review_vote where product_review_id = '$review_id' and user_id = '$user_id'");
			 }
			
			$jumlahVote		= $this->db->query("select count(*) as total from product_review_vote where product_review_id = '$review_id' and user_id = '$user_id'")->row();
			echo $jumlahVote->total;
		}
	}

}