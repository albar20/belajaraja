<div id="content-wrapper">
        <div class="page-header">
            <h1><span class="text-light-gray"><a href="<?php echo base_url()?>admin/customer"><?php echo ucwords('customer') ?></a> / </span><?php echo ucwords($heading)?></h1>
        </div> <!-- / .page-header -->
<!-- 5. $SUMMERNOTE_WYSIWYG_EDITOR =================================================================
        Summernote WYSIWYG-editor
-->
        <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js)-->
        <?php $this->load->view('admin/script_admin_code_mirror'); ?>
        <script type="text/javascript">
            function new_item(kode,field,table)
            {
                $("#add_item_"+table+"_"+kode).hide(); //hide submit button
                $("#loading_image_"+table+"_"+kode).show(); //show loading image
                console.log('masuk ke fungsinya bro');
                jQuery.ajax({
                    url: baseurl+"admin/user/add_item/"+kode+"/"+field+"/"+table, //Where to make Ajax calls
                    success:function(response){
                        $("#respond_item_"+table+"_"+kode).append(response);
                        // $("#respond_item"+kode).html(response);
                        $("#add_item_"+table+"_"+kode).show(); //show submit button
                        $("#loading_image_"+table+"_"+kode).hide(); //hide loading image
                        // alert(thrownError);
                        console.log('masuk ke ajax sukses');
                    },
                    error:function (xhr, ajaxOptions, thrownError){
                        console.log(thrownError);
                        $("#add_item_"+table+"_"+kode).show(); //show submit button
                        $("#loading_image_"+table+"_"+kode).hide(); //hide loading image
                        // alert(thrownError);
                    }
                });
            }
            function delete_item(kode,field,table)
            {
                var x;
                if (confirm("Anda yakin? Sekali dihapus, tidak dapat dikembalikan lagi.") == true) {
                    $("#delete_item_"+table+"_"+kode).hide(); //hide submit button
                    $("#loading_image_del_"+table+"_"+kode).show(); //show loading image
                    console.log('masuk ke fungsi delete');
                    
                    jQuery.ajax({
                        url: baseurl+"admin/user/delete_item/"+kode+"/"+field+"/"+table, //Where to make Ajax calls
                        success:function(response){
                            $("#target_item_"+table+"_"+kode).fadeOut();
                            $("#target_item_"+table+"_"+kode).hide();
                            $("#delete_item_"+table+"_"+kode).show(); //show submit button
                            $("#loading_del_image_"+table+"_"+kode).hide(); //hide loading image
                        },
                        error:function (xhr, ajaxOptions, thrownError){
                            console.log(thrownError);
                            $("#delete_item_"+table+"_"+kode).show(); //show submit button
                            $("#loading_del_image_"+table+"_"+kode).hide(); //hide loading image
                        }
                    });
                }
            }
        </script>
        <!-- Javascript -->
        <script>
            init.push(function () {
                $('#styled-finputs-example').pixelFileInput({ placeholder: 'Picture File Only' });
                
                $('#loading-example-btn').click(function () {
                    var btn = $(this);
                    btn.button('loading');
                    setTimeout(function () {
                        btn.button('reset');
                    }, 1500);
                });
                $('#bs-datepicker-component').datepicker();
                
            });
        </script>
        <!-- / Javascript -->
        <?php $this->load->view('admin/field/message_info'); ?>
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo $form_action?>" method="post" enctype="multipart/form-data" class="panel form-horizontal form-bordered">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo set_value('user_name', isset($default['user_name']) ? ucwords($default['user_name']) : ucwords($heading)); ?></span>
                    </div>
                    <div class="panel-body no-padding-hr">
                        <?php 
                            $datas['view_image']     =   true;
                            $this->load->view('admin/customer/add_customer_field',$datas); ?>
                    </div>
                    <div class="panel-footer text-right">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="<?php echo site_url('admin/customer')?>"><button class="btn btn-default" type="button">Back</button></a>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal -->
        <div id="myModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Data Gambar</h4>
                    </div>
                    <div class="modal-body">
                        <img width="100%" src="<?php echo base_url()?>uploads/customer/<?php echo set_value('customer_photo', isset($default['customer_photo']) ? $default['customer_photo'] : '3.jpg'); ?>">
                    </div> <!-- / .modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div> <!-- / .modal-content -->
            </div> <!-- / .modal-dialog -->
        </div> <!-- /.modal -->
        <!-- / Modal -->
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
        $("#forum_category_id").change(function(){
            var id = $("#forum_category_id").val();
            $.ajax({
                url:baseurl+'admin/user/get_subcategory/'+id,
                //data: "materi_id="+id,
                cache: false,
                success: function(msg){
                    //jika data sukses diambil dari server kita tampilkan
                    //di <select id=kota>
                    $("#forum_subcategory_id").html(msg);
                }
            });
          });
    });
    window.PixelAdmin.start(init);
</script>