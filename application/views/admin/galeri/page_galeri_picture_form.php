<div id="content-wrapper">
        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/galeri')?>"><?php echo ucwords('galeri') ?></a> / </span><?php echo ucwords($heading)?></h1>
        </div> <!-- / .page-header -->
        <div class="row">
            <div class="col-sm-12">
<!-- 5. $SUMMERNOTE_WYSIWYG_EDITOR =================================================================
        Summernote WYSIWYG-editor
-->
        <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
        <?php $this->load->view('admin/script_admin_code_mirror'); ?>
        <!-- Javascript -->
        <script>
            init.push(function () {
                $('#styled-finputs-example').pixelFileInput({ placeholder: 'Picture File Only' });
                $('#loading-example-btn').click(function () {
                    var btn = $(this);
                    btn.button('loading');
                    setTimeout(function () {
                        btn.button('reset');
                    }, 1500);
                });
                $("#character-limit-input").limiter(255, { label: '#character-limit-input-label' });
            });
        </script>
        <!-- / Javascript -->
        <?php $this->load->view('admin/field/message_info'); ?>
        
        <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo set_value('galeri_picture_title', isset($default['galeri_picture_title']) ? ucwords($default['galeri_picture_title']) : ucwords($heading)); ?></span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        <?php if(set_value('galeri_picture_picture', isset($default['galeri_picture_picture']) ? $default['galeri_picture_picture'] : '') != '') : ?>
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('galeri_picture_title') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-md-8">
                                    <img class="img img-responsive" src="<?php echo base_url()?>uploads/galeri/<?php echo $default['galeri_slug'].'/'.set_value('galeri_picture_picture', isset($default['galeri_picture_picture']) ? $default['galeri_picture_picture'] : '3.jpg'); ?>"><br>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('galeri_picture_title') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Caption</label>
                                <div class="col-sm-8">
                                    <textarea id="character-limit-input" required name="galeri_picture_title" class="form-control" placeholder="Nama" ><?php echo set_value('galeri_picture_title', isset($default['galeri_picture_title']) ? $default['galeri_picture_title'] : ''); ?></textarea>
                                    <div id="character-limit-input-label" class="limiter-label form-group-margin">Characters left: <span class="limiter-count"></span></div>
                                    <input type="hidden" name="galeri_id" class="form-control" placeholder="id galeri" value="<?php echo set_value('galeri_id', isset($default['galeri_id']) ? $default['galeri_id'] : ''); ?>">
                                    <input type="hidden" name="galeri_picture_id" class="form-control" placeholder="id subgaleri" value="<?php echo set_value('galeri_picture_id', isset($default['galeri_picture_id']) ? $default['galeri_picture_id'] : ''); ?>">
                                    <?php echo form_error('galeri_picture_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('galeri_picture_type') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Tipe Link</strong></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="galeri_picture_type" id="inlineCheckbox1" value="in" class="px" <?php echo set_radio('galeri_picture_type', 'in', isset($default['galeri_picture_type']) && $default['galeri_picture_type'] == 'in' ? TRUE : FALSE); ?>> <span class="lbl">Tautan Halaman</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="galeri_picture_type" id="inlineCheckbox2" value="out" class="px" <?php echo set_radio('galeri_picture_type', 'out', isset($default['galeri_picture_type']) && $default['galeri_picture_type'] == 'out' ? TRUE : FALSE); ?>> <span class="lbl">Buka Tab Baru</span>
                                    </label>
                                    <?php echo form_error('galeri_picture_type', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('galeri_picture_link') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-5">
                                    <input type="url" name="galeri_picture_link" class="form-control" placeholder="Link" value="<?php echo set_value('galeri_picture_link', isset($default['galeri_picture_link']) ? $default['galeri_picture_link'] : ''); ?>">
                                    <?php echo form_error('galeri_picture_link', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('userfile') != '') { echo 'has-error'; } ?>">
                             <div class="row">
                                <label class="col-sm-2 control-label">Picture</label>
                                <div class="col-sm-4">
                                    <input id="styled-finputs-example" type="file" name="userfile" class="form-control" placeholder="Picture">
                                    <?php echo form_error('userfile', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                                <div class="col-sm-3">
                                    <button  data-toggle="modal" data-target="#myModal" type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-labeled btn-primary <?php if((isset($default['galeri_picture_picture']) ? $default['galeri_picture_picture'] : '') == '' ) : echo 'disabled'; endif; ?>"><!-- <span class="btn-label icon fa fa-camera-retro"></span> --> View Image</button>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="<?php echo site_url()?>admin/galeri"><button class="btn btn-danger" type="button">Back</button></a>
                    </div>
                </form>
                <!-- Modal -->
                <div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h4 class="modal-title" id="myModalLabel">Data Gambar</h4>
                            </div>
                            <div class="modal-body">
                                <img width="100%" src="<?php echo base_url()?>uploads/galeri/<?php echo $default['galeri_slug'].'/'.set_value('galeri_picture_picture', isset($default['galeri_picture_picture']) ? $default['galeri_picture_picture'] : '3.jpg'); ?>">
                            </div> <!-- / .modal-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div> <!-- / .modal-content -->
                    </div> <!-- / .modal-dialog -->
                </div> <!-- /.modal -->
                <!-- / Modal -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <!-- Javascript -->
                <script>
                    init.push(function () {
                        $('#tooltips-demo button').tooltip();
                        $('#tooltips-demo a').tooltip();
                        $('#jq-datatables-example').dataTable();
                        $('#jq-datatables-example_wrapper .table-caption').text('Daftar Gambar');
                        $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
                    });
                </script>
                <!-- / Javascript -->
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo ucwords($heading)?></span>
                    </div>
                    <div class="panel-body">
                        <!-- <a href="<?php echo base_url() ?>admin/galeri_picture/add"><button class="btn btn-labeled btn-success"><span class="btn-label icon fa fa-plus"></span> Add</button></a> -->
                        <!-- <br><br> -->
                        <?php if($galeri_picture_list->num_rows() > 0) : $i=1;?>
                        <div class="table-primary" id="tooltips-demo">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Gambar</th>
                                        <th>Last Update</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($galeri_picture_list->result() as $row) :?>
                                    <tr class="odd gradeX">
                                        <td><?=$i++?></td>
                                        <td>
                                            <img width="200" src="<?php echo base_url()?>uploads/galeri/<?php echo $default['galeri_slug'].'/'.$row->galeri_picture_picture; ?>" class="img img-responsive">
                                            <h4><?php echo ucwords($row->galeri_picture_title)?></h4>
                                        </td>
                                        <td class="center">
                                            <h5><?php echo date('d F Y', strtotime($row->create_date))?><br>
                                            <small>Pukul <?php echo date('H:i:s', strtotime($row->create_date))?> WIB</small></h5>
                                        </td>
                                        <td class="center">
                                            <a href="<?php echo site_url('admin/galeri/update_picture/'.$row->galeri_picture_id)?>"><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk ubah data" class="btn btn-sm  btn-warning"><span class="btn-label icon fa fa-pencil"></span></button></a>&nbsp;&nbsp;
                                            <a href="<?php echo site_url('admin/galeri/delete_picture/'.$row->galeri_picture_id)?>" onclick="return confirm('Anda yakin akan menghapus data ini?')" ><button data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Klik untuk hapus data" class="btn btn-sm  btn-danger"><span class="btn-label icon fa fa-minus-circle"></span></button></a>
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
                
<!-- /5. $SUMMERNOTE_WYSIWYG_EDITOR -->
    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<?php $this->load->view('admin/script_admin_below'); ?>