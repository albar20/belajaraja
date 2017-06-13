<?php 
/*=============================================================
	1.	SLIDER
	2.	BANNER
	3.	LATEST PRODUCT
	4.	BEST SELLER ( FEATURED ) PRODUCTS
=============================================================*/ ?>


	<?php 
	/*=============================================================
		1.	SLIDER
	=============================================================*/ ?>
	<div class="slider">
		<div class="container">
			<div id="main-carousel" class="carousel slide" data-ride="carousel">
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
	</div>

	<?php 
	/*=============================================================
		2.	BANNER
	=============================================================*/ ?>
	<div class="col3-banners">
		<div class="container">
			<ul class="row list-unstyled">
				<?php 
					$banner_list =	$this->banner_list->result(); 
					if( count($banner_list) > 0 ): ?>
				<?php 
					
					$x = 0;
					foreach( $banner_list as $sl ): 
					if( 	$x >= 0
						&& 	$x < 3
					):
							
				?>
					<li class="col-sm-4">
						<a href="<?php echo $sl->banner_link ?>" target="blank">
							<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" alt="banners" class="img-responsive banner-image" />
						</a>
					</li>
				<?php 
					endif;
					$x++;
					if($x == 3){
						break;
					}
					endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
	</div>


	<?php 
	/*=============================================================
		3.	LATEST PRODUCT
	=============================================================*/ ?>
	<section class="products-list">			
		<div class="container">
		<!-- Heading Starts -->
		<h2 class="product-head">Latest Products</h2>
		<!-- Heading Ends -->
		<!-- Products Row Starts -->
			<div class="row">
				<?php 
					$x = 0;
					foreach($product->result() as $row): ?>
				<?php 
					if( $x <= 3 ):
					$product_picture		= $row->picture_highlight;
					if($product_picture == null){
						$product_picture	= $row->newest_picture;
					}
				?>
				<!-- Product #1 Starts -->
				<div class="col-md-3 col-sm-6">
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
								<button type="button" title="Wishlist" class="btn btn-wishlist wishlist" id="<?php echo $row->product_id?>">
									<i class="fa fa-heart"></i>
								</button>
								<a type="button" class="btn btn-cart" href="<?php echo base_url()?>product/<?php echo $row->slug?>">
									Detail
								</a>							
							</div>
						</div>
					</div>
				</div>
				<?php 
					endif;
					if( $x == 3 ){
						break;
					}
					$x++;
					endforeach; ?>
				<!-- Product #1 Ends -->
			</div>
		<!-- Products Row Ends -->
		</div>
	</section>

	<?php 
	/*=============================================================
		2.	BANNER
	=============================================================*/ ?>
	<div class="col3-banners">
		<div class="container">
			<ul class="row list-unstyled">
				<?php 
					$banner_list =	$this->banner_list->result(); 
					if( count($banner_list) > 0 ): ?>
				<?php 
					
					$x = 0;
					foreach( $banner_list as $sl ): 
					if( 	$x >= 3
						&& 	$x < 5
					):
							
				?>
					<li class="col-sm-6">
						<a href="<?php echo $sl->banner_link ?>" target="blank">
							<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" alt="banners" class="img-responsive banner-image" />
						</a>
					</li>
				<?php 
					endif;
					$x++;
					if($x == 5){
						break;
					}
					endforeach; ?>
				<?php endif; ?>
			</ul>
		</div>
	</div>

	<?php 
	/*=============================================================
		4.	BEST SELLER ( FEATURED ) PRODUCTS
	=============================================================*/ ?>
	<section class="products-list">			
		<div class="container">
			<!-- Heading Starts -->
			<h2 class="product-head">Featured Products</h2>
			<!-- Heading Ends -->

			<!-- Products Row Starts -->
			<div class="row">
				<?php if( 		isset($best_seller) 
							&&	count($best_seller->result()) > 0 ):
				?>
				<!-- Product #1 Starts -->
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
							<div class="price">
								<span class="price-new">Rp. <?php echo $this->cart->format_number($bs->price)?></span>
							</div>
							<div class="cart-button button-group">
								<button type="button" title="Wishlist" id="<?php echo $bs->product_id; ?>" class="btn btn-wishlist wishlist">
									<i class="fa fa-heart"></i>
								</button>
								<a type="button" class="btn btn-cart" href="<?php echo base_url()?>product/<?php echo $bs->slug?>">
									Detail
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- Product #1 Ends -->
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
		<!-- Products Row Ends -->
		</div>
	</section>
<!-- Featured Products Ends -->