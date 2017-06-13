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
			3.	MAIN CONTENT
				1.	NEWEST PRODCUT 
				2.	FILTER BAR
				3.	PRODUCT LIST 
		=====================================================*/ ?>
		<!-- Primary Content Starts -->
		<div class="col-md-9">

			<!-- Breadcrumb Starts -->
            <?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/breadcrumb'); ?>
            <!-- Breadcrumb Ends -->
            
			<?php 
			/*=====================================================
				1.	NEWEST PRODCUT 
			=====================================================*/ ?>
			<!-- <h2 class="main-heading2 inner">
							Spices &amp; Herbs
						</h2>
						<div class="row cat-intro">
							<div class="col-sm-3">
								<img src="images/misc/cat-thumb-img1.jpg" alt="Image" class="img-responsive img-thumbnail" />
							</div>
							<div class="col-sm-9 cat-body">
								<p>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
								</p>
								<p>
									It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
								</p>
							</div>
						</div>		 -->			
		
	

			<?php 
			/*=====================================================
				2.	FILTER BAR
					1.	LIST / GRID VIEW 
					2.	SORT 
					3.	TOTAL PRODUCT SHOW
			=====================================================*/ ?>
			<!-- Product Filter Starts -->
			<div class="product-filter" style="margin-top: 0;">
				<div class="row">
					<div class="col-md-4">
						<div class="display">
							<?php 
								$display_format = "grid";
								$session_display_format = $this->session->userdata('display_format');

								if( isset( $session_display_format ) ){
									$display_format = $session_display_format;
								}
							?>
							<a href="<?php echo base_url()?>product/set_grid_or_list_view/list"
								class="<?php echo $display_format == 'list' ? 'active' : '' ?>">
								<i class="fa fa-th-list" title="List View"></i>
							</a>
							<a href="<?php echo base_url()?>product/set_grid_or_list_view/grid" 
								class="<?php echo $display_format == 'grid' ? 'active' : '' ?>">
								<i class="fa fa-th" title="Grid View"></i>
							</a>
						</div>
					 </div>
					<div class="col-md-2 text-right">
						<label class="control-label">Sort</label>
					</div>
					<form id="sort_form" action="<?php echo current_url() ?>" method="post" >
						<div class="col-md-3 text-right">
							<select class="form-control" name="sort_product" id="sort_product">
								<?php 
									$selected_ASC 	= '';
									$selected_DESC	= '';
									$session_sort_product = $this->session->userdata('sort_product');
									if( 	isset($session_sort_product) 
										&&  $session_sort_product != ''
									){
										if( $session_sort_product == "ASC" ){
											$selected_ASC 	= 'selected="selected"';
										}else{
											$selected_DESC 	= 'selected="selected"';	
										}
									}
								?>
								<option value="">Default</option>
								<option value="ASC" <?php echo $selected_ASC ?> >Name (A - Z)</option>
								<option value="DESC" <?php echo $selected_DESC ?> >Name (Z - A)</option>
							</select>
						</div>
						<div class="col-md-1 text-right">
							<label class="control-label" for="input-limit">Show</label>
						</div>
						<div class="col-md-2 text-right">
							<select name="show_total_product" id="show_total_product" class="form-control">
								<?php 
									$total_product = '';
									$session_show_total_product = $this->session->userdata('show_total_product');
									if( 	isset($session_show_total_product) 
										&&  $session_show_total_product != ''
									){
									 	$total_product = $session_show_total_product;	
									}
								?>
								<?php for($t=2;$t<20;$t=$t+2): ?>
									<option <?php echo $total_product == $t ? 'selected="selected"' : '' ?> value="<?php echo $t ?>"><?php echo $t ?></option>
								<?php endfor; ?>
							</select>
						</div>
						<!-- <input type="submit" id="sort_submit" /> -->
					</form>
				</div>						 
			</div>
			<!-- Product Filter Ends -->
			
	
			<?php 
			/*=====================================================
				3.	PRODUCT LIST 
			=====================================================*/ ?>
			<!-- Product Grid Display Starts -->
			<div class="row">
				<?php if(count($product_list->result()) > 0 ) :?>
				<?php foreach( $product_list->result() as $pr ): ?>
					<?php 
						if( $display_format == 'grid'){
							$product_class_out  = "col-md-4 col-sm-6";
							$product_class_in  	= "";
						}else if( $display_format == 'list' ){
							$product_class_out 	= "col-xs-12";	
							$product_class_in  	= "list clearfix";
						}
					?>
					<!-- Product #1 Starts -->
					<div class="<?php echo $product_class_out ?>">
						<div class="product-col <?php echo $product_class_in ?>">
							<div class="image">
								<img src="<?php echo base_url() ?>uploads/product/<?php echo $pr->product_id?>/thumb_<?php echo $pr->product_picture?>" 
									alt="<?php echo $pr->product_name; ?>" class="img-responsive" />
							</div>
							<div class="caption">
								<h4><a href="<?php echo base_url() ?>product/<?php echo $pr->slug ?>"><?php echo character_limiter($pr->product_name,'15'); ?></a></h4>
								<div class="description">
									<?php echo character_limiter($pr->description,'10'); ?>
								</div>
								<div class="price">
									<span class="price-new">Rp. <?php echo $this->cart->format_number($pr->price)?></span>
								</div>
								<div class="cart-button button-group">
									<a type="button" class="btn btn-cart" href="<?php echo base_url()?>product/<?php echo $pr->slug?>">
										Detail
									</a>			
									<button type="button" title="Wishlist" id="<?php echo $pr->product_id; ?>" class="btn btn-wishlist wishlist">
										<i class="fa fa-heart"></i>
									</button>
									<!-- <button type="button" title="Compare" class="btn btn-compare">
																<i class="fa fa-bar-chart-o"></i>
															</button>	 -->						
								</div>
							</div>
						</div>
					</div>
					<!-- Product #1 Ends -->
				<?php endforeach ?>
				<?php endif; ?>
			</div>
			<!-- Product Grid Display Ends -->
			
	
			<?php 
			/*=====================================================
				4.	PAGINATION
			=====================================================*/ ?>
			<!-- Pagination & Results Starts -->
			<div class="row">
			<!-- Pagination Starts -->
				<div class="col-sm-6 pagination-block">
					<?php echo $this->pagination->create_links(); ?>
				</div>
			<!-- Pagination Ends -->
			<!-- Results Starts -->
				<!-- <div class="col-sm-6 results">
					Showing 1 to 3 of 12 (4 Pages)
				</div> -->
			<!-- Results Ends -->
			</div>
			<!-- Pagination & Results Ends -->

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
<!-- Main Container Ends -->