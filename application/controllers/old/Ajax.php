<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */
class ajax extends MY_Controller {
	
	/*==============================================================
		index
	==============================================================*/
	public function index($table){	
		redirect(base_url());
	}

	/*==============================================================
		2.	GET DATA
	==============================================================*/
	public function get_data($table){	
	
		if( $this->input->is_ajax_request() ){
			
			$data_limit 	= 	$this->security->xss_clean($_POST['limit']);
			$start  		=  	($this->security->xss_clean($_POST['no_halaman']) - 1) * $data_limit;
			$sql 			= 	"SELECT 
									".$table."_title,
									".$table."_picture,
									".$table."_description,
									".$table."_link,
									".$table."_slug,
									DATE_FORMAT(create_date,'%e %M %Y') AS create_date
								FROM ".$table."
								WHERE ".$table."_hide = 'no' 
								ORDER BY create_date DESC 
								LIMIT ".$start.",".$data_limit;
			$data['data_list'] = $this->db->query($sql);

			$post = '';
			foreach( $data['data_list']->result_array() as $row ){
				$post .= 
					'<div class="post">
						<div class="entry">
							<div class="thumb">';
							if( $row[$table.'_picture'] != ''):
								
								$post .= '<img src="'.base_url().'uploads/'.
											( $table == 'galeri' ? $table .'/'. $row[$table.'_slug'] : $table )
											.'/thumb_'.$row[$table.'_picture'].'">';
							else:
								$post .= '<img src="'.base_url().'assets/library/thumb_no_image.jpg">';	
							endif;
				$post .= '</div>
							<div class="desc">
								<a href="'.base_url().'/'.$table.'/'.$row[$table.'_slug'].'" class="header">'.character_limiter(ucwords($row[$table.'_title']),30).'</a>
								<div class="description-inside">
								'.character_limiter(strip_tags($row[$table.'_description']),130).'
								</div>
							</div>	
						</div>
						<div class="meta">';
					
					if( $table != 'galeri'):        
				   	$post .= '<span class="date">
					        	<i class="fa fa-calendar"></i>
					        	'.$row['create_date'].'
					        </span>';
					endif;			
				$post .= '<span class="read-more">
								<a href="'.$row[$table.'_link'].'">
								 	Selengkapnya
								 	<i class="fa fa-angle-double-right"></i>
								</a>
							</span>
						</div>
					</div>';
			}
			echo $post;
			die();

		}else{
			redirect(base_url());
		}
	}

	/*==============================================================
		2.	GET DATA BERITA ON SLIDER PAGE
	==============================================================*/
	public function get_data_berita_on_slider_page(){
		if( $this->input->is_ajax_request() ){
			$this->get_data_ajax_berita_on_slider_page();
		}else{
			redirect(base_url());
		}
	}

	/*==============================================================
		3.	CUSTOM SEARCH
	==============================================================*/
	public function search(){	

		
		$this->load->database();
		$this->load->library('custom_search_library');
		//$this->custom_search_library->create_index();
		$this->custom_search_library->search( $_POST['keyword'] );
	}


	public function visitor_counter(){	
		
		if( $this->input->is_ajax_request() ){
			
			$this->load->library('log_library');
			$visitor_counter = $this->log_library->visitor_counter();

			$structure = '
			<div class="statistic">
				<header>
					<h3 class="title">Statistik Kunjungan</h3>
				</header>
				<div class="visitor">
					<div class="icon">
						<i class="fa fa-bar-chart"></i>
					</div>
					<div class="desc">
						<div class="visited">
							Kunjungan :'; 
							if(count($visitor_counter) > 0 ):
							$structure .= '<span class="num"> '.$visitor_counter[0]['kunjungan'].'</span>';
							endif;
	 	  $structure .= '</div>
						<div class="visited">
							Pageviews :'; 
							if(isset($visitor_counter)):
			 $structure .= '<span class="num"> '.$visitor_counter[0]['page_views'].'</span>';
							endif;  
	 	   $structure .='</div>
					</div>
				</div>
			</div>';

			echo $structure;

		}else{
			redirect(base_url());
		}
	}

	/*===================================================================
	
	===================================================================*/
	public function add_wishlist(){	

		if( $this->input->is_ajax_request() ){

			$customer_id 	= 	$this->session->userdata('id_customer');
			$product_id 	=	$this->security->xss_clean($this->input->post('product_id'));

			$sql 			= 	"DELETE
								FROM wishlists 
								WHERE customer_id=".$customer_id
								." AND product_id=".$product_id;
			$this->db->query($sql);
			$weleh = array (
								'customer_id' 			=> $customer_id,
								'product_id' 			=> $this->security->xss_clean($this->input->post('product_id'))
							);
			$query 			= 	$this->model_utama->insert_data('wishlists', $weleh);
			if( $query ){
				echo 'wishlist is added';
			}	
		}else{
			redirect(base_url());
		}
	}

}