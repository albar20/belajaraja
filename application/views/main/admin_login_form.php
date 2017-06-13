    
    <style type="text/css">
        .login_wrapper{
            margin:50px auto; 
            float: none; 
            text-align: center; 
            clear:both;
        }
        .register-link{
            text-align: left;
        }
        .lost-password-link{
            text-align: right;
        }
    </style>

    <div class="col-md-6 login_wrapper">

        <h1 class="form-header">Sign in to your Account</h1>

        <!-- Form -->
        <form action="<?php echo base_url()?>admin_login/login_process" id="signin-form_id" class="panel" method="post">
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

            <div class="form-group">
                <input type="text" name="signin_username" id="username_id" class="form-control input-lg" placeholder="Username" required>
            </div> <!-- / Username -->

            <div class="form-group signin-password">
                <input type="password" name="signin_password" id="password_id" class="form-control input-lg" placeholder="Password" required>
                <!--<a href="#" class="forgot">Forgot?</a>-->
            </div> <!-- / Password -->

            <div class="form-actions">
                <input type="submit" value="Sign In" class="btn btn-primary btn-block btn-lg">
            </div> <!-- / .form-actions -->
        </form>
        <!-- <div class="col-md-6 lost-password-link"> 
            <a href="<?php //echo base_url() ?>forget_password">Forget Password</a>
        </div> -->
        <div style="clear:both;"></div>
    </div>
    <div style="clear:both;"></div>