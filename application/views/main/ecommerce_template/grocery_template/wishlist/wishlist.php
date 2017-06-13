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
                1.  MY<div id="main-container" class="container">
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
                1.  INFORMASI KONTAK
                2.  ALAMAT PENAGIHAN / ALAMAT PENGIRIMAN
                3.  TAMBAH ALAMAT BARU
        =====================================================*/ ?>
        <div class="col-md-9 col-sm-9 col-xs-12">

            <!-- Breadcrumb Starts -->
            <?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/breadcrumb'); ?>
            <!-- Breadcrumb Ends -->
            
            <?php 
            /*=====================================================
                1.  INFORMASI KONTAK
            =====================================================*/ ?>
            <div class="product-filter" style="margin-top: 0;">
                <div class="row">
                    <div class="col-md-12">
                        <h2>My Wishlist</h2>
                    </div>
                </div>                       
            </div>
            <div class="row">
                <div class="datatables-wrapper">  
                    <table class="table table-striped table-hover table-bordered datatables">
                        <thead>
                            <tr>
                                <td class="text-center">
                                    Image
                                </td>
                                <td class="text-center">
                                    Product Name
                                </td>
                                <td class="text-center">
                                    Price
                                </td>
                                <td class="text-center">
                                    Action 
                                </td>

                            </tr>
                        </thead>
                        <tbody>
                            <?php if( count($wishlist->result()) > 0  ): ?>
                            <?php foreach( $wishlist->result() as $wl ): ?>
                            <tr>
                                <td class="text-center">
                                    <a href="product.html">
                                        <img src="<?php echo base_url() ?>uploads/product/<?php echo $wl->product_id ?>/thumb_<?php echo $wl->product_picture ?>" alt="Product Name" title="Product Name" class="img-thumbnail">
                                    </a>
                                </td>
                                <td class="text-center">
                                    <?php echo $wl->product_name; ?>
                                </td>
                                <td class="text-center">
                                    Rp. <?php echo number_format($wl->price); ?>
                                </td>
                                <td class="text-center">
                                     <a class="btn btn-success" href="http://ecommerce.babastudio.net/product/gemulaimont">Buy</a>
                                     <a class="btn btn-success" href="<?php echo site_url() ?>wishlist/delete/<?php echo $wl->product_id ?>">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>                             
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="clear"></div>
            <br/>
            
        </div>

    </div>
