<section class="content-area single-woo-tour">
			<div class="container">
				<div class="tb_single_tour product">
					<div class="top_content_single row">
						<div class="images images_single_left">
							<div class="title-single">
								<div class="title">
									<h1><?php echo $tour->name?></h1>
								</div>
								
							</div>
							<div class="tour_after_title">
								
								
							</div>
							<div id="slider" class="flexslider">
								<ul class="slides">
								<?php if($tour->picture_1 != ''){ ?>	
									<li>
										<a href="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_1?>" class="swipebox" title=""><img width="950" height="550" src="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_1?>" class="wp-post-image" alt="" title="" draggable="false"></a>
									</li>
								<?php } ?>	
								<?php if($tour->picture_2 != ''){ ?>	
									<li>
										<a href="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_2?>" class="swipebox" title=""><img width="950" height="550" src="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_2?>" class="wp-post-image" alt="" title="" draggable="false"></a>
									</li>
								<?php } ?>	
								<?php if($tour->picture_3 != ''){ ?>	
									<li>
										<a href="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_3?>" class="swipebox" title=""><img width="950" height="550" src="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_3?>" class="wp-post-image" alt="" title="" draggable="false"></a>
									</li>
								<?php } ?>	
								<?php if($tour->picture_4 != ''){ ?>	
									<li>
										<a href="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_4?>" class="swipebox" title=""><img width="950" height="550" src="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_4?>" class="wp-post-image" alt="" title="" draggable="false"></a>
									</li>
								<?php } ?>	
								<?php if($tour->picture_5 != ''){ ?>	
									<li>
										<a href="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_5?>" class="swipebox" title=""><img width="950" height="550" src="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_5?>" class="wp-post-image" alt="" title="" draggable="false"></a>
									</li>
								<?php } ?>	
								</ul>
							</div>
							<div id="carousel" class="flexslider thumbnail_product">
								<ul class="slides">
								<?php if($tour->picture_1 != ''){ ?>		
									<li>
										<img width="150" height="100" src="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_1?>" class="wp-post-image" alt="" title="" draggable="false">
									</li>
								<?php } ?>		
								<?php if($tour->picture_2 != ''){ ?>		
									<li>
										<img width="150" height="100" src="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_2?>" class="wp-post-image" alt="" title="" draggable="false">
									</li>
								<?php } ?>	
								<?php if($tour->picture_3 != ''){ ?>		
									<li>
										<img width="150" height="100" src="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_3?>" class="wp-post-image" alt="" title="" draggable="false">
									</li>
								<?php } ?>		
								<?php if($tour->picture_4 != ''){ ?>		
									<li>
										<img width="150" height="100" src="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_4?>" class="wp-post-image" alt="" title="" draggable="false">
									</li>
								<?php } ?>		
								<?php if($tour->picture_5 != ''){ ?>		
									<li>
										<img width="150" height="100" src="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_5?>" class="wp-post-image" alt="" title="" draggable="false">
									</li>
								<?php } ?>		
								</ul>
							</div>
							<div class="clear"></div>
							<div class="single-tour-tabs wc-tabs-wrapper">
								<ul class="tabs wc-tabs" role="tablist">
									<li class="reviews_tab active" role="presentation">
										<a href="#tab-reviews" role="tab" data-toggle="tab">Reviews (<?php echo $list_review->num_rows()?>)</a>
									</li>
									<li class="description_tab" role="presentation">
										<a href="#tab-description" role="tab" data-toggle="tab">Description</a>
									</li>
									<li class="location_tab_tab" role="presentation">
										<a href="#tab-location_tab" role="tab" data-toggle="tab">Location</a>
									</li>
								</ul>
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane single-tour-tabs-panel single-tour-tabs-panel--reviews panel entry-content wc-tab active" id="tab-reviews">
										<div id="reviews" class="travel_tour-Reviews">
											<div id="comments">
											<?php if($list_review->num_rows() > 0){ ?>
												<ol class="commentlist">
												<?php foreach($list_review->result() as $row){ ?>
													<li itemscope="" itemtype="http://schema.org/Review" class="comment byuser comment-author-physcode bypostauthor even thread-even depth-1" id="li-comment-62">
														<div id="comment-62" class="comment_container">
															<img alt="" src="http://placehold.it/90x90" class="avatar avatar-60 photo" height="60" width="60">
															<div id="jumlahsuka<?php echo $row->tour_review_id?>">suka</div>
															<div class="comment-text" id="commentText<?php echo $row->tour_review_id?>">
																<div class="star-rating" title="">
																	<?php 															
																	for($i=1;$i<=$row->rate;$i++){?>
																	<i class="fa fa-star"></i>
																<?php } ?>	
																<?php if($row->rate < $i and $row->rate > $i-1){
																	$i++;
																?>
																<i class="fa fa-star-half-o"></i>
																<?php } 
																	for($j=$i;$j<=5;$j++){
																?>	
																	<i class="fa fa-star-o"></i>
																<?php } ?>
																</div>
																<p class="meta">
																	<strong><?php echo $row->judul?></strong> –
																	<?php echo date('d F Y', strtotime($row->tanggal_review))?>
																	:
																</p>
																<div class="description">
																	<p><?php echo $row->review?></p>
																</div>
																<?php
																if($this->session->userdata('logged_in_user') == TRUE){
																$like	= $this->db->query("select * from tour_review_like where tour_review_id = '$row->tour_review_id' and user_id = '$user_id' limit 1");
																if($like->num_rows() > 0){
																?>
																<button class="button-sudah-terimakasih">Anda Menyukai Review Ini</button>
																<?php } else { ?>
																<button class="button-terimakasih" id="btn-like-<?php echo $row->tour_review_id?>" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Memproses" onclick="terimaKasih('<?php echo $row->tour_review_id?>')">Review Ini Sangat Membantu</button>
																<?php	} 
																} ?>
															</div>
														</div>
													</li>
												<?php } ?>	
												</ol>
												<?php } else { ?>
												<div class="alert alert-info">
												<i class="fa fa-exclamation"></i>Belum Ada Review</div>
												<?php } ?>
											</div>
											
											<div class="clear"></div>
										</div>
									</div>
									<div role="tabpanel" class="tab-pane single-tour-tabs-panel single-tour-tabs-panel--description panel entry-content wc-tab" id="tab-description">
										<p><?php echo $tour->description?></p>
									</div>
									<div role="tabpanel" class="tab-pane single-tour-tabs-panel single-tour-tabs-panel--location_tab panel entry-content wc-tab" id="tab-location_tab">
										<div class="wrapper-gmap">
											<div id="googleMapCanvas" class="google-map" data-lat="50.893577" data-long="-1.393483" data-address="European Way, Southampton, United Kingdom"></div>
										</div>
									</div>
								</div>
							</div>
							<div class="related tours">
								<h2>Wisata Lainnya</h2>
								<ul class="tours products wrapper-tours-slider">
									<?php foreach($related->result() as $row) { ?>
									<li class="item-tour col-md-4 col-sm-6 product">
										<div class="item_border item-product">
											<div class="post_images">
												<a href="<?php echo base_url()?>tour/detail/<?php echo $row->slug?>">
													<img width="430" height="305" src="<?php echo base_url()?>uploads/wisata/<?php echo $row->slug?>/thumb/thumb_<?php echo $row->picture_1?>" alt="" title="">
												</a>
											</div>
											<div class="wrapper_content">
												<div class="post_title"><h4>
													<a href="<?php echo base_url()?>tour/detail/<?php echo $row->slug?>" rel="bookmark"><?php echo ucwords($row->name) ?></a>
												</h4></div>
												<div class="description">
													<p><?php echo ucwords(character_limiter($row->description, 100)) ?></p>
												</div>
											</div>
											<div class="read_more">
												<div class="item_rating">
													<?php
												if($row->total_review == 0)
												{
													echo '<span style="font-size:10px">Belum ada review</span>' ;
												}
												else
												{
													$rate = $row->nilai_rating/$row->total_review;
													for($i=1;$i<=$rate;$i++){?>
														<i class="fa fa-star"></i>
													<?php } ?>	
													<?php if($rate < $i and $rate > $i-1){
														$i++;
													?>
													<i class="fa fa-star-half-o"></i>
													<?php } 
														for($j=$i;$j<=5;$j++){
													?>	
														<i class="fa fa-star-o"></i>
													<?php } 
												}	
													?>
												</div>
												<a rel="nofollow" href="<?php echo base_url()?>tour/detail/<?php echo $row->slug?>" class="button product_type_tour_phys add_to_cart_button">Selanjutnya</a>
											</div>
										</div>
									</li>
							<?php } ?>
								</ul>
							</div>
						</div>
						<div class="summary entry-summary description_single">
							<div class="affix-sidebar">
								<div class="entry-content-tour">
									
									<div class="clear"></div>
									<div class="booking">
										<div class="">
											<div id="tourBookingForm">
											<?php if($list_review->num_rows() > 0){ ?>
												<p class="nilai-rating"><?php echo $tour_rating?></p>
											
												<p class="bintang-rating-big">
													<?php 																					for($i=1;$i<=$tour_rating;$i++){?>
														<i class="fa fa-star" aria-hidden="true"></i>
													<?php } ?>	
													<?php if($tour_rating < $i and $tour_rating > $i-1){
														$i++;
													?>
													<i class="fa fa-star-half-o" aria-hidden="true"></i>
													<?php } 
														for($j=$i;$j<=5;$j++){
													?>	
														<i class="fa fa-star-o"></i>
													<?php } ?>
												</p>
											
												<a href="<?php echo base_url()?>review/add/<?php echo $tour->slug?>"><input class="btn-booking btn" value="Tulis Review" type="submit"></a>
											<?php } else { ?>	
												<h1><strong>Belum Ada Rating</strong></h1>
											<?php } ?>	
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>