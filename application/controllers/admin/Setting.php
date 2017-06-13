<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */
class setting extends MY_Controller {
	

	public function index(){



		if(		$this->session->userdata('login_admin') == true 
			or 	$this->session->userdata('login_editor') == true
		){
			
			if( isset($_FILES['userfile']) ){
				$config['upload_path'] 		= './uploads/logo/';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
				
				$image_folder_path 			= 'uploads/logo/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );

				if( $file_dokumen != '' ){
					$weleh = array (
									'website_logo' 			=> $this->security->xss_clean($file_dokumen)
									);
				}
				
				$this->model_utama->update_data('1','setting_id','setting',$weleh);
			}


			$user_id 						= $this->session->userdata('id_user');
			$judul							= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 					= 'Halaman Kelola page | '.$judul;
			$data['heading'] 				= "Setting";
			$data['page']					= 'admin/setting/form';
			$data['default']				= $this->model_utama->cek_data('1','setting_id','setting')->row_array();
			$data['template_list']			= $this->model_utama->get_data('templates');
			$data['template_list_active']	= $this->db->query('SELECT * FROM templates WHERE active="1"')->row();
			$data['page_list']				= $this->model_utama->get_data('page');
			$this->load->view($this->admin_template, $data);
			
			// $this->log_activity("lihat setting");
		}else{
			redirect(base_url().'login');
		}
	}
	
	

	function update_field(	$field,
							$id,
							$id_field,
							$table
	){


		if($this->session->userdata('login_admin') == true)
		{

			$data[$field] = $this->security->xss_clean($this->input->post('value'));						if($field == "chat")			{				$data[$field] = $this->input->post('value');			}			
			if($field ==  $table.'_title')
			{
				$slug 	= $table.'_slug';
				$query 	= $this->db->query("SHOW COLUMNS FROM `$table` LIKE '$slug'");
				if($query->num_rows() > 0) {
					$data[$table.'_slug'] = url_title($this->security->xss_clean($this->input->post('value')),'dash',true);
				}
				$query_date	= $this->db->query("SHOW COLUMNS FROM `$table` LIKE 'update_date'");
				if($query_date->num_rows() > 0) {
					$data['update_date'] = date('Y-m-d H:i:s');
				}
			}

			$this->model_utama->update_data($id,$id_field,$table, $data);
			
			// $this->load->library('create_html_file_library');
			// $this->create_html_file_library->delete_all_html_file();
		}
	}

	function update_themes(){
		$this->db->query("UPDATE templates SET active='0'");
		$this->db->query("UPDATE templates SET active='1' WHERE template_id=".$this->security->xss_clean($this->input->post('value')) );
	}
	
}
