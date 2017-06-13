<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */

class Home extends MY_Controller {

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
		$data['best_tour']	= $this->db->query("select * from tourism_place order by create_date limit 4");
		$data['new_tour']	= $this->db->query("select * from tourism_place order by create_date limit 3");
		//$data['page']		= $this->front_folder.$this->themes_folder_name.'/home/home';
		
		//$this->load->model('home_model');
		//$home_model = $this->home_model->index();
		//$data['category'] 		= $home_model['category'];
		//$data['product_new'] 		= $home_model['product_new'];		$data['product_top'] 		= $home_model['product_top'];
		//$data['slider_list'] 		= $home_model['slider_list'];

		$limit 					= 4;
		if( 	$this->themes_folder_name == 'furniture_template' 
			|| 	$this->themes_folder_name == 'electro_template' 
		){
			$limit 		= 10;
		}
		//$data['best_seller'] 	= $this->get_best_seller_helper($limit);

		$this->load->view('main/infongetrip_template/page_home', $data);
		$this->log_visitor('lihat halaman home');		
	}

}