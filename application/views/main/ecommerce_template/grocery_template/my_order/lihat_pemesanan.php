<?php 
/*=====================================================
    2.  SIDEBAR LEFT
        1.  MY ACCOUNT 
        2.  MY WISHLIST
        3.  MY ORDER
    3.  MAIN CONTENT
        1.  MY ORDER
=====================================================*/ ?>


    <div class="row">   
        <?php 
        /*=====================================================
            2.  SIDEBAR LEFT
                1.  MY ACCOUNT 
                2.  MY WISHLIST
                3.  MY ORDER
        =====================================================*/ ?>
        <div class="col-md-3 col-sm-3 col-xs-12">

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
                1.  MY ORDER
        =====================================================*/ ?>
        <div class="col-md-9 col-sm-9 col-xs-12 digi">
            
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url() ?>">Home</a></li>
                <li><a href="<?php echo base_url() ?>my_order">My Order</a></li>
                <li class="active">Order Details</li>
            </ol>


            <?php 
            /*=====================================================
                1.  MY ORDER
                    1.  ORDER DATE
                    2.  SHIPPING ADDRESS
                    3.  PRODUCTS DETAIL PRICE
            =====================================================*/ ?>
            <div class="product-filter" style="margin-top: 0;">
                <div class="row">
                    <div class="col-md-12">
                        <h2>My Order Details</h2>
                    </div>
                </div>                       
            </div>
            <?php if($lihat_pemesanan->num_rows() > 0) : $i=1;?>

            
            <?php 
            /*=====================================================
                1.  ORDER DATE
            =====================================================*/ ?>
            <div class="my_order_box">
                <div class="product-filter" style="margin-top: 0;">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Order Date</h3>
                        </div>
                    </div>                       
                </div>
                <div class="row">
                    
                    <?php 
                    /*======================================================
                        1.  ALAMAT
                    ======================================================*/ ?>
                    <?php $lp = $lihat_pemesanan->result_array(); ?> 
                    
                    <div class="col-md-12">
                        <div class="datatables-wrapper">
                            <p>
                                <span class="bold">Order Date :</span>
                                <br/>
                                <span><?php echo $lp[0]['order_date'] ?></span>
                            </p>
                            <p>
                                <span class="bold">Order Id :</span>
                                <br/>
                                <span class="order_id_front"><?php echo $lp[0]['order_id'] ?></span>
                            </p>
                            <br/>
                        </div>
                    </div>     
                </div>
            </div>

            <?php 
            /*=====================================================
                2.  SHIPPING ADDRESS
            =====================================================*/ ?>
            <div class="my_order_box">
                <div class="product-filter" style="margin-top: 0;">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Shipping Address</h3>
                        </div>
                    </div>                       
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="datatables-wrapper">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="">
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
                    </div>      
                </div>
            </div>

           



            <?php 
            /*=====================================================
                3.  PRODUCTS DETAIL PRICE
                    1.  FOR DESKTOP 
                    2.  FOR MOBILE
            =====================================================*/ ?>
            <div class="my_order_box">
                <div class="product-filter" style="margin-top: 0;">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Order Products</h3>
                        </div>
                    </div>                       
                </div>

                <?php 
                /*=====================================================
                    1.  FOR DESKTOP 
                =====================================================*/ ?>
                <div class="row hidden-xs">
                    <div class="col-md-12">
                        <div class="datatables-wrapper">
                    
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered datatables" id="jq-datatables-example">
                                <thead>
                                    <tr>    
                                        <th>No</th>
                                        <th>Product</th>
                                        <th>Total</th>
                                        <th>Decriptions</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $total_price    = 0;
                                    $order_status   = '';
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
                                            <?php echo $row->product_description; ?>
                                        </td>
                                        <td>
                                            <?php echo number_format($row->product_price); ?>
                                        </td>
                                    </tr>
                                <?php 
                                    $total_price += $row->product_price-0;
                                    $order_status = $row->order_status; 
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
                            <br/>
                            <?php if( $order_status == 'pending' ): ?>
                            <a class="btn btn-default" href="<?php echo base_url() ?>payment/confirm/<?php echo $lp[0]['order_id']; ?>" >
                                Confirm Payment Here
                            </a>
                            <?php endif; ?>
                            <br/>
                            <br/>
                        </div>
                    </div>
                </div>


                <?php 
                /*=====================================================
                    2.  FOR MOBILE
                =====================================================*/ ?>
                <div class="row mobile-order-products hidden-lg hidden-md hidden-sm ">
                    <div class="col-md-12">
                        <div class="datatables-wrapper">
                        
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="">
                                <thead>
                                </thead>
                                <tbody>
                                    <?php 
                                        $total_price = 0;
                                        foreach($lihat_pemesanan->result() as $row) :?>
                                    <tr class="odd gradeX first-row">
                                        <td class="bold">Product </td>
                                        <td><?php echo $row->product_name; ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>Quantity</td>
                                        <td><?php echo $row->product_qty; ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>Description</td>
                                        <td><?php echo $row->product_description; ?></td>
                                    </tr>
                                    <tr class="odd gradeX last-row">
                                        <td>Price</td>
                                        <td><?php echo number_format($row->product_price); ?></td>
                                    </tr>
                                    <?php 
                                        $total_price += $row->product_price-0;
                                        endforeach;?>
                                </tbody>
                            </table>

                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="">
                                <thead>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
                                        <td class="bold">Discount :</td>
                                        <td>Rp <?php echo number_format($row->order_discount); ?></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td class="bold">Shipping Charge</td>
                                        <td>Rp <?php echo number_format($row->order_shipping_charge); ?> </td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td class="bold">Total</td>
                                        <td>Rp <?php echo number_format($row->order_total); ?> </td>
                                    </tr>
                                </tbody>
                            </table>
                            <br/>
                            <a class="btn btn-default" href="<?php echo base_url() ?>payment/confirm/<?php echo $lp[0]['order_id']; ?>" >
                                Confirm Payment Here
                            </a>
                            <br/>
                            <br/>

                        </div>
                    </div>
                </div>


            </div>
            <?php endif;?>
            <div class="clear"></div>
            <br/>
        </div>

    </div>
