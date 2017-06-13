<?php 
/*=============================================================
	1.	GENERAL 
	2. 	FOOTER
=============================================================*/ ?>
	<div id="content-wrapper">

        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo site_url('admin/dashboard')?>"><?php echo ucwords('dashboard') ?></a> / </span><?php echo ucwords($heading)?></h1>
        </div> <!-- / .page-header -->

        <?php $this->load->view('admin/field/message_info'); ?>

        <form action="#" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
            <div class="panel-heading">
                <span class="panel-title"><?php echo set_value('heading', isset($heading) ? ucwords($heading) : ''); ?></span>
            </div>
            <div class="panel-body no-padding-hr">
                
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <label class="col-sm-2 control-label">Logo Website</label>
                        <div class="col-sm-8">
                            <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                                <!-- <h4 id='loading' >loading..</h4>
                                <div id="message"></div>
                                <hr id="line"> -->
                                <br/>
                                <div id="selectImage">
                                    <label>Select Your Image</label><br/>
                                
                                    <input type="file" name="userfile" id="file" required /><br>
                                    <img src="<?php echo base_url() ?>uploads/logo/<?php echo set_value('website_logo', isset($default['website_logo']) ? $default['website_logo'] : ''); ?>" width="200">
                                    <div class="clear"></div>
                                    <br/>
                                    <button type="submit" class="btn btn-success submit" >Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <label class="col-sm-2 control-label">Nama Website</label>
                        <div class="col-sm-8">
                            <a href="#" class="form_editable" data-type="text" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/website_name/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('website_name', isset($default['website_name']) ? $default['website_name'] : ''); ?></a>
                        </div>
                    </div>
                </div>
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <label class="col-sm-2 control-label">Deskripsi Website</label>
                        <div class="col-sm-8">
                            <a href="#" class="form_editable" data-type="text" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/website_description/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('website_description', isset($default['website_description']) ? $default['website_description'] : ''); ?></a>
                        </div>
                    </div>
                </div>
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <label class="col-sm-2 control-label">Website Meta Description</label>
                        <div class="col-sm-8">
                            <a href="#" class="form_editable" data-type="text" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/website_meta_description/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('website_meta_description', isset($default['website_meta_description']) ? $default['website_meta_description'] : ''); ?></a>
                        </div>
                    </div>
                </div>
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <label class="col-sm-2 control-label">Facebook</label>
                        <div class="col-sm-8">
                            <a href="#" class="form_editable" data-type="text" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/facebook/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('facebook', isset($default['facebook']) ? $default['facebook'] : ''); ?></a>
                        </div>
                    </div>
                </div>
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <label class="col-sm-2 control-label">Google</label>
                        <div class="col-sm-8">
                            <a href="#" class="form_editable" data-type="text" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/google/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('google', isset($default['google']) ? $default['google'] : ''); ?></a>
                        </div>
                    </div>
                </div>
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <label class="col-sm-2 control-label">Twitter</label>
                        <div class="col-sm-8">
                            <a href="#" class="form_editable" data-type="text" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/twitter/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('twitter', isset($default['twitter']) ? $default['twitter'] : ''); ?></a>
                        </div>
                    </div>
                </div>
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <label class="col-sm-2 control-label">Instagram</label>
                        <div class="col-sm-8">
                            <a href="#" class="form_editable" data-type="text" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/instagram/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('instagram', isset($default['instagram']) ? $default['instagram'] : ''); ?></a>
                        </div>
                    </div>
                </div>
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <label class="col-sm-2 control-label">Analytics</label>
                        <div class="col-sm-8">
                            <a href="#" class="form_editable" data-type="textarea" data-inputclass="some_class" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/analytics/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('analytics', isset($default['analytics']) ? $default['analytics'] : ''); ?></a>
                            <style type="text/css">.some_class { width: 260px !important; }</style>
                        </div>
                    </div>
                </div>
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                        <label class="col-sm-2 control-label">Chat</label>
                        <div class="col-sm-8">
                            <a href="#" class="form_editable" data-type="textarea" data-inputclass="some_class" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/chat/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('chat', isset($default['chat']) ? $default['chat'] : ''); ?></a>
                            <style type="text/css">.some_class { width: 260px !important; }</style>
                        </div>
                    </div>
                </div>
                

				<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
					 	<label class="col-sm-2 control-label">Template</label>
                        <div class="col-sm-8">
                            <a href="#" 
                                class="form_editable" 
                                <?php
                                if( count($template_list->result()) > 0 ): ?>
                                <?php 
                                    $data_source = '';
                                    $p = 1;
                                    foreach( $template_list->result() as $tl ){
                                        $separator = ',';
                                        if( count($template_list->result()) == $p ){
                                            $separator = '';   
                                        }
                                        $data_source .= "{value: '".$tl->template_id."',text: '".$tl->template_name."'}".$separator;
                                        $p++;
                                    }
                                ?>
                                <?php endif; ?>
                                data-source="[<?php echo $data_source ?>]" 
                                data-type="select" 
                                data-pk="1" 
                                data-mode="inline"  
                                data-title="Ubah data"  
                                data-url="<?php echo base_url()?>admin/setting/update_themes/"><?php echo $template_list_active->template_name; ?></a>
                        </div>
					</div>
                </div>	
            </div>
        </form>
		
		<?php 
		/*=============================================================
			2. 	FOOTER
		=============================================================*/ ?>
        <form action="#" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
            <div class="panel-heading">
                <span class="panel-title">Setting Footer</span>
            </div>
            <div class="panel-body no-padding-hr">
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="row">
                       	<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
		                    <div class="row">
		                        <label class="col-sm-2 control-label">Nama Perusahaan</label>
		                        <div class="col-sm-8">
		                            <a href="#" class="form_editable" data-type="textarea" data-inputclass="some_class" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/nama_perusahaan/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('nama_perusahaan', isset($default['nama_perusahaan']) ? $default['nama_perusahaan'] : ''); ?></a>
		                            <style type="text/css">.some_class { width: 260px !important; }</style>
		                        </div>
		                    </div>
		                </div>
		                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
		                    <div class="row">
		                        <label class="col-sm-2 control-label">Alamat Perusahaan</label>
		                        <div class="col-sm-8">
		                            <a href="#" class="form_editable" data-type="textarea" data-inputclass="some_class" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/alamat_perusahaan/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('alamat_perusahaan', isset($default['alamat_perusahaan']) ? $default['alamat_perusahaan'] : ''); ?></a>
		                            <style type="text/css">.some_class { width: 260px !important; }</style>
		                        </div>
		                    </div>
		                </div>
		                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
		                    <div class="row">
		                        <label class="col-sm-2 control-label">Email Perusahaan</label>
		                        <div class="col-sm-8">
		                            <a href="#" class="form_editable" data-type="textarea" data-inputclass="some_class" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/email_perusahaan/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('email_perusahaan', isset($default['email_perusahaan']) ? $default['email_perusahaan'] : ''); ?></a>
		                            <style type="text/css">.some_class { width: 260px !important; }</style>
		                        </div>
		                    </div>
		                </div>
		                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
		                    <div class="row">
		                        <label class="col-sm-2 control-label">Telepon Perusahaan</label>
		                        <div class="col-sm-8">
		                            <a href="#" class="form_editable" data-type="textarea" data-inputclass="some_class" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/telepon_perusahaan/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('telepon_perusahaan', isset($default['telepon_perusahaan']) ? $default['telepon_perusahaan'] : ''); ?></a>
		                            <style type="text/css">.some_class { width: 260px !important; }</style>
		                        </div>
		                    </div>
		                </div>
		                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
		                    <div class="row">
		                        <label class="col-sm-2 control-label">copyright</label>
		                        <div class="col-sm-8">
		                            <a href="#" class="form_editable" data-type="textarea" data-inputclass="some_class" data-pk="1" data-mode="inline"  data-title="Ubah data"  data-url="<?php echo base_url()?>admin/setting/update_field/copyright/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting"><?php echo set_value('copyright', isset($default['copyright']) ? $default['copyright'] : ''); ?></a>
		                            <style type="text/css">.some_class { width: 260px !important; }</style>
		                        </div>
		                    </div>
		                </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="row">
                                <label class="col-sm-2 control-label">BCA Gambar</label>
                                <div class="col-sm-8">
                                    <a href="#" 
                                        class="form_editable" 
                                        data-source="[{value: '1', text: 'Aktif'},{value: '0', text: 'Tidak Aktif'}]"
                                        data-type="select" 
                                        data-pk="1" 
                                        data-mode="inline"  
                                        data-title="Ubah data"  
                                        data-url="<?php echo base_url()?>admin/setting/update_field/bca_gambar/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting">
                                            <?php echo set_value('bca_gambar', isset($default['bca_gambar']) && $default['bca_gambar'] == '1' ? 'Aktif' : 'Tidak Aktif'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="row">
                                <label class="col-sm-2 control-label">Mandiri Gambar</label>
                                <div class="col-sm-8">
                                    <a href="#" 
                                        class="form_editable" 
                                        data-source="[{value: '1', text: 'Aktif'},{value: '0', text: 'Tidak Aktif'}]"
                                        data-type="select" 
                                        data-pk="1" 
                                        data-mode="inline"  
                                        data-title="Ubah data"  
                                        data-url="<?php echo base_url()?>admin/setting/update_field/mandiri_gambar/<?php echo set_value('setting_id', isset($default['setting_id']) ? $default['setting_id'] : ''); ?>/setting_id/setting">
                                            <?php echo set_value('mandiri_gambar', isset($default['mandiri_gambar']) && $default['mandiri_gambar'] == '1' ? 'Aktif' : 'Tidak Aktif'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>    

                    </div>
                </div>
            </div>
        </form>
		
       
<!-- /5. $SUMMERNOTE_WYSIWYG_EDITOR -->


    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
    <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url()?>assets/general/js/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
    <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->
<script src="<?php echo base_url()?>assets/general/js/jquery.transit.js"></script>
<!-- Pixel Admin's javascripts -->
<script src="<?php echo base_url()?>assets/general/js/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/pixel-admin.min.js"></script>




<script type="text/javascript">
    var baseurl = '<?php echo base_url()?>';
    init.push(function () {
        // Javascript code here
        $('.form_editable').editable();
        // $('.form_editable').editable({
        //     success: function(response, newValue) {
        //         alert(response);
        //     }
        // }); 
        
    });
    window.PixelAdmin.start(init);


   


</script>