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
                        $('#jq-datatables-example_wrapper .table-caption').text('Daftar product');
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
						<div class="row">
							<div class="col-md-2">
								<a href="<?php echo base_url()?>admin/product/add"><button class="btn btn-labeled btn-success"><span class="btn-label icon fa fa-plus"></span> Add</button></a>
							</div>
							<div class="col-md-6 col-md-offset-4">
							<form action="<?php echo base_url()?>admin/product" method="post">
								<div class="input-group" style="float:right">
								  <span class="input-group-btn">
									<a href="<?php echo base_url()?>admin/product" class="btn btn-info" type="button">Reset Pencarian</a>
									<button class="btn btn-default" type="submit">Search</button>
								  </span>
								  <input type="text" class="form-control" name="searchProduct" placeholder="Masukkan Nama Produk" id="searchProduct">
								</div><!-- /input-group -->
							</form>	
							</div>	
						</div>	
                        <br><br>
					<?php if($product_list->num_rows() > 0) : $i = 1; ?>
					<table class="table table-striped table-bordered table-hover table-checkable order-column">
						<thead>
							<tr>
								<th>No.</th>
        
								<th>Category</th>
			
								<th>Subcategory</th>
			
								<th>Name</th>
			
								<th>Weight</th>
			
								<th>Merk</th>
			
								<th>Price</th>
			
								<th>Description</th>
			
								<th style="min-width: 100px">Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach($product_list->result() as $row) :?>
							<tr class="odd gradeX">
								<td><?php echo $i++?></td>
        
								<td>
									<h4><?php echo ucwords($row->category_product_name)?></h4>
								</td>

								<td>
									<h4><?php echo ucwords($row->subcategory_product_name)?></h4>
								</td>								
			
								<td>
									<h4><?php echo ucwords($row->product_name)?></h4>
								</td>  
			
								<td>
									<h4><?php echo ucwords($row->weight)?></h4>
								</td>  
			
								<td>
									<h4><?php echo ucwords($row->merk_name)?></h4>
								</td>  
			
								<td>
									<h4><?php echo ucwords($row->price)?></h4>
								</td>  
			
								<td>
									<h4><?php echo ucwords($row->description)?></h4>
								</td>  
			
								<td class="center">
									<a href="<?php echo site_url('admin/product/update/'.$row->product_id)?>"><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk ubah data" class="btn btn-sm  btn-warning"><span class="btn-label icon fa fa-pencil"></span></button></a>&nbsp;&nbsp;
									<a href="<?php echo site_url('admin/product/delete/'.$row->product_id)?>" onclick="return confirm('Anda yakin akan menghapus data ini?')" ><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk hapus data" class="btn btn-sm  btn-danger"><span class="btn-label icon fa fa-minus-circle"></span></button></a>
								</td>
							</tr>
						<?php endforeach;?>   
						</tbody>
					</table>					<?php echo $this->pagination->create_links(); ?>
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
		