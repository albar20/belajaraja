<script src="http://vitalets.github.io/x-editable/assets/mockjax/jquery.mockjax.js"></script>
            
<!-- momentjs --> 
<script src="http://vitalets.github.io/x-editable/assets/momentjs/moment.min.js"></script> 

<!-- select2 --> 
<script src="http://vitalets.github.io/x-editable/assets/select2/select2.js"></script>         

<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]--> 

 
<!-- bootstrap 3 -->
<script src="http://vitalets.github.io/x-editable/assets/bootstrap300/js/bootstrap.js"></script>

<!-- bootstrap-datetimepicker -->
<script src="http://vitalets.github.io/x-editable/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>        

<!-- x-editable (bootstrap 3) -->
<script src="http://vitalets.github.io/x-editable/assets/x-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>

<!-- select2 bootstrap -->

<!-- typeaheadjs -->
<script src="http://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/typeaheadjs/lib/typeahead.js"></script>         
<script src="http://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/typeaheadjs/typeaheadjs.js"></script>         



<!-- address input -->
<script src="http://vitalets.github.io/x-editable/assets/x-editable/inputs-ext/address/address.js"></script> 

<script type="text/javascript">
    $(function(){
        $( ".ui-accordion" ).accordion({
            heightStyle: "content",
            header: "> div > h3",
            active: false,
            collapsible: true,
        }).sortable({
            axis: "y",
            handle: "h3",
            stop: function( event, ui ) {
                // IE doesn't register the blur when sorting
                // so trigger focusout handlers to remove .ui-state-focus
                ui.item.children( "h3" ).triggerHandler( "focusout" );
            },
            update: function (event, ui) {
                var data = $(this).sortable('serialize');
                
                // POST to server using $.post or $.ajax
                $.ajax({
                    data: data,
                    type: 'POST',
                    url: baseurl+"admin/user/sorting/user_kursus_order/user_kursus_id/user_kursus"
                });

            } 
        });

        $(".form_editable").editable();

        $('.styled-finputs').pixelFileInput({ placeholder: 'Picture File Only', width:100 });
        
    });
</script>

<?php $query_kursus = $this->model_utama->get_data('kursus'); ?>
<div class="ui-accordion">
    <div class="group" id="target_item_user_kursus_<?php echo $row->user_kursus_id; ?>">
        <h3><strong>Kursus <?php echo $row->user_kursus_order; ?> : <?php echo set_value('kursus_id', isset($row->kursus_id) && $row->kursus_id != '' ? ucwords($this->model_utama->get_detail($row->kursus_id,'kursus_id','kursus')->row()->kursus_title) : ''); ?></strong></h3>
        <div>
            <table class="table">
                <tr>
                    <td>Kursus</td>
                    <td><a href="#" class="form_editable" data-type="select" data-source='[<?php if($query_kursus->num_rows() > 0) :  foreach($query_kursus->result() as $fg) : ?>{value: <?php echo $fg->kursus_id; ?>, text: "<?php echo $fg->kursus_title?>"}, <?php endforeach; endif; ?>]' data-pk="1" data-title="Ubah kursus"  data-url="<?php echo base_url()?>admin/kursus/update_field/kursus_id/<?php echo $row->user_kursus_id; ?>/user_kursus_id/user_kursus"><?php echo set_value('kursus_id', isset($row->kursus_id) ? $this->model_utama->get_detail($row->kursus_id,'kursus_id','kursus')->row()->kursus_title : ''); ?></a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Create Date</td>
                    <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo base_url()?>admin/kursus/update_field/create_date/<?php echo $row->user_kursus_id; ?>/user_kursus_id/user_kursus"><?php echo set_value('create_date', isset($row->create_date) ? $row->create_date : ''); ?></a></td>
                    <td></td>
                </tr>
            </table>
            <br>
            <p class="text-right">
                <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_user_kursus_<?php echo $row->user_kursus_id; ?>" onclick="delete_item('<?php echo $row->user_kursus_id?>','user_kursus_id','user_kursus')"><span class="btn-label icon fa fa-times"></span> Delete</button>
                <img src="http://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_user_kursus_<?php echo $row->user_kursus_id?>" style="display:none" /> 
            </p>
        </div>
    </div>
</div>