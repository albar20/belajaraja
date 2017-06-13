<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/dashboard')?>"><?php echo ucwords('home') ?></a> / </span><?php echo ucwords($heading)?></h1>
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
                        <span class="panel-title"><?php echo set_value('blog_title', isset($default['blog_title']) ? ucwords($default['blog_title']) : ucwords($heading)); ?></span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('create_date') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label">Tanggal Tayang</label>
                                <div class="col-sm-3">
                                    <div class="input-group date" id="bs-datepicker-component">
                                        <input  type="text" name="create_date" class="form-control" placeholder="tanggal" value="<?php echo set_value('create_date', isset($default['create_date']) && $default['create_date'] != '' && $default['create_date'] != '0000-00-00' ? date('m/d/Y',strtotime($default['create_date'])) : ''); ?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                    <?php echo form_error('create_date', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('user_id') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Users</strong></label>
                                <div class="col-sm-4">
                                    <select name="user_id" id="user_id" class="form-control" >
                                        <option value="">Choose One</option>
                                        <?php if(count($user) > 0) : ?>
                                            <<?php foreach($user as $key => $value ): ?>
                                                <option value="<?php echo $key ?>" 
                                                        <?php echo set_select('user_id', $key, isset($default['user_id']) && $default['user_id'] == $key ? TRUE : FALSE); ?>>
                                                    <?php echo $value; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        <?php endif;?>
                                    </select>
                                    <?php echo form_error('user_id', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('activity') != '') { echo 'has-error'; } ?>">
                            <div class="row">
                                <label class="col-sm-2 control-label"><strong>Aktifitas</strong></label>
                                <div class="col-sm-4">
                                    <?php 
                                        $options = array(
                                                        'tambah'    =>   'Tambah', 
                                                        'ubah'      =>   'Ubah',       
                                                        'hapus'     =>   'Hapus'                       
                                                    );
                                    ?>
                                    <select name="activity" id="activity" class="form-control" >
                                        <option value="">Choose One</option>
                                            <?php foreach($options as $key => $value ): ?>
                                                <option value="<?php echo $key ?>" 
                                                        <?php echo set_select('activity', $key, isset($default['activity']) && $default['activity'] == $key ? TRUE : FALSE); ?>>
                                                    <?php echo $value; ?>
                                                </option>
                                            <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('activity', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary" name="lihat-log-visitor" type="submit">Lihat Log</button>
                    </div>
                </form>


                <?php if( isset($log_user_activity) ): ?>
                <?php if( count($log_user_activity) > 0 ): ?>
                    <table class="table table-striped table-hover table-bordered akun_bbppk" id="datatables_id"> 
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Status</th>
                                <th>Aktifitas ( Lihat Halaman )</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            foreach($log_user_activity as $lu) : ?>
                            <tr>
                                <td><?php echo $i++?></td>
                                <td><?php echo $lu['username']; ?></td>
                                <td><?php echo $lu['user_status']; ?></td>
                                <td><?php echo $lu['activity']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>                  
                <?php endif; ?>        


<!-- /5. $SUMMERNOTE_WYSIWYG_EDITOR -->


    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
    <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url()?>assets/general/js/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
    <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->
<!-- Pixel Admin's javascripts -->
<script src="<?php echo base_url()?>assets/general/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/general/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/general/datatables/datatables-initialize.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/pixel-admin.min.js"></script>

<script type="text/javascript">
    init.push(function () {
        // Javascript code here
    });
    window.PixelAdmin.start(init);
</script>