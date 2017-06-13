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
            Confirm Register
        </h2>
    <!-- Main Heading Ends -->
    <!-- Login Form Section Starts -->
        <section class="login-area">
            <div class="row">
                <?php 
                /*===================================================================
                    1.  LOGIN           FORM
                ===================================================================*/ ?>
                <div class="col-sm-12">
                    <div class="panel panel-smart">
                
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
                    </div>
                </div>
                    
            </div>
        </section>
    <!-- Login Form Section Ends -->
    </div>
<!-- Main Container Ends -->