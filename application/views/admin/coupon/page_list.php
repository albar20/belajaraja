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
                        $('#jq-datatables-example_wrapper .table-caption').text('Coupon List');
                        $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
                    });
                </script>
                <!-- / Javascript -->

                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo ucwords($heading)?></span>
                    </div>
                    <div class="panel-body">
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
						
						 <a href="<?php echo base_url()?>admin/coupon/add"><button class="btn btn-labeled btn-success"><span class="btn-label icon fa fa-plus"></span> Add</button></a>
                        <br><br>
					<?php if($coupon_master_list->num_rows() > 0) : $i = 1; ?>
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="jq-datatables-example">
						<thead>
							<tr>
								<th>No.</th>
        
								<th>Coupon Code</th>
			
								<th>Coupon Type</th>
			
								<th>Coupon Percentage</th>
			
								<th>Coupon Amount</th>
			
								<th>Coupon Start Date</th>
			
								<th>Coupon End Date</th>
			
								<th>Use Coupon</th>
			
								<th>Use Customer</th>
			
								<th>Coupon Status</th>
			
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($coupon_master_list->result() as $row) :?>
							<tr class="odd gradeX">
								<td><?php echo $i++?></td>
        
								<td>
									<h4><?php echo ucwords($row->coupon_code)?></h4>
								</td>  
			
								<td>
									<h4><?php echo ucwords($row->coupon_type)?></h4>
								</td>  
			
								<td>
									<h4><?php echo ucwords($row->coupon_percentage)?>%</h4>
								</td>  
			
								<td>
									<h4>Rp.<?php echo ucwords($row->coupon_amount)?></h4>
								</td>  
			
								<td>
									<h4><?php echo date("d F Y", strtotime($row->coupon_start_date))?></h4>
								</td>  
			
								<td>
									<h4><?php echo date("d F Y", strtotime($row->coupon_end_date))?></h4>
								</td>  
			
								<td>
									<h4><?php echo ucwords($row->use_coupon)?></h4>
								</td>  
			
								<td>
									<h4><?php echo ucwords($row->use_customer)?></h4>
								</td>  
			
								<td>
									<h4><?php echo ucwords($row->coupon_status)?></h4>
								</td>  
			
								<td class="center">
									<a href="<?php echo site_url('admin/coupon/update/'.$row->coupon_master_id)?>"><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk ubah data" class="btn btn-sm  btn-warning"><span class="btn-label icon fa fa-pencil"></span></button></a>&nbsp;&nbsp;
									<a href="<?php echo site_url('admin/coupon/delete/'.$row->coupon_master_id)?>" onclick="return confirm('Anda yakin akan menghapus data ini?')" ><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk hapus data" class="btn btn-sm  btn-danger"><span class="btn-label icon fa fa-minus-circle"></span></button></a>
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

            </div>
        </div>

    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<?php $this->load->view('admin/script_admin_below'); ?>
		