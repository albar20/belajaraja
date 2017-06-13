                
                 <ul class="list-unstyled list-inline text-uppercase menu">
                    <li><a href="<?php echo base_url()?>">Home</a></li>
                    <?php if( $this->session->userdata('login_customer') == true ): ?>  
                        <li><a href="<?php echo base_url()?>wishlist">Wish List( <?php echo $this->wishlist_total->total; ?> )</a></li>
                        <li><a href="<?php echo base_url()?>my_account">My Account</a></li>
                        <li><a href="<?php echo base_url()?>my_order">My Order</a></li>
                    <?php endif ?> 
                    <li><a href="<?php echo base_url()?>cart">Shopping Cart</a></li>
                    <li><a href="<?php echo base_url()?>cart/checkout">Checkout</a></li>
                    <?php if( $this->session->userdata('login_customer') != true ): ?>  
                                <li><a href="<?php echo base_url()?>register">Register</a></li>
                            <?php endif ?> 

                    <?php if( $this->session->userdata('login_customer') == true ): ?>
                    <li><a href="<?php echo base_url()?>logout">Logout</a></li>
                    <?php else: ?>
                    <li><a href="<?php echo base_url()?>login">Login</a></li>
                    <?php endif ?> 
                </ul>


        