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



                        <a href="<?php echo base_url() ?>admin/user_admin/add"><button class="btn btn-labeled btn-success"><span class="btn-label icon fa fa-plus"></span> Add</button></a>

                        <br><br>

                        <?php if($user_list->num_rows() > 0) : $i=1;?>

                        <div class="table-primary" id="tooltips-demo">

                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">

                                <thead>

                                    <tr>

                                        <th>No.</th>

                                        <th>Nama user</th>

                                        <th>Last Update</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                <?php foreach($user_list->result() as $row) :?>

                                    <tr class="odd gradeX">

                                        <td><?=$i++?></td>

                                        <td>

                                            <h4><?php echo ucwords($row->user_name)?></h4>

                                        </td>

                                        <td class="center">

                                            <h5><?php echo date('d F Y', strtotime($row->create_date))?><br>

                                            <small>Pukul <?php echo date('H:i:s', strtotime($row->create_date))?> WIB</small></h5>

                                        </td>

                                        <td class="center">

                                            <a href="<?php echo base_url() ?>admin/user_admin/update/<?php echo $row->user_id?>"><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk ubah data" class="btn btn-sm  btn-warning"><span class="btn-label icon fa fa-pencil"></span></button></a>&nbsp;&nbsp;

                                            <a href="<?php echo base_url() ?>admin/user_admin/delete/<?php echo $row->user_id?>" onclick="return confirm('Anda yakin akan menghapus data ini?')" ><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk hapus data" class="btn btn-sm  btn-danger"><span class="btn-label icon fa fa-minus-circle"></span></button></a>

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



<!-- Get jQuery from Google CDN -->

<!--[if !IE]> -->

    <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url()?>assets/javascripts/jquery.min.js">'+"<"+"/script>"); </script>

<!-- <![endif]-->

<!--[if lte IE 9]>

    <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>

<![endif]-->



<script src="<?php echo base_url()?>assets/javascripts/jquery.transit.js"></script>



<!-- Pixel Admin's javascripts -->

<script src="<?php echo base_url()?>assets/javascripts/bootstrap.min.js"></script>

<script src="<?php echo base_url()?>assets/javascripts/pixel-admin.min.js"></script>



<script type="text/javascript">

    init.push(function () {

        // Javascript code here

    });

    window.PixelAdmin.start(init);

</script>