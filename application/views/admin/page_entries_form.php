<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo base_url()?>admin/entries"><?php echo ucwords('entries') ?></a> / </span><?php echo ucwords($heading)?></h1>
        </div> <!-- / .page-header -->


<!-- 5. $SUMMERNOTE_WYSIWYG_EDITOR =================================================================

        Summernote WYSIWYG-editor
-->
        <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/codemirror/3.20.0/codemirror.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/codemirror/3.20.0/theme/blackboard.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/codemirror/3.20.0/theme/monokai.min.css">
        <script type="text/javascript" src="<?php echo base_url()?>assets/codemirror/3.20.0/codemirror.js"></script>
        <script src="<?php echo base_url()?>assets/codemirror/3.20.0/mode/xml/xml.min.js"></script>
        <script src="<?php echo base_url()?>assets/codemirror/2.36.0/formatting.min.js"></script>

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


        <?php
          $message = $this->session->flashdata('warning');
          echo $message == '' ? '' : '<div class="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-warning"></i> ' . $message . '</div>';
        ?>
        <?php
          $message = $this->session->flashdata('danger');
          echo $message == '' ? '' : '<div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-times"></i> ' . $message . '</div>';
        ?>
        <?php
          $message = $this->session->flashdata('success');
          echo $message == '' ? '' : '<div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-check"></i> ' . $message . '</div>';
        ?>
        <?php
          $message = $this->session->flashdata('info');
          echo $message == '' ? '' : '<div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <i class="fa fa-exclamation"></i> ' . $message . '</div>';
        ?>


        <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
            <div class="panel-heading">
                <span class="panel-title"><?php echo set_value('entries_title', isset($default['entries_title']) ? ucwords($default['entries_title']) : ucwords($heading)); ?></span>
                <div class="panel-heading-controls">
                    <span class="panel-heading-text" style="font-size:11px;font-weight:600;">BOXED&nbsp;&nbsp;</span>
                    <input type="checkbox" data-class="switcher-sm" id="summernote-boxed">
                </div> <!-- / .panel-heading-controls -->
            </div>
            <div class="panel-body no-padding-hr">
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('entries_title') != '') { echo 'has-error'; } ?>">
                    <div class="row">
                        <label class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-8">
                            <input type="text" name="entries_title" class="form-control" placeholder="Judul entries" value="<?php echo set_value('entries_title', isset($default['entries_title']) ? $default['entries_title'] : ''); ?>">
                            <?php echo form_error('entries_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group no-margin-hr no-margin-b panel-padding-h <?php if(form_error('entries_content') != '') { echo 'has-error'; } ?>">
                    <div class="row">
                        <textarea class="form-control" id="summernote-example" name="entries_content" rows="10"><?php echo set_value('entries_content', isset($default['entries_content']) ? $default['entries_content'] : ''); ?></textarea>
                        <?php echo form_error('entries_content', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                    </div>
                </div>

            </div>
            <div class="panel-footer text-right">
                <button class="btn btn-primary" type="submit">Save</button>
                <!--<a href="<?php echo base_url()?>entries"><button class="btn btn-danger" type="button">Back</button></a>-->
            </div>
        </form>

        


<!-- /5. $SUMMERNOTE_WYSIWYG_EDITOR -->


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