<?php 
/*=================================================
    1.  ORDER PENDING
    2.  ORDER CONFIRM
    3.  ORDER APPROVE 
    4.  ORDER CANCEL
=================================================*/ ?>
<div id="content-wrapper">

        <div class="page-header">
            <h1><?php echo strtoupper($heading)?></h1>
        </div> <!-- / .page-header -->

        <div class="row">
            <div class="col-sm-12">

                <!-- Javascript -->
                <script>
                    init.push(function () {
                        $('#tooltips-demo button').tooltip();
                        $('#tooltips-demo a').tooltip();
                        //$('#jq-datatables-example').dataTable();

                        $('.jq-datatables-example').DataTable( {
                            "footerCallback": function ( row, data, start, end, display ) {
                                var api = this.api(), data;
                     
                                // Remove the formatting to get integer data for summation
                                var intVal = function ( i ) {
                                    return typeof i === 'string' ?
                                        i.replace(/[\$,]/g, '')*1 :
                                        typeof i === 'number' ?
                                            i : 0;
                                };
                     
                                // Total over all pages
                                total = api
                                    .column( 4 )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0 );
                     
                                // Total over this page
                                pageTotal = api
                                    .column( 4, { page: 'current'} )
                                    .data()
                                    .reduce( function (a, b) {
                                        return intVal(a) + intVal(b);
                                    }, 0 );
                     
                                // Update footer
                                $( api.column( 4 ).footer() ).html(
                                    'Rp. '+pageTotal +' ( '+ total +' )'
                                );
                            }
                        } );


                       //$('.jq-datatables-example_wrapper .table-caption').text('Order List');

                        $('#order-pending-table_wrapper .table-caption').text('Order Pending');
                        $('#order-confirm-table_wrapper .table-caption').text('Order Confirm');
                        $('#order-approve-table_wrapper .table-caption').text('Order Approval');
                        $('#order-cancel-table_wrapper .table-caption').text('Order Cancel');

                        


                        $('.jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
                    });
                </script>
                <!-- / Javascript -->
                
                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo ucwords('Order Pending')?></span>
                    </div>
                    <div class="panel-body">
                        <br />
                        <?php 
                        /*=================================================
                            1.  ORDER PENDING
                        =================================================*/ ?>
                        <?php if($order_pending->num_rows() > 0) : $i=1;?>
                        <div class="table-primary" id="tooltips-demo">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered jq-datatables-example order-pending-table" 
                                id="order-pending-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order Date</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>   
                                        <th>Total</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" style="text-align:right">Total:</th>
                                        <th colspan="3"></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach($order_pending->result() as $row) :?>
                                    <tr class="odd gradeX">
                                        <td><?=$i++?></td>
                                        <td>
                                            <?php echo $row->order_date; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->order_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->customer_fname; ?>
                                        </td>
                                        <td>
                                            <?php //echo 'Rp ' . number_format($row->order_total); ?> 
                                            <?php echo $row->order_total ?>   
                                        </td>
                                        <td class="center">
                                            <a target="blank" href="<?php echo base_url() ?>admin/order/lihat_pemesanan/<?php echo $row->order_id?>">
                                                Look Order Details
                                            </a>
                                        </td>
                                        <td class="center">
                                            <?php if( $row->order_status == 'confirm' ): ?>
                                                <a href="<?php echo base_url() ?>admin/order/konfirmasi_pembayaran/<?php echo $row->order_id?>" >
                                                    <?php echo $row->order_status; ?>
                                                </a>
                                            <?php else: ?>
                                                <?php echo $row->order_status; ?>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach;?>   
                                </tbody>



                            </table>
                        </div>
                        <?php else :?>
                            <div class="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Warning!</strong> Data tidak ada</div>
                        <?php endif;?>

                        <?php 
                        /*=================================================
                            2.  ORDER CONFIRM
                        =================================================*/ ?>
                        <?php if($order_confirm->num_rows() > 0) : $i=1;?>
                        <div class="table-primary" id="tooltips-demo">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered jq-datatables-example order-confirm-table" 
                                 id="order-confirm-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order Date</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>   
                                        <th>Total</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" style="text-align:right">Total:</th>
                                        <th colspan="3"></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach($order_confirm->result() as $row) :?>
                                    <tr class="odd gradeX">
                                        <td><?=$i++?></td>
                                        <td>
                                            <?php echo $row->order_date; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->order_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->customer_fname; ?>
                                        </td>
                                        <td>
                                            <?php //echo 'Rp ' . number_format($row->order_total); ?> 
                                            <?php echo $row->order_total ?>   
                                        </td>
                                        <td class="center">
                                            <a target="blank" href="<?php echo base_url() ?>admin/order/lihat_pemesanan/<?php echo $row->order_id?>">
                                                Look Order Details
                                            </a>
                                        </td>
                                        <td class="center">
                                            <?php if( $row->order_status == 'confirm' ): ?>
                                                <a href="<?php echo base_url() ?>admin/order/konfirmasi_pembayaran/<?php echo $row->order_id?>" >
                                                    <?php echo $row->order_status; ?>
                                                </a>
                                            <?php else: ?>
                                                <?php echo $row->order_status; ?>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach;?>   
                                </tbody>



                            </table>
                        </div>
                        <?php else :?>
                            <div class="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Warning!</strong> Data tidak ada</div>
                        <?php endif;?>


                        <?php 
                        /*=================================================
                            3.  ORDER APPROVE 
                        =================================================*/ ?>
                        <?php if($order_approve->num_rows() > 0) : $i=1;?>
                        <div class="table-primary" id="tooltips-demo">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered jq-datatables-example order-approve-table" 
                                id="order-approve-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order Date</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>   
                                        <th>Total</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" style="text-align:right">Total:</th>
                                        <th colspan="3"></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach($order_approve->result() as $row) :?>
                                    <tr class="odd gradeX">
                                        <td><?=$i++?></td>
                                        <td>
                                            <?php echo $row->order_date; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->order_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->customer_fname; ?>
                                        </td>
                                        <td>
                                            <?php //echo 'Rp ' . number_format($row->order_total); ?> 
                                            <?php echo $row->order_total ?>   
                                        </td>
                                        <td class="center">
                                            <a target="blank" href="<?php echo base_url() ?>admin/order/lihat_pemesanan/<?php echo $row->order_id?>">
                                                Look Order Details
                                            </a>
                                        </td>
                                        <td class="center">
                                            <?php if( $row->order_status == 'confirm' ): ?>
                                                <a href="<?php echo base_url() ?>admin/order/konfirmasi_pembayaran/<?php echo $row->order_id?>" >
                                                    <?php echo $row->order_status; ?>
                                                </a>
                                            <?php else: ?>
                                                <?php echo $row->order_status; ?>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach;?>   
                                </tbody>



                            </table>
                        </div>
                        <?php else :?>
                            <div class="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Warning!</strong> Data tidak ada</div>
                        <?php endif;?>

                        <?php 
                        /*=================================================
                            4.  ORDER CANCEL
                        =================================================*/ ?>
                        <?php if($order_cancel->num_rows() > 0) : $i=1;?>
                        <div class="table-primary" id="tooltips-demo">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered jq-datatables-example order-cancel-table" 
                                id="order-cancel-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Order Date</th>
                                        <th>Order ID</th>
                                        <th>Customer</th>   
                                        <th>Total</th>
                                        <th>Problem</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="4" style="text-align:right">Total:</th>
                                        <th colspan="3"></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                <?php foreach($order_cancel->result() as $row) :?>
                                    <tr class="odd gradeX">
                                        <td><?=$i++?></td>
                                        <td>
                                            <?php echo $row->order_date; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->order_id; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->customer_fname; ?>
                                        </td>
                                        <td>
                                            <?php //echo 'Rp ' . number_format($row->order_total); ?> 
                                            <?php echo $row->order_total ?>   
                                        </td>
                                        <td>
                                            <?php
                                                if( $row->rekening_salah ){
                                                    echo 'Rekening Salah ';
                                                }
                                                if( $row->nominal_salah ){
                                                    echo 'Nominal Salah ';
                                                }
                                            ?>   
                                        </td>
                                        <td class="center">
                                            <a target="blank" href="<?php echo base_url() ?>admin/order/lihat_pemesanan/<?php echo $row->order_id?>">
                                                Look Order Details
                                            </a>
                                        </td>
                                        <td class="center">
                                            <?php if( $row->order_status == 'confirm' ): ?>
                                                <a href="<?php echo base_url() ?>admin/order/konfirmasi_pembayaran/<?php echo $row->order_id?>" >
                                                    <?php echo $row->order_status; ?>
                                                </a>
                                            <?php else: ?>
                                                <?php echo $row->order_status; ?>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach;?>   
                                </tbody>



                            </table>
                        </div>
                        <?php else :?>
                            <div class="alert">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Warning!</strong> Data tidak ada</div>
                        <?php endif;?>



                    </div>
                </div>



            </div>
        </div>

    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<?php $this->load->view('admin/script_admin_below'); ?>