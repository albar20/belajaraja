<div id="content-wrapper">
        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/galeri_category')?>"><?php echo ucwords('galeri_category') ?></a> / </span><?php echo ucwords($heading)?></h1>
        </div> <!-- / .page-header -->
<!-- 5. $SUMMERNOTE_WYSIWYG_EDITOR =================================================================
        Summernote WYSIWYG-editor
-->
        <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
        <?php $this->load->view('admin/script_admin_code_mirror'); ?>
        <!-- Javascript -->
        <script>
            init.push(function () {
            });
        </script>
        <!-- / Javascript -->
        <?php $this->load->view('admin/field/message_info'); ?>
        <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo set_value('galeri_category_title', isset($default['galeri_category_title']) ? ucwords($default['galeri_category_title']) : ucwords($heading)); ?></span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('galeri_category_title') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Nama galeri_category</label>
                                <div class="col-sm-8">
                                    <input type="text" required name="galeri_category_title" class="form-control" placeholder="Nama" value="<?php echo set_value('galeri_category_title', isset($default['galeri_category_title']) ? $default['galeri_category_title'] : ''); ?>">
                                    <input type="hidden" name="galeri_category_id" class="form-control" placeholder="id galeri_category" value="<?php echo set_value('galeri_category_id', isset($default['galeri_category_id']) ? $default['galeri_category_id'] : ''); ?>">
                                    <?php echo form_error('galeri_category_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="<?php echo site_url('admin/galeri_category')?>"><button class="btn btn-danger" type="button">Back</button></a>
                    </div>
                </form>
                
<!-- /5. $SUMMERNOTE_WYSIWYG_EDITOR -->
    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<?php $this->load->view('admin/script_admin_below'); ?>