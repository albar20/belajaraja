<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class blog extends MY_Controller {
	
	public function index($kode='')
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola Post | '.$judul;
			$data['heading'] 		= "all post list";
			$data['page']			= 'admin/blog/page_list';
			$data['blog_list']	= $this->model_utama->get_order('create_date','desc','blog');

			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat blog";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function category($kode = '')
	{	
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola Post | '.$judul;
			$data['heading'] 		= "all post list";
			$data['page']			= 'admin/blog/page_list';
			$data['blog_list']	= $this->model_utama->get_order('create_date','desc','blog');

			if($kode != '')
			{
				$cek_category = $this->model_utama->cek_order($kode,'category_id','blog_id','desc','blog');
				if($cek_category->num_rows() > 0)
				{
					$category = $this->model_utama->cek_data($kode,'category_id','category')->row();
					$data['title'] 			= 'Halaman Kelola Post '.$category->category_title.' | '.$judul;
					$data['heading'] 		= $category->category_title." list";
					$data['page']			= 'admin/blog/page_list';
					$data['blog_list']		= $cek_category;
				}
			}

			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat blog";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	
	function add()
	{
	
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 					= $this->session->userdata('id_user');
			$judul						= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 				= 'Halaman Tambah blog | '.$judul;
			$data['heading'] 			= 'Add blog List';
			$data['form_action'] 		= site_url('admin/blog/add_process');
			$data['blog_list']			= $this->model_utama->get_order('create_date','desc','blog');
			$data['category_list']		= $this->model_utama->get_order('create_date','desc','category');
			// $data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['page']				= 'admin/blog/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']		= $user_id;
			$log['activity']			= 'klik tambah data blog';
			$this->model_utama->insert_data('log_user', $log);

		}
		else
		{
			redirect('login');
		}
	}
	
	function add_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah blog | '.$judul;
			$data['heading'] 		= 'Add blog List';
			$data['blog_list']		= $this->model_utama->get_order('create_date','desc','blog');
			$data['category_list']	= $this->model_utama->get_order('create_date','desc','category');
			// $data['subcategory_list']	= $this->model_utama->get_order('create_date','desc','subcategory');
			$data['form_action'] 	= site_url('admin/blog/add_process');
			$data['page']			= 'admin/blog/page_form';

			
			$this->form_validation->set_rules('blog_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('blog_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('blog_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('blog_hide', 'hide', 'min_length[1]');
			// $this->form_validation->set_rules('blog_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$blog_title 				= url_title($this->input->post('blog_title'), 'dash', TRUE);
				$config['upload_path'] 		= './uploads/blog/'.$blog_title;
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$image_folder_path 			= 'uploads/blog/'.$blog_title.'/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );

				$weleh = array (
								'blog_title' 		=> $this->security->xss_clean($this->input->post('blog_title')),
								'blog_slug' 		=> $this->security->xss_clean($blog_title),
								'user_id'	 		=> $user_id,
								// 'blog_link' 		=> $this->input->post('blog_link'),
								'blog_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->security->xss_clean($this->input->post('category_id')),
								'subcategory_id' 	=> $this->security->xss_clean($this->input->post('subcategory_id')),
								'blog_description' 	=> $this->security->xss_clean($this->input->post('blog_description')),
								'blog_hide' 		=> $this->security->xss_clean($this->input->post('blog_hide')),
								'blog_date' 		=> date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('blog_date')) )),
								'create_date' 		=> date('Y-m-d H:i:s')
								);
				
				$this->model_utama->insert_data('blog', $weleh);
				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data blog';
				$this->model_utama->insert_data('log_user', $log);


				redirect('admin/blog/add', 'refresh');
			}
			else
			{
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	
	function delete($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'hapus data blog dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'blog_id','blog');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/blog');
		}
		else
		{
			redirect('login');
		}
	}

	function hide($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'ubah data blog dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$wew = $this->model_utama->get_detail($kode, 'blog_id', 'blog')->row_array();
			$hide 	= 'yes';
			if($wew['blog_hide'] == 'yes') {
				$hide = 'no';
			}
			$data['blog_hide']			= $hide;
			$this->model_utama->update_data($kode, 'blog_id','blog',$data);
			$this->session->set_flashdata('success', 'Data berhasil diubah!');
			redirect('admin/blog');
		}
		else
		{
			redirect('login');
		}
	}
	
	function update($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah blog | '.$judul;
			$data['heading'] 		= 'Update blog';
			$data['category_list']	= $this->model_utama->get_order('category_title','asc','category');
			
			$data['form_action'] 	= site_url('admin/blog/update_process');

			$wew = $this->model_utama->get_detail($kode, 'blog_id', 'blog')->row_array();
			$this->session->set_userdata('kd_weleh', $wew['blog_id']);
			
			$data['default'] 			= $wew;

			$data['subcategory_list']	= $this->model_utama->cek_order($wew['category_id'],'category_id','subcategory_title','asc','subcategory');
			
			$data['page']			= 'admin/blog/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data blog dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	
	function update_process()
	{

		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah blog | '.$judul;
			$data['heading'] 		= 'Update blog';
			$data['category_list']	= $this->model_utama->get_order('category_title','asc','category');
			$data['form_action'] 	= site_url('admin/blog/update_process');

			$kode = $this->input->post('blog_id');
			$wew = $this->model_utama->get_detail($kode, 'blog_id', 'blog')->row_array();
			
			$data['subcategory_list']	= $this->model_utama->cek_order($wew['category_id'],'category_id','subcategory_title','asc','subcategory');
			
			$this->form_validation->set_rules('blog_title', 'Title', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('blog_description', 'Description', 'min_length[5]');
			$this->form_validation->set_rules('blog_date', 'Date', 'min_length[1]');
			$this->form_validation->set_rules('blog_hide', 'hide', 'min_length[1]');
			// $this->form_validation->set_rules('blog_link', 'Link', 'min_length[1]');
			$this->form_validation->set_rules('category_id', 'Type', 'min_length[1]');
			$this->form_validation->set_rules('subcategory_id', 'Link', 'min_length[1]');

			if ($this->form_validation->run() == TRUE)
			{

				$wew = $this->model_utama->get_detail($this->input->post('blog_id'), 'blog_id', 'blog')->row();	
				
				$blog_title 				= url_title($this->input->post('blog_title'), 'dash', TRUE);
				$config['upload_path'] 		= './uploads/blog/'.$blog_title;
				$config['remove_spaces']	= true;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';

				$image_folder_path 			= 'uploads/blog/'.$blog_title.'/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );

				$weleh = array ('blog_title' 		=> $this->security->xss_clean($this->input->post('blog_title')),
								'blog_slug' 		=> $this->security->xss_clean($blog_title),
								'user_id'	 		=> $user_id,
								'blog_picture' 		=> $file_dokumen,
								'category_id' 		=> $this->security->xss_clean($this->input->post('category_id')),
								'subcategory_id' 	=> $this->security->xss_clean($this->input->post('subcategory_id')),
								// 'blog_link' 		=> $this->input->post('blog_link'),
								'blog_description' 	=> $this->security->xss_clean($this->input->post('blog_description')),
								'blog_hide' 		=> $this->security->xss_clean($this->input->post('blog_hide')),
								'blog_date' 		=> date('Y-m-d',strtotime($this->security->xss_clean($this->input->post('blog_date')) ))
								);
				
				$this->model_utama->update_data($this->input->post('blog_id'),'blog_id','blog',$weleh);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data blog dengan id : '.$this->session->userdata('kd_weleh').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/blog/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/blog/update/'.$this->input->post('blog_id'));
			}
			else
			{
				$data['page']			= 'admin/blog/page_form';
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect('login');
		}
	}
	
	function get_subcategory($id = 0)
    {
        $query_subcategory = $this->db->query("select * from subcategory where category_id = '$id'");

        echo '<option value="">-- Silakan Pilih Subcategory --</option>';

        if($query_subcategory->num_rows() > 0)
        {
            foreach($query_subcategory->result() as $row)
            {
                echo '<option value="'.$row->subcategory_id.'">'.$row->subcategory_title.'</option>';
            }
        }
    }



    

}

