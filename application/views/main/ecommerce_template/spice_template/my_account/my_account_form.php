<?php 
/*=====================================================
    2.  SIDEBAR LEFT
        1.  MY ACCOUNT 
        2.  MY WISHLIST
        3.  MY ORDER
    3.  MAIN CONTENT
        1.  INFORMASI KONTAK
        2.  ALAMAT PENAGIHAN / ALAMAT PENGIRIMAN
        3.  TAMBAH ALAMAT BARU
=====================================================*/ ?>

<!-- Main Container Starts -->
<div id="main-container" class="container">
    <div class="row">   
        <?php 
        /*=====================================================
            2.  SIDEBAR LEFT
                1.  MY ACCOUNT 
                2.  MY WISHLIST
                3.  MY ORDER
        =====================================================*/ ?>
        <div class="col-md-3">

            <?php 
            /*=====================================================
                1.  CATEGORY
            =====================================================*/ ?>
            <h3 class="side-heading">Dashboard</h3>
            <div class="list-group categories">
                <a href="<?php echo base_url() ?>my_account" class="list-group-item">
                    <i class="fa fa-angle-right"></i>
                    My Account
                </a>
                <a href="<?php echo base_url() ?>wishlist" class="list-group-item">
                    <i class="fa fa-angle-right"></i>
                    My Wishlist
                </a>
                <a href="<?php echo base_url() ?>my_order" class="list-group-item">
                    <i class="fa fa-angle-right"></i>
                    My Order
                </a>
            </div>
        </div>
            
            



        <?php 
        /*=====================================================
            3.  MAIN CONTENT
                1.  INFORMASI KONTAK
                2.  ALAMAT PENAGIHAN / ALAMAT PENGIRIMAN
                3.  TAMBAH ALAMAT BARU
        =====================================================*/ ?>
        <div class="col-md-9">  

            <!-- Breadcrumb Starts -->
            <?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/breadcrumb'); ?>
            <!-- Breadcrumb Ends -->

            <?php 
            /*=====================================================
                1.  INFORMASI KONTAK
            =====================================================*/ ?>
            <?php $this->load->view('main/field/message_info'); ?>

            <div class="product-filter" style="margin-top: 0;">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Edit My Account</h2>
                    </div>
                </div>                       
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-10 col-xs-10">
                    <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered">
                        <div class="panel-body no-padding-hr">
                            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('customer_fname') != '') { echo 'has-error'; } ?>">
                                <div class="row">
                                    <label class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input type="text"  name="customer_fname" class="form-control" placeholder="" value="<?php echo set_value('customer_fname', isset($default['customer_fname']) ? $default['customer_fname'] : ''); ?>">
                                        <?php echo form_error('customer_fname', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('customer_lname') != '') { echo 'has-error'; } ?>">
                                <div class="row">
                                    <label class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input type="text"  name="customer_lname" class="form-control" placeholder="" value="<?php echo set_value('customer_lname', isset($default['customer_lname']) ? $default['customer_lname'] : ''); ?>">
                                        <?php echo form_error('customer_lname', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('customer_sex') != '') { echo 'has-error'; } ?>">
                                <div class="row">
                                    <label class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select id="jquery-select2-example" name="customer_sex" class="form-control">
                                            <option value="">-- Choose One --</option>
                                            <option value="laki" <?php echo set_select('customer_sex', 'laki', isset($default['customer_sex']) && $default['customer_sex'] == 'laki' ? TRUE : FALSE); ?>>Male</option>
                                            <option value="perempuan" <?php echo set_select('customer_sex', 'perempuan', isset($default['customer_sex']) && $default['customer_sex'] == 'perempuan' ? TRUE : FALSE); ?>>Female</option>
                                        </select>
                                        <?php echo form_error('customer_sex', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('customer_birthday') != '') { echo 'has-error'; } ?>">
                                <div class="row">
                                    <label class="col-sm-2 control-label">Birthday</label>
                                    <div class="col-sm-3">
                                        <div class="input-group date" id="bs-datepicker-component">
                                            <input  type="text" id="boostrap_date_picker" name="customer_birthday" class="form-control" placeholder="Date" value="<?php echo set_value('customer_birthday', isset($default['customer_birthday']) && $default['customer_birthday'] != '' && $default['customer_birthday'] != '0000-00-00' ? date('m/d/Y',strtotime($default['customer_birthday'])) : ''); ?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        </div>
                                        <?php echo form_error('customer_birthday', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('customer_password') != '') { echo 'has-error'; } ?>">
                                <div class="row">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password"  name="customer_password" class="form-control" placeholder="" value="<?php echo set_value('customer_password', isset($default['customer_password']) ? $default['customer_password'] : ''); ?>">
                                        <?php if(isset($password_not_same_message) ): ?>
                                            <span class="help-block">
                                                <i class="fa fa-warning"></i>
                                                <?php echo isset($password_not_same_message) ? $password_not_same_message : ''; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('customer_password2') != '') { echo 'has-error'; } ?>">
                                <div class="row">
                                    <label class="col-sm-2 control-label">Re-Password</label>
                                    <div class="col-sm-10">
                                        <input type="password"  name="customer_password2" class="form-control" placeholder="" value="<?php echo set_value('customer_password2', isset($default['customer_password2']) ? $default['customer_password2'] : ''); ?>">
                                        <?php if(isset($password_not_same_message) ): ?>
                                            <span class="help-block">
                                                <i class="fa fa-warning"></i>
                                                <?php echo isset($password_not_same_message) ? $password_not_same_message : ''; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t <?php if(form_error('userfile') != '') { echo 'has-error'; } ?>">
                                <div class="row">
                                    <label class="col-sm-2 control-label">Photo</label>
                                    <div class="col-sm-7">
                                        <input id="styled-finputs-example" type="file" name="userfile" class="form-control" placeholder="Picture" >
                                        <?php echo form_error('userfile', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                        <br/>
                                        <img src="<?php echo base_url() ?>uploads/customer/thumb/<?php echo isset($default['customer_photo']) ? $default['customer_photo'] : '';  ?>" alt="my image" />
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="">
                                <button class="btn btn-warning" type="submit">Save</button>
                                <a class="btn btn-warning " href="<?php echo base_url()?>my_account">My Account</a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
            <br/>            
        </div>

    </div>
</div>
<!-- Main Container Ends -->