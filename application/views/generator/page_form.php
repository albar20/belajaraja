<div id="content-wrapper">
        <ul class="breadcrumb breadcrumb-page">
            <div class="breadcrumb-label text-light-gray">You are here: </div>
            <li><a href="#">Home</a></li>
            <li class="active"><a href="#">Dashboard</a></li>
        </ul>
        <div class="page-header">
			<div class="row">
				<div class="col-md-12">
							<?php
							 $message = $this->session->flashdata('warning');
							  echo $message == '' ? '' : '<div class="alert">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong><i class="fa fa-exclamation"></i></strong> ' . $message . '</div>';
							?>
							<?php
							  $message = $this->session->flashdata('danger');
							  echo $message == '' ? '' : '<div class="alert alert-danger">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong><i class="fa fa-times"></i></strong> ' . $message . '</div>';
							?>
							<?php
							 $message = $this->session->flashdata('success');
							  echo $message == '' ? '' : '<div class="alert alert-success">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong><i class="fa fa-check"></i></strong> ' . $message . '</div>';
							?>
							<?php
							  $message = $this->session->flashdata('info');
							  echo $message == '' ? '' : '<div class="alert alert-info">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong><i class="fa fa-exclamation"></i></strong> ' . $message . '</div>';
							?>


							<form class="form-horizontal" action="<?php echo $form_action?>" method="post" enctype="multipart/form-data">
								 <div class="panel-heading">
									<span class="panel-title"><?php echo set_value('slider_title', isset($default['slider_title']) ? ucwords($default['slider_title']) : ucwords($heading)); ?></span>
								</div>
								<div class="panel-body no-padding-hr">
									<input type="hidden" value="<?php echo base_url()?>" id="baseurl">
									<div class="form-group <?php if(form_error('deskripsi_kategori') != '') { echo 'has-error'; } ?>">
										<div class="row">
											<label class="col-sm-2 control-label">Plih Tabel</label>
											<div class="col-sm-8">
												<select name="list_tabel" id="listTabel" class="form-control" onchange="pilihTabel(this.value)" required>
													<option value="">-- Pilih Tabel --</option>
													<?php foreach($daftar_tabel->result() as $row){?>
													<option value="<?php echo $row->TABLE_NAME ?>"><?php echo $row->TABLE_NAME ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
									</div> 
									
									<div class="form-group">
										<div class="row">	
											<label class="col-md-2 control-label">Nama Controller</label>	
											<div class="col-md-8">	
												<input type="text" name="nama_controller" class="form-control" placeholder="Masukkan Nama Controller" required>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="row">	
											<label class="col-md-2 control-label">Akses controller menggunakan otorisasi ?</label>	
											<div class="col-md-8">	
												<label class="radio-inline"><input type="radio" name="otorisasi" onchange="pakaiOtorisasi(this.value)" value="ya">Ya</label>
												<label class="radio-inline"><input type="radio" name="otorisasi" onchange="pakaiOtorisasi(this.value)" value="tidak" checked>Tidak</label>
											</div>
										</div>
										<div class="row code-otorisasi" style="display:none;">	
											<div class="col-md-8 col-md-offset-2">	
												<textarea class="form-control" name="code_otorisasi" id="codeOtorisasi">if($this->session->userdata('login_admin') != true){redirect(base_url());}
											</textarea>
											</div>
										</div>
									</div>

									<div id="listField">
										
									</div>
					
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												<button type="submit" class="btn green">Submit</button>
												<a href="<?php echo base_url()?>utama/kategori" class="btn default">Cancel</a>
											</div>
										</div>
									</div>
									
								</div>		
							</form>
						
				</div>
			</div>
		</div>
	</div>
<div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
	
<script src="<?php echo base_url()?>assets/javascripts/jquery.min.js"></script> 		
<script src="<?php echo base_url()?>assets/javascripts/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/pixel-admin.min.js"></script>

<script type="text/javascript">
    init.push(function () {
        // Javascript code here
    })
    window.PixelAdmin.start(init);
</script>		
		
		<script>
		var urutanValue = 0;
		var baseurl		= $("#baseurl").val();
		var selectedTabel = "";
		
		function pilihTabel(namaTabel)
		{
			$.ajax({
				url: baseurl+"crudgenerator/crudgenerator/pilih_tabel",
				type: "post",
				data: "nama_tabel="+namaTabel,
				beforeSend: function(){
				
				},
				success: function(response){
					$("#listField").html(response);
					selectedTabel = namaTabel;
				}
			});
		}
		
		function pilihType(namaField)
		{
			if($("#fieldTabel"+namaField).val() == 'select' || $("#fieldTabel"+namaField).val() == 'radio')
			{
				console.log("select");
				$("#opsiTambahan"+namaField).html('<div class="row form-group"><div class="col-md-7"><input type="text" id="newSelectValue'+namaField+'" class="form-control" placeholder="Masukkan Pilihan"></div><div class="col-md-5"><a onclick="tambahValue(\''+namaField+'\')" id="buttonTambahValue" type="button" data-loading-text="<i class=\'fa fa-circle-o-notch fa-spin\'></i> Sedang Ditambahkan" class="btn blue">Tambah</a></div></div>');
			}
			else if($("#fieldTabel"+namaField).val() == 'foreign')
			{
				$.ajax({
					url: baseurl+"crudgenerator/crudgenerator/pilih_foreign_key",
					type: "post",
					data: { tabel : selectedTabel, field : namaField },
					success:function(response)
					{
						$("#opsiTambahan"+namaField).html(response);
					}
				});
			}
			else
			{
				$("#opsiTambahan"+namaField).html('');
			}
		}
		
		function tambahValue(namaField)
		{
			if($("#newSelectValue"+namaField).val() == '')
			{
				$("#newSelectValue"+namaField).focus();
			}
			else
			{
				$("#opsiTambahan"+namaField).append('<div class="row form-group" id="optionValue'+urutanValue+'"><div class="col-md-7"><input type="text" name="'+namaField+'[]" class="form-control" value="'+$("#newSelectValue"+namaField).val()+'"></div><div class="col-md-1"><a type="button" onclick="hapusOptionValue(\''+urutanValue+'\')">X</a></div></div>');
			
				$("#newSelectValue"+namaField).val('');
				urutanValue++;
			}	
		}
		
		function hapusOptionValue(idValue)
		{
			$("#optionValue"+idValue).html('');
		}
		
		function hapusField(namaField)
		{
			$("#"+namaField).html('');
		}
		
		function pakaiOtorisasi(value)
		{
			if(value == "ya")
			{
				$(".row .code-otorisasi").fadeIn();
			}
			else
			{
				$(".row .code-otorisasi").fadeOut();
			}
		}
		
		function tipeOtorisasi(value)
		{
			if(value == "default")
			{
				$("#codeOtorisasi").val("if($this->session->userdata('login_admin') != true){ redirect(base_url()); }");
			}
			else
			{
				$("#codeOtorisasi").val("");
			}
		}
		</script>
		
        <!-- END THEME LAYOUT SCRIPTS -->
	