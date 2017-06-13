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
                        $('#jq-datatables-example_wrapper .table-caption').text('Daftar Kategori');
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
                        <a href="<?php echo site_url('admin/video_category/add') ?>"><button class="btn btn-labeled btn-success"><span class="btn-label icon fa fa-plus"></span> Add</button></a>
                        <br><br>
                        <?php if($video_category_list->num_rows() > 0) : $i=1;?>
                        <div class="table-primary" id="tooltips-demo">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama video_category</th>
                                        <th>Last Update</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($video_category_list->result() as $row) :?>
                                    <tr class="odd gradeX">
                                        <td><?=$i++?></td>
                                        <td>
                                            <h4><?php echo ucwords($row->video_category_title)?></h4>
                                        </td>
                                        <td class="center">
                                            <h5><?php echo date('d F Y', strtotime($row->create_date))?><br>
                                            <small>Pukul <?php echo date('H:i:s', strtotime($row->create_date))?> WIB</small></h5>
                                        </td>
                                        <td class="center">
                                            <a href="<?php echo site_url('admin/video_category/update/'.$row->video_category_id) ?>"><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk ubah data" class="btn btn-sm  btn-warning"><span class="btn-label icon fa fa-pencil"></span></button></a>&nbsp;&nbsp;
                                            <a href="<?php echo site_url('admin/video_category/delete/'.$row->video_category_id) ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')" ><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk hapus data" class="btn btn-sm  btn-danger"><span class="btn-label icon fa fa-minus-circle"></span></button></a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>   
                                </tbody>
                            </table>
                        </div>
                        <?php else :?>
                            <div class="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Warning!</strong> Data tidak ada</div>
                        <?php endif;?>
                    </div>
                </div>
<!-- /11. $JQUERY_DATA_TABLES -->
            </div>
        </div>
    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<?php $this->load->view('admin/script_admin_below'); ?>