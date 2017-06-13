<div id="content-wrapper">



        <div class="page-header">

            <h1><span class="text-light-gray"><a href="<?php echo base_url()?>admin/user_admin"><?php echo ucwords('user') ?></a> / </span><?php echo ucwords($heading)?></h1>

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



            });

        </script>

        <!-- / Javascript -->





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





        <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">

                    <div class="panel-heading">

                        <span class="panel-title"><?php echo set_value('user_name', isset($default['user_name']) ? ucwords($default['user_name']) : ucwords($heading)); ?></span>

                    </div>

                    <div class="panel-body no-padding-hr">

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('user_name') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label">Nama user</label>

                                <div class="col-sm-8">

                                    <input type="text" required name="user_name" class="form-control" placeholder="Nama" value="<?php echo set_value('user_name', isset($default['user_name']) ? $default['user_name'] : ''); ?>">

                                    <input type="hidden" name="user_id" class="form-control" placeholder="id user" value="<?php echo set_value('user_id', isset($default['user_id']) ? $default['user_id'] : ''); ?>">

                                    <?php echo form_error('user_name', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('username') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label">Username</label>

                                <div class="col-sm-8">

                                    <input type="text" required name="username" class="form-control" placeholder="Nama" value="<?php echo set_value('username', isset($default['username']) ? $default['username'] : ''); ?>">

                                    <?php echo form_error('username', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('password') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label">Password</label>

                                <div class="col-sm-8">

                                    <input type="password" name="password" class="form-control" placeholder="Password" value="<?php echo set_value('password', isset($default['password']) ? $default['password'] : ''); ?>">

                                    <?php echo form_error('password', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('user_status') != '') { echo 'has-error'; } ?>">

                            <div class="row">

                                <label class="col-sm-2 control-label"><strong>Status</strong></label>

                                <div class="col-sm-4">

                                    <select name="user_status" id="user_status" class="form-control" required>

                                        <option value="">Choose One</option>

                                        <option value="admin" <?php echo set_select('user_status', 'admin', isset($default['user_status']) && $default['user_status'] == 'admin' ? TRUE : FALSE); ?>>Super Admin</option>
                                        <option value="user" <?php echo set_select('user_status', 'user', isset($default['user_status']) && $default['user_status'] == 'user' ? TRUE : FALSE); ?>>user</option>
                                        <option value="staff" <?php echo set_select('user_status', 'staff', isset($default['user_status']) && $default['user_status'] == 'staff' ? TRUE : FALSE); ?>>staff</option>
                                        <option value="manager" <?php echo set_select('user_status', 'manager', isset($default['user_status']) && $default['user_status'] == 'manager' ? TRUE : FALSE); ?>>manager</option>
                                        

                                    </select>

                                    <?php echo form_error('user_status', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>

                            </div>

                        </div>



                        

                    </div>

                    <div class="panel-footer text-right">

                        <button class="btn btn-primary" type="submit">Save</button>

                        <a href="<?php echo base_url()?>user_admin"><button class="btn btn-danger" type="button">Back</button></a>

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