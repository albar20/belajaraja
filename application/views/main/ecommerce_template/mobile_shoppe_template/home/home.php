<?php 
/*=============================================================
	1.	SIDEBAR
		1.	CATEGORIES
		2.	BANNER
	2.	MAIN CONTENT
		1.	SLIDER
		2.	BANNER
		3.	LATEST PRODUCT
		4.	BEST SELLER ( FEATURED ) PRODUCTS
=============================================================*/ ?>

<div id="main-container" class="container home">
	<div class="row">

		<?php 
		/*=============================================================
			1.	SIDEBAR
				1.	CATEGORIES
				2.	BANNER
		=============================================================*/ ?>
		<!-- Sidebar Starts -->
		<div class="col-md-3">
		<!-- Categories Links Starts -->
			<h3 class="side-heading">Categories</h3>
			<div class="list-group categories">
				<a href="<?php echo base_url() ?>product" 
					class="list-group-item">
					<i class="fa fa-angle-right"></i>
					All
				</a>
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
		
			<!-- Banner #1 Starts -->
			<?php 
				$banner_list =	$this->banner_list->result(); 
				if( count($banner_list) > 0 ): ?>
			<?php 
				
				$x = 0;
				foreach( $banner_list as $sl ): 
				if( 	$x >= 2
					&& 	$x < 4
				):
						
			?>
				<a href="<?php echo $sl->banner_link ?>" target="blank">
					<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" alt="banners" class="img-responsive banner-image" />
				</a>
				<br>
			<?php 
				endif;
				$x++;
				if($x == 4){
					break;
				}
				endforeach; ?>
			<?php endif; ?>
			<!-- Banner #1 Ends -->
		</div>
		<!-- Sidebar Ends -->	
	


		<?php 
		/*=============================================================
			2.	MAIN CONTENT
				1.	SLIDER
				2.	BANNER
				3.	LATEST PRODUCT
				4.	BEST SELLER ( FEATURED ) PRODUCTS
		=============================================================*/ ?>
		<!-- Primary Content Starts -->
		<div class="col-md-9">
		<!-- Top Section Starts -->
			<div class="row">

				<?php 
				/*=============================================================
					1.	SLIDER
				=============================================================*/ ?>
				<!-- Slider Starts -->
				<div class="col-sm-8 col-xs-12">
					<div id="main-carousel" class="carousel slide slider" data-ride="carousel">
						<!-- Wrapper For Slides Starts -->
						<div class="carousel-inner">
							<?php if( count($slider_list->result()) > 0 ): ?>
							<?php 
								
								$x = 0;
								foreach( $slider_list->result() as $sl ): 
									$active = '';
									if($x == 0){
										$active = 'active';
									}
							?>
								<div class="item <?php echo $active; ?>">
									<a href="<?php echo $sl->slider_link?>" target="blank">
										<img src="<?php echo base_url()?>uploads/slider/thumb/<?php echo $sl->slider_picture ?>" alt="Slider" class="img-responsive slider-image" />
									</a>
								</div>
							<?php 
								$x++;
								endforeach; ?>
							<?php endif; ?>
						</div>
						<!-- Wrapper For Slides Ends -->
						<!-- Controls Starts -->
						<a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
						<a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
						<!-- Controls Ends -->
					</div>	
				</div>
				<!-- Slider Ends -->


				<?php 
				/*=============================================================
					2.	BANNER
				=============================================================*/ ?>
				<!-- Banners Starts -->
				<div class="col-sm-4 col-xs-12">
					<ul class="list-unstyled top-banners">
						<?php 
							$banner_list =	$this->banner_list->result(); 
							if( count($banner_list) > 0 ): ?>
						<?php 
							
							$x = 0;
							foreach( $banner_list as $sl ): 
							if( 	$x >= 0
								&& 	$x < 2
							):
									
						?>
							<li>
								<a href="<?php echo $sl->banner_link ?>" target="blank">
									<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" alt="banners" class="img-responsive banner-image" />
								</a>
							</li>
						<?php 
							endif;
							$x++;
							if($x == 4){
								break;
							}
							endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>
				<!-- Banners Ends -->
			</div>
			<!-- Top Section Ends -->

			<?php 
			/*=============================================================
				3.	LATEST PRODUCT
			=============================================================*/ ?>
			<!-- Latest Products Starts -->
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
								<?php foreach($product->result() as $row): ?>
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
							</div>
						<!-- Product Carousel Ends -->
						</div>
					</div>
				<!-- Products Row Ends -->
				</section>
				<!-- Latest Products Ends -->
			
			<?php 
			/*=============================================================
				4. 	BANNER
			=============================================================*/ ?>
			<!-- 1 Column Banners Starts -->
			<?php 
				$banner_list =	$this->banner_list->result(); 
				if( count($banner_list) > 0 ): ?>
			<?php 
				
				$x = 0;
				foreach( $banner_list as $sl ): 
				if( $x == 4 ):
						
			?>
				<div class="col1-banners">
					<a href="<?php echo $sl->banner_link ?>" target="blank">
						<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" alt="banners" class="img-responsive banner-image img-center-sm img-center-xs" />
					</a>
				</div>
			<?php 
				endif;
				$x++;
				if($x == 5){
					break;
				}
				endforeach; ?>
			<?php endif; ?>
			<!-- 1 Column Banners Ends -->

			<?php 
			/*=============================================================
				4.	BEST SELLER ( FEATURED ) PRODUCTS
			=============================================================*/ ?>
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
						$x = 0;
						foreach( $best_seller->result() as $bs ): 
						if( $x <= 2 ):
					?>
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
						if( $x == 2 ){
							break;
						}
						$x++;
						endforeach; ?>
					<?php endif; ?>
				</div>
			<!-- Products Row Ends -->
			</section>
		<!-- Featured Products Ends -->
		</div>
		<!-- Primary Content Ends -->	

	</div>
	<!-- Nested Row Ends -->
</div>
<!-- Main Container Ends -->