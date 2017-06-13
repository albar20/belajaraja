<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/banner')?>"><?php echo ucwords('banner') ?></a> / </span><?php echo ucwords($heading)?></h1>
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

                 // Single select
                $("#category_id").select2({
                    allowClear: true,
                    placeholder: "Pilih Kategori"
                });

                // Single select
                $("#subcategory_id").select2({
                    allowClear: true,
                    placeholder: "Pilih Sub Kategori"
                });
            });
        </script>
        <!-- / Javascript -->
        <?php $this->load->view('admin/field/message_info'); ?>
        <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo set_value('banner_title', isset($default['banner_title']) ? ucwords($default['banner_title']) : ucwords($heading)); ?></span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('banner_title') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Nama banner</label>
                                <div class="col-sm-8">
                                    <input type="text" name="banner_title" class="form-control" placeholder="Nama" value="<?php echo set_value('banner_title', isset($default['banner_title']) ? $default['banner_title'] : ''); ?>">
                                    <input type="hidden" name="banner_id" class="form-control" placeholder="id banner" value="<?php echo set_value('banner_id', isset($default['banner_id']) ? $default['banner_id'] : ''); ?>">
                                    <?php echo form_error('banner_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('banner_description') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Subtitle</label>
                                <div class="col-sm-8">
                                    <input type="text" name="banner_description" class="form-control" placeholder="subtitle" value="<?php echo set_value('banner_description', isset($default['banner_description']) ? $default['banner_description'] : ''); ?>">
                                    <?php echo form_error('banner_description', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('banner_link') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Banner Link</label>
                                <div class="col-sm-8">
                                    <input type="text" name="banner_link" class="form-control" placeholder="Banner Link" value="<?php echo set_value('banner_link', isset($default['banner_link']) ? $default['banner_link'] : ''); ?>">
                                    <?php echo form_error('banner_link', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('banner_type') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label"><strong>Sembunyikan Caption?</strong></label>

                                <div class="col-sm-10">

                                    <label class="radio-inline">

                                        <input type="radio" name="banner_type" id="inlineCheckbox1" value="in" class="px" <?php echo set_radio('banner_type', 'in', isset($default['banner_type']) && $default['banner_type'] == 'in' ? TRUE : FALSE); ?>> <span class="lbl">Tidak</span>

                                    </label>

                                    <label class="radio-inline">

                                        <input type="radio" name="banner_type" id="inlineCheckbox2" value="out" class="px" <?php echo set_radio('banner_type', 'out', isset($default['banner_type']) && $default['banner_type'] == 'out' ? TRUE : FALSE); ?>> <span class="lbl">Ya</span>

                                    </label>

                                    <?php echo form_error('banner_type', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('userfile') != '') { echo 'has-error'; } ?>">
                             <div class="row">
                                <label class="col-sm-2 control-label">Picture</label>
                                <div class="col-sm-4">
                                    <input id="styled-finputs-example" type="file" name="userfile" class="form-control" placeholder="Picture" >
                                    <?php echo form_error('userfile', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                                <div class="col-sm-3">
                                    <button  data-toggle="modal" data-target="#myModal" type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-labeled btn-primary <?php if((isset($default['banner_picture']) ? $default['banner_picture'] : '') == '' ) : echo 'disabled'; endif; ?>"><!-- <span class="btn-label icon fa fa-camera-retro"></span> --> View Image</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('banner_hide') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label"><strong>Sembunyikan Banner?</strong></label>

                                <div class="col-sm-10">

                                    <label class="radio-inline">

                                        <input type="radio" name="banner_hide" id="inlineCheckbox1" value="no" class="px" <?php echo set_radio('banner_hide', 'no', isset($default['banner_hide']) && $default['banner_hide'] == 'no' ? TRUE : FALSE); ?>> <span class="lbl">Tidak</span>

                                    </label>

                                    <label class="radio-inline">

                                        <input type="radio" name="banner_hide" id="inlineCheckbox2" value="yes" class="px" <?php echo set_radio('banner_hide', 'yes', isset($default['banner_hide']) && $default['banner_hide'] == 'yes' ? TRUE : FALSE); ?>> <span class="lbl">Ya</span>

                                    </label>

                                    <?php echo form_error('banner_hide', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

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
                                <img width="100%" src="<?php echo base_url()?>uploads/banner/<?php echo set_value('banner_slug', isset($default['banner_slug']) ? $default['banner_slug'] : ''); ?>/<?php echo set_value('banner_picture', isset($default['banner_picture']) ? $default['banner_picture'] : '3.jpg'); ?>">
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