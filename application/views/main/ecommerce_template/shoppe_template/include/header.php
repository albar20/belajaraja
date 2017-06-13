<?php 
/*================================================================================
	1.	NAVIGATION
	2.	SEARCH
	2.	LOGO
	3.	SHOPPING CART
	4.	CATEGORY NAVIGATION
================================================================================*/ ?>	

	<!-- Header Section Starts -->
	<header id="header-area">
		<!-- Header Top Starts -->
		<div class="header-top">
			<div class="container">					
				
				<?php 
				/*================================================================================
					1.	NAVIGATION
				================================================================================*/ ?>	
				<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/menu')?>
				
			</div>
		</div>
		<!-- Header Top Ends -->
		<!-- Starts -->
		<div class="container">
		<!-- Main Header Starts -->
			<div class="main-header">
				<div class="row">
					<?php 
					/*================================================================================
						2.	SEARCH
					================================================================================*/ ?>					
					<!-- Search Starts -->
					<div class="col-md-3">
						<div id="search">
							<div class="input-group">
							  <input type="text" class="form-control input-lg" id="search_top_keyword"  placeholder="Search">
							  <span class="input-group-btn">
								<button class="btn btn-lg" type="button" id="search_button_top">
									<i class="fa fa-search"></i>
								</button>
							  </span>
							</div>
						</div>	
					</div>
					<!-- Search Ends -->
					<?php 
					/*================================================================================
						2.	LOGO
					================================================================================*/ ?>	
					<!-- Logo Starts -->
					<div class="col-md-6">
						<div id="logo">
							<a href="<?php echo base_url() ?>"><img style="width:119px;height:60px;" src="<?php echo base_url() ?>uploads/logo/thumb/<?php echo $this->setting->website_logo ?>" title="Fit In Beauty" alt="fitinbeauty" class="img-responsive" /></a>
						</div>
					</div>
					<!-- Logo Starts -->
					
					<?php 
					/*================================================================================
						3.	SHOPPING CART
					================================================================================*/ ?>	
					<!-- Shopping Cart Starts -->
					<div class="col-md-3">
						<div id="cart" class="btn-group btn-block">
							<ul class="dropdown-menu pull-right">
								<?php 
								$discount		= 0;
								if($this->cart->total_items() == 0){ ?>
								<li>
                                    <p class="text-center">Your shopping cart is empty!</p>
                                </li>              
								<?php } else { ?>
								<li>
                                    <table class="table hcart">
                                        <?php
                                        $discount		= 0;
										foreach($this->cart->contents() as $row){
										$discount	= $discount + $row['discount'];
										?>
										<tr>
                                            <td class="text-center">
                                                <a href="<?php echo base_url() ?>product/<?php echo $row['slug']; ?>">
                                                    <img src="<?php echo base_url() ?>uploads/product/<?php echo $row['id'] ?>/thumb_<?php echo $row['gambar'] ?>" 
                                                        alt="image" title="image" class="img-thumbnail img-responsive" />
                                                </a>
                                            </td>
                                            <td class="text-left">
                                                <a href="<?php echo base_url() ?>product/<?php echo $row['slug']; ?>">
                                                    <?php echo $row['name']?>
                                                </a>
                                            </td>
                                            <td class="text-right">x <?php echo $row['qty']?></td>
                                            <td class="text-right">Rp.<?php echo $this->cart->format_number($row['subtotal'])?></td>
                                            <td class="text-center">
                                                <a href="#">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
										<?php } ?>
                                    </table>
                                </li>
								<li>
									<table class="table table-bordered total">
										<tbody>
											<tr>
												<td class="text-right"><strong>Total</strong></td>
												<td class="text-left">Rp. <?php echo $this->cart->format_number($this->cart->total())?></td>
											</tr>
											<tr>
												<td class="text-right"><strong>Discount</strong></td>
												<td class="text-left">Rp. <?php echo $this->cart->format_number($discount)?></td>
											</tr>
											<tr>
												<td class="text-right"><strong>Total (Net)</strong></td>
												<td class="text-left">Rp. <?php echo $this->cart->format_number($this->cart->total() - $discount)?></td>
											</tr>
										</tbody>
									</table>
									<p class="text-right btn-block1">
										<a href="<?php echo base_url()?>cart">
                                            View Cart
                                        </a>
                                        <a href="<?php echo base_url()?>cart/checkout">
                                            Checkout
                                        </a>
									</p>
								</li>	
								<?php } ?>								
							</ul>														<button type="button" data-toggle="dropdown" class="btn btn-block btn-lg dropdown-toggle">								<i class="fa fa-shopping-cart"></i>								<span class="hidden-md">Cart:</span> 								<span id="cart-total"><?php echo $this->cart->total_items()?> item(s) - Rp.<?php echo $this->cart->format_number($this->cart->total() - $discount)?></span>								<i class="fa fa-caret-down"></i>							</button>
						</div>
					</div>
					<!-- Shopping Cart Ends -->
				</div>
			</div>
			<!-- Main Header Ends -->
			
			<?php 
			/*================================================================================
				4.	CATEGORY NAVIGATION
			================================================================================*/ ?>	
			<!-- Main Menu Starts -->
			<nav id="main-menu" class="navbar" role="navigation">
				<!-- Nav Header Starts -->
				<div class="navbar-header">
					<button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-cat-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<i class="fa fa-bars"></i>
					</button>
				</div>
				<!-- Navbar Cat collapse Starts -->
				<div class="collapse navbar-collapse navbar-cat-collapse">
					<ul class="nav navbar-nav">
						<?php
							$category_product_list = $this->category_product;
							$category_product = $category_product_list->result();
							if( count($category_product) > 0 ): ?>
						<?php foreach($category_product as $cp ): ?>
							<?php 
								$sub_category_product_list = $this->subcategory_product;
								$class_drop_down = '';
								if( count($sub_category_product_list->result()) > 0 ):
							?>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" data-delay="10"> <?php echo $cp->category_product_name ?></a>
									<?php if( count($sub_category_product_list->result()) > 0 ): ?>
										<ul class="dropdown-menu" role="menu">
											<?php foreach($sub_category_product_list->result() as $scp ): ?>
												<?php if( $scp->category_product_id == $cp->category_product_id ): ?>
													<li>
														<a tabindex="-1" href="<?php echo base_url() ?>product/category/<?php echo $scp->slug ?>">
														<?php echo $scp->subcategory_product_name; ?></a>
													</li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php else: ?>
								<li><a href="<?php echo base_url() ?>product/category/<?php echo $scp->slug ?>"><?php echo $cp->category_product_name ?></a></li>
							<?php endif; ?>
						<?php endforeach;?>
						<?php endif; ?>
					</ul>
				</div>
				<!-- Navbar Cat collapse Ends -->
			</nav>
			<!-- Main Menu Ends -->
		</div>
		<!-- Ends -->
	</header>
	<!-- Header Section Ends -->