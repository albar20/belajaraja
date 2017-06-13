<?php 
/*=============================================================
	1.	SIDEBAR
	2.	MAIN CONTENT
		3.	LATEST PRODUCT
		4.	BEST SELLER ( FEATURED ) PRODUCTS
=============================================================*/ ?>	


	<!-- Main Container Starts -->
	<div class="main-container container">
	<!-- Nested Row Starts -->
		<div class="row">
			
			<?php 
			/*=============================================================
				1.	SIDEBAR
			=============================================================*/ ?>	
			<!-- Sidebar Starts -->
			<div class="col-md-3">
			<!-- Categories Links Starts -->
				<h3 class="side-heading"><i class="fa fa-align-justify"></i> Categories</h3>
				<div class="list-group categories">
					<?php
						$category_product_list = $this->category_product;
						$category_product = $category_product_list->result();
						if( count($category_product) > 0 ): ?>
					<?php foreach($category_product as $cp ): ?>
					<div href="#" class="list-group-item category-product">
						<i class="fa fa-angle-right"></i>
						<?php echo $cp->category_product_name ?>
						<?php 
							$sub_category_product_list = $this->subcategory_product;
							if( count($sub_category_product_list->result()) > 0 ): ?>
							<?php foreach($sub_category_product_list->result() as $scp ): ?>
								<?php if( $scp->category_product_id == $cp->category_product_id ): ?>
								<?php 
									$category_active_class = '';
									if( $scp->slug == $this->segment_3 ){
										$category_active_class = "category_active";
									}
								?>
								<a href="<?php echo base_url() ?>product/category/<?php echo $scp->slug ?>" 
									class="list-group-item sub-category-product <?php echo $category_active_class ?>">
								<i class="fa fa-angle-right"></i>
									<?php echo $scp->subcategory_product_name; ?>
								</a>
								<?php endif; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<?php endforeach;?>
					<?php endif; ?>
				</div>
			<!-- Categories Links Ends -->
			<!-- Special Products Starts -->
				<h3 class="side-heading"><i class="fa fa-align-justify"></i> Best Sellers</h3>
				<ul class="side-products-list">
					<?php if( 		isset($best_seller) 
								&&	count($best_seller->result()) > 0 ):
					?>
					<!-- Product #1 Starts -->
					<?php 
						$x = 1;
						foreach( $best_seller->result() as $bs ): 
						if( $x == 1 ):
						?>
						<li class="clearfix">
							<img src="<?php echo base_url() ?>uploads/product/<?php echo $bs->product_id?>/thumb_<?php echo $bs->product_picture?>" 
								alt="Special product" class="img-responsive" />
							<h5><a href="<?php echo base_url() ?>product/<?php echo $bs->slug ?>"><?php echo character_limiter($bs->product_name,'15'); ?></a></h5>
							<div class="clear"></div>
							<div class="price">
								<span class="price-new"> Rp. <?php echo $this->cart->format_number($bs->price)?></span>
							</div>
						</li>
						<?php endif; ?>
					<?php
						$x++;
						if( $x == 2 ){
							break;
						}
						endforeach; ?>
					<?php endif; ?>
				
				</ul>
			<!-- Special Products Ends -->
			
			<!-- Banner #1 Starts -->
				<?php 
					$banner_list =	$this->banner_list->result(); 
					if( count($banner_list) > 0 ): ?>
				<?php 
					foreach( $banner_list as $sl ): 
							
				?>
					<a href="<?php echo $sl->banner_link ?>"><img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/<?php echo $sl->banner_picture ?>" class="img-responsive img-center-sm img-center-xs" /></a>
					<br>
				<?php
					break;
					endforeach; ?>
				<?php endif; ?>
				
			<!-- Banner #1 Ends -->
			</div>
		<!-- Sidebar Ends -->	
			

			
			<?php 
			/*=============================================================
				2.	MAIN CONTENT
			=============================================================*/ ?>	
			<!-- Primary Content Starts -->
			<div class="col-md-9">
			<!-- 2 Column Banners Starts -->
				<div class="col2-banners">
					<ul class="row list-unstyled">
						<?php 
							$banner_list =	$this->banner_list->result(); 
							if( count($banner_list) > 0 ): ?>
						<?php 
							
							$x = 1;
							foreach( $banner_list as $sl ): 
							if(		$x > 0 
								|| 	$x <= 2
							):
									
						?>
							<li class="col-sm-6">
								<a href="<?php echo $sl->banner_link ?>" target="blank">
									<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" alt="banners" class="img-responsive banner-image" />
								</a>
							</li>
						<?php
							endif;
							if( $x == 2 ){
								break;
							}
							$x++;
							endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
				<!-- 2 Column Banners Ends -->
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
								<?php 
									foreach($product->result() as $row): ?>
								<?php 	
									$product_picture		= $row->picture_highlight;
									if($product_picture == null){
										$product_picture	= $row->newest_picture;
									}
								?>
								<div class="item">
									<div class="product-col">
										<div class="image">
											<img src="<?php echo base_url()?>uploads/product/<?php echo $row->product_id?>/thumb_<?php echo $product_picture?>" 
												alt="product" class="img-responsive" />
										</div>
										<div class="caption">
											<h4><a href="<?php echo base_url()?>product/<?php echo $row->slug?>"><?php echo $row->product_name?> </a></h4>
											<div class="price">
												<span class="price-new">Rp. <?php echo $this->cart->format_number($row->price)?></span> 
											</div>
											<div class="cart-button button-group">
												<a type="button" class="btn btn-cart" href="<?php echo base_url()?>product/<?php echo $row->slug?>">
													Detail
												</a>	
												<button type="button" title="Wishlist" class="btn btn-wishlist wishlist" id="<?php echo $row->product_id?>">
													<i class="fa fa-heart"></i>
												</button>
																				
											</div>
										</div>
									</div>
								</div>
								<?php endforeach; ?>
							<!-- Product #1 Ends -->
						
						<!-- Product Carousel Ends -->
							</div>
						<!-- Product Carousel Ends -->
						</div>
					</div>
				<!-- Products Row Ends -->
				</section>
			<!-- Latest Products Ends -->
					
				<?php 
					$banner_list =	$this->banner_list->result(); 
					if( count($banner_list) > 0 ): ?>
				<?php 
					
					$x = 0;
					foreach( $banner_list as $sl ): 
					if(	$x == 3 ):
							
				?>
				<!-- 1 Column Banners Starts -->
				<div class="col1-banners">
					<a href="<?php echo $sl->banner_link ?>" target="blank">
						<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" alt="banners" class="img-responsive banner-image" />
					</a>
				</div>
				<!-- 1 Column Banners Ends -->
				<?php
					endif;
					if( $x == 3 ){
						break;
					}
					$x++;
					endforeach; ?>
				<?php endif; ?>

			<!-- Featured Products Starts -->
				<section class="products-list">			
				<!-- Heading Starts -->
					<h2 class="product-head">Featured Products</h2>
				<!-- Heading Ends -->
				<!-- Products Row Starts -->
					<div class="row">
						<?php if( 		isset($best_seller) 
									&&	count($best_seller->result()) > 0 ):
						?>
						<!-- Product #1 Starts -->
						<?php 
							$x = 1;
							foreach( $best_seller->result() as $bs ):
							if( $x > 1 ):
								
							?>
					<!-- Product #1 Starts -->
						<div class="col-md-4 col-sm-6">
							<div class="product-col">
								<div class="image">
									<img src="<?php echo base_url() ?>uploads/product/<?php echo $bs->product_id?>/thumb_<?php echo $bs->product_picture?>" 
										alt="<?php echo $bs->product_name; ?>" 
										class="img-responsive" />
								</div>
								<div class="caption">
									<h4>
										<a href="<?php echo base_url() ?>product/<?php echo $bs->slug ?>"><?php echo character_limiter($bs->product_name,'15'); ?></a>
									</h4>
									<div class="price">
										<span class="price-new">Rp. <?php echo $this->cart->format_number($bs->price)?></span>
									</div>
									<div class="cart-button button-group">
										<a type="button" class="btn btn-cart" href="<?php echo base_url()?>product/<?php echo $bs->slug?>">
											Detail
										</a>
										<button type="button" title="Wishlist" id="<?php echo $bs->product_id; ?>" class="btn btn-wishlist wishlist">
											<i class="fa fa-heart"></i>
										</button>								
									</div>
								</div>
							</div>
						</div>
						<!-- Product #1 Ends -->
						<?php 
							endif;
							$x++;
							if( $x == 5 ){
								break;
							}
							endforeach; ?>
						<?php endif; ?>
					</div>
				<!-- Products Row Ends -->
				</section>
			<!-- Featured Products Ends -->
			</div>
		<!-- Nested Row Ends -->
		</div>
	<!-- Nested Container Ends -->
	</div>
<!-- Footer Top Ends -->