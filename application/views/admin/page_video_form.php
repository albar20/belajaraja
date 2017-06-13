<div id="content-wrapper">
        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo base_url()?>admin/video"><?php echo ucwords('video') ?></a> / </span><?php echo ucwords($heading)?></h1>
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
            });
        </script>
        <!-- / Javascript -->
        <?php $this->load->view('admin/field/message_info'); ?>
        <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo set_value('video_title', isset($default['video_title']) ? ucwords($default['video_title']) : ucwords($heading)); ?></span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        <?php if(set_value('video_link', isset($default['video_link']) ? $default['video_link'] : '') != '') : ?>
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('video_list_title') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-md-8">
                                <?php 
                                    $url = $default['video_link'];
                                    preg_match(
                                            '/[\\?\\&]v=([^\\?\\&]+)/',
                                            $url,
                                            $matches
                                        );
                                    $id = $matches[1];
                                    echo '<object width="100%" height="360"><param name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="100%" height="360"></embed></object>';
                                ?>
                                    
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('video_title') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Nama Album</label>
                                <div class="col-sm-8">
                                    <input type="text" name="video_title" class="form-control" placeholder="Nama" value="<?php echo set_value('video_title', isset($default['video_title']) ? $default['video_title'] : ''); ?>">
                                    <input type="hidden" name="video_id" class="form-control" placeholder="id video" value="<?php echo set_value('video_id', isset($default['video_id']) ? $default['video_id'] : ''); ?>">
                                    <?php echo form_error('video_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('video_type') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Tipe Link *</strong></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input type="radio" name="video_type" id="inlineCheckbox1" value="in" class="px" <?php echo set_radio('video_type', 'in', isset($default['video_type']) && $default['video_type'] == 'in' ? TRUE : FALSE); ?>> <span class="lbl">Tautan Halaman</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="video_type" id="inlineCheckbox2" value="out" class="px" <?php echo set_radio('video_type', 'out', isset($default['video_type']) && $default['video_type'] == 'out' ? TRUE : FALSE); ?>> <span class="lbl">Tautan Keluar</span>
                                    </label>
                                    <?php echo form_error('video_type', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div> -->
                       
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('video_link') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-5">
                                    <input type="url" name="video_link" class="form-control" placeholder="Link" value="<?php echo set_value('video_link', isset($default['video_link']) ? $default['video_link'] : ''); ?>">
                                    <?php echo form_error('video_link', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('userfile') != '') { echo 'has-error'; } ?>">
                             <div class="row">
                                <label class="col-sm-2 control-label">Picture</label>
                                <div class="col-sm-4">
                                    <input id="styled-finputs-example" type="file" name="userfile" class="form-control" placeholder="Picture" >
                                    <?php echo form_error('userfile', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                                <div class="col-sm-3">
                                    <button  data-toggle="modal" data-target="#myModal" type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-labeled btn-primary <?php if((isset($default['video_picture']) ? $default['video_picture'] : '') == '' ) : echo 'disabled'; endif; ?>"> <span class="btn-label icon fa fa-camera-retro"></span> View Image</button>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('video_description') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="summernote-example" name="video_description" rows="10"><?php echo set_value('video_description', isset($default['video_description']) ? $default['video_description'] : ''); ?></textarea>
                                    <?php echo form_error('video_description', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="<?php echo base_url()?>admin/video"><button class="btn btn-danger" type="button">Back</button></a>
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
                                <img width="100%" src="<?php echo base_url()?>uploads/video/<?php echo set_value('video_picture', isset($default['video_picture']) ? $default['video_picture'] : '3.jpg'); ?>">
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