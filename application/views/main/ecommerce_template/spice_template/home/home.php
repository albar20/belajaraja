	<!-- Slider Section Starts -->
		<!--<div class="slider">
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
						<a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left"></span>
						</a>
						<a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">
							<span class="glyphicon glyphicon-chevron-right"></span>
						</a>
				</div> -->				
			</div>
		</div>
	<!-- Slider Section Ends -->

	<!-- 3 Column Banners Starts -->
		<div class="col3-banners">
			<div class="container">
				<ul class="row list-unstyled">

					<?php 
						$banner_list =	$this->banner_list->result(); 
						if( count($banner_list) > 0 ): ?>
					<?php 
						
						$x = 0;
						foreach( $banner_list as $sl ): 
						if($x < 3 ):
								
					?>
					<li class="col-sm-4">
						<a href="<?php echo $sl->banner_link ?>" target="blank">
							<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" 
							alt="<?php echo $sl->banner_title ?>" class="img-responsive banner-image" />
						</a>
					</li>
					
					<?php 
						endif;
						if( $x == 3){
							break;
						}
						$x++;
						endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	<!-- 3 Column Banners Ends -->
	<!-- Latest Products Starts -->
		<section class="products-list">			
			<div class="container">
			<!-- Heading Starts -->
				<h2 class="product-head">Latest Review</h2>
			<!-- Heading Ends -->
			<!-- Products Row Starts -->
				<div class="row">
					<!-- Product #1 Starts -->
					<?php 
						$x = 0;
						foreach($product_new->result() as $row): 
						if( $x < 4 ):
						?>
					<?php 	
						$product_picture		= $row->picture_highlight;
						if($product_picture == null){
							$product_picture	= $row->newest_picture;
						}												$jumlah_review		= ($row->jumlah_rate == 0 ? 1 : $row->jumlah_rate);						$rating				= ($row->total_rate/$jumlah_review);
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
									<?php 																						for($i=1;$i<=$rating;$i++){?>												<i style="color:rgb(239, 95, 150);" class="fa fa-star" aria-hidden="true"></i>												<?php } ?>												<?php if($rating < $i and $rating > $i-1){ 												?>												<i style="color:rgb(239, 95, 150);" class="fa fa-star-half" aria-hidden="true"></i>												<?php } ?>
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
					<?php 
						endif;
						if( $x == 4 ){
							break;
						}
						$x++;
						endforeach; ?>
					<!-- Product #1 Ends -->
				
				</div>
			<!-- Products Row Ends -->
			</div>
		</section>
	<!-- Latest Products Ends -->
	<!-- 2 Column Banners Starts -->
		<!--<div class="col2-banners">
			<div class="container">
				<ul class="row list-unstyled">
					<?php 
						$banner_list =	$this->banner_list->result(); 
						if( count($banner_list) > 0 ): ?>
					<?php 
						
						$x = 0;
						foreach( $banner_list as $sl ): 
						if(		$x > 3 	
							&& 	$x <=5

						):
								
					?>
					<li class="col-sm-6">
						<a href="<?php echo $sl->banner_link ?>" target="blank">
							<img src="<?php echo base_url()?>uploads/banner/<?php echo $sl->banner_slug ?>/thumb/<?php echo $sl->banner_picture ?>" 
							alt="<?php echo $sl->banner_title ?>" class="img-responsive banner-image" />
						</a>
					</li>
					<?php 
						endif;
						if( $x == 5){
							break;
						}
						$x++;
						endforeach; ?>
					<?php endif; ?>
				</ul>
			</div>
		</div>-->
	<!-- 2 Column Banners Ends -->
	<!-- Specials Products Starts -->
		<section class="products-list">			
			<div class="container">
			<!-- Heading Starts -->
				<h2 class="product-head">Top Review</h2>
			<!-- Heading Ends -->
			<!-- Products Row Starts -->
				<div class="row">
					<?php if( 		isset($product_top) 
								&&	count($product_top->result()) > 0 ):
					?>
					<!-- Product #1 Starts -->
					<?php 
						$x = 0;
						foreach( $product_top->result() as $bs ): 
						if( $x < 4 ):						$jumlah_review		= ($bs->jumlah_rate == 0 ? 1 : $bs->jumlah_rate);						$rating				= ($bs->total_rate/$jumlah_review);						
					?>	
					<div class="col-md-3 col-sm-6">
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
									<?php 																						for($i=1;$i<=$rating;$i++){?>												<i style="color:rgb(239, 95, 150);" class="fa fa-star" aria-hidden="true"></i>												<?php } ?>												<?php if($rating < $i and $rating > $i-1){ 												?>												<i style="color:rgb(239, 95, 150);" class="fa fa-star-half" aria-hidden="true"></i>												<?php } ?>
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
					<?php 
						endif;
						$x++;
						if( $x == 4 ){
							break;
						}
						endforeach; ?>
					<?php endif; ?>
					
				</div>
			<!-- Products Row Ends -->
			</div>
		</section>
	<!-- Specials Products Ends -->