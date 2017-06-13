<div id="content-wrapper">
		<?php $this->load->view('admin/field/message_info'); ?>
	<div class="page-header">
		<h1><span class="text-light-gray"><a href="<?php echo site_url('admin/product')?>"><?php echo ucwords('product') ?></a> / </span><?php echo ucwords($heading)?></h1>
	</div> <!-- / .page-header -->
	<div class="row">
		<div class="col-md-6">


<!-- 5. $SUMMERNOTE_WYSIWYG_EDITOR =================================================================

        Summernote WYSIWYG-editor
-->
        <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/codemirror/3.20.0/codemirror.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/codemirror/3.20.0/theme/blackboard.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/codemirror/3.20.0/theme/monokai.min.css">
        <script type="text/javascript" src="<?php echo base_url()?>assets/codemirror/3.20.0/codemirror.js"></script>
        <script src="<?php echo base_url()?>assets/codemirror/3.20.0/mode/xml/xml.min.js"></script>
        <script src="<?php echo base_url()?>assets/codemirror/2.36.0/formatting.min.js"></script>

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
                    on_state_content: '<span class="fa fa-check" style="font-size:11px;"></span>',
                    off_state_content: '<span class="fa fa-times" style="font-size:11px;"></span>'
                });
                $('#summernote-boxed').on($('html').hasClass('ie8') ? "propertychange" : "change", function () {
                    var $panel = $(this).parents('.panel');
                    if ($(this).is(':checked')) {
                        $panel.find('.panel-body').addClass('no-padding');
                        $panel.find('.panel-body > *').addClass('no-border');
                    } else {
                        $panel.find('.panel-body').removeClass('no-padding');
                        $panel.find('.panel-body > *').removeClass('no-border');
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

                $("#category_id").select2({
                    allowClear: true,
                    placeholder: "Pilih Kategori"
                });

                $("#subcategory_id").select2({
                    allowClear: true,
                    placeholder: "Pilih Sub Kategori"
                });
            });
        </script>
        <!-- / Javascript -->

					<form class="form-horizontal" action="<?php echo $form_action?>" method="post" enctype="multipart/form-data">
						<div class="panel-heading">
							<span class="panel-title"><?php echo set_value('slider_title', isset($default['slider_title']) ? ucwords($default['slider_title']) : ucwords($heading)); ?></span>
						</div>
						
						<div class="panel-body no-padding-hr">
		
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('category_product_id') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-8">
                
									<select name="category_product_id" class="form-control" onchange="changeCategory(this.value)" required>
										<option value="">-- Pilih category_product_id --</option>
								<?php	
									foreach($query_tabel->result_array() as $opt)
									{
								?>	
										<option value="<?php echo $opt[$primary_key->Column_name] ?>" <?php echo set_value('$opt[name]', isset($default['category_product_id']) && $default['category_product_id'] == $opt[$primary_key->Column_name] ? 'selected' : ''); ?>><?php echo $opt["category_product_name"] ?></option>
								<?php
									}
								?>	
									</select>
                                </div>
                            </div>
						</div>

						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('category_product_id') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-3 control-label">Subcategory</label>
                                <div class="col-sm-8">
                
									<select name="subcategory_product_id" id="subcategoryId" onchange="changeSubcategory(this.value)" class="form-control" required>
										<option value="">-- Pilih subcategory --</option>
										<?php if(isset($default['subcategory_product_id'])){?>
											<option value="<?php echo $default['subcategory_product_id']?>" selected><?php echo $default['subcategory_product_name']?></option>
										<?php } ?>
									</select>
                                </div>
                            </div>
						</div>						
			
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('name') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-8">
                                    
				<input type="text" name="name" class="form-control" placeholder="Name" value="<?php echo set_value('name', isset($default['name']) ? $default['name'] : ''); ?>" required>
                <?php echo form_error('name', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
			
                                </div>
                            </div>
						</div>      
			
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('weight') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-3 control-label">Weight</label>
                                <div class="col-sm-8">
                                    
				<input type="number" name="weight" class="form-control" placeholder="Weight" value="<?php echo set_value('weight', isset($default['weight']) ? $default['weight'] : ''); ?>" required>
                <?php echo form_error('weight', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
			
                                </div>
                            </div>
						</div>      
			
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('stock') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-3 control-label">Stock</label>
                                <div class="col-sm-8">
                                    
				<input type="number" name="stock" class="form-control" placeholder="Stock" value="<?php echo set_value('stock', isset($default['stock']) ? $default['stock'] : ''); ?>" required>
                <?php echo form_error('stock', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
			
                                </div>
                            </div>
						</div>      
			
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('price') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-3 control-label">Price</label>
                                <div class="col-sm-8">
                                    
				<input type="number" name="price" class="form-control" placeholder="Price" value="<?php echo set_value('price', isset($default['price']) ? $default['price'] : ''); ?>" required>
                <?php echo form_error('price', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
			
                                </div>
                            </div>
						</div>      
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('merk') != '') { echo 'has-error'; } ?>">							<div class="row">								<label class="col-sm-3 control-label">Merk</label> 								<div class="col-sm-8">									<input type="text" name="merk" class="form-control" placeholder="Merk" value="<?php echo set_value('merk', isset($default['merk_name']) ? $default['merk_name'] : ''); ?>">									<?php echo form_error('merk', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>								</div>                           							</div>												</div>												<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('pt') != '') { echo 'has-error'; } ?>">							<div class="row"> 								<label class="col-sm-3 control-label">PT</label>								<div class="col-sm-8">									<input type="text" name="pt" class="form-control" placeholder="PT" value="<?php echo set_value('pt', isset($default['vendor_name']) ? $default['vendor_name'] : ''); ?>">									<?php echo form_error('pt', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>								</div>  							</div>						</div>
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('description') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-3 control-label">Description</label>
                                <div class="col-sm-8">
                
				<textarea class="form-control" id="summernote-example" name="description" rows="10"><?php echo set_value('description', isset($default['description']) ? $default['description'] : ''); ?></textarea>
				<?php echo form_error('description', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
						</div>
						
						<div class="row">
							<label class="col-sm-3 control-label">Size</label>
							<div class="col-sm-3">
								<div class="checkbox">
								  <label><input type="checkbox" id="allHuruf">All Size</label>
								</div>
							<?php foreach($size_huruf as $row){ ?>
								<div class="checkbox">
								  <label><input type="checkbox" class="sizeHuruf" name="size[]" id="size" value="<?php echo $row->size_id?>" <?php echo (in_array($row->size_id, $default['size']) ? "checked" : "")?>><?php echo $row->size_name?></label>
								</div>
							<?php } ?>			
							</div>
							<div class="col-sm-3"> 
								<div class="checkbox">
								  <label><input type="checkbox" id="allAngka">All Size</label>
								</div>
								<?php foreach($size_angka as $row){ ?>
								<div class="checkbox">
								  <label><input type="checkbox" class="sizeAngka" name="size2[]" id="size2" value="<?php echo $row->size_id?>" <?php echo (in_array($row->size_id, $default['size']) ? "checked" : "")?>><?php echo $row->size_name?></label>
								</div>
							<?php } ?>	
							</div>
						</div>
						<br/>
						<div id="responseResult">
							<?php if(isset($default['subcategory_product_id']))
								{ 
									

									foreach($list_additional->result() as $row)
									{
									?>
									<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
									<div class="row">
										<label class="col-sm-3 control-label"><?php echo $row->specific_name?></label>
										<div class="col-sm-8">
											
											<input type="text" name="specific<?php echo $row->subcategory_specific_information_id?>" class="form-control" placeholder="<?php echo $row->specific_name?>" value="<?php echo $default['additional'.$row->subcategory_specific_information_id] ?>">
					
										</div>
									</div>
								</div>
							<?php
									}
								}
							?>
						</div>
			
							<div class="panel-footer text-right">
								<button type="submit" class="btn btn-primary">Submit</button>
								<a href="<?php echo base_url()?>admin/product" class="btn default">Cancel</a>
							</div>		
						</div>		
					</form>
			
			</div>
					
			<div class="col-md-6">		
				
			
					<form class="form-horizontal" action="<?php echo base_url()?>admin/product/add_picture/" method="post" enctype="multipart/form-data">
						
						<div class="panel-heading">
							<span class="panel-title">Product Picture</span>
						</div>
						
						<div class="panel-body no-padding-hr">
		
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('name') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-3 control-label">Product Picture</label>
                                <div class="col-sm-8">
                                    
									<input type="file" name="product_picture" class="form-control" placeholder="Name" value="" required>			
                                
								</div>
                            </div>
						</div>  

						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('name') != '') { echo 'has-error'; } ?>">
                            <div class="row">
								<div class="col-sm-12">
						
								<?php if($product_picture->num_rows() > 0) : $i = 1; ?>
								<table class="table table-striped table-bordered table-hover table-checkable order-column" id="jq-datatables-example">
									<thead>
										<tr>
											<th>No.</th>
					
											<th>Picture</th>
						
											<th>Cover Picture</th>
						
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
									<?php foreach($product_picture->result() as $row) :?>
										<tr class="odd gradeX">
											<td><?php echo $i++?></td>
					
											<td>
												<img width="50%" src="<?php echo base_url()?>uploads/product/<?php echo $row->product_id?>/thumb_<?php echo $row->product_picture?>" class="img img-responsive">
											</td>
											<td>
												<?php if($row->picture_highlight == 'yes'){?>
													<button type="button" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk hapus data" class="btn btn-success disabled">Cover Picture</button>
												<?php } else { ?>
													<a href="<?php echo site_url('admin/product/set_cover_picture/'.$row->product_picture_id.'/'.$row->product_id)?>" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk hapus data" class="btn btn-info">Set as Cover</a>
												<?php } ?>
											</td>
											<td class="center">
												<a href="<?php echo site_url('admin/product/delete_picture/'.$row->product_picture_id)?>" onclick="return confirm('Anda yakin akan menghapus data ini?')" ><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk hapus data" class="btn btn-sm  btn-danger"><span class="btn-label icon fa fa-minus-circle">Delete</span></button></a>
											</td>
										</tr>
									<?php endforeach;?>   
									</tbody>
								</table>
								<?php else :?>

								<div class="alert">
									<button type="button" class="close" data-dismiss="alert">×</button>
									<strong>Warning!</strong> Data tidak ada
								</div>

								<?php endif;?>
								</div>
							</div>	
								
								
			
							<div class="panel-footer text-right">
								<button type="submit" class="btn btn-primary">Submit</button>
								<a href="<?php echo base_url()?>admin/product" class="btn default">Cancel</a>
							</div>		
						</div>		
					</form>
				</div>
			</div>	
			
			</div>	
		</div>

    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
    <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url()?>assets/general/js/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
    <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->
<script src="<?php echo base_url()?>assets/general/js/jquery.transit.js"></script>
<!-- Pixel Admin's javascripts -->
<script src="<?php echo base_url()?>assets/general/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/pixel-admin.min.js"></script>

<script type="text/javascript">
    var baseurl		= "<?php echo base_url()?>";
	function changeSubcategory(id)
	{
		$.ajax({
			url	: baseurl+"admin/product/get_additional_info",
			type: "post",
			data: { subcategoryId : id },
			success:function(response)
			{
				$("#responseResult").html(response);
			}
		});
	}
	
	function changeCategory(id)
	{
		$.ajax({
			url	: baseurl+"admin/product/get_subcategory",
			type: "post",
			data: { categoryId : id },
			success:function(response)
			{
				$("#subcategoryId").html(response);
			}
		});
	}
	
	init.push(function () {
        // Javascript code here
		$("#allHuruf").change(function(){  //"select all" change
			var status = this.checked; // "select all" checked status
			$('.sizeHuruf').each(function(){ //iterate all listed checkbox items
				this.checked = status; //change ".checkbox" checked status
			});
		});
		
		$("#allAngka").change(function(){  //"select all" change
			var status = this.checked; // "select all" checked status
			$('.sizeAngka').each(function(){ //iterate all listed checkbox items
				this.checked = status; //change ".checkbox" checked status
			});
		});
    });
    window.PixelAdmin.start(init);
</script>
		