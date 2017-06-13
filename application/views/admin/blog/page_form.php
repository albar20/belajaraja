<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/blog')?>"><?php echo ucwords('blog') ?></a> / </span><?php echo ucwords($heading)?></h1>
        </div> <!-- / .page-header -->


<!-- 5. $SUMMERNOTE_WYSIWYG_EDITOR =================================================================

        Summernote WYSIWYG-editor
-->
        <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
        <?php $this->load->view('admin/script_admin_code_mirror'); ?>

        <!-- Javascript -->
        <script>
            var baseurl = '<?php echo base_url()?>';

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

                $("#category_id").change(function(){
                    var id = $("#category_id").val();
                    $.ajax({
                        url:baseurl+'admin/blog/get_subcategory/'+id,
                        cache: false,
                        success: function(msg){
                            $("#subcategory_id").html(msg);
                        }
                    });
                });

            });
        </script>
        <!-- / Javascript -->
        <?php $this->load->view('admin/field/message_info'); ?>
        <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo set_value('blog_title', isset($default['blog_title']) ? ucwords($default['blog_title']) : ucwords($heading)); ?></span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('blog_title') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Nama blog</label>
                                <div class="col-sm-8">
                                    <input type="text" required name="blog_title" class="form-control" placeholder="Nama" value="<?php echo set_value('blog_title', isset($default['blog_title']) ? $default['blog_title'] : ''); ?>">
                                    <input type="hidden" name="blog_id" class="form-control" placeholder="id blog" value="<?php echo set_value('blog_id', isset($default['blog_id']) ? $default['blog_id'] : ''); ?>">
                                    <?php echo form_error('blog_title', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>


                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('category_id') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Kategori</strong></label>
                                <div class="col-sm-4">
                                    <select name="category_id" id="category_id" class="form-control" >
                                        <option value="">Choose One</option>
                                        <?php if($category_list->num_rows() > 0) : ?>
                                            <?php foreach($category_list->result() as $cat) : ?>
                                            <option value="<?php echo $cat->category_id?>" <?php echo set_select('category_id', $cat->category_id, isset($default['category_id']) && $default['category_id'] == $cat->category_id ? TRUE : FALSE); ?>><?php echo $cat->category_title?></option>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                    </select>
                                    <?php echo form_error('category_id', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('subcategory_id') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Sub Kategori</strong></label>
                                <div class="col-sm-4">
                                    <select name="subcategory_id" id="subcategory_id" class="form-control" >
                                        <option value="">Choose One</option>
                                        <?php if(isset($subcategory_list) && $subcategory_list->num_rows() > 0) : ?>
                                            <?php foreach($subcategory_list->result_array() as $row) : ?>
                                            	<option value="<?php echo $row['subcategory_id']; ?>"><?php echo isset($row['subcategory_id']) && $this->model_utama->cek_data($row['subcategory_id'],'subcategory_id','subcategory')->num_rows() > 0 ? $this->model_utama->cek_data($row['subcategory_id'],'subcategory_id','subcategory')->row()->subcategory_title : '-'; ?></option>  
                                            <?php endforeach; ?>
                                        <?php else : ?> 
                                        	<?php if(isset($default['subcategory_id']) && $default['subcategory_id'] != '') : ?>
                                                <option selected="selected" value="<?php echo $default['subcategory_id']; ?>"><?php echo isset($default['subcategory_id']) && $this->model_utama->cek_data($default['subcategory_id'],'subcategory_id','subcategory')->num_rows() > 0 ? $this->model_utama->cek_data($default['subcategory_id'],'subcategory_id','subcategory')->row()->subcategory_title : '-'; ?></option>                                     
                                            <?php endif; ?>
                                        <?php endif;?>
                                    </select>
                                    <?php echo form_error('subcategory_id', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('blog_date') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Tanggal Tayang</label>
                                <div class="col-sm-3">
                                    <div class="input-group date" id="bs-datepicker-component">
                                        <input  type="text" name="blog_date" class="form-control" placeholder="tanggal" value="<?php echo set_value('blog_date', isset($default['blog_date']) && $default['blog_date'] != '' && $default['blog_date'] != '0000-00-00' ? date('m/d/Y',strtotime($default['blog_date'])) : ''); ?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <?php echo form_error('blog_date', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
                        

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('blog_hide') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Sembunyikan Posting?</strong></label>
                                <div class="col-sm-8">
                                    <label class="radio-inline">
                                        <input required type="radio" name="blog_hide" id="inlineCheckbox2" value="no" class="px" <?php echo set_radio('blog_hide', 'no', isset($default['blog_hide']) && $default['blog_hide'] == 'no' ? TRUE : FALSE); ?>> <span class="lbl">Tidak</span>
                                    </label>
                                    <label class="radio-inline">
                                        <input required type="radio" name="blog_hide" id="inlineCheckbox1" value="yes" class="px" <?php echo set_radio('blog_hide', 'yes', isset($default['blog_hide']) && $default['blog_hide'] == 'yes' ? TRUE : FALSE); ?>> <span class="lbl">Ya</span>
                                    </label>
                                    <?php echo form_error('blog_hide', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div> 

                        <!--
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('blog_link') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Link</label>
                                <div class="col-sm-5">
                                    <input type="url" name="blog_link" class="form-control" placeholder="Link" value="<?php echo set_value('blog_link', isset($default['blog_link']) ? $default['blog_link'] : ''); ?>">
                                    <?php echo form_error('blog_link', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
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
                                    <button  data-toggle="modal" data-target="#myModal" type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-labeled btn-primary <?php if((isset($default['blog_picture']) ? $default['blog_picture'] : '') == '' ) : echo 'disabled'; endif; ?>"><!-- <span class="btn-label icon fa fa-camera-retro"></span> --> View Image</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('blog_description') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <div class="col-sm-12">
                                    <textarea class="form-control" id="summernote-example" name="blog_description" rows="10"><?php echo set_value('blog_description', isset($default['blog_description']) ? $default['blog_description'] : ''); ?></textarea>
                                    <?php echo form_error('blog_description', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="<?php echo site_url('blog')?>"><button class="btn btn-danger" type="button">Back</button></a>
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
                                <img width="100%" src="<?php echo base_url()?>uploads/blog/<?php echo set_value('blog_picture', isset($default['blog_picture']) ? $default['blog_picture'] : '3.jpg'); ?>">
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