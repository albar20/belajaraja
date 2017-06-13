<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class crudgenerator extends CI_Controller {
	
	public function index()
	{
		$user_id 				= $this->session->userdata('user_id');
		$judul					= $this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
		$data['title'] 			= 'Halaman Form Crud Generator | '.$judul;
		$data['heading'] 		= 'Form Crud';
		$data['form_action'] 	= site_url('crudgenerator/crudgenerator/process');
		$data['daftar_tabel']	= $this->db->query("SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='ppid'");
		$page					= 'generator/page_form';
		$this->load->view($page, $data);
	}	
	
	function pilih_tabel()
	{
		$tabel			= $this->input->post('nama_tabel');
		$database		= $this->db->database;
		
		$query_field		= $this->db->query("SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$tabel'");
		
		$list_field		= '<hr>
		<div class="form-group">
			<div class="row">
				<label class="col-sm-2 control-label"><strong>Nama Field</strong></label>
				<label class="col-sm-2 control-label" style="text-align:center;">
					<strong>Input Type</strong>
				</label>
				<label class="col-sm-2 control-label" style="text-align:center;">
					<strong>Aksi</strong>
				</label>
				<label class="col-sm-6 control-label" style="text-align:center;">
					<strong>Opsi Tambahan</strong>
				</label>
			</div>
		</div>
		';
		
		foreach($query_field->result() as $row)
		{
			$list_field .='<div class="form-group" id="'.$row->COLUMN_NAME.'"><hr>
				<div class="row">
					<label class="col-md-2 control-label">'.$row->COLUMN_NAME.'</label>
					<div class="col-md-2">
						<select name="field_tabel['.$row->COLUMN_NAME.']" class="form-control" onchange="pilihType(\''.$row->COLUMN_NAME.'\')" id="fieldTabel'.$row->COLUMN_NAME.'">
							<option value="text">Text</option>
							<option value="textarea">Textarea</option>
							<option value="select">Select</option>
							<option value="radio">Radio Button</option>
							<option value="foreign">Foreign Key</option>
						</select>
					</div>
					<div class="col-md-2" style="text-align:center;">
						<a onclick="hapusField(\''.$row->COLUMN_NAME.'\')" id="buttonHapusField" type="button" data-loading-text="<i class=\'fa fa-circle-o-notch fa-spin\'></i> Dihapus" class="btn red">Hapus Field</a>
					</div>
					<div class="col-md-6" id="opsiTambahan'.$row->COLUMN_NAME.'">
					
					</div>
				</div>
			</div>
			';
		}
		
		echo $list_field;
	}
	
	function pilih_foreign_key()
	{
		$tabel			= $this->input->post("tabel");
		$database		= $this->db->database;
		$field			= $this->input->post("field");
		
		$list_field		= $this->db->query("SELECT REFERENCED_TABLE_NAME
												FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
												WHERE TABLE_SCHEMA = '$database'
												AND TABLE_NAME = '$tabel'
												AND CONSTRAINT_NAME != 'PRIMARY'
												AND COLUMN_NAME = '$field' limit 1");
		
		if($list_field->num_rows() > 0)
		{
			$tabel_foreign				= $list_field->row()->REFERENCED_TABLE_NAME;
		
			$field_tabel_foreign		= $this->db->query("SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='$database' AND TABLE_NAME='$tabel_foreign'");										
											  
			$view			= "<div class=\"row form-group\"><div class=\"col-md-5\"><select name=\"".$field."[tabel]\" class=\"form-control\" required>";
			
			foreach($list_field->result() as $row)
			{
				$view		.= "<option value=\"".$row->REFERENCED_TABLE_NAME."\">".$row->REFERENCED_TABLE_NAME."</option>";
			}
			
			$view			.= "</select></div><div class=\"col-md-5\"><select name=\"".$field."[label]\" class=\"form-control\" required><option value=\"\">-- Pilih Kolom Sebagai Label --</option>";
			
			foreach($field_tabel_foreign->result() as $row)
			{
				$view		.= "<option value=\"".$row->COLUMN_NAME."\">".$row->COLUMN_NAME."</option>";
			}
			
			$view			.= "</select></div></div>";
			
			echo $view;
		}
		else
		{
			echo "Kolom ini bukan foreign key";
		}
	}
	
	function process()
	{
		$basic['table_name'] 			= $_POST['list_tabel'];
		$basic['controller_name']		= $_POST['list_tabel'];
		
		if(empty($_POST['field_tabel']))
		{
			echo "Tabel Belum Dipilih";
			exit();
		}
		else
		{
			foreach($_POST['field_tabel'] as $key=>$value)
			{
				$field[]	= array(
										"name"		=> $key,
										"type"		=> $value,
										"option"	=> $this->input->post($key),
				);
			}			
		}
		
		//foreach($field as $row)
		//{
		//	echo $row['nama']." ".$row['tipe'];
		//}
		//print_r($field);
		//exit();
		//$field		= array('test1','test2','test3','test4','test5');
		
		$this->load->library('crud_generator');
		
		$this->crud_generator->create_controller($basic,$field);
		$this->crud_generator->create_views_list($basic,$field);
		$this->crud_generator->create_views_form($basic,$field);
		
		echo '<br><a href="'.base_url().'public/"'.$basic['controller_name'];
	}
	
	function set_session()
	{
		$this->session->set_userdata('login_admin',true);
		$this->session->set_userdata('user_level','public');
	}
}