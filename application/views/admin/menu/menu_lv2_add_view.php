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
        $('.form_editable').editable();

        $( ".ui-menu_lv2" ).accordion({
            heightStyle: "content",
            header: "> div > h3"
        }).sortable({
            axis: "y",
            handle: "h3",
            stop: function( event, ui ) {
                // IE doesn't register the blur when sorting
                // so trigger focusout handlers to remove .ui-state-focus
                ui.item.children( "h3" ).triggerHandler( "focusout" );
            }
        });

    });
</script>

<div class="ui-menu_lv2">        
    <div class="group" id="target_item_menu_lv2_<?php echo $menu_lv2->menu_lv2_id; ?>">
        <h3><strong>Sub Menu_2 : <?php echo set_value('menu_lv2_id', isset($menu_lv2->menu_lv2_id) ? $menu_lv2->menu_lv2_title : ''); ?></strong></h3>
        <div>
            <table class="table">
                <tr>
                    <td width="20%">Nama Menu</td>
                    <td><a href="#" class="form_editable" data-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_lv2_title/'.$menu_lv2->menu_lv2_id.'/menu_lv2_id/menu_lv2'); ?>"><?php echo set_value('menu_lv2_title', isset($menu_lv2->menu_lv2_title) ? $menu_lv2->menu_lv2_title : ''); ?></a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Link menu_lv2</td>
                    <td><a href="#" class="form_editable" ddata-type="text" data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_lv2_link/'.$menu_lv2->menu_lv2_id.'/menu_lv2_id/menu_lv2'); ?>"><?php echo set_value('menu_lv2_link', isset($menu_lv2->menu_lv2_link) ? $menu_lv2->menu_lv2_link : ''); ?></a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Buka tab baru ?</td>
                    <td><a href="#" class="form_editable" data-type="select" data-source='[{value: "in", text: "Tidak"},{value: "out", text: "Ya"}, ]' data-pk="1" data-title="Ubah data"  data-url="<?php echo site_url('admin/menu/update_field/menu_lv2_type/'.$menu_lv2->menu_lv2_id.'/menu_lv2_id/menu_lv2'); ?>"><?php echo set_value('menu_lv2_type', isset($menu_lv2->menu_lv2_type) && $menu_lv2->menu_lv2_type == 'out' ? 'Ya' : 'Tidak'); ?></a></td>
                    <td></td>
                </tr>
            </table>
            <p class="text-right">
                <button class="btn btn-labeled btn-danger btn-xs" type="button" id="delete_item_menu_lv2_<?php echo $menu_lv2->menu_lv2_id; ?>" onclick="delete_item('<?php echo $menu_lv2->menu_lv2_id?>','menu_lv2_id','menu_lv2')"><span class="btn-label icon fa fa-times"></span> Delete menu_lv2</button>
                <img src="https://sekolahpintar.com/assets/img/input-spinner.gif" id="loading_image_del_menu_lv2_<?php echo $menu_lv2->menu_lv2_id?>" style="display:none" /> 
            </p>
        </div>
    </div>
</div>