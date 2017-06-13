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
                        $('#jq-datatables-example_wrapper .table-caption').text('Daftar Category Specific Information');
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
						
						 <a href="<?php echo base_url()?>admin/additional_info/add"><button class="btn btn-labeled btn-success"><span class="btn-label icon fa fa-plus"></span> Add</button></a>
                        <br><br>
					<?php if($category_specific_information_list->num_rows() > 0) : $i = 1; ?>
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="jq-datatables-example">
						<thead>
							<tr>
								<th>No.</th>
        
								<th>Category</th>
			
								<th>Subcategory</th>
			
								<th>Specific Name</th>
			
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($category_specific_information_list->result() as $row) :?>
							<tr class="odd gradeX">
								<td><?php echo $i++?></td>
        
								<td>
									<h4><?php echo ucwords($row->category_product_name)?></h4>
								</td>
		
								<td>
									<h4><?php echo ucwords($row->subcategory_product_name)?></h4>
								</td>  
			
								<td>
									<h4><?php echo ucwords($row->specific_name)?></h4>
								</td>  
			
								<td class="center">
									<a href="<?php echo site_url('admin/additional_info/update/'.$row->subcategory_specific_information_id)?>"><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk ubah data" class="btn btn-sm  btn-warning"><span class="btn-label icon fa fa-pencil"></span></button></a>&nbsp;&nbsp;
									<a href="<?php echo site_url('admin/additional_info/delete/'.$row->subcategory_specific_information_id)?>" onclick="return confirm('Anda yakin akan menghapus data ini?')" ><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk hapus data" class="btn btn-sm  btn-danger"><span class="btn-label icon fa fa-minus-circle"></span></button></a>
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
		