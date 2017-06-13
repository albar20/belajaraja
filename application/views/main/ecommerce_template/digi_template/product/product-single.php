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
<div class="main-container container">
	<div class="row">

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
            <br/>

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
						<h2><?php echo $product_list->product_name ?></h2>
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
						<hr />
					<!-- Price Starts -->
						<div class="price">
							<span class="price-head">Price :</span>
							<span class="price-new">Rp. <?php echo $this->cart->format_number($product_list->price) ?></span>
							<!-- <p class="price-tax">Ex Tax: $279.99</p> -->
						</div>
					<!-- Price Ends -->
						<hr />
					<!-- Available Options Starts -->
						<div class="options">
							<h3>Available Options</h3>
							<!-- <div class="form-group">
								<label for="select" class="control-label text-uppercase">Select:</label>
								<select name="select" id="select" class="form-control">
									<option value="1" selected>Select</option>
									<option value="2">Option 1</option>
									<option value="3">Option 1</option>
								</select>
							</div>	
							<div class="form-group">
								<label class="control-label text-uppercase">Radio:</label>
								<div class="radio">
									<label>
										<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
										Option one is this and that&mdash;be sure to include why it's great
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
										Option two can be something else and selecting it will deselect option one
									</label>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label text-uppercase">Checkbox:</label>
								<div class="checkbox">
									<label>
										<input type="checkbox" value="">
										Option one is this and that&mdash;be sure to include why it's great
									</label>
								</div>
								<div class="checkbox">
									<label>
										<input type="checkbox" value="" checked>
										Option two is checked
									</label>
								</div>
							</div> -->
							<div class="form-group">
								<div class="row">
									<div class="col-md-12">
										<label class="control-label text-uppercase" for="input-quantity">Stock : </label><?php echo $product_list->stock; ?>	
									</div>
									<br/>


									<div class="col-md-12">
										<label class="control-label text-uppercase" for="input-quantity">Qty :</label>
										<div class="row">
											<div class="col-md-2" id="qty-product">
												<input type="number" min="1" max="9999" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
												<span class="help-block" style="display:none;" id="alert-qty"><i class="fa fa-warning"></i> At Least 1</span>
											</div>
											<?php if($size->num_rows() > 0){ ?>
											<div class="col-md-3" id="size-product">
												<select class="form-control" name="size" id="input-size">
													<option value="">-- Size --</option>
													<?php foreach($size->result() as $row){ 
													$size_array = array( 'size_id' => $row->size_id, 'size_label' => $row->size_name );
													?>
													<option value='<?php echo json_encode($size_array)?>'><?php echo $row->size_name?></option>
													<?php } ?>
												</select>
												<span class="help-block" style="display:none;" id="alert-size"><i class="fa fa-warning"></i> Please Choose Size</span>
											</div>
											<?php } ?>
										</div>	
									</div>
								</div>	
							</div>
							<div class="cart-button button-group">
								<button type="button" title="Wishlist" id="<?php echo $product_list->product_id?>" class="btn btn-wishlist wishlist">
									<i class="fa fa-heart"></i>
								</button>
								<!-- <button type="button" title="Compare" class="btn btn-compare">
									<i class="fa fa-bar-chart-o"></i>
								</button> -->
								<button type="button" class="btn btn-cart" id="buttonCart<?php echo $product_list->product_id?>" onclick="addToCart('<?php echo $product_list->product_id?>')">
									<i class="fa fa-shopping-cart hidden-sm hidden-xs"></i> 
									Add to Cart
								</button>									
							</div>
						</div>
					<!-- Available Options Ends -->
					</div>
				</div>
				<!-- Right Ends -->
			</div>
			<!-- Product Info Ends -->	
			

			<!-- Tabs Starts -->
			<div class="tabs-panel panel-smart">
			<!-- Nav Tabs Starts -->
				<ul class="nav nav-tabs">
					<li class="active">
						<a href="#tab-description">Description</a>
					</li>
					<li><a href="#tab-info">Additional Info</a></li>
				</ul>
				<!-- Nav Tabs Ends -->
				<!-- Tab Content Starts -->
				<div class="tab-content clearfix">
					<!-- Description Starts -->
					<?php 
					/*=====================================================
						1.	BREADCRUMB 
					=====================================================*/ ?>
					<div class="tab-pane active" id="tab-description"><pre><?php echo $product_list->description; ?></pre></div>
					<!-- Description Ends -->

					<?php 
					/*=====================================================
						2.	REVIEW  
					=====================================================*/ ?>
					<div class="tab-pane" id="tab-info">
						<?php if($additional_info->num_rows() > 0){ 
						?>
						
							<table class="table table-bordered">

								<thead>

								  <tr>

									<td colspan="2"><strong>Additional Info</strong></td>

								  </tr>

								</thead>

								<tbody>

						<?php foreach($additional_info->result() as $row){?>		
								  <tr>

									<td><?php echo ucwords($row->specific_name)?></td>

									<td><?php echo ucwords($row->value)?></td>

								  </tr>
								  
						<?php } ?>		  

								</tbody>

							</table>
						<?php  
						} else {
							echo '<div class="alert alert-info">This Product Don\'t Have Additional Info</div>';
						}
						?>	
					</div>
					
				</div>
			<!-- Tab Content Ends -->
			</div>
			<!-- Tabs Ends -->		
			

			<!-- Related Products Starts -->
			<div class="product-info-box">
				<h4 class="heading">Related Products</h4>
				<br>
			<!-- Products Row Starts -->
				<div class="row">
					<?php if( 		isset($related_products) 
								&&	count($related_products->result()) > 0 ):
					?>
					<?php foreach( $related_products->result() as $rp ): ?>
					<!-- Product #1 Starts -->
					<div class="col-md-3 col-sm-6">
						
						<div class="product-col">
							<div class="image">
								<img 	src="<?php echo base_url() ?>uploads/product/<?php echo $rp->product_id?>/thumb_<?php echo $rp->product_picture?>" 
										alt="<?php echo $rp->product_name; ?>" 
										class="img-responsive" />
							</div>
							<div class="caption">
								<h4>
									<a href="<?php echo base_url() ?>product/<?php echo $rp->slug ?>"><?php echo character_limiter($rp->product_name,'15'); ?></a>
								</h4>
								<div class="description">
									<?php echo character_limiter($rp->description,'10'); ?>
								</div>
								<div class="price">
									<span class="price-new related-product-price">Rp. <?php echo $this->cart->format_number($rp->price)?></span>
								</div>
								<div class="cart-button button-group">
									<a type="button" class="btn btn-cart" href="<?php echo base_url()?>product/<?php echo $rp->slug?>">
										Detail
									</a>		
									<button type="button" title="Wishlist" id="<?php echo $rp->product_id; ?>" class="btn btn-wishlist wishlist">
										<i class="fa fa-heart"></i>
									</button>
									<!-- <button type="button" title="Compare" class="btn btn-compare">
																	<i class="fa fa-bar-chart-o"></i>
																</button> -->							
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
			<!-- Related Products Ends -->


		</div>
		<!-- Primary Content Ends -->


		
	</div>
</div>
<!-- Main Container Ends --                                                                                                                                                                               >