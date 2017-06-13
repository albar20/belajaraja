<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/product_subcategory')?>"><?php echo ucwords('Product Subcategory') ?></a> / </span><?php echo ucwords($heading)?></h1>
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
                                <label class="col-sm-2 control-label">Category Product Id</label>
                                <div class="col-sm-8">
                                    <?php
				$query_tabel	= $this->db->query("select * from category_product");
				$primary_key	= $this->db->query("SHOW KEYS FROM category_product WHERE Key_name = 'PRIMARY'")->row();
			?>
				
					<select name="category_product_id" class="form-control" required>
						<option value="">-- Pilih category_product_id --</option>
			<?php	
				foreach($query_tabel->result_array() as $opt)
				{
			?>	
					<option value="<?php echo $opt[$primary_key->Column_name] ?>" <?php echo set_value('$opt[category_product_name]', isset($default['category_product_id']) && $default['category_product_id'] == $opt[$primary_key->Column_name] ? 'selected' : ''); ?>><?php echo $opt["category_product_name"] ?></option>
			<?php
				}
			?>	
				</select>
                                </div>
                            </div>
						</div>      
			
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('subcategory_product_name') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Subcategory Product Name</label>
                                <div class="col-sm-8">
                                    
				<input type="text" name="subcategory_product_name" class="form-control" placeholder="Subcategory Product Name" value="<?php echo set_value('subcategory_product_name', isset($default['subcategory_product_name']) ? $default['subcategory_product_name'] : ''); ?>" required>
                <?php echo form_error('subcategory_product_name', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
			
                                </div>
                            </div>
						</div>      
			
							<div class="panel-footer text-right">
								<button type="submit" class="btn btn-primary">Submit</button>
								<a href="<?php echo base_url()?>admin/product_subcategory" class="btn default">Cancel</a>
							</div>		
						</div>		
					</form>
				</div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<?php $this->load->view('admin/script_admin_below'); ?>
		