<?php

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class home_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function index(){

    	$data['category']	= $this->model_utama->get_data('category_product');
		$data['product_new']	= $this->db->query("select *,(select sum(rate) as total_rate from product_review where product.product_id = product_id) as total_rate,(select count(rate) as jumlah_rate from product_review where product.product_id = product_id) as jumlah_rate,(select product_picture from product_picture where product_id = product.product_id and picture_highlight = 'yes' limit 1) as picture_highlight,(select product_picture from product_picture where product_id = product.product_id order by create_date limit 1) as newest_picture from product order by create_date DESC limit 4");		$data['product_top']	= $this->db->query("select *,(select sum(rate) as total_rate from product_review where product.product_id = product_id) as total_rate,(select count(rate) as jumlah_rate from product_review where product.product_id = product_id) as jumlah_rate,(select product_picture from product_picture where product_id = product.product_id and picture_highlight = 'yes' limit 1) as picture_highlight,(select product_picture from product_picture where product_id = product.product_id order by create_date limit 1) as product_picture from product order by total_rate DESC limit 4");
		/*$data['banner_list']	= $this->model_utama->get_order_limit('banner_id','asc',5,'banner');*/
		$data['slider_list']	= $this->model_utama->get_order_limit('slider_id','asc',6,'slider');
		
		return $data;
    }






   

}