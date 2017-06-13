<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *
 * @author	M.Fadli Prathama (09081003031)
 *  email : m.fadliprathama@gmail.com
 *
 */


class menu extends MY_Controller {
	
	public function index()
	{
		if($this->session->userdata('login_admin') == true)
		{
			$user_id 				= $this->session->userdata('id_user');
			$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			$data['title'] 			= 'Kelola Menu | '.$judul;
			$data['heading'] 		= "Menu";
			$data['page']			= 'admin/menu/page_list';
			$data['menu_list']		= $this->model_utama->get_order('menu_order','asc','menu');
			$this->load->view($this->admin_template, $data);

			$log['user_id']			= $this->session->userdata('id_user');
			$log['activity']		= "lihat menu";
			$this->model_utama->insert_data('log_user', $log);
		}
		else
		{
			redirect('login');
		}
	}
	

	function update_field($field,$id,$id_field,$table)
	{
		if($this->session->userdata('login_admin') == true)
		{

			$data[$field] = $this->input->post('value');
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
			echo $this->input->post('value');
		}
	}

	function add_item($kode, $field, $table)
	{
		if($this->session->userdata('login_admin') == true)
		{
			if($field != '0') : 
				$data[$field] 	= $kode;				
			endif; 

			$field_order 	= $table.'_order';
			$query 	= $this->db->query("SHOW COLUMNS FROM `$table` LIKE '$field_order'");
			if($query->num_rows() > 0) {
				$order = 1;
				$query_order = $this->model_utama->get_order_limit($table.'_order','desc','1',$table);
				if($field != '0')
				{
					$query_order = $this->model_utama->cek_order_limit($kode,$field,$table.'_order','desc','1',$table);
				}

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
			
			if($table == 'menu')
			{	
				$this->model_utama->insert_data($table,$data);

				$data_menu['menu'] = $this->model_utama->get_last('create_date','menu')->row();
				$this->load->view('admin/menu/menu_add_view',$data_menu);

				// echo "masuk brow";
			}
			if($table == 'menu_lv1')
			{
				$this->model_utama->insert_data($table,$data);

				$data_menu_lv1['menu_lv1'] = $this->model_utama->get_last('create_date','menu_lv1')->row();
				$this->load->view('admin/menu/menu_lv1_add_view',$data_menu_lv1);

				
			}

			if($table == 'menu_lv2')
			{
				$this->model_utama->insert_data($table,$data);

				$data_menu_lv2['menu_lv2'] = $this->model_utama->get_last('create_date','menu_lv2')->row();
				$this->load->view('admin/menu/menu_lv2_add_view',$data_menu_lv2);

				
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

