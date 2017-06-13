<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin')?>"></span>Dashboard</a></h1>
        </div> <!-- / .page-header -->


<!-- 5. $SUMMERNOTE_WYSIWYG_EDITOR =================================================================

        Summernote WYSIWYG-editor
-->
        <?php $this->load->view('admin/page_form_script'); ?>

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


         <?php $this->load->view('admin/field/flash_message'); ?>


        <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
                    <div class="panel-heading">
                        <span class="panel-title">Ganti Password</span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('old_password') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Password Lama</label>
                                <div class="col-sm-8">
                                    <input type="password" name="old_password" class="form-control" placeholder="Password Lama" value="" required>
									<?php echo form_error('old_password', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('new_password') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Password Baru</label>
                                <div class="col-sm-8">
                                    <input type="password" name="new_password" class="form-control" placeholder="Password Baru" value="" required>
									<?php echo form_error('new_password', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>
						
						<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('confirm_password') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Konfirmasi Password Baru</label>
                                <div class="col-sm-8">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Ketik Ulang Password Baru" value="" required>
									<?php echo form_error('confirm_password', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="<?php echo site_url('Dashboard')?>"><button class="btn btn-danger" type="button">Cancel</button></a>
                    </div>
                </form>


<!-- /5. $SUMMERNOTE_WYSIWYG_EDITOR -->


    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->

<?php $this->load->view('admin/page_form_script_below'); ?>
