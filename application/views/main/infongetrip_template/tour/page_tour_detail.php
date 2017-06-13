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
								
								<div class="tour-share">
									<ul class="share-social">
										<li>
											<a target="_blank" class="facebook" href="#"><i class="fa fa-facebook"></i></a>
										</li>
										<li>
											<a target="_blank" class="twitter" href="#"><i class="fa fa-twitter"></i></a>
										</li>
										<li>
											<a target="_blank" class="pinterest" href="#"><i class="fa fa-pinterest"></i></a>
										</li>
										<li>
											<a target="_blank" class="googleplus" href="#"><i class="fa fa-google"></i></a>
										</li>
									</ul>
								</div>
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
															<div class="comment-text">
																<div class="star-rating" title="">
																	<?php 															
																	for($i=1;$i<=$row->rate;$i++){?>
																	<i class="fa fa-star"></i>
																<?php } ?>	
																<?php if($row->rate < $i and $row->rate > $i-1){
																?>
																<i class="fa fa-star-half"></i>
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
																<button class="button-terimakasih" id="btn-like-<?php echo $row->tour_review_id?>" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Memproses" onclick="terimaKasih('<?php echo $row->tour_review_id?>')">Review Ini Sangat Membantu</button>
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
								<h2>Related Tours</h2>
								<ul class="tours products wrapper-tours-slider">
									<li class="item-tour col-md-4 col-sm-6 product">
										<div class="item_border item-product">
											<div class="post_images">
												<a href="single-tour.html">
													<span class="price">$93.00</span>
													<img width="430" height="305" src="http://placehold.it/430x305" alt="Discover Brazil" title="Discover Brazil">
												</a>
												<div class="group-icon">
													<a href="tours.html" data-toggle="tooltip" data-placement="top" title="" class="frist" data-original-title="Escorted Tour"><i class="flaticon-airplane-4"></i></a>
													<a href="tours.html" data-toggle="tooltip" data-placement="top" title="" data-original-title="Rail Tour"><i class="flaticon-cart-1"></i></a>
												</div>
											</div>
											<div class="wrapper_content">
												<div class="post_title"><h4>
													<a href="single-tour.html" rel="bookmark">Discover Brazil</a>
												</h4></div>
												<span class="post_date">5 DAYS 4 NIGHTS</span>
												<div class="description">
													<p>Aliquam lacus nisl, viverra convallis sit amet&nbsp;penatibus nunc&nbsp;luctus</p>
												</div>
											</div>
											<div class="read_more">
												<div class="item_rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<a rel="nofollow" href="single-tour.html" class="button product_type_tour_phys add_to_cart_button">Read more</a>
											</div>
										</div>
									</li>
									<li class="item-tour col-md-4 col-sm-6 product">
										<div class="item_border item-product">
											<div class="post_images">
												<a href="single-tour.html">
											<span class="price"><del>$87.00</del>
												<ins>$82.00</ins>
											</span>
													<span class="onsale">Sale!</span>
													<img width="430" height="305" src="http://placehold.it/430x305" alt="Discover Brazil" title="Discover Brazil">
												</a>
												<div class="group-icon">
													<a href="tours.html" data-toggle="tooltip" data-placement="top" title="" class="frist" data-original-title="River Cruise"><i class="flaticon-transport-2"></i></a>
													<a href="tours.html" data-toggle="tooltip" data-placement="top" title="" data-original-title="Wildlife"><i class="flaticon-island"></i></a>
												</div>
											</div>
											<div class="wrapper_content">
												<div class="post_title"><h4>
													<a href="single-tour.html" rel="bookmark">Kiwiana Panorama</a>
												</h4></div>
												<span class="post_date">5 DAYS 4 NIGHTS</span>
												<div class="description">
													<p>Aliquam lacus nisl, viverra convallis sit amet&nbsp;penatibus nunc&nbsp;luctus</p>
												</div>
											</div>
											<div class="read_more">
												<div class="item_rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<a rel="nofollow" href="single-tour.html" class="button product_type_tour_phys add_to_cart_button">Read more</a>
											</div>
										</div>
									</li>
									<li class="item-tour col-md-4 col-sm-6 product">
										<div class="item_border item-product">
											<div class="post_images">
												<a href="single-tour.html">
													<span class="price">$64.00</span>
													<img width="430" height="305" src="http://placehold.it/430x305" alt="Discover Brazil" title="Discover Brazil">
												</a>
												<div class="group-icon">
													<a href="tours.html" data-toggle="tooltip" data-placement="top" title="" class="frist" data-original-title="Escorted Tour"><i class="flaticon-airplane-4"></i></a>
													<a href="tours.html" data-toggle="tooltip" data-placement="top" title="" data-original-title="River Cruise"><i class="flaticon-transport-2"></i></a>
												</div>
											</div>
											<div class="wrapper_content">
												<div class="post_title"><h4>
													<a href="single-tour.html" rel="bookmark">Anchorage to Quito</a>
												</h4></div>
												<span class="post_date">5 DAYS 4 NIGHTS</span>
												<div class="description">
													<p>Aliquam lacus nisl, viverra convallis sit amet&nbsp;penatibus nunc&nbsp;luctus</p>
												</div>
											</div>
											<div class="read_more">
												<div class="item_rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o"></i>
												</div>
												<a rel="nofollow" href="single-tour.html" class="button product_type_tour_phys add_to_cart_button">Read more</a>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="summary entry-summary description_single">
							<div class="affix-sidebar">
								<div class="entry-content-tour">
									
									<div class="clear"></div>
									<div class="booking">
										<div class="">
											<div class="form-block__title">
												<h4>Rating</h4>
											</div>
											<div id="tourBookingForm">
												<p><?php echo $tour_rating?></p>
											
												<p>
													<?php 																					for($i=1;$i<=$tour_rating;$i++){?>
														<i style="font-size:2em;color:#ffb300;" class="fa fa-star" aria-hidden="true"></i>
													<?php } ?>	
													<?php if($tour_rating < $i and $tour_rating > $i-1){
													?>
													<i style="font-size:2em;color:#ffb300;" class="fa fa-star-half" aria-hidden="true"></i>
													<?php } ?>
												</p>
											
											
												<a href="<?php echo base_url()?>review/add/<?php echo $tour->slug?>"><input class="btn-booking btn" value="Tulis Review" type="submit"></a>
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