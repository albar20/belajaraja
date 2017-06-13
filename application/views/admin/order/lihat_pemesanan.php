<?php 
/*======================================================
    1.  ORDER DATE
    2.  PRODUCTS
    3.  PAYMENT RECEIPTS
    4.  CUSTOMER INFO & ALAMAT PENGIRIMAN
======================================================*/ ?>
<div id="content-wrapper" class="order-lihat-pemesanan">

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
                        $('#jq-datatables-example').dataTable();
                        $('#jq-datatables-example_wrapper .table-caption').text('Daftar Pemesanan');
                        $('#jq-datatables-example_wrapper .dataTables_filter input').attr('placeholder', 'Search...');
                    });
                </script>
                <!-- / Javascript -->

                <div class="panel">
                    <div class="panel-heading">
                        <span class="panel-title"><?php echo ucwords($heading)?></span>
                    </div>
                    <div class="panel-body">
                        <?php if($lihat_pemesanan->num_rows() > 0) : $i=1;?>
                            
                            <?php 
                            /*======================================================
                                1.  ORDER DATE
                            ======================================================*/ ?>
                            <?php $lp = $lihat_pemesanan->result_array(); ?> 
                            <h2>Customer Info</h2> 
                            <div class="col-md-12">
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables_normal_table" id="">
                                    <thead>
                                        <tr>    
                                            <th>Name</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td><?php echo $lp[0]['customer_fname'] ?></td>
                                            <td>
                                                <a target="blank" href="<?php echo base_url(); ?>admin/customer/update/<?php echo $lp[0]['customer_id'] ?>">
                                                Customer Details</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="clear"></div>

                            <?php 
                            /*======================================================
                                1.  ORDER DATE
                            ======================================================*/ ?>
                            <?php $lp = $lihat_pemesanan->result_array(); ?> 
                            <h2>Order Date</h2> 
                            <div class="col-md-12">
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables_normal_table" id="">
                                    <thead>
                                        <tr>    
                                            <th>Order Date</th>
                                            <th>Order ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td><?php echo $lp[0]['order_date'] ?></td>
                                            <td>
                                                <span class="order_id_dipemesanan">#<?php echo $lp[0]['order_id'] ?></span> 
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="clear"></div>
                            <?php 
                            /*======================================================
                                2.  PRODUCTS
                            ======================================================*/ ?>
                            <br/>
                            <div class="table-primary" id="tooltips-demo">
                                <h2>Order Products</h2> 
                                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                                    <thead>
                                        <tr>    
                                            <th>No</th>
                                            <th>Produk</th>
                                            <th>Jumlah</th>
                                            <th>Size</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $total_price = 0;
                                        foreach($lihat_pemesanan->result() as $row) :?>
                                        <tr class="odd gradeX">
                                            <td><?=$i++?></td>
                                            <td>
                                                <?php echo $row->product_name; ?>
                                            </td>
                                            <td>
                                                <?php echo $row->product_qty; ?>
                                            </td>
                                            <td>
                                                <?php echo $row->size_label; ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($row->product_price); ?>
                                            </td>
										    
                                        </tr>
                                    <?php 
                                        $total_price += $row->product_price-0;
                                        endforeach;?>
                                    </tbody>
                                    <tfoot>
                                        <tr class="odd gradeX">
                                            <td class="total_price" colspan="4">
                                                <strong>Discount</strong>
                                            </td>
                                            <td>
                                               Rp <?php echo number_format($row->order_discount); ?> 
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td class="total_price" colspan="4">
                                                <strong>Shipping Charge</strong>
                                            </td>
                                            <td>
                                               Rp <?php echo number_format($row->order_shipping_charge); ?> 
                                            </td>
                                        </tr>
                                        <tr class="odd gradeX">
                                            <td class="total_price" colspan="4">
                                                <strong>Total</strong>
                                            </td>
                                            <td>
                                               Rp <?php echo number_format($row->order_total); ?> 
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>


                            <?php 
                            /*======================================================
                                3.  PAYMENT RECEIPTS
                            ======================================================*/ ?>
                            <br/>
                            <div class="table-primary" id="tooltips-demo">
                                <h2>Payment Receipts</h2> 
                                <img width="500" src="<?php echo base_url(); ?>uploads/bukti_pembayaran/<?php echo $row->bukti_transfer; ?>" alt="" />
                            </div>

                            
                            <?php 
                            /*======================================================
                                 4.  CUSTOMER INFO & ALAMAT PENGIRIMAN
                            ======================================================*/ ?>
                            <br/>
                           <h2>Shipping Address</h2> 
                            <div class="table-primary" id="tooltips-demo">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables_normal_table" id="">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td>Recipient </td>
                                                <td><?php echo $lp[0]['nama_penerima'] ?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                                <td>Phone</td>
                                                <td><?php echo $lp[0]['no_telepon'] ?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                                <td>Full Address</td>
                                                <td><?php echo $lp[0]['alamat_lengkap'] ?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                                <td>Post Code</td>
                                                <td><?php echo $lp[0]['kode_pos'] ?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                                <td>Province</td>
                                                <td><?php echo $raja_ongkir['rajaongkir']['results']['province']  ?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                                <td>City</td>
                                                <td><?php echo $raja_ongkir['rajaongkir']['results']['city_name']  ?></td>
                                            </tr>
                                            <tr class="odd gradeX">
                                                <td>Courier</td>
                                                <td><?php echo $lp[0]['order_courier'] ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="clear:both"></div>
                            </div>


                            <?php if( $lp[0]['order_status'] == 'confirm' ): ?>
                                <br/>       
                                <a href="<?php echo base_url() ?>/admin/order/konfirmasi_pembayaran/<?php echo $lp[0]['order_id'] ?>" class="btn konfirmasi_button btn-primary">Confirmation / Cancellation </a>
                            <?php endif; ?>

                        <?php endif;?>
                    </div>
                </div>

                


            </div>
        </div>

    </div> <!-- / #content-wrapper -->
    <div id="main-menu-bg"></div>
</div> <!-- / #main-wrapper -->
<?php $this->load->view('admin/script_admin_below'); ?>
