

<!-- Main Container Starts -->
    <div class="main-container container">
    <!-- Main Heading Starts -->
        <h2 class="main-heading text-center">
            Register <br />
            <span>Create New Account</span>
        </h2>
    <!-- Main Heading Ends -->
    <!-- Registration Section Starts -->
        <section class="registration-area">
            <div class="row">

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

                <div class="col-sm-6">
                <!-- Registration Block Starts -->
                    <div class="panel panel-smart">
                        <div class="panel-heading">
                            <h3 class="panel-title">Personal Information</h3>
                        </div>
                        <div class="panel-body">
                        <!-- Registration Form Starts -->
                            <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                                <input type="hidden" name="from_register_form" value="true" />
                                <?php 
                                    $datas['view_image']     =   false;
                                    $this->load->view('admin/customer/add_customer_field',$datas); ?>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="" id="see_password" /> 
                                                    see password
                                                <br/>

                                                <?php 
                                                    $checked_term_and_conditions = '';
                                                    if( isset($_POST['accept_terms_and_condition']) ){
                                                       $checked_term_and_conditions = 'checked="checked"'; 
                                                    }
                                                ?>
                                                <input type="checkbox" <?php echo $checked_term_and_conditions ?> name="accept_terms_and_condition" /> 
                                                    I have read and agree to these terms and conditions
                                                <br/>
                                                <?php if(isset($error_term_and_conditions) ): ?>
                                                <span class="help-block">
                                                    <i class="fa fa-warning"></i>
                                                    <?php echo isset($error_term_and_conditions) ? $error_term_and_conditions : ''; ?>
                                                </span>
                                                <?php endif; ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-black">
                                            Register
                                        </button>
                                    </div>
                                </div>
                            <!-- Password Area Ends -->
                            </form>
                        <!-- Registration Form Starts -->
                        </div>                          
                    
                    </div>
                <!-- Registration Block Ends -->
                </div>
                
                <?php 
                    if( $this->session->has_userdata('total_resend_email') ):
                    if( $this->session->userdata('total_resend_email') <= 3 ):
                ?>
                <div class="col-sm-6">
                    <div class="panel panel-smart">
                        <div class="panel-heading">
                            <h3 class="panel-title">Resend Email</h3>
                        </div>
                        <div class="panel-body">
                            <p>If you dont receive an email sent to you , then you can resend an email activation to your email account</p>
                            <a class="btn btn-default" href="<?php base_url() ?>login/resend_emails">Yes, Resend to me</a>
                        </div>
                    </div>
                </div>
                <?php 
                    endif;
                    endif;
                ?>
            </div>
        </section>
    <!-- Registration Section Ends -->
    </div>
<!-- Main Container Ends -->