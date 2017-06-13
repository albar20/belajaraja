<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/page'); ?>"><?php echo ucwords('page') ?></a> / </span><?php echo ucwords($heading)?></h1>
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


            });
        </script>
        <!-- / Javascript -->


        <?php $this->load->view('admin/field/message_info'); ?>
        <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo set_value('page_title', isset($default['page_title']) ? ucwords($default['page_title']) : ucwords($heading)); ?></span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('page_title') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Nama page</label>
                                <div class="col-sm-8">
                                    <input type="text" required name="page_title" class="form-control" placeholder="Nama" value="<?php echo set_value('page_title', isset($default['page_title']) ? $default['page_title'] : ''); ?>">
                                    <input type="hidden" name="page_id" class="form-control" placeholder="id page" value="<?php echo set_value('page_id', isset($default['page_id']) ? $default['page_id'] : ''); ?>">
                                    <?php echo form_error('page_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('page_subtitle') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Subtitle page</label>
                                <div class="col-sm-8">
                                    <input type="text" name="page_subtitle" class="form-control" placeholder="subtitle" value="<?php echo set_value('page_subtitle', isset($default['page_subtitle']) ? $default['page_subtitle'] : ''); ?>">                                    
                                    <?php echo form_error('page_subtitle', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('page_date') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Tanggal</label>
                                <div class="col-sm-3">
                                    <div class="input-group date" id="bs-datepicker-component">
                                        <input required type="text" name="page_date" class="form-control" placeholder="tanggal" value="<?php echo set_value('page_date', isset($default['page_date']) ? $default['page_date'] : ''); ?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <?php echo form_error('page_date', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                        -->

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('userfile') != '') { echo 'has-error'; } ?>">
                             <div class="row">
                                <label class="col-sm-2 control-label">Picture</label>
                                <div class="col-sm-4">
                                    <input id="styled-finputs-example" type="file" name="userfile" class="form-control" placeholder="Picture" >
                                    <?php echo form_error('userfile', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                                <div class="col-sm-3">
                                    <button  data-toggle="modal" data-target="#myModal" type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-labeled btn-primary <?php if((isset($default['page_picture']) ? $default['page_picture'] : '') == '' ) : echo 'disabled'; endif; ?>"><!-- <span class="btn-label icon fa fa-camera-retro"></span> --> View Image</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('page_description') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="summernote-example" name="page_description" rows="10"><?php echo set_value('page_description', isset($default['page_description']) ? $default['page_description'] : ''); ?></textarea>
                                    <?php echo form_error('page_description', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>


                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('page_type') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Gunakan Halaman View ?</strong></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="page_type" id="inlineCheckbox1" value="in" class="px" <?php echo set_radio('page_type', 'in', isset($default['page_type']) && $default['page_type'] == 'in' ? TRUE : FALSE); ?>> <span class="lbl">Tidak, menggunakan deskripsi</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="page_type" id="inlineCheckbox2" value="out" class="px" <?php echo set_radio('page_type', 'out', isset($default['page_type']) && $default['page_type'] == 'out' ? TRUE : FALSE); ?>> <span class="lbl">Ya</span>
                                    </label>
                                    <?php echo form_error('page_type', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                       
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('page_link') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Halaman View</label>
                                <div class="col-sm-5">
                                    <input type="text" name="page_link" class="form-control" placeholder="Link" value="<?php echo set_value('page_link', isset($default['page_link']) ? $default['page_link'] : ''); ?>">
                                    <?php echo form_error('page_link', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div> 

                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <!--<a href="<?php echo base_url()?>page"><button class="btn btn-danger" type="button">Back</button></a>-->
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
                                <img width="100%" src="<?php echo base_url()?>uploads/page/<?php echo set_value('page_picture', isset($default['page_picture']) ? $default['page_picture'] : '3.jpg'); ?>">
                            </div> <!-- / .modal-body -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div> <!-- / .modal-content -->
                    </div> <!-- / .modal-dialog -->
                </div> <!-- /.modal -->
                <!-- / Modal -->


<!-- /5. $SUMMERNOTE_WYSIWYG_EDITOR -->


    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<?php $this->load->view('admin/script_admin_below'); ?>