<?php 
/*=============================================================
	1.	BANNER
	1.	LATEST PRODUCT
	2.	BEST SELLER ( FEATURED ) PRODUCTS
=============================================================*/ ?>
<div class="main-container container">
	
	<?php 
	/*=============================================================
		1.	BANNER
	=============================================================*/ 
	?>
	<!-- Category Banners List Starts -->
	<div class="banners-cat">
		<div class="row">
			<?php 
				$banner_list =	$this->banner_list->result(); 
				if( count($banner_list) > 0 ): ?>
			<?php 
				
				$x = 0;
				foreach( $banner_list as $sl ): 
				if( 	$x >= 0
					&& 	$x <=3
				):
						
			?>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<a href="<?php echo $sl->banner_link ?>" target="blank">
						<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" alt="banners" class="img-responsive banner-image" />
					</a>
				</div>
			<?php 
				endif;
				$x++;
				if($x == 4){
					break;
				}
				endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
	<!-- Category Banners List Ends -->





		<?php 
		/*=============================================================
			1.	LATEST PRODUCT
		=============================================================*/ 
		?>
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
						
						if($product_picture == null)
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
		<?php 
			$banner_list =	$this->banner_list->result(); 
			if( count($banner_list) > 0 ): ?>
		<?php 
			
			$x = 0;
			foreach( $banner_list as $sl ): 
			if( $x == 4 ):
					
		?>
			<a href="<?php echo $sl->banner_link ?>" target="blank">
				<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" alt="banners" class="img-responsive banner-image" />
			</a>
		<?php 
			endif;
			$x++;
			if($x == 5){
				break;
			}
			endforeach; ?>
		<?php endif; ?>
	</div>
	<!-- Big Banner Ends -->

	<?php 
	/*=============================================================
		2.	BEST SELLER ( FEATURED ) PRODUCTS
	=============================================================*/ ?>
	<!-- Main Container Starts -->
	<div class="main-container container">
	<!-- Featured Products Starts -->
		<section class="products-list">			
			<!-- Heading Starts -->
			<h2 class="product-head">Best Seller Products</h2>
			<!-- Heading Ends -->
			<!-- Products Row Starts -->
			<div class="row">
				
				<?php if( 		isset($best_seller) 
							&&	count($best_seller->result()) > 0 ):
				?>
				<?php foreach( $best_seller->result() as $bs ): ?>
				<div class="col-md-3 col-sm-6">
					<div class="product-col">
						<div class="image">
							<img 	src="<?php echo base_url() ?>uploads/product/<?php echo $bs->product_id?>/thumb_<?php echo $bs->product_picture?>" 
									alt="<?php echo $bs->product_name; ?>" 
									class="img-responsive" />
						</div>
						<div class="caption">
							<h4>
								<a href="<?php echo base_url() ?>product/<?php echo $bs->slug ?>"><?php echo character_limiter($bs->product_name,'15'); ?></a>
							</h4>
							<div class="description">
								<?php echo character_limiter($bs->description,'10'); ?>
							</div>
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
								<!-- <button type="button" title="Compare" class="btn btn-compare">
																<i class="fa fa-bar-chart-o"></i>
															</button> -->							
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
			
		<!-- Products Row Ends -->
		</section>
		<!-- Featured Products Ends -->

		<?php 
			$banner_list =	$this->banner_list->result(); 
			if( count($banner_list) > 0 ): ?>
		<?php 
			
			$x = 0;
			foreach( $banner_list as $sl ): 
			if( 	$x > 4 
				&&	$x <=6
			):
					
		?>
		<!-- 2Col Banners Starts -->
		<div class="col2-banners">
			<div class="row">
				<div class="col-sm-6 col-xs-12">
					<a href="<?php echo $sl->banner_link ?>" target="blank">
						<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" alt="banners" class="img-responsive banner-image" />
					</a>
				</div>
			</div>
		</div>
		<!-- 2Col Banners Ends -->

		<?php 
			endif;
			$x++;
			if($x == 6){
				break;
			}
			endforeach; ?>
		<?php endif; ?>


	</div>



