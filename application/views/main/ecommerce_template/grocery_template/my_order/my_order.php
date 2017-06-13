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
        <div class="col-md-9 col-sm-9 col-xs-12 grocery">
            
            <!-- Breadcrumb Starts -->
            <?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/breadcrumb'); ?>
            <!-- Breadcrumb Ends -->


            <?php 
            /*=====================================================
                1.  MY ORDER
                    1.  KONFIRMASI PEMBAYARAN
                    2.  LAGI DI PROSES
                    3.  LUNAS 
                    4.  CANCEL
            =====================================================*/ ?>
            <div class="product-filter" style="margin-top: 0;">
                <div class="row">
                    <div class="col-md-12">
                        <h2>My Order</h2>
                    </div>
                </div>                       
            </div>
            <br/>
                
                <?php 
                /*=====================================================
                    1.  KONFIRMASI PEMBAYARAN
                =====================================================*/ ?>
                <div class="my_order_box">
                    <div class="product-filter" style="margin-top: 0; border-top:0">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Confirm Your Payment</h2>
                            </div>
                        </div>                       
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="datatables-wrapper">  
                                <table class="table table-striped table-hover table-bordered datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($pending->result() as $row) :?>
                                            <tr class="odd gradeX">
                                                <td><?=$i++?></td>
                                                <td class="center">
                                                    <?php if( $row->order_status == 'pending' ): ?>
                                                        <a href="<?php echo base_url() ?>payment/confirm/<?php echo $row->order_id?>" >
                                                            Confirm Payment Here
                                                        </a>
                                                    <?php endif; ?>
                                                    
                                                </td>
                                                <td><?php echo $row->order_date; ?></td>
                                                <td>
                                                    <?php echo 'Rp ' . number_format($row->order_total); ?>  
                                                </td>
                                                <td class="center">
                                                    <a href="<?php echo base_url() ?>my_order/lihat_pemesanan/<?php echo $row->order_id?>">
                                                        Look Order Details
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>

                <?php 
                /*=====================================================
                    2.  LAGI DI PROSES
                =====================================================*/ ?>
                <div class="my_order_box">
                    <div class="product-filter" style="margin-top: 0; border-top:0">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Waiting Approval Payment Confirmation</h2>
                            </div>
                        </div>                       
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="datatables-wrapper">  
                                <table class="table table-striped table-hover table-bordered datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($confirm->result() as $row) :?>
                                            <tr class="odd gradeX">
                                                <td><?=$i++?></td>
                                                <td class="center">
                                                    <?php if( $row->order_status == 'confirm' ): ?>
                                                        On Process
                                                    <?php endif; ?>
                                                    
                                                </td>
                                                <td><?php echo $row->order_date; ?></td>
                                                <td>
                                                    <?php echo 'Rp ' . number_format($row->order_total); ?>  
                                                </td>
                                                <td class="center">
                                                    <a href="<?php echo base_url() ?>my_order/lihat_pemesanan/<?php echo $row->order_id?>">
                                                        Order Details
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>

                <?php 
                /*=====================================================
                    3.  LUNAS 
                =====================================================*/ ?>
                <div class="my_order_box">
                    <div class="product-filter" style="margin-top: 0; border-top:0">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Order Success ( Paid )</h2>
                            </div>
                        </div>                       
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="datatables-wrapper">  
                                <table class="table table-striped table-hover table-bordered datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($approve->result() as $row) :?>
                                            <tr class="odd gradeX">
                                                <td><?=$i++?></td>
                                                <td class="center">
                                                    <?php if( $row->order_status == 'approve' ): ?>
                                                        Payment Success
                                                    <?php endif; ?>
                                                    
                                                </td>
                                                <td><?php echo $row->order_date; ?></td>
                                                <td>
                                                    <?php echo 'Rp ' . number_format($row->order_total); ?>  
                                                </td>
                                                <td class="center">
                                                    <a href="<?php echo base_url() ?>my_order/lihat_pemesanan/<?php echo $row->order_id?>">
                                                        Order Details
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>

                <?php 
                /*=====================================================
                    4.  CANCEL
                =====================================================*/ ?>
                <div class="my_order_box">
                    <div class="product-filter" style="margin-top: 0; border-top:0">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Order Cancellation</h2>
                            </div>
                        </div>                       
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="datatables-wrapper">  
                                <table class="table table-striped table-hover table-bordered datatables">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Status</th>
                                            <th>Order Date</th>
                                            <th>Total</th>
                                            <th>Problems</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            foreach($cancel->result() as $row) :?>
                                            <tr class="odd gradeX">
                                                <td><?=$i++?></td>
                                                <td class="center">
                                                    <?php if( $row->order_status == 'cancel' ): ?>
                                                        Cancel
                                                    <?php endif; ?>
                                                    
                                                </td>
                                                <td><?php echo $row->order_date; ?></td>
                                                <td>
                                                    <?php echo 'Rp ' . number_format($row->order_total); ?>  
                                                </td>
                                                <td>
                                                    <?php
                                                        if( $row->rekening_salah ){
                                                            echo 'Sent to Wrong Account';
                                                        }
                                                        if( $row->nominal_salah ){
                                                            echo ', Wrong Total Payment  ';
                                                        }
                                                    ?>  
                                                </td>
                                                <td class="center">
                                                    <a href="<?php echo base_url() ?>my_order/lihat_pemesanan/<?php echo $row->order_id?>">
                                                        Order Details
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="clear"></div>
            <br/>
        </div>

    </div>
