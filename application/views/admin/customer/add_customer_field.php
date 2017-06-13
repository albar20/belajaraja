<style type="text/css">
    <?php 
        $segment1 = $this->uri->segment(1);
        if( $segment1 == 'admin' ): 
    ?>
    .form-group {
        border: 0px !important;
    }
    .col-sm-9 {
        width: 60% !important;
    }
    <?php endif; ?>
</style>                      
                        <div class="form-group">
                            <label for="inputFname" class="col-sm-3 control-label">First Name</label>
                            <div class="col-sm-9">
                                <input type="text"  name="customer_fname" class="form-control" placeholder="Nama Depan" value="<?php echo set_value('customer_fname', isset($default['customer_fname']) ? $default['customer_fname'] : ''); ?>">
                                <input type="hidden" name="customer_id" class="form-control" placeholder="id user" value="<?php echo set_value('customer_id', isset($default['customer_id']) ? $default['customer_id'] : ''); ?>">
                                <?php echo form_error('customer_fname', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Last Name</label>
                            <div class="col-sm-9">
                                <input type="text"  name="customer_lname" class="form-control" placeholder="" value="<?php echo set_value('customer_lname', isset($default['customer_lname']) ? $default['customer_lname'] : ''); ?>">
                                    <?php echo form_error('customer_lname', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Gender</label>
                            <div class="col-sm-9">
                                <select id="jquery-select2-example" name="customer_sex" class="form-control">
                                    <option value="">-- Choose One --</option>
                                    <option value="male" <?php echo set_select('customer_sex', 'male', isset($default['customer_sex']) && $default['customer_sex'] == 'male' ? TRUE : FALSE); ?>>Male</option>
                                    <option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Female</option>
                                </select>
                                <?php echo form_error('customer_sex', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Birth Date</label>
                            <div class="col-sm-9">
                                <div class="input-group date" id="bs-datepicker-component">
                                    <input  type="text" id="boostrap_date_picker" name="customer_birthday" class="form-control" placeholder="tanggal" value="<?php echo set_value('customer_birthday', isset($default['customer_birthday']) && $default['customer_birthday'] != '' && $default['customer_birthday'] != '0000-00-00' ? date('m/d/Y',strtotime($default['customer_birthday'])) : ''); ?>"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
                                <?php echo form_error('customer_birthday', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="text"  name="customer_email" class="form-control" placeholder="" value="<?php echo set_value('customer_email', isset($default['customer_email']) ? $default['customer_email'] : ''); ?>">
                                    <?php echo form_error('customer_email', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>
						<div class="form-group">                            <label for="" class="col-sm-3 control-label">Eye Color</label>                            <div class="col-sm-9">                                <select id="jquery-select2-example" name="customer_sex" class="form-control">                                    <option value="">-- Choose One --</option>                                    <option value="male" <?php echo set_select('customer_eye_color', 'male', isset($default['customer_eye_color']) && $default['customer_sex'] == 'male' ? TRUE : FALSE); ?>>Brown</option>                                    <option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Blue</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Grey</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Hazel</option>									<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Others</option>									                                </select>                                <?php echo form_error('customer_sex', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>                            </div>													</div>														<div class="form-group">                            <label for="" class="col-sm-3 control-label">Hair Color</label>							<div class="col-sm-9">                                <select id="jquery-select2-example" name="customer_sex" class="form-control">                                    <option value="">-- Choose One --</option>                                    <option value="male" <?php echo set_select('customer_eye_color', 'male', isset($default['customer_eye_color']) && $default['customer_sex'] == 'male' ? TRUE : FALSE); ?>>Blonde</option>                                    <option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Red</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Black</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Brown</option>									<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Grey</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Others</option>									                                </select>                                <?php echo form_error('customer_sex', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>                            </div>                        </div>										<div class="form-group">                            <label for="" class="col-sm-3 control-label">Hair Condition</label>							<div class="col-sm-9">                                <select id="jquery-select2-example" name="customer_sex" class="form-control">                                    <option value="">-- Choose One --</option>                                    <option value="male" <?php echo set_select('customer_eye_color', 'male', isset($default['customer_eye_color']) && $default['customer_sex'] == 'male' ? TRUE : FALSE); ?>>Oily</option>                                    <option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Dry</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Normal</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Not Sure</option>									                                </select>                                <?php echo form_error('customer_sex', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>                            </div>                        </div>												<div class="form-group">                            <label for="" class="col-sm-3 control-label">Hair Type</label>							<div class="col-sm-9">                                <select id="jquery-select2-example" name="customer_sex" class="form-control">                                    <option value="">-- Choose One --</option>                                    <option value="male" <?php echo set_select('customer_eye_color', 'male', isset($default['customer_eye_color']) && $default['customer_sex'] == 'male' ? TRUE : FALSE); ?>>Straight</option>                                    <option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Wavy</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Curly</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Colored</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Others</option>									                                </select>                                <?php echo form_error('customer_sex', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>                            </div>                        </div>												<div class="form-group">                            <label for="" class="col-sm-3 control-label">Skin Color</label>							<div class="col-sm-9">                                <select id="jquery-select2-example" name="customer_sex" class="form-control">                                    <option value="">-- Choose One --</option>                                    <option value="male" <?php echo set_select('customer_eye_color', 'male', isset($default['customer_eye_color']) && $default['customer_sex'] == 'male' ? TRUE : FALSE); ?>>Pale</option>                                    <option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Light</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Tan</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Brown</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Dark</option>									                                </select>                                <?php echo form_error('customer_sex', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>                            </div>                        </div>												<div class="form-group">                            <label for="" class="col-sm-3 control-label">Skin Type</label>							<div class="col-sm-9">                                <select id="jquery-select2-example" name="customer_sex" class="form-control">                                    <option value="">-- Choose One --</option>                                    <option value="male" <?php echo set_select('customer_eye_color', 'male', isset($default['customer_eye_color']) && $default['customer_sex'] == 'male' ? TRUE : FALSE); ?>>Oily</option>                                    <option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Dry</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Combination</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Normal</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Sensitive</option>									                                </select>                                <?php echo form_error('customer_sex', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>                            </div>                        </div>										<div class="form-group">                            <label for="" class="col-sm-3 control-label">Skin Undertone</label>							<div class="col-sm-9">                                <select id="jquery-select2-example" name="customer_sex" class="form-control">                                    <option value="">-- Choose One --</option>                                    <option value="male" <?php echo set_select('customer_eye_color', 'male', isset($default['customer_eye_color']) && $default['customer_sex'] == 'male' ? TRUE : FALSE); ?>>Cold</option>                                    <option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Warm</option>																		<option value="female" <?php echo set_select('customer_sex', 'female', isset($default['customer_sex']) && $default['customer_sex'] == 'female' ? TRUE : FALSE); ?>>Other</option>									                                </select>                                <?php echo form_error('customer_sex', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>                            </div>                        </div>				
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Photo</label>
                            <div class="col-sm-9">
                                <?php 
                                    $file_class = "col-sm-7";
                                    if( $this->uri->segment(1) == 'register'){
                                        $file_class = '';
                                    }
                                ?>
                                <div class="<?php echo $file_class ?>">
                                    <input id="styled-finputs-example" type="file" name="userfile" placeholder="Picture" >
                                        <?php echo form_error('userfile', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                </div>

                                <?php if( $view_image ): ?>
                                <div class="col-sm-3">
                                    <button  data-toggle="modal" data-target="#myModal" type="button" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-labeled btn-primary <?php if((isset($default['userfile']) ? $default['userfile'] : '') == '' ) : echo 'disabled'; endif; ?>"><!-- <span class="btn-label icon fa fa-camera-retro"></span> --> View Image</button>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- <h3 class="panel-heading inner">
                            Delivery Information
                        </h3>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Full Address</label>
                            <div class="col-sm-9">
                                <textarea id="<?php echo 'customer_address'; ?>" name="<?php echo 'customer_address'; ?>" class="form-control" 
                                placeholder="" ><?php echo set_value('customer_address', isset($default['customer_address']) ? $default['customer_address'] : ''); ?></textarea>
                                    <?php echo form_error('customer_address', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Propinsi</label>
                            <div class="col-sm-9">
                                <input type="text"  name="customer_state" class="form-control" placeholder="" value="<?php echo set_value('customer_state', isset($default['customer_state']) ? $default['customer_state'] : ''); ?>">
                                    <?php echo form_error('customer_state', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kota</label>
                            <div class="col-sm-9">
                                <input type="text"  name="customer_city" class="form-control" placeholder="" value="<?php echo set_value('customer_city', isset($default['customer_city']) ? $default['customer_city'] : ''); ?>">
                                    <?php echo form_error('customer_city', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Kode Pos</label>
                            <div class="col-sm-9">
                                <input type="text"  name="customer_sub_postal" class="form-control" placeholder="" value="<?php echo set_value('customer_sub_postal', isset($default['customer_sub_postal']) ? $default['customer_sub_postal'] : ''); ?>">
                                    <?php echo form_error('customer_sub_postal', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?> 
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Telepon</label>
                            <div class="col-sm-9">
                                <input type="text"  name="customer_phone" class="form-control" placeholder="" value="<?php echo set_value('customer_phone', isset($default['customer_phone']) ? $default['customer_phone'] : ''); ?>">
                                    <?php echo form_error('customer_phone', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label">Handphone</label>
                            <div class="col-sm-9">
                                <input type="text"  name="customer_mobile" class="form-control" placeholder="" value="<?php echo set_value('customer_mobile', isset($default['customer_mobile']) ? $default['customer_mobile'] : ''); ?>">
                                    <?php echo form_error('customer_mobile', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>  
                            </div>
                        </div>-->

                        <h3 class="panel-heading inner">
                            Password
                        </h3>

                        <div class="form-group">
                            <label for="inputFname" class="col-sm-3 control-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" id="customer_password" name="customer_password" class="form-control" placeholder="" value="">
                                <?php echo form_error('customer_password', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                <?php if(isset($password_not_same_message) ): ?>
                                    <span class="help-block">
                                        <i class="fa fa-warning"></i>
                                        <?php echo isset($password_not_same_message) ? $password_not_same_message : ''; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputFname" class="col-sm-3 control-label">Re-Password</label>
                            <div class="col-sm-9">
                                <input type="password" id="customer_password2" name="customer_password2" class="form-control" placeholder="" value="">
                                <?php echo form_error('customer_password2', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                                <?php if(isset($password_not_same_message) ): ?>
                                    <span class="help-block">
                                        <i class="fa fa-warning"></i>
                                        <?php echo isset($password_not_same_message) ? $password_not_same_message : ''; ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>