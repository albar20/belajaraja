<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Crud_generator {
	
	//public $target	= "../application/";
	
	public function create_controller($basic="",$field="",$folder="public")
	{
		$file_name		= ucfirst($basic['controller_name']);
		$table			= $basic['table_name'];
		$class_name		= $basic['controller_name'];
	
		if (!file_exists("./application/controllers/".$folder))
        {
            mkdir("./application/controllers/".$folder, 0777, true);
        }
	
		$string = "<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class ".$class_name." extends CI_Controller {
		
		public function __construct()
        {
                parent::__construct();
                // Your own constructor code
				".$basic['otorisasi']."
        }
		
		public function index()
		{
			
			\$user_id 				= \$this->session->userdata('id_user');
			\$judul					= \$this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			\$data['title'] 		= 'Halaman Daftar ".$class_name." | '.\$judul;
			\$data['heading'] 		= \"".$class_name."\";
			\$data['page']			= '".$folder."/".$class_name."/page_list';
			\$data['".$table."_list']	= \$this->model_utama->get_data('".$table."');
			
			\$this->load->view('template', \$data);

			\$this->insert_log('lihat data ".$table."');
		}
		
		function add()
		{			
			\$user_id 				= \$this->session->userdata('id_user');
			\$judul					= \$this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			\$data['title'] 		= 'Halaman Tambah ".$class_name." | '.\$judul;
			\$data['heading'] 		= 'Add ".$class_name." List';
			\$data['form_action'] 	= site_url('".$folder."/".$class_name."/add_process');
			\$data['page']			= '".$folder."/".$class_name."/page_form';
			\$this->load->view('template', \$data);

			\$this->insert_log('lihat form ".$table."');
		}
		
		function add_process()
		{
			\$user_id 				= \$this->session->userdata('id_user');
			\$judul					= \$this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			\$data['title'] 		= 'Halaman Tambah ".$class_name." | '.\$judul;
			\$data['heading'] 		= 'Add ".$class_name." List';
			\$data['form_action'] 	= site_url('".$folder."/".$class_name."/add_process');
			\$data['page']			= '".$folder."/".$class_name."/page_form';
		";		

		foreach($field as $row){
			$string .="
			\$this->form_validation->set_rules('".$row['name']."', '".$row['name']."', 'required|min_length[3]');	
		";			
		}
		
		$string .="
			if (\$this->form_validation->run() == TRUE)
			{
				
				\$insert_data = array (
		";
		
		foreach($field as $row)
		{
			$string .="
								'".$row['name']."'					=> \$this->input->post('".$row['name']."'), 
			";
		}
		
		$string .="
								);
				
				\$this->model_utama->insert_data('".$table."', \$insert_data);
				\$this->session->set_flashdata('success', 'Data berhasil disimpan!');
					
				\$this->insert_log('tambah data ".$table."');

				redirect('".$folder."/".$class_name."/add', 'refresh');
			}
			else
			{
				\$this->load->view('template', \$data);
			}
		}
		
		function delete(\$kode)
		{
			\$this->insert_log('hapus data category_product dengan id : '.\$kode);

			\$this->model_utama->delete_data(\$kode, '".$table."_id','".$table."');
			\$this->session->set_flashdata('success', 'Data berhasil dihapus!');
			redirect('".$folder."/".$class_name."');
		}
		
		function update(\$kode)
		{
			\$user_id 				= \$this->session->userdata('id_user');
			\$judul					= \$this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			\$data['title'] 		= 'Halaman Ubah ".$class_name." | '.\$judul;
			\$data['heading'] 		= 'Update ".$class_name."';
			\$data['form_action'] 	= site_url('".$folder."/".$class_name."/update_process');
				
			\$wew = \$this->model_utama->get_detail(\$kode, '".$table."_id', '".$table."')->row();
			\$this->session->set_userdata('kd_update', \$wew->".$table."_id);
		";
		
		foreach($field as $row)
		{
			$string .="
			\$data['default']['".$row['name']."']		 	= \$wew->".$row['name'].";	
			";
		}	

		$string .="
			\$data['page']			= '".$folder."/".$class_name."/page_form';
			\$this->load->view('template', \$data);

			\$this->insert_log('klik ubah data category dengan id : '.\$kode);
			
		}
		
		function update_process()
		{
			\$user_id 				= \$this->session->userdata('id_user');
			\$judul					= \$this->model_utama->get_detail('1','setting_id','setting')->row()->website_name;
			\$data['title'] 			= 'Halaman Ubah ".$class_name." | '.\$judul;
			\$data['heading'] 		= 'Update ".$class_name."';
			\$data['form_action'] 	= site_url('".$folder."/".$class_name."/update_process');
	
		";		

		foreach($field as $row){
			$string .="
			\$this->form_validation->set_rules('".$row['name']."', '".$row['name']."', 'required|min_length[3]');	
		";			
		}
		
		$string .="
				
			if (\$this->form_validation->run() == TRUE)
			{
				
				\$update_data = array (
			";
		
		foreach($field as $row)
		{
			$string .="
								'".$row['name']."'					=> \$this->input->post('".$row['name']."'), 
			";
		}
		
		$string .="
								);
					
				\$this->model_utama->update_data(\$this->session->userdata('kd_update'),'".$table."_id','".$table."',\$update_data);

				\$this->session->set_flashdata('success', 'Data berhasil diupdate!');
				
				\$log['user_id']			= \$user_id;
				\$log['activity']			= 'ubah data ".$table." dengan id : '.\$this->session->userdata('kd_update').'  ';
				\$this->model_utama->insert_data('log_user', \$log);
	
				// redirect('".$folder."/category/update/'.\$this->session->userdata('kd_update'));
				redirect('".$folder."/".$class_name."/');
			}
			else
			{
				\$this->session->set_flashdata('danger', 'Data gagal diupdate!');
				redirect('".$folder."/".$class_name."/update/'.\$this->session->userdata('kd_update'));
			}
		}
		
		function insert_log(\$activity)
		{
			\$log['user_id']			= \$this->session->userdata('id_user');
			\$log['activity']		= \$activity;
			\$this->model_utama->insert_data('log_user', \$log);
		}
	}	
		";
		
		if (file_exists("./application/controllers/".$folder."/" . $file_name .".php"))
        {
            echo "Folder/File Controller Telah Ada proses generasi dibatalkan<br>";
        }
		else
		{
			$this->createFile($string, "./application/controllers/" . $folder ."/" . $file_name .".php");
			echo "File Controller Berhasil Dibuat<br>";
		}
		//return $table;
	}
	
	public function create_views_list($basic="",$field="",$folder="public")
	{
		$file_name		= ucfirst($basic['controller_name']);
		$table			= $basic['table_name'];
		$class_name		= $basic['controller_name'];
		
		if (!file_exists("./application/views/".$folder."/" . $class_name))
        {
            mkdir("./application/views/".$folder."/" . $class_name, 0777, true);
        }
		
		$string		= "<div id=\"content-wrapper\">

        <div class=\"page-header\">
            <h1><?php echo strtoupper(\$heading)?></h1>
        </div> <!-- / .page-header -->

        <div class=\"row\">
            <div class=\"col-sm-12\">

                <!-- Javascript -->
                <script>
                    init.push(function () {
                        $('#tooltips-demo button').tooltip();
                        $('#tooltips-demo a').tooltip();

                        $('#jq-datatables-example').dataTable();
                        $('#jq-datatables-example_wrapper .table-caption').text('Daftar ".$table."');
                        $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
                    });
                </script>
                <!-- / Javascript -->

                <div class=\"panel\">
                    <div class=\"panel-heading\">
                        <span class=\"panel-title\"><?php echo ucwords(\$heading)?></span>
                    </div>
                    <div class=\"panel-body\">
                        <?php
                          \$message = \$this->session->flashdata('warning');
                          echo \$message == '' ? '' : '<div class=\"alert\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                            <strong><i class=\"fa fa-exclamation\"></i></strong> ' . \$message . '</div>';
                        ?>
                        <?php
                          \$message = \$this->session->flashdata('danger');
                          echo \$message == '' ? '' : '<div class=\"alert alert-danger\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                            <strong><i class=\"fa fa-times\"></i></strong> ' . \$message . '</div>';
                        ?>
                        <?php
                          \$message = \$this->session->flashdata('success');
                          echo \$message == '' ? '' : '<div class=\"alert alert-success\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                            <strong><i class=\"fa fa-check\"></i></strong> ' . \$message . '</div>';
                        ?>
                        <?php
                          \$message = \$this->session->flashdata('info');
                          echo \$message == '' ? '' : '<div class=\"alert alert-info\">
                            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
                            <strong><i class=\"fa fa-exclamation\"></i></strong> ' . \$message . '</div>';
                        ?>
						
						 <a href=\"<?php echo base_url()?>".$folder."/".$class_name."/add\"><button class=\"btn btn-labeled btn-success\"><span class=\"btn-label icon fa fa-plus\"></span> Add</button></a>
                        <br><br>
					<?php if(\$".$table."_list->num_rows() > 0) : \$i = 1; ?>
					<table class=\"table table-striped table-bordered table-hover table-checkable order-column\" id=\"jq-datatables-example\">
						<thead>
							<tr>
								<th>No.</th>
        ";
		foreach($field as $row)
		{
			$string .="
								<th>".$this->label($row['name'])."</th>
			";
		}	
		$string .="
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach(\$".$table."_list->result() as \$row) :?>
							<tr class=\"odd gradeX\">
								<td><?php echo \$i++?></td>
        ";
		foreach($field as $row)
		{
			$string .="
								<td>
									<h4><?php echo ucwords(\$row->".$row['name'].")?></h4>
								</td>  
			";
		}	
		$string .="
								<td class=\"center\">
									<a href=\"<?php echo site_url('".$folder."/".$class_name."/update/'.\$row->".$table."_id)?>\"><button data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"\" data-original-title=\"Klik untuk ubah data\" class=\"btn btn-sm  btn-warning\"><span class=\"btn-label icon fa fa-pencil\"></span></button></a>&nbsp;&nbsp;
									<a href=\"<?php echo site_url('".$folder."/".$class_name."/delete/'.\$row->".$table."_id)?>\" onclick=\"return confirm('Anda yakin akan menghapus data ini?')\" ><button data-toggle=\"tooltip\" data-placement=\"bottom\" title=\"\" data-original-title=\"Klik untuk hapus data\" class=\"btn btn-sm  btn-danger\"><span class=\"btn-label icon fa fa-minus-circle\"></span></button></a>
								</td>
							</tr>
						<?php endforeach;?>   
						</tbody>
					</table>
					<?php else :?>

					<div class=\"alert\">
						<button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
						<strong>Warning!</strong> Data tidak ada
					</div>

					<?php endif;?>
				 </div>
                </div>

            </div>
        </div>

    </div> <!-- / #content-wrapper -->
    <div id=\"main-menu-bg\"></div>
</div> <!-- / #main-wrapper -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
    <script type=\"text/javascript\"> window.jQuery || document.write('<script src=\"<?php echo base_url()?>assets/javascripts/jquery.min.js\">'+\"<\"+\"/script>\"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
    <script type=\"text/javascript\"> window.jQuery || document.write('<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js\">'+\"<\"+\"/script>\"); </script>
<![endif]-->

<script src=\"<?php echo base_url()?>assets/javascripts/jquery.transit.js\"></script>

<!-- Pixel Admin's javascripts -->
<script src=\"<?php echo base_url()?>assets/javascripts/bootstrap.min.js\"></script>
<script src=\"<?php echo base_url()?>assets/javascripts/pixel-admin.min.js\"></script>

<script type=\"text/javascript\">
    init.push(function () {
        // Javascript code here
    });
    window.PixelAdmin.start(init);
</script>
		";
		
		if (file_exists("./application/views/".$folder."/" . $class_name."/page_list.php"))
        {
            echo "Folder/File Form Telah Ada proses generasi dibatalkan<br>";
        }
		else
		{
			echo "File Form Berhasil Dibuat<br>";
			$this->createFile($string, "./application/views/".$folder."/" . $class_name ."/page_list.php");
		}	
	}
	
	public function create_views_form($basic="",$field="",$folder="public")
	{
		$file_name		= ucfirst($basic['controller_name']);
		$table			= $basic['table_name'];
		$class_name		= $basic['controller_name'];
		
		if (!file_exists("./application/views/".$folder."/" . $class_name))
        {
            mkdir("./application/views/".$folder."/" . $class_name, 0777, true);
        }
		
		$string ="<div id=\"content-wrapper\">

        <div class=\"page-header\">
            <h1><span class=\"text-light-gray\"><a href=\"<?php echo site_url('admin/slider')?>\"><?php echo ucwords('slider') ?></a> / </span><?php echo ucwords(\$heading)?></h1>
        </div> <!-- / .page-header -->


<!-- 5. \$SUMMERNOTE_WYSIWYG_EDITOR =================================================================

        Summernote WYSIWYG-editor
-->
        <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
        <link rel=\"stylesheet\" type=\"text/css\" href=\"<?php echo base_url()?>assets/codemirror/3.20.0/codemirror.min.css\" />
        <link rel=\"stylesheet\" href=\"<?php echo base_url()?>assets/codemirror/3.20.0/theme/blackboard.min.css\">
        <link rel=\"stylesheet\" href=\"<?php echo base_url()?>assets/codemirror/3.20.0/theme/monokai.min.css\">
        <script type=\"text/javascript\" src=\"<?php echo base_url()?>assets/codemirror/3.20.0/codemirror.js\"></script>
        <script src=\"<?php echo base_url()?>assets/codemirror/3.20.0/mode/xml/xml.min.js\"></script>
        <script src=\"<?php echo base_url()?>assets/codemirror/2.36.0/formatting.min.js\"></script>

        <!-- Javascript -->
        <script>
            init.push(function () {
                $('#styled-finputs-example').pixelFileInput({ placeholder: 'Picture File Only' });

                if (! $('html').hasClass('ie8')) {
                    $('#summernote-example').summernote({
                        height: 200,
                        tabsize: 2,
                        codemirror: {
                            theme: 'monokai'
                        }
                    });
                }
                $('#summernote-boxed').switcher({
                    on_state_content: '<span class=\"fa fa-check\" style=\"font-size:11px;\"></span>',
                    off_state_content: '<span class=\"fa fa-times\" style=\"font-size:11px;\"></span>'
                });
                $('#summernote-boxed').on($('html').hasClass('ie8') ? \"propertychange\" : \"change\", function () {
                    var \$panel = $(this).parents('.panel');
                    if ($(this).is(':checked')) {
                        \$panel.find('.panel-body').addClass('no-padding');
                        \$panel.find('.panel-body > *').addClass('no-border');
                    } else {
                        \$panel.find('.panel-body').removeClass('no-padding');
                        \$panel.find('.panel-body > *').removeClass('no-border');
                    }
                });

                $('#loading-example-btn').click(function () {
                            var btn = $(this);
                            btn.button('loading');
                            setTimeout(function () {
                                btn.button('reset');
                            }, 1500);
                        });

                $('#bs-datepicker-component').datepicker();

                $(\"#category_id\").select2({
                    allowClear: true,
                    placeholder: \"Pilih Kategori\"
                });

                $(\"#subcategory_id\").select2({
                    allowClear: true,
                    placeholder: \"Pilih Sub Kategori\"
                });
            });
        </script>
        <!-- / Javascript -->


        <?php
          \$message = \$this->session->flashdata('warning');
          echo \$message == '' ? '' : '<div class=\"alert\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
            <strong><i class=\"fa fa-exclamation\"></i></strong> ' . \$message . '</div>';
        ?>
        <?php
          \$message = \$this->session->flashdata('danger');
          echo \$message == '' ? '' : '<div class=\"alert alert-danger\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
            <strong><i class=\"fa fa-times\"></i></strong> ' . \$message . '</div>';
        ?>
        <?php
          \$message = \$this->session->flashdata('success');
          echo \$message == '' ? '' : '<div class=\"alert alert-success\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
            <strong><i class=\"fa fa-check\"></i></strong> ' . \$message . '</div>';
        ?>
        <?php
          \$message = \$this->session->flashdata('info');
          echo \$message == '' ? '' : '<div class=\"alert alert-info\">
            <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
            <strong><i class=\"fa fa-exclamation\"></i></strong> ' . \$message . '</div>';
        ?>
					<form class=\"form-horizontal\" action=\"<?php echo \$form_action?>\" method=\"post\" enctype=\"multipart/form-data\">
						<div class=\"panel-heading\">
							<span class=\"panel-title\"><?php echo set_value('slider_title', isset(\$default['slider_title']) ? ucwords(\$default['slider_title']) : ucwords(\$heading)); ?></span>
						</div>
						
						<div class=\"panel-body no-padding-hr\">
		";
		foreach($field as $row)
		{
			$input_type		= $this->form_input_type($row['name'],$row['type'],$row['option']);
		
			$string .="
						<div class=\"form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('".$row['name']."') != '') { echo 'has-error'; } ?>\">
                            <div class=\"row\">
                                <label class=\"col-sm-2 control-label\">".$this->label($row['name'])."</label>
                                <div class=\"col-sm-8\">
                                    ".$input_type."
                                </div>
                            </div>
						</div>      
			";
		}
		$string .="
							<div class=\"panel-footer text-right\">
								<button type=\"submit\" class=\"btn btn-primary\">Submit</button>
								<a href=\"<?php echo base_url()?>".$folder."/".$class_name."\" class=\"btn default\">Cancel</a>
							</div>		
						</div>		
					</form>
				</div> <!-- / #content-wrapper -->
    <div id=\"main-menu-bg\"></div>
</div> <!-- / #main-wrapper -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
    <script type=\"text/javascript\"> window.jQuery || document.write('<script src=\"<?php echo base_url()?>assets/javascripts/jquery.min.js\">'+\"<\"+\"/script>\"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
    <script type=\"text/javascript\"> window.jQuery || document.write('<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js\">'+\"<\"+\"/script>\"); </script>
<![endif]-->

<script src=\"<?php echo base_url()?>assets/javascripts/jquery.transit.js\"></script>

<!-- Pixel Admin's javascripts -->
<script src=\"<?php echo base_url()?>assets/javascripts/bootstrap.min.js\"></script>
<script src=\"<?php echo base_url()?>assets/javascripts/pixel-admin.min.js\"></script>

<script type=\"text/javascript\">
    init.push(function () {
        // Javascript code here
    });
    window.PixelAdmin.start(init);
</script>
		";
		
		if (file_exists("./application/views/".$folder."/" . $class_name."/page_form.php"))
        {
            echo "Folder/File View Telah Ada proses generasi dibatalkan <br>";
        }
		else
		{
			echo "File View Berhasil Dibuat<br>";
			$this->createFile($string, "./application/views/".$folder."/" . $class_name ."/page_form.php");
		}
	}
	
	function createFile($string, $path)
	{
		$create = fopen($path, "w") or die("Unable to open file!");
		fwrite($create, $string);
		fclose($create);
		
		return $path;
	}
	
	function label($str)
	{
		$label = str_replace('_', ' ', $str);
		$label = ucwords($label);
		return $label;
	}
	
	function form_input_type($name,$type,$option="")
	{
		if($type == "text")
		{
			$input_form		= "
				<input type=\"".$type."\" name=\"".$name."\" class=\"form-control\" placeholder=\"".$this->label($name)."\" value=\"<?php echo set_value('".$name."', isset(\$default['".$name."']) ? \$default['".$name."'] : ''); ?>\" required>
                <?php echo form_error('".$name."', '<span class=\"help-block\"><i class=\"fa fa-warning\"></i> ', '</span>'); ?>
			";
		}
		elseif($type == "textarea")
		{
			$input_form		= "
				<textarea type=\"".$type."\" name=\"".$name."\" class=\"form-control\" placeholder=\"".$this->label($name)."\" value=\"\" required><?php echo set_value('".$name."', isset(\$default['".$name."']) ? \$default['".$name."'] : ''); ?></textarea>
                <?php echo form_error('".$name."', '<span class=\"help-block\"><i class=\"fa fa-warning\"></i> ', '</span>'); ?>
			";
		}
		elseif($type == "select")
		{
			$input_form		= "
				<select name=\"".$name."\" class=\"form-control\" required>
					<option value=\"\">-- Pilih ".$name." --</option>";
			
			foreach($option as $opt)
			{
				$input_form .=	"<option value=\"".$opt."\" <?php echo set_value('".$name."', isset(\$default['".$name."']) && \$default['".$name."'] == '".$opt."' ? 'selected' : ''); ?>>".$opt."</option>";
			}
			
			$input_form		.=	"</select>";
		}
		elseif($type == "radio")
		{
			$input_form = "";
		
			foreach($option as $opt)
			{
				$input_form .=	"<div class=\"radio\">
				  <label><input type=\"radio\" name=\"".$name."\" value=\"".$opt."\" <?php echo set_value('".$name."', isset(\$default['".$name."']) && \$default['".$name."'] == '".$opt."' ? 'checked' : ''); ?>>".$opt."</label>
				</div>";
			}
		}
		elseif($type == "foreign")
		{
			$tabel			= $option['tabel'];
			$label			= $option['label'];
			
			$input_form = "<?php
				\$query_tabel	= \$this->db->query(\"select * from ".$tabel."\");
				\$primary_key	= \$this->db->query(\"SHOW KEYS FROM ".$tabel." WHERE Key_name = 'PRIMARY'\")->row();
			?>
				
					<select name=\"".$name."\" class=\"form-control\" required>
						<option value=\"\">-- Pilih ".$name." --</option>
			<?php	
				foreach(\$query_tabel->result_array() as \$opt)
				{
			?>	
					<option value=\"<?php echo \$opt[\$primary_key->Column_name] ?>\" <?php echo set_value('\$opt[".$label."]', isset(\$default['".$name."']) && \$default['".$name."'] == \$opt[\$primary_key->Column_name] ? 'selected' : ''); ?>><?php echo \$opt[\"".$label."\"] ?></option>
			<?php
				}
			?>	
				</select>";
		}
		else
		{
			echo "<br>Terjadi Kesalahan Saat Penentuan Input Type<br>";
		}
		
		return $input_form;
	}
}