<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class Product_api extends API_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	/*=========================================================
		USING
		=================================
		=>	
			1.	url : http;//ecommerce.babastudio.net/product_api

			2.	url : http;//ecommerce.babastudio.net/product_api/$product_name
				url : http;//ecommerce.babastudio.net/product_api/feminasion

			3.	url : http;//ecommerce.babastudio.net/product_api/$page
				url : http;//ecommerce.babastudio.net/product_api/2


			POST variables
			=====================
			$_POST['request_method'] 	= 'index';
				

		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	GET DATA ( FROM MODEL )
		3.	RESPONSE JSON 
	=========================================================*/
	public function index()
	{

		/*=============================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		=============================================*/
		$data = $this->data_for_all_pages();


		/*====================================================
			1.	GET DATA
				1. 	PRODUCT 
				3.	BEST SELLER
				4.	IF PAGINATION EXIST
				5.	FOR SINGLE PRODUCT
		====================================================*/
		$limit 					= $this->_limit;
			
			/*====================================================
				1. 	PRODUCT 
			====================================================*/
			$start 	= 	0;
			$sql = $this->product_sql_helper(	$start, 
												$limit );
			$data['product_list']	= $this->db->query($sql);

			/*====================================================
				3.	BEST SELLER
			====================================================*/
			$data['best_seller'] = $this->get_best_seller_helper();
	
	
			if( $this->uri->segment(2) != '' ){

				/*====================================================
					4.	IF PAGINATION EXIST
				====================================================*/
				if(is_numeric($this->security->xss_clean($this->uri->segment(2))))
				{
					$start 					= $this->security->xss_clean($this->uri->segment(2));
					$sql 					= $this->product_sql_helper(	$start, 
																			$limit );
					$data['product_list']	= $this->db->query($sql);
				

				/*====================================================
					5.	FOR SINGLE PRODUCT
				====================================================*/		
				}else{


					$product_slug	= $this->security->xss_clean($this->uri->segment(2));
					$product 		= $this->model_utama->cek_data($product_slug,'slug','product');

					if($product->num_rows() > 0)
					{
						$data['product_list']		= $product = $product->row();

						$this->load->model('product_model');
						$product_model	 			= $this->product_model->additional_info_and_size($product);
						$data['additional_info'] 	= $product_model['additional_info'];
						$data['size'] 				= $product_model['size'];
						
						$data['related_products'] 	= $this->product_single_related_products_helper(	$data['product_list']->category_product_id,
																										$data['product_list']->product_id );

						$data['product_thumnails']	= $this->product_single_thumbnail_helper($data['product_list']->product_id);

					}
				}

			} 

		$data['product_list']	= $this->db->query($sql)->result_array();	

		/*=============================================
			3.	RESPONSE JSON 
		=============================================*/
		$status 	= self::SUCCESS;
		$message 	= '';
		$this->jsonout(	$status,
						$message, 
						$data
						);
		exit ;
	}




	/*=========================================================
		USING
		=================================
		=>	
			1.	url : http;//ecommerce.babastudio.net/product_api/category/$category_name
				url : http;//ecommerce.babastudio.net/product_api/category/pakaian_santai
			
			2.	url : http;//ecommerce.babastudio.net/product_api/category/$category_name/$page
				url : http;//ecommerce.babastudio.net/product_api/category/pakaian_santai/2

	
			POST variables
			=====================
			$_POST['request_method'] 	= 'category';
				

		1.	DATA FOR ALL PAGE ( FROM api_controller )
		2.	GET DATA ( FROM MODEL )
		3.	RESPONSE JSON 
	=========================================================*/
	public function category(	$subcategory_product_slug = '', 
								$start = 0
	){

		$subcategory_product_slug = $this->security->xss_clean($this->uri->segment(3)); 

		/*=============================================
			1.	DATA FOR ALL PAGE ( FROM api_controller )
		=============================================*/
		$data = $this->data_for_all_pages();

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
				$limit 					= $this->_limit;
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
				$data['product_list'] 		= $data['product_list']->result_array();

			/*====================================================
				3.	BEST SELLER
			====================================================*/
			$data['best_seller'] = $this->get_best_seller_helper();
			$data['best_seller'] = $data['best_seller']->result_array();


		/*=============================================
			3.	RESPONSE JSON 
		=============================================*/
		$status 	= self::SUCCESS;
		$message 	= '';
		$this->jsonout(	$status,
						$message, 
						$data
						);
		exit;

	}



}