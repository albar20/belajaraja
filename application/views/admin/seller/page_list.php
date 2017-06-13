<div id="content-wrapper">

        <div class="page-header">
            <h1><?php echo strtoupper($heading)?></h1>
        </div> <!-- / .page-header -->

        <div class="row">
            <div class="col-sm-12">

                <!-- Javascript -->
                <script>
                    init.push(function () {
                        $('#tooltips-demo button').tooltip();
                        $('#tooltips-demo a').tooltip();

                        $('#jq-datatables-example').dataTable();
                        $('#jq-datatables-example_wrapper .table-caption').text('Daftar setting');
                        $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
                    });
                </script>
                <!-- / Javascript -->

                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo ucwords($heading)?></span>
                    </div>
                    <div class="panel-body">
                        <?php $this->load->view('admin/field/message_info'); ?>
						
                        <br><br>
					<?php if($setting_list->num_rows() > 0) : $i = 1; ?>
					<form class="form-horizontal">
						
						<div class="panel-body no-padding-hr">
		
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('shop_location') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Shop Location</label>
                                <div class="col-sm-8">
                                    <?php echo $city['province']?>, <?php echo $city['city_name']?>
                                </div>
                            </div>
						</div>

						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('shop_location') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Courier Available</label>
                                <div class="col-sm-8">
                                   <?php if($courier->num_rows() == 0){?>
										Not Set Yet
								   <?php } else { 
									foreach($courier->result() as $row){
								   ?>
										- <?php echo $row->courier_name?><br>
								   <?php 
										}
								   } ?>
                                </div>
                            </div>
						</div>
			
							<div class="panel-footer text-right">
								<a type="button" class="btn btn-primary" href="<?php echo base_url()?>admin/seller/update/<?php echo $setting_list->row()->setting_id?>">Ubah</a>
							</div>		
						</div>		
					</form>
					<?php else :?>

					<div class="alert">
						<button type="button" class="close" data-dismiss="alert">×</button>
						<strong>Warning!</strong> Data tidak ada
					</div>

					<?php endif;?>
				 </div>
                </div>

            </div>
        </div>

    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<?php $this->load->view('admin/script_admin_below'); ?>
		