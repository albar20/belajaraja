<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/additional_info')?>"><?php echo ucwords('additional info') ?></a> / </span><?php echo ucwords($heading)?></h1>
        </div> <!-- / .page-header -->


<!-- 5. $SUMMERNOTE_WYSIWYG_EDITOR =================================================================

        Summernote WYSIWYG-editor
-->
        <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
        <?php $this->load->view('admin/script_admin_code_mirror'); ?>

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
        <?php $this->load->view('admin/field/message_info'); ?>
					<form class="form-horizontal" action="<?php echo $form_action?>" method="post" enctype="multipart/form-data">
						<div class="panel-heading">
							<span class="panel-title"><?php echo set_value('slider_title', isset($default['slider_title']) ? ucwords($default['slider_title']) : ucwords($heading)); ?></span>
						</div>
						
						<div class="panel-body no-padding-hr">
		
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('category_product_id') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Category</label>
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
                                <label class="col-sm-2 control-label">Subcategory</label>
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
			
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('specific_name') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Specific Name</label>
                                <div class="col-sm-8">
                                    
				<input type="text" name="specific_name" class="form-control" placeholder="Specific Name" value="<?php echo set_value('specific_name', isset($default['specific_name']) ? $default['specific_name'] : ''); ?>" required>
                <?php echo form_error('specific_name', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
			
                                </div>
                            </div>
						</div>      
			
							<div class="panel-footer text-right">
								<button type="submit" class="btn btn-primary">Submit</button>
								<a href="<?php echo base_url()?>admin/additional_info" class="btn default">Cancel</a>
							</div>		
						</div>		
					</form>
				</div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
    <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url()?>assets/general/js/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
    <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->
<script src="<?php echo base_url()?>assets/javascripts/jquery.transit.js"></script>
<!-- Pixel Admin's javascripts -->
<script src="<?php echo base_url()?>assets/general/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/pixel-admin.min.js"></script>


<script type="text/javascript">
    var baseurl		= "<?php echo base_url()?>";
	
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
    });
    window.PixelAdmin.start(init);
</script>