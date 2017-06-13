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

            <?php if($customer->num_rows() > 0) : $i=1;?>
            <?php $cs = $customer->result_array(); ?>     
            <?php 
            /*=====================================================
                1.  INFORMASI KONTAK
            =====================================================*/ ?>
            <?php $this->load->view('main/field/message_info'); ?>

            <div class="product-filter" style="margin-top: 0;">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Contact Information</h2>
                    </div>
                </div>                       
            </div>
            <div class="row">
                <div class="table-primary" id="tooltips-demo">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <span class="col-md-3 col-sm-3 col-xs-3">Name</span>
                        <span class="col-md-9 col-sm-9 col-xs-9"><?php echo $cs[0]['customer_fname'] ?></span>
                        <div class="clear"></div>
                        <br/>
                        <span class="col-md-3 col-sm-3 col-xs-3">Email</span>
                        <span class="col-md-9 col-sm-9 col-xs-9"><?php echo $cs[0]['customer_email'] ?></span>
                        <div class="clear"></div>
                        <br/>
                        <span class="col-md-3 col-sm-3 col-xs-3">Birthday</span>
                        <span class="col-md-9 col-sm-9 col-xs-9"><?php echo $cs[0]['customer_birthday'] ?></span>
                        <div class="clear"></div>
                        <br/>
                        <div class="col-md-5">
                            <a class="btn btn-main" href="<?php echo base_url() ?>my_account/edit_customer/<?php echo $cs[0]['customer_id'] ?>">Edit</a>
                        </div> 
                    </div>
                    
                </div>
                <?php endif;?>
            </div>
            <div class="clear"></div>
            <br/>


            <?php 
            /*=====================================================
                2.  ALAMAT PENAGIHAN / ALAMAT PENGIRIMAN
            =====================================================*/ ?>
            <div class="product-filter" style="margin-top: 0;">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Billing Address / Shipping Address</h2>
                    </div>
                </div>                       
            </div>
            <div class="row">
            <?php if( count($customer_address->result()) > 0 ): ?> 
                <div class="col-md-10 col-sm-10 col-xs-12 my_account">
                    <div class="genap">
                        <br/>
                        <div class="col-md-10 col-sm-10 col-xs-8">
                            <span class="bold">Address</span>
                        </div> 
                        <div class="col-md-2 col-sm-2 col-xs-4">
                            <span class="bold">Shipping</span>    
                        </div>
                        <div class="clear"></div>
                        <br/>
                    </div>
                    <?php 
                        $x = 0;
                        $row_type = 'genap';
                        foreach($customer_address->result() as $ca ): 
                            if( $row_type == 'genap' ){
                                $row_type = 'ganjil';
                            }else{
                                $row_type = 'genap';
                            }
                        ?>
                        <div class="<?php echo $row_type; ?>">
                            <div class="col-md-10 col-sm-10 col-xs-8">
                                <br/>
                                <span><?php echo $ca->nama_penerima ?></span> , 
                                <span><?php echo $ca->no_telepon ?></span>
                                <div class="alamat_lengkap">
                                    <?php echo $ca->alamat_lengkap ?>
                                </div>
                                <br/>   
                                <span>
                                    <a  id="<?php echo $ca->customer_address_id ?>" 
                                        class="btn btn-main ubah_alamat_baru_button">Edit</a>
                                </span>
                                <?php if( $x != 0 ): ?>
                                    <span><a href="<?php echo base_url() ?>my_account/hapus_alamat/<?php echo $ca->customer_address_id ?>" class="btn btn-main">Delete</a></span>
                                <?php endif; ?>  
                            </div> 
                            <div class="col-md-2 col-sm-2 col-xs-4">
                                <br/>
                                <?php   
                                    $selected = '';
                                    if( $ca->default_column == '1' ){
                                        $selected = 'checked="checked"';
                                    }
                                ?>
                                <input <?php echo $selected ?> type="radio" name="pengiriman_id[]" class="pengiriman_id" value="<?php echo $ca->customer_address_id ?>" />
                            </div>

                            <div class="clear"></div>
                            <br/>
                        </div>
                    <?php 
                        $x++;
                        endforeach ?>
                    <div class="clear"></div>
                    <br/>
                    <div class="col-md-6 col-sm-4 col-xs-12">
                        <input type="button" id="show_tambah_alamat_form" value="Add New Address" class="btn btn-main" />
                    </div> 
                </div> 
            <?php endif;?>   
            </div>
            <div class="clear"></div>
            <br/>  
            

            <?php 
            /*======================================================
                3.  TAMBAH ALAMAT BARU
            ======================================================*/
            $display_style = '';  
            if(     isset($validation_false)
                &&  $validation_false 
            ){
                $display_style = "display:block;";
            } 
            ?>
            <div class="col-md-12 col-sm-12 col-xs-12 tambah_alamat_form" style="<?php echo $display_style; ?>" >
                <form method="post" >
                <h2></h2>
                <div class="product-filter" style="margin-top: 0;">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>Adding New Address Form</h2>
                        </div>
                    </div>                       
                </div>

                <input type="hidden" class="customer_address_id form-control" name="customer_address_id" 
                    value="<?php echo set_value('customer_address_id', isset($default['customer_address_id']) ? $default['customer_address_id'] : ''); ?>" />
                <div>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        Recipient Name
                    </div> 
                    <div class="col-md-4 col-sm-8 col-xs-12">
                        <input type="text" class="form-control" name="nama_penerima" id="nama_penerima" required="required" 
                            value="<?php echo set_value('nama_penerima', isset($default['nama_penerima']) ? $default['nama_penerima'] : ''); ?>" />
                        <?php echo form_error('nama_penerima', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                    </div>
                    <div class="clear"></div>
                    <br/>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        Telephone
                    </div> 
                    <div class="col-md-4 col-sm-8 col-xs-12">
                        <input type="text" class="form-control" name="no_telepon" id="no_telepon" required="required" 
                            value="<?php echo set_value('no_telepon', isset($default['no_telepon']) ? $default['no_telepon'] : ''); ?>" />
                        <?php echo form_error('no_telepon', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                    </div>
                    <div class="clear"></div>
                    <br/>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        Full Address
                    </div> 
                    <div class="col-md-4 col-sm-8 col-xs-12">
                        <textarea id="alamat_lengkap" class="form-control" name="alamat_lengkap" required="required" ><?php echo set_value('alamat_lengkap', isset($default['alamat_lengkap']) ? $default['alamat_lengkap'] : ''); ?></textarea>
                        <?php echo form_error('alamat_lengkap', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                    </div>
                    <div class="clear"></div>
                    <br/>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        Post Code 
                    </div> 
                    <div class="col-md-4 col-sm-8 col-xs-12">
                        <input type="text" class="form-control" name="kode_pos" id="kode_pos" required="required" 
                            value="<?php echo set_value('kode_pos', isset($default['kode_pos']) ? $default['kode_pos'] : ''); ?>" />
                        <?php echo form_error('kode_pos', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                    </div>
                    <div class="clear"></div>
                    <br/>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        Province
                    </div> 
                    <div class="col-md-4 col-sm-8 col-xs-12">
                        <select class="form-control" id="province_id" name="province_id" required="required">
                            <?php foreach( $province as $pr ): ?>
                                <option value="<?php echo $pr['id'] ?>"
                                    <?php echo set_select('province_id', 'laki', isset($default['province_id']) && $default['province_id'] == $pr['id'] ? TRUE : FALSE); ?>
                                ><?php echo $pr['nama'] ?></option>
                            <?php endforeach;?>
                        </select>
                        <?php echo form_error('province_id', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                    </div>
                    <div class="clear"></div>
                    <br/>
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        City
                    </div> 
                    <div class="col-md-4 col-sm-8 col-xs-12">
                        <select class="form-control" id="city_id" name="city_id" required="required" >
                            <?php foreach( $city as $ct ): ?>
                                <option value="<?php echo $ct['id'] ?>"
                                    <?php echo set_select('city_id', 'laki', isset($default['city_id']) && $default['city_id'] == $ct['id'] ? TRUE : FALSE); ?>
                                ><?php echo $ct['nama'] ?></option>
                            <?php endforeach;?>
                            <br/>        
                        </select>
                        <?php echo form_error('city_id', '<span class="help-block"><i class="fa fa-warning"></i> ', '</span>'); ?>
                    </div>
                    <div class="clear"></div>
                    <br/>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <input type="submit" class="btn btn-main tambah_alamat_baru" name="" id="" value="Save" />
                            <div class="clear"></div>                 
                            <br/>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <input type="button" class="btn btn-main cancel_tambah_alamat" name="" id="" value="Cancel" />
                        </div>
                        
                    </div>

                </div>
                </form>
            </div> 

        </div>

    </div>
