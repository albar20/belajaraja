<?php 
/*===================================================================
    1.  LOGIN           FORM 
    2.  REGISTER        LINK
    3.  LOST PASSWORD   LINK
===================================================================*/ ?>

<!-- Main Container Starts -->
    <div class="main-container container">
    <!-- Main Heading Starts -->
        <h2 class="main-heading text-center">
            Reset Password
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
                        <h2><?php echo $message ?></h2>

                        <div class="panel-heading">
                            <h3 class="panel-title">Reset</h3>
                        </div>
                        <div class="panel-body">
                            <p>
                                Please Enter your new Password
                            </p>
                            <?php if( $allow_reset_password ): ?>
                        
                            <form action="<?php echo $form_action?>" id="signin-form_id" class="form-inline" method="post">
                                <div class="form-group">
                                    <label class="sr-only" for="">New Password</label>
                                    <input type="password" name="customer_password" class="form-control" id="" placeholder="New Password">
                                    <?php echo form_error('customer_password', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="">New Re-Password</label>
                                    <input type="password" name="customer_password2" class="form-control" id="" placeholder="New Re-Password">
                                    <?php echo form_error('customer_password2', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>
                                <button type="submit" class="btn btn-black">
                                    Reset
                                </button>
                            </form>
                            <?php else: ?>
                                <h2>Reset Password Gagal , Silahkan Ulangi lagi</h2>
                            <?php endif; ?>
                                
                        </div>
                    </div>
                <!-- Login Panel Ends -->
                </div>

            </div>
        </section>
    <!-- Login Form Section Ends -->
    </div>
<!-- Main Container Ends -->