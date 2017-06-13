<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */
class user extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Kelola user | '.$judul;
			$data['heading'] 		= "user list";
			$data['page']			= 'admin/user/page_list';
			$data['user_list']		= $this->db->query("select * from user,user_detail where user.user_id = user_detail.user_id order by user_detail.create_date desc");
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat user";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	

	function add()
	{	
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah user | '.$judul;
			$data['heading'] 		= 'Add user List';
			$data['form_action'] 	= site_url('index.php/admin/user/add_process');
			$data['user_list']		= $this->model_utama->get_order('create_date','desc','user');
			$data['page']			= 'admin/user/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $user_id;
			$log['activity']		= 'klik tambah data user';
			$this->model_utama->insert_data('log_user', $log);

		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function add_process()
	{

		if($this->session->userdata('login_admin') == true)
		{

			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Tambah user | '.$judul;
			$data['heading'] 		= 'Add user List';
			$data['user_list']		= $this->model_utama->get_order('create_date','desc','user');
			
			$data['form_action'] 	= site_url('index.php/admin/user/add_process');
			$data['page']			= 'admin/user/page_form';

			$this->form_validation->set_rules('user_name', 'nama', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('username', 'username', 'required|min_length[3]');
			$this->form_validation->set_rules('password', 'password', 'required|min_length[3]');
			$this->form_validation->set_rules('user_status', 'status', 'required');
			$this->form_validation->set_rules('user_email', 'email', 'valid_email|min_length[1]');
				
				
			if ($this->form_validation->run() == TRUE)
			{
				$username 		= $this->input->post('username');
				$cek_username 	= $this->model_utama->cek_data($username,'username','user');

				if($cek_username->num_rows == 0) : 

				$config['upload_path'] 		= './uploads/user';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
				
				$image_folder_path 			= 'uploads/user/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );

				$weleh = array (
								'user_name' 			=> $this->security->xss_clean($this->input->post('user_name')),
								'username' 				=> $this->security->xss_clean($this->input->post('username')),
								'password' 				=> md5($this->security->xss_clean($this->input->post('password'))),
								'user_status' 			=> $this->security->xss_clean($this->input->post('user_status')),
								'create_date'			=> date('Y-m-d H:i:s')
								);
				$this->model_utama->insert_data('user', $weleh);

				$last_user_id = $this->model_utama->get_last('user_id','user')->row()->user_id;

				$detail = array(
								'user_id' 				=> $last_user_id,
								'user_detail_email' 	=> $this->input->post('user_email'),
								'user_detail_picture' 	=> $file_dokumen,
								'create_date'			=> date('Y-m-d H:i:s')
								);

				$this->model_utama->insert_data('user_detail', $detail);

				$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				$log['user_id']				= $user_id;
				$log['activity']			= 'tambah data user';
				$this->model_utama->insert_data('log_user', $log);
				redirect('admin/user/add', 'refresh');

				else : 
					$this->session->set_flashdata('danger', 'Username sudah digunakan!');
					$this->load->view($this->admin_template, $data);
				endif;
			}
			else
			{
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function delete($kode)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$log['user_id']				= $this->session->userdata('id_user');
			$log['activity']			= 'hapus data user dengan id : '.$kode.'  ';
			$this->model_utama->insert_data('log_user', $log);

			$this->model_utama->delete_data($kode, 'user_id','user');
			// $this->model_utama->delete_data($kode, 'user_id','user_detail');
			$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('admin/user');
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function update($kode)
	{
	

		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah user | '.$judul;
			$data['heading'] 		= 'Update user';
			
			$data['form_action'] 	= site_url('index.php/admin/user/update_process');

			$wew = $this->db->query("select * from user,user_detail where user.user_id = user_detail.user_id and user.user_id = '$kode'")->row();

			$this->session->set_userdata('kd_weleh', $wew->user_id);
			
			$data['default']['user_name'] 				= $wew->user_name;		
			$data['default']['user_status'] 			= $wew->user_status;		
			$data['default']['username']				= $wew->username;	
			// $data['default']['password']				= $wew->password;	
			$data['default']['user_email']				= $wew->user_detail_email;	
			$data['default']['user_picture'] 			= $wew->user_detail_picture;
			$data['default']['user_id'] 				= $wew->user_id;
			
			$data['page']			= 'admin/user/page_form';
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= 'klik ubah data user dengan id : '.$kode;
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function update_process()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Halaman Ubah user | '.$judul;
			$data['heading'] 		= 'Update user';
			$data['page']			= 'admin/user/page_form';
			$data['form_action'] 	= site_url('index.php/admin/user/update_process');

			
			$this->form_validation->set_rules('user_name', 'nama', 'required|min_length[3]|max_length[255]');
			$this->form_validation->set_rules('username', 'username', 'required|min_length[3]');
			$this->form_validation->set_rules('password', 'password', 'min_length[3]');
			$this->form_validation->set_rules('user_status', 'status', 'required');
			$this->form_validation->set_rules('user_email', 'email', 'valid_email|min_length[1]');
			
			if ($this->form_validation->run() == TRUE)
			{
				$password = md5($this->security->xss_clean($this->input->post('password')));

				if($this->input->post('password') == '') {
					$cek_pass = $this->model_utama->cek_data($this->input->post('user_id'),'user_id','user');
				
					if($cek_pass->num_rows() > 0)
					{
						$password = $cek_pass->row()->password;
					}
				
				}


				$wew = $this->model_utama->get_detail($this->input->post('user_id'), 'user_id', 'user_detail')->row();	
				
				$config['upload_path'] 		= './uploads/user';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg|doc|docx|xls|xlsx|rar|zip';
				
				$image_folder_path 			= 'uploads/user/thumb';
				$file_dokumen 				= $this->upload_photo( 	$image_folder_path,
																	$config );

				$weleh = array (
								'user_name' 			=> $this->security->xss_clean($this->input->post('user_name')),
								'username' 				=> $this->security->xss_clean($this->input->post('username')),
								'password' 				=> $password,
								'user_status' 			=> $this->security->xss_clean($this->input->post('user_status'))
								);


				$this->model_utama->update_data($this->input->post('user_id'),'user_id','user',$weleh);

				$detail = array(
								'user_detail_email' 	=> $this->security->xss_clean($this->input->post('user_email'))
								);

				if( $file_dokumen != '' ){
					$detail['user_detail_picture']	= $file_dokumen;
				}

				
				$this->model_utama->update_data($this->input->post('user_id'),'user_id','user_detail',$detail);
				$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				$log['user_id']				= $user_id;
				$log['activity']			= 'ubah data user dengan id : '.$this->input->post('user_id').'  ';
				$this->model_utama->insert_data('log_user', $log);
	
				// redirect('admin/user/update/'.$this->session->userdata('kd_weleh'));
				redirect('admin/user/update/'.$this->input->post('user_id'));
			}
			else
			{
				$data['page']			= 'admin/user/page_form/update/'.$this->input->post('user_id');
				$this->load->view($this->admin_template, $data);
			}
		}
		else
		{
			redirect(base_url().'login');
		}
	}
	
	function get_subcategory($id = 0)
    {
        $query_subcategory = $this->db->query("select * from forum_subcategory where forum_category_id = '$id'");
            
        echo '<option value="0">-- Silakan Pilih Sub Kategori --</option>';

        if($query_subcategory->num_rows() > 0)
        {
            foreach($query_subcategory->result() as $row)
            {
                echo '<option value="'.$row->forum_subcategory_id.'">'.$row->forum_subcategory_title.'</option>';
            }
        }
    }

    function add_item($kode, $field, $table)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$data[$field] 	= $kode;
			$field_order 	= $table.'_order';
			$query 	= $this->db->query("SHOW COLUMNS FROM `$table` LIKE '$field_order'");
			if($query->num_rows() > 0) {
				$order = 1;
				$query_order = $this->model_utama->cek_order_limit($kode,$field,$table.'_order','desc','1',$table);
				if($query_order->num_rows() > 0) {
					$row_order = $query_order->row_array();
					$order = $row_order[$field_order] + 1;
				}
				$data[$table.'_order'] = $order;
			}
			$query_date	= $this->db->query("SHOW COLUMNS FROM `$table` LIKE 'create_date'");
			if($query_date->num_rows() > 0) {
				$data['create_date'] = date('Y-m-d H:i:s');
			}
			
			if($table == 'user_kursus')
			{	
				$this->model_utama->insert_data($table,$data);

				$data_row['row'] = $this->model_utama->get_last('create_date','user_kursus')->row();
				$this->load->view('admin/user/user_kursus_add_view',$data_row);
				// echo 'eaaaaa';
				
			}
		}
	}

	function sorting($field_order,$field_id,$table)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$i = 1;

			foreach ($this->input->post('target_item_'.$table) as $value) {
			    // Execute statement:
			    // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
				$data[$field_order]	= $i;
			    $this->model_utama->update_data($value,$field_id,$table,$data);
			    $i++;
			}
		}
	}

	function delete_item($value,$field,$table)
	{
		if($this->session->userdata('login_admin') == true)
		{
			$this->model_utama->delete_data($value,$field,$table);
		}
	}
}

