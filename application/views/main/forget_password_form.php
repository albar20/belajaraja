<?php 
/*===================================================================
    3.  LOST PASSWORD   FORM
===================================================================*/ ?>

<!-- Main Container Starts -->
    <div class="main-container container">
    <!-- Main Heading Starts -->
        <h2 class="main-heading text-center">
            Reset New Password Request
        </h2>
    <!-- Main Heading Ends -->
    <!-- Login Form Section Starts -->
        <section class="login-area">
            <div class="row">
                
                <?php 
                /*===================================================================
                    3.  LOST PASSWORD   FORM
                ===================================================================*/ ?>
                <div class="col-sm-6">
                <!-- Login Panel Starts -->
                    <div class="panel panel-smart">
                        <h2><?php echo $message; ?></h2>
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
                            <h3 class="panel-title">Forget Password</h3>
                        </div>
                        <div class="panel-body">
                        <!-- Login Form Starts -->
                            <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="form-inline"
                                id="signin-form_id" method="post">
                                <div class="form-group">
                                    <label class="sr-only" for="customer_fname">Nama Depan</label>
                                    <input id="exampleInputPassword2" type="text"  name="customer_fname" class="form-control" placeholder="Nama Depan" value="<?php echo set_value('customer_fname', isset($default['customer_fname']) ? $default['customer_fname'] : ''); ?>">
                                    <?php echo form_error('customer_fname', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>

                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="customer_email">Email</label>
                                    <input id="exampleInputPassword2" type="text" name="customer_email" class="form-control" placeholder="Email" value="<?php echo set_value('customer_email', isset($default['customer_email']) ? $default['customer_email'] : ''); ?>">
                                    <?php echo form_error('customer_email', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                                <button type="submit" class="btn btn-black">
                                    Send
                                </button>
                            </form>
                        <!-- Login Form Ends -->
                        </div>
                    </div>
                <!-- Login Panel Ends -->
                </div>
            </div>
        </section>
    <!-- Login Form Section Ends -->
    </div>
<!-- Main Container Ends -->