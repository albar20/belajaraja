


<div class="main-container container">
	
	<!-- Category Banners List Starts -->
		<div class="banners-cat">
			<div class="row">
				<div class="col-md-3 col-sm-6 col-xs-12">
					<a href="#"><img src="<?php echo base_url()?>assets/fashion/images/banners/category-banner-img-1.png" alt="Banner" class="img-responsive" /></a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<a href="#"><img src="<?php echo base_url()?>assets/fashion/images/banners/category-banner-img-2.png" alt="Banner" class="img-responsive" /></a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<a href="#"><img src="<?php echo base_url()?>assets/fashion/images/banners/category-banner-img-3.png" alt="Banner" class="img-responsive" /></a>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<a href="#"><img src="<?php echo base_url()?>assets/fashion/images/banners/category-banner-img-4.png" alt="Banner" class="img-responsive" /></a>
				</div>
			</div>
		</div>
	<!-- Category Banners List Ends -->
	<!-- Latest Products Starts -->
		<section class="product-carousel">
		<!-- Heading Starts -->
			<h2 class="product-head">Latest Products</h2>
		<!-- Heading Ends -->
		<!-- Products Row Starts -->
			<div class="row">
				<div class="col-xs-12">
				<!-- Product Carousel Starts -->
					<div id="owl-product" class="owl-carousel">
					<!-- Product #1 Starts -->
					<?php foreach($product->result() as $row)
					{
						$product_picture		= $row->picture_highlight;
						
						if($product_picture == "NULL")
						{
							$product_picture	= $row->newest_picture;
						}
					?>
						<div class="item">
							<div class="product-col">
								<div class="image">
									<a href="<?php echo base_url()?>product/<?php echo $row->slug?>"><img src="<?php echo base_url()?>uploads/product/<?php echo $row->product_id?>/thumb_<?php echo $product_picture?>" alt="product" class="img-responsive" /></a>
								</div>
								<div class="caption">
									<h4><a href="<?php echo base_url()?>product/<?php echo $row->slug?>"><?php echo $row->product_name?> </a></h4>
									<div class="description">
										<?php echo character_limiter($row->description, 30)?>
									</div>
									<div class="price">
										<span class="price-new">Rp. <?php echo $this->cart->format_number($row->price)?></span> 
									</div>
									<div class="cart-button button-group">
										<button type="button" class="btn btn-cart" id="buttonCart<?php echo $row->product_id?>" onclick="addToCart('<?php echo $row->product_id?>')">
											<i class="fa fa-shopping-cart hidden-sm hidden-xs"></i> 
											Add to Cart
										</button>		
										<button type="button" title="Wishlist" class="btn btn-wishlist wishlist" id="<?php echo $row->product_id?>">
											<i class="fa fa-heart"></i>
										</button>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
					<!-- Product #1 Ends -->
					</div>
				<!-- Product Carousel Ends -->
				</div>
			</div>
		<!-- Products Row Ends -->
		</section>
	<!-- Latest Products Ends -->
	</div>
<!-- Main Container Ends -->
<!-- Big Banner Starts -->
	<div class="full-banner">
		<img src="images/banners/big-banner.jpg" alt="Banner" class="img-responsive" />
	</div>
<!-- Big Banner Ends -->
<!-- Main Container Starts -->
	<div class="main-container container">
	<!-- Featured Products Starts -->
		<section class="products-list">			
		<!-- Heading Starts -->
			<h2 class="product-head">Featured Products</h2>
		<!-- Heading Ends -->
		<!-- Products Row Starts -->
			<div class="row">
			<!-- Product #1 Starts -->
				<div class="col-md-3 col-sm-6">
					<div class="product-col">
						<div class="image">
							<img src="images/product-images/9.jpg" alt="product" class="img-responsive" />
						</div>
						<div class="caption">
							<h4><a href="product-full.html">Quis Nostrud Exercitation </a></h4>
							<div class="description">
								We are so lucky living in such a wonderful time. Our almost unlimited ...
							</div>
							<div class="price">
								<span class="price-new">$199.50</span> 
								<span class="price-old">$249.50</span>
							</div>
							<div class="cart-button button-group">
								<button type="button" class="btn btn-cart">
									<i class="fa fa-shopping-cart"></i> Add to Cart
								</button>		
								<button type="button" title="Wishlist" class="btn btn-wishlist">
									<i class="fa fa-heart"></i>
								</button>
								<button type="button" title="Compare" class="btn btn-compare">
									<i class="fa fa-bar-chart-o"></i>
								</button>							
							</div>
						</div>
					</div>
				</div>
			<!-- Product #1 Ends -->
			<!-- Product #2 Starts -->
				<div class="col-md-3 col-sm-6">
					<div class="product-col">
						<div class="image">
							<img src="images/product-images/10.jpg" alt="product" class="img-responsive" />
						</div>
						<div class="caption">
							<h4><a href="product-full.html">Quis Nostrud Exercitation </a></h4>
							<div class="description">
								We are so lucky living in such a wonderful time. Our almost unlimited ...
							</div>
							<div class="price">
								<span class="price-new">$99.50</span> 
							</div>
							<div class="cart-button button-group">
								<button type="button" class="btn btn-cart">
									<i class="fa fa-shopping-cart"></i> Add to Cart
								</button>			
								<button type="button" title="Wishlist" class="btn btn-wishlist">
									<i class="fa fa-heart"></i>
								</button>
								<button type="button" title="Compare" class="btn btn-compare">
									<i class="fa fa-bar-chart-o"></i>
								</button>							
							</div>
						</div>
					</div>
				</div>
			<!-- Product #2 Ends -->
			<!-- Product #3 Starts -->
				<div class="col-md-3 col-sm-6">
					<div class="product-col">
						<div class="image">
							<img src="images/product-images/11.jpg" alt="product" class="img-responsive" />
						</div>
						<div class="caption">
							<h4><a href="product-full.html">Quis Nostrud Exercitation </a></h4>
							<div class="description">
								We are so lucky living in such a wonderful time. Our almost unlimited ...
							</div>
							<div class="price">
								<span class="price-new">$199.50</span> 
								<span class="price-old">$249.50</span>
							</div>
							<div class="cart-button button-group">
								<button type="button" class="btn btn-cart">
									<i class="fa fa-shopping-cart"></i> Add to Cart
								</button>		
								<button type="button" title="Wishlist" class="btn btn-wishlist">
									<i class="fa fa-heart"></i>
								</button>
								<button type="button" title="Compare" class="btn btn-compare">
									<i class="fa fa-bar-chart-o"></i>
								</button>							
							</div>
						</div>
					</div>
				</div>
			<!-- Product #3 Ends -->
			<!-- Product #4 Starts -->
				<div class="col-md-3 col-sm-6">
					<div class="product-col">
						<div class="image">
							<img src="images/product-images/12.jpg" alt="product" class="img-responsive" />
						</div>
						<div class="caption">
							<h4><a href="product-full.html">Quis Nostrud Exercitation </a></h4>
							<div class="description">
								We are so lucky living in such a wonderful time. Our almost unlimited ...
							</div>
							<div class="price">
								<span class="price-new">$199.50</span> 
								<span class="price-old">$249.50</span>
							</div>
							<div class="cart-button button-group">
								<button type="button" class="btn btn-cart">
									<i class="fa fa-shopping-cart"></i> Add to Cart
								</button>			
								<button type="button" title="Wishlist" class="btn btn-wishlist">
									<i class="fa fa-heart"></i>
								</button>
								<button type="button" title="Compare" class="btn btn-compare">
									<i class="fa fa-bar-chart-o"></i>
								</button>							
							</div>
						</div>
					</div>
				</div>
			<!-- Product #4 Ends -->
			</div>
		<!-- Products Row Ends -->
		</section>
	<!-- Featured Products Ends -->
	<!-- 2Col Banners Starts -->
		<div class="col2-banners">
			<div class="row">
				<div class="col-sm-5 col-xs-12">
					<img src="images/banners/banner-img1.png" alt="Banner Image" class="img-responsive" />
				</div>
				<div class="col-xs-12 hidden-lg hidden-md hidden-sm">
					<br>
				</div>
				<div class="col-sm-7 col-xs-12">
					<img src="images/banners/banner-img2.png" alt="Banner Image" class="img-responsive" />
				</div>
			</div>
		</div>
	<!-- 2Col Banners Ends -->
	</div>