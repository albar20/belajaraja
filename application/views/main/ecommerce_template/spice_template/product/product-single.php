<?php 
/*=====================================================
	
	1.	MAIN CONTENT
		1.	NEWEST PRODCUT 
		2.	FILTER BAR
			1.	LIST / GRID VIEW 
			2.	SORT 
			3.	TOTAL PRODUCT SHOW
		3.	PRODUCT LIST 
		4.	PAGINATION

	2.	SIDEBAR LEFT
		1.	CATEGORY
		2.	BEST SELLER


=====================================================*/ ?>

<!-- Main Container Starts -->
<div id="main-container" class="container">
	<div class="row">

		
	

		<?php 
		/*=====================================================
			1.	MAIN CONTENT
				1.	NEWEST PRODCUT 
				2.	FILTER BAR
				3.	PRODUCT LIST 
		=====================================================*/ ?>
		<!-- Primary Content Starts -->
		<div class="col-md-9">

			<!-- Breadcrumb Starts -->
            <?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/breadcrumb'); ?>
            <!-- Breadcrumb Ends -->

			<!-- Product Info Starts -->
			<div class="row product-info full">
				
				<?php 
				/*=====================================================
					1.	LEFT CONTENT
				=====================================================*/ ?>
				<!-- Left Starts -->
				<div class="col-sm-4 images-block">
					<?php if(count($product_thumnails) > 0): 
						$product_thumnails = $product_thumnails->result_array();
					?>
					<a href="<?php echo base_url() ?>/uploads/product/<?php echo $product_list->product_id ?>/thumb_<?php echo $product_thumnails[0]['product_picture']; ?>">
						<img src="<?php echo base_url() ?>/uploads/product/<?php echo $product_list->product_id ?>/thumb_<?php echo $product_thumnails[0]['product_picture']; ?>"  
							alt="Image" class="img-responsive thumbnail" />
					</a>
					<ul class="list-unstyled list-inline">
						<?php 
							$x = 0;
							foreach($product_thumnails as $pt): ?>
						<?php if($x!=0): ?>
						<li class="col-md-3 col-sm-3 col-xs-3">
							<a href="<?php echo base_url() ?>/uploads/product/<?php echo $product_list->product_id ?>/thumb_<?php echo $pt['product_picture']; ?>">
								<img src="<?php echo base_url() ?>/uploads/product/<?php echo $product_list->product_id ?>/thumb_<?php echo $pt['product_picture']; ?>" 
										alt="Image" class="img-responsive thumbnail" />
							</a>
						</li>
						<?php endif;?>
						<?php 
							$x++;
						endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>
				<!-- Left Ends -->
				
				<?php 
				/*=====================================================
					2.	RIGHT CONTENT
				=====================================================*/ ?>
				<!-- Right Starts -->
				<div class="col-sm-8 product-details">
					<div class="panel-smart">
					<!-- Product Name Starts -->
						<div class="row">
							<div class="col-sm-8">
								<h1><?php echo $product_list->product_name ?></h1>
							<!-- Product Name Ends -->
								<!-- <hr /> -->
							<!-- Manufacturer Starts -->
								<!-- <ul class="list-unstyled manufacturer">
									<li>
										<span>Brand:</span> Indian spices
									</li>
									<li><span>Model:</span> SKU012452</li>
									<li><span>Reward Points:</span> 300</li>
									<li>
										<span>Availability:</span> <strong class="label label-danger">Out Of Stock</strong>
									</li>
								</ul> -->
							<!-- Manufacturer Ends -->
								
							<!-- Price Starts -->
								<div class="price">
									<span class="price-new"><div id="rateproduct"></div><input type="hidden" value="<?php echo $rating?>" name="nilai_rating" id="nilaiRating" required></span>
									<!-- <p class="price-tax">Ex Tax: $279.99</p> -->
								</div>
							</div>
							<div class="col-sm-4 text-center">																<?php if($rating > 0){ ?>
									<h1><span class="rating"><?php echo $rating?></span></h1>								<?php } else { ?>									Not Rated Yet								<?php } ?>
							</div>
					<!-- Price Ends -->
						</div>
						<hr>
						<div class="row">
							<div class="col-md-12 text-center">
								<a class="btn btn-pink btn-lg" href="<?php echo base_url()?>product/review/<?php echo $product_list->product_id?>">WRITE REVIEW</a>
							</div>
						</div>
					<!-- Available Options Starts -->
						
					</div>
				</div>
				<!-- Right Ends -->
			</div>
			<!-- Product Info Ends -->	
			
			<div class="row product-details">
				
				<div class="col-sm-12 product-details">
				<!-- Related Products Starts -->
					<div class="product-info-box">
						<h4 class="heading">Review</h4>
					<!-- Products Row Starts -->
						<div class="row">
							<div class="col-xs-12">
							<?php if($customer_review->num_rows() > 0){ 								foreach($customer_review->result() as $row)								{							?>
								<div class="product-col list clearfix">
									<div class="caption">
										<h4><a href="#"><?php echo $row->customer_fname?> <?php echo $row->customer_lname?></a>	
										<br>										
											<?php 										
												for($i=1;$i<=$row->rate;$i++){?>
												<i style="color:rgb(239, 95, 150);" class="fa fa-star" aria-hidden="true"></i>
												<?php } ?>
												<?php if($row->rate < $i and $row->rate > $i-1){ 
												?>
												<i style="color:rgb(239, 95, 150);" class="fa fa-star-half" aria-hidden="true"></i>
												<?php } ?>
										</h4>
										<div class="description">
											<?php echo $row->review?>
										</div>
										<div class="price">
											<!--<p class="price-tax">Age: 20-25</p>-->
										</div>
										<div class="cart-button button-group">	
											<i style="color:rgb(239, 95, 150);" class="fa fa-heart"></i><strong class="description" id="jumlahReview<?php echo $row->product_review_id?>"> <?php echo $row->totalvote?></strong>
											<button type="button" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading" title="Favourite" class="btn btn-wishlist" onClick="favourite('<?php echo $row->product_review_id?>')">
												<i class="fa fa-heart"> Favourite</i>
											</button> 
											
										</div>
									</div>
								</div>							<?php								}							} else { ?>															<div class="product-col list clearfix">									<div class="caption">										<div class="description">											This product don't have any review yet.										</div>									</div>								</div>														<?php } ?>
							</div>
						</div>
					<!-- Products Row Ends -->
					</div>
					<!-- Related Products Ends -->
				</div>
			</div>

		</div>
		<!-- Primary Content Ends -->


		<?php 
		/*=====================================================
			2.	SIDEBAR LEFT
				1.	CATEGORY
				2.	BEST SELLER
		=====================================================*/ ?>
		<div class="col-md-3">

			<?php 
			/*=====================================================
				1.	CATEGORY
			=====================================================*/ ?>
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
			
			<?php 
			/*=====================================================
				2.	BEST SELLER
			=====================================================*/ ?>
			<!-- Bestsellers Links Starts -->
			<h3 class="side-heading">Best Sellers</h3>
			<?php if( 		isset($best_seller) 
						&&	count($best_seller->result()) > 0 ):
			?>
			<?php foreach( $best_seller->result() as $bs ): ?>
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
			<?php endforeach; ?>
			<?php endif; ?>
			<!-- Bestsellers Links Ends -->
		</div>
		
	</div>
</div>
<!-- Main Container Ends --                                                                                                                                                                               >