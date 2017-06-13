                    <div class="col-sm-5 col-xs-12">
                        <div class="header-links">
                            <ul class="nav navbar-nav">
                                <li>
                                    <a href="<?php echo base_url()?>">
                                        <i class="fa fa-home hidden-lg hidden-md" title="Home"></i>
                                        <span class="hidden-sm hidden-xs">
                                            Home
                                        </span>
                                    </a>
                                </li>
                                <?php if( $this->session->userdata('login_customer') == true ): ?>  
                                <li>
                                    <a href="<?php echo base_url()?>wishlist">    
                                        <i class="fa fa-heart hidden-lg hidden-md" title="Wish List"></i>
                                        <span class="hidden-sm hidden-xs">
                                            Wish List( <?php echo $this->wishlist_total->total; ?> )
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>my_account">
                                        <i class="fa fa-user hidden-lg hidden-md" title="My Account"></i>
                                        <span class="hidden-sm hidden-xs">
                                            My Account
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url()?>my_order">
                                        <i class="fa fa-credit-card hidden-lg hidden-md" title="My Order"></i>
                                        <span class="hidden-sm hidden-xs">
                                            My Order
                                        </span>
                                    </a>
                                </li>
                                <?php endif ?> 
                                <li>
                                    <a href="<?php echo base_url()?>cart">
                                        <i class="fa fa-shopping-cart hidden-lg hidden-md" title="Shopping Cart"></i>
                                        <span class="hidden-sm hidden-xs">
                                            Shopping Cart
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo base_url()?>cart/checkout">
                                        <i class="fa fa-crosshairs hidden-lg hidden-md" title="checkout"></i>
                                        <span class="hidden-sm hidden-xs">
                                            Checkout
                                        </span>
                                    </a>
                                </li>
<?php if( $this->session->userdata('login_customer') != true ): ?>  
                                <li>
                                    <a href="<?php echo base_url()?>register">
                                        <i class="fa fa-unlock hidden-lg hidden-md" title="Register"></i>
                                        <span class="hidden-sm hidden-xs">
                                            Register
                                        </span>
                                    </a>
                                </li>
<?php endif ?> 
                                <?php if( $this->session->userdata('login_customer') == true ): ?>   
                                <li>
                                    <a href="<?php echo base_url()?>logout">
                                        <i class="fa fa-lock hidden-lg hidden-md" title="Logout"></i>
                                        <span class="hidden-sm hidden-xs">
                                            Logout
                                        </span>
                                    </a>
                                </li>
                                <?php else: ?>
                                    <li>
                                    <a href="<?php echo base_url()?>login">
                                        <i class="fa fa-lock hidden-lg hidden-md" title="Login"></i>
                                        <span class="hidden-sm hidden-xs">
                                            Login
                                        </span>
                                    </a>
                                </li>
                                <?php endif ?>   
                            </ul>
                        </div>
                    </div>