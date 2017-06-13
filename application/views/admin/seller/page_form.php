<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/slider')?>"><?php echo ucwords('slider') ?></a> / </span><?php echo ucwords($heading)?></h1>
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
		
							<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('shop_location') != '') { echo 'has-error'; } ?>">
								<div class="row">
									<label class="col-sm-2 control-label">Your Province</label>
									<div class="col-sm-8">
										<select class="form-control" name="province" onclick="getCity(this.value)" required>

											<option value="">- Choose Province -</option>
											<?php 
											$province_user		= (empty($city) ? 0 : $city['province_id']);
											foreach($province as $row){?>
											<option value="<?php echo $row['province_id']?>" <?php echo ($row['province_id'] == $province_user ? "selected" : "")?>><?php echo $row['province']?></option>	
											<?php } ?>

										</select>
									</div>
								</div>
							</div>

							<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('shop_location') != '') { echo 'has-error'; } ?>">
								<div class="row">
									<label class="col-sm-2 control-label">Your City</label>
									<div class="col-sm-8">
										<select class="form-control" name="city" id="listCity" required>
											<option value="">- Choose City -</option>
											<?php if($city != ""){ ?>
											<option value="<?php echo $city['city_id']?>" selected><?php echo $city['city_name']?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							
							<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('shop_location') != '') { echo 'has-error'; } ?>">
								<div class="row">
									<label class="col-sm-2 control-label">Select Courier</label>
									<div class="col-sm-8">
										<?php foreach($courier->result() as $row){ ?>
											<label class="checkbox-inline"><input type="checkbox" name="courier[]" value="<?php echo $row->courier_id?>" <?php echo ($row->status == 1 ? "checked" : "")?>><?php echo $row->courier_name?></label>
										<?php } ?>
									</div>
								</div>
							</div>
			
							<div class="panel-footer text-right">
								<button type="submit" class="btn btn-primary">Submit</button>
								
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
<script src="<?php echo base_url()?>assets/general/js/jquery.transit.js"></script>
<!-- Pixel Admin's javascripts -->
<script src="<?php echo base_url()?>assets/general/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/pixel-admin.min.js"></script>

<script type="text/javascript">
    var baseurl		= "<?php echo base_url()?>";
	
	function getCity(provinceId)
	{
		$.ajax({
			url			: baseurl+"cart/get_city",
			type		: "post",
			data		: { province_id : provinceId },
			success		: function(response)
			{
				$("#listCity").html(response);
			}
		});
	}
	
	init.push(function () {
        // Javascript code here
    });
    window.PixelAdmin.start(init);
</script>
		