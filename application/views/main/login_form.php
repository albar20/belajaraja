<?php
$btn_class = 'btn-black';
if( $this->themes_folder_name == 'shoppe_template' ){
    $btn_class = 'btn-brown';
}








/*===================================================================
    1.  LOGIN           FORM 
    2.  REGISTER        LINK
    3.  LOST PASSWORD   LINK
===================================================================*/ ?>

    <!-- Main Container Starts -->
    <div class="main-container container">
        
        <h2 class="main-heading text-center">
            Login or create new account
        </h2>
    <!-- Main Heading Ends -->
    <!-- Login Form Section Starts -->
        <section class="login-area">
            <div class="row">
                <?php 
                /*===================================================================
                    1.  LOGIN           FORM
                ===================================================================*/ ?>
                <div class="col-sm-6">
                <!-- Login Panel Starts -->
                    <div class="panel panel-smart">
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
                        <div class="panel-heading">
                            <h3 class="panel-title">Login</h3>
                        </div>
                        <div class="panel-body">
                            <p>
                                Please login using your existing account
                            </p>
                        <!-- Login Form Starts -->
                            <form action="<?php echo base_url()?>login/login_process" id="signin-form_id" class="form-inline" method="post">
                                <div class="form-group">
                                    <label class="sr-only" for="customer_email">Email</label>
                                    <input type="text" name="customer_email" id="customer_email" class="form-control" id="" placeholder="Email">
                                    <?php echo form_error('customer_email', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="customer_password">Password</label>
                                    <input type="password" name="customer_password" id="customer_password" class="form-control" id="" placeholder="Password">
                                    <?php echo form_error('customer_password', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                                <button type="submit" class="btn <?php echo $btn_class ?>">
                                    Login
                                </button>
                            </form>
                        <!-- Login Form Ends -->
                        </div>
                    </div>
                <!-- Login Panel Ends -->
                </div>

                <?php 
                /*===================================================================
                    2.  REGISTER        LINK
                ===================================================================*/ ?>
                <div class="col-sm-6">
                <!-- Account Panel Starts -->
                    <div class="panel panel-smart">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Create new account
                            </h3>
                        </div>
                        <div class="panel-body">
                            <p>
                                Registration allows you to avoid filling in billing and shipping forms every time you checkout on this website
                            </p>
                            <a href="<?php echo base_url() ?>register" class="btn <?php echo $btn_class ?>">
                                Register
                            </a>
                        </div>
                    </div>
                <!-- Account Panel Ends -->
                </div>
                
                <?php 
                /*===================================================================
                    3.  LOST PASSWORD   LINK
                ===================================================================*/ ?>
                <div class="col-sm-6">
                <!-- Account Panel Starts -->
                    <div class="panel panel-smart">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                FORGET PASSWORD
                            </h3>
                        </div>
                        <div class="panel-body">
                            <p>
                                Reset to new password
                            </p>
                            <a href="<?php echo base_url() ?>forget_password" class="btn <?php echo $btn_class ?>">
                                FORGET PASSWORD
                            </a>
                        </div>
                    </div>
                <!-- Account Panel Ends -->
                </div>
            
            </div>
        </section>
    <!-- Login Form Section Ends -->
    </div>
<!-- Main Container Ends -->