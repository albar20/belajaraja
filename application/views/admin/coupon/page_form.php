<div id="content-wrapper">        
	<div class="page-header">            
		<h1><span class="text-light-gray"><a href="<?php echo site_url('admin/coupon')?>"><?php echo ucwords('coupon') ?></a> / </span><?php echo ucwords($heading)?></h1>
	</div> 
	<!-- / .page-header -->
	<!-- 5. $SUMMERNOTE_WYSIWYG_EDITOR =================================================================        Summernote WYSIWYG-editor-->
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
			$('.bs-datepicker-component').datepicker( "option", "dateFormat", 'yy-mm-dd' );
			$("#category_id").select2({
				allowClear: true,
				placeholder: "Pilih Kategori"
			});
			$("#subcategory_id").select2({
				allowClear: true,
				placeholder: "Pilih Sub Kategori"
			});
		});
		
		function pilihSubcategory(kategori)
		{				
			$.ajax({
				url 	: "<?php echo base_url()?>admin/coupon/get_subcategory",
				type	: "POST",
				data	: { kategori : kategori },
				success : function(response)
				{
					$("#subcategoryId").html(response);
				}
			});
		}
		function pilihProduct(subkategori)
		{
			$.ajax({
			url 	: "<?php echo base_url()?>admin/coupon/get_product",
			type	: "POST",
			data	: { subkategori : subkategori },
			success : function(response)
			{
				$("#listProduct").html(response);
			}
			});	
		}
</script> 
																<!-- / Javascript -->
<?php $this->load->view('admin/field/message_info'); ?>
<form class="form-horizontal" action="<?php echo $form_action?>" method="post" enctype="multipart/form-data">
	<div class="panel-heading">
		<span class="panel-title"><?php echo set_value('slider_title', isset($default['slider_title']) ? ucwords($default['slider_title']) : ucwords($heading)); ?></span>
	</div>
	<div class="panel-body no-padding-hr">
		<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('coupon_code') != '') { echo 'has-error'; } ?>">
			<div class="row">
				<label class="col-sm-2 control-label">Coupon Code</label>
				<div class="col-sm-9">
				<input type="text" name="coupon_code" class="form-control" placeholder="Coupon Code" value="<?php echo set_value('coupon_code', isset($default['coupon_code']) ? $default['coupon_code'] : ''); ?>" required>
                <?php echo form_error('coupon_code', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
				</div>
			</div>
		</div>
		<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('coupon_type') != '') { echo 'has-error'; } ?>">
			<div class="row">
				<label class="col-sm-2 control-label">Coupon Type</label>
				<div class="col-sm-9">
					<div class="radio">
						<label><input type="radio" name="coupon_type" value="percentage" <?php echo set_value('coupon_type', isset($default['coupon_type']) && $default['coupon_type'] == 'percentage' ? 'checked' : ''); ?>>percentage</label>
					</div>
					<div class="radio">
					<label><input type="radio" name="coupon_type" value="amount" <?php echo set_value('coupon_type', isset($default['coupon_type']) && $default['coupon_type'] == 'amount' ? 'checked' : ''); ?>>amount</label>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('coupon_percentage') != '') { echo 'has-error'; } ?>">
			<div class="row">
				<label class="col-sm-2 control-label">Coupon Percentage</label>
				<div class="col-sm-9">
					<input type="number" name="coupon_percentage" class="form-control" placeholder="Coupon Percentage" value="<?php echo set_value('coupon_percentage', isset($default['coupon_percentage']) ? $default['coupon_percentage'] : ''); ?>" required>
					<?php echo form_error('coupon_percentage', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
				</div>
			</div>
		</div>
		<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('coupon_amount') != '') { echo 'has-error'; } ?>">
			<div class="row">
				<label class="col-sm-2 control-label">Coupon Amount</label>
				<div class="col-sm-9">
					<input type="number" name="coupon_amount" class="form-control" placeholder="Coupon Amount" value="<?php echo set_value('coupon_amount', isset($default['coupon_amount']) ? $default['coupon_amount'] : ''); ?>" required>
					<?php echo form_error('coupon_amount', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
				</div>
			</div>
		</div>
		<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('coupon_start_date') != '') { echo 'has-error'; } ?>">
			<div class="row">
				<label class="col-sm-2 control-label">Coupon Start Date</label>
				<div class="col-sm-9">
					<input type="text" name="coupon_start_date" class="form-control bs-datepicker-component" placeholder="Coupon Start Date" value="<?php echo set_value('coupon_start_date', isset($default['coupon_start_date']) ? $default['coupon_start_date'] : ''); ?>" required>                <?php echo form_error('coupon_start_date', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
				</div>
			</div>
		</div>
		<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('coupon_end_date') != '') { echo 'has-error'; } ?>">
			<div class="row">
				<label class="col-sm-2 control-label">Coupon End Date</label>
				<div class="col-sm-9">
					<input type="text" name="coupon_end_date" class="form-control bs-datepicker-component" placeholder="Coupon End Date" value="<?php echo set_value('coupon_end_date', isset($default['coupon_end_date']) ? $default['coupon_end_date'] : ''); ?>" required>
					<?php echo form_error('coupon_end_date', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
				</div>
			</div>
		</div>
		<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('use_coupon') != '') { echo 'has-error'; } ?>">  
			<div class="row"> 
				<label class="col-sm-2 control-label">Use Coupon</label>
				<div class="col-sm-9">
					<input type="number" name="use_coupon" class="form-control" placeholder="Use Coupon" value="<?php echo set_value('use_coupon', isset($default['use_coupon']) ? $default['use_coupon'] : ''); ?>" required>
                <?php echo form_error('use_coupon', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>		
				</div>
			</div>
		</div>
		<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('use_customer') != '') { echo 'has-error'; } ?>">
			<div class="row">
				<label class="col-sm-2 control-label">Use Customer</label>
					<div class="col-sm-9">
						<input type="number" name="use_customer" class="form-control" placeholder="Use Customer" value="<?php echo set_value('use_customer', isset($default['use_customer']) ? $default['use_customer'] : ''); ?>" required>
						<?php echo form_error('use_customer', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
					</div>
			</div>
		</div>
		<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('coupon_status') != '') { echo 'has-error'; } ?>">
		<div class="row">
		<label class="col-sm-2 control-label">Coupon Status</label>
		<div class="col-sm-9">
		<select name="coupon_status" class="form-control" required>
		<option value="">-- Pilih coupon_status --</option><option value="active" <?php echo set_value('coupon_status', isset($default['coupon_status']) && $default['coupon_status'] == 'active' ? 'selected' : ''); ?>>active</option><option value="none" <?php echo set_value('coupon_status', isset($default['coupon_status']) && $default['coupon_status'] == 'none' ? 'selected' : ''); ?>>none</option></select>
		</div>
		</div>
		</div>
		<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('category_product') != '') { echo 'has-error'; } ?>">
		<div class="row">
		<label class="col-sm-2 control-label">Choose Product</label>
		<div class="col-sm-3">
		<select name="category_product" class="form-control" onchange="pilihSubcategory(this.value)">
		<option value="">-- Choose Category --</option>
		<?php foreach($category_product->result() as $row){?>
		<option value="<?php echo $row->category_product_id?>" <?php echo (isset($default['category_id']) && $default['category_id'] == $row->category_product_id ? 'selected' : '')?>><?php echo $row->category_product_name?></option>
		<?php } ?>	
		</select>
		</div>
		<div class="col-sm-3">
		<select name="subcategory_product" id="subcategoryId" class="form-control" onchange="pilihProduct(this.value)">
		<option value="">-- Choose Subcategory --</option>
		<?php if(isset($default['subcategory_id'])){?>
		<option value="<?php echo $default['subcategory_id']?>" selected><?php echo $default['subcategory_name']?></option>
		<?php } ?>
		</select>
		</div>
		<div class="col-sm-3">
		<select name="product_id" class="form-control" id="listProduct" required>
		<option value="">-- Choose Product --</option>
		<?php if(isset($default['product_id'])){?>
		<option value="<?php echo $default['product_id']?>" selected><?php echo $default['product_name']?></option>
		<?php } ?>
		</select>
		</div>
		</div>
		</div>
		<div class="panel-footer text-right">
		<button type="submit" class="btn btn-primary">Submit</button>
		<a href="<?php echo base_url()?>admin/coupon" class="btn default">Cancel</a>
		</div>
		</div>
		</form>
		</div>
		<!-- / #content-wrapper -->
		<div id="main-menu-bg"></div></div> <!-- / #main-wrapper --><!-- Get jQuery from Google CDN --><!--[if !IE]> -->
		<?php $this->load->view('admin/script_admin_below'); ?>