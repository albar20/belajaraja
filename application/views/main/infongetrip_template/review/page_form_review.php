<section class="content-area">
			<div class="container">
				<div class="row">
					<div class="site-main col-sm-8 col-sm-offset-2">
					<?php


      $message = $this->session->flashdata('warning');


      echo $message == '' ? '' : '<div class="alert">


        <button type="button" class="close" data-dismiss="alert">&times;</button>


        <i class="fa fa-warning"></i> ' . $message . '</div>';


    ?>


    <?php
      $message = $this->session->flashdata('danger');
      echo $message == '' ? '' : '<div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-times"></i> ' . $message . '</div>';

      $message = $this->session->flashdata('success');
      echo $message == '' ? '' : '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-check"></i> ' . $message . '</div>';

      $message = $this->session->flashdata('info');
      echo $message == '' ? '' : '<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-exclamation"></i> ' . $message . '</div>';
    ?>
						<ul class="tours products wrapper-tours-slider">
							<li class="item-list-tour col-md-12 product">
								<div class="content-list-tour">
									<div class="post_images">
										<a href="<?php echo base_url()?>tour/detail/<?php echo $tour->slug?>">
											<img width="430" height="305" src="<?php echo base_url()?>uploads/wisata/<?php echo $tour->slug?>/thumb/thumb_<?php echo $tour->picture_1?>" alt="Discover Brazil" title="Discover Brazil">
										</a>
										
									</div>
									<div class="wrapper_content">
										<div class="content-left">
											<div class="post_title"><h4>
												<a href="<?php echo base_url()?>tour/detail/<?php echo $tour->slug?>" rel="bookmark"><?php echo $tour->name?></a>
											</h4></div>
											<div class="description">
												<p><?php echo $tour->description?></p>
											</div>
										</div>
										<div class="content-right">
											<div class="item_rating">
												<div class="item_rating">
													<?php 																					for($i=1;$i<=$tour_rating;$i++){?>
														<i class="fa fa-star" aria-hidden="true"></i>
													<?php } ?>	
													<?php if($tour_rating < $i and $tour_rating > $i-1){
														$i++;
													?>
													<i class="fa fa-star-half" aria-hidden="true"></i>
													<?php } ?>
													<?php 
														for($j=$i;$j<=5;$j++){
													?>	
														<i class="fa fa-star-o"></i>
													<?php } ?>
												</div>
											</div>
											<span class="price"><?php echo $tour_rating?></span>
											
										</div>
									</div>
								</div>
							</li>
							<li class="item-list-tour col-md-12 product">
								<div id="review_form_wrapper">
									<div id="review_form">
										<div id="respond" class="comment-respond">
											<h3 id="reply-title" class="comment-reply-title">Terima kasih, Review dari anda akan sangat membantu traveller lainnya.</h3>
											<form action="<?php echo base_url()?>review/add_process" method="post" id="commentform" class="comment-form" novalidate="" enctype='multipart/form-data'>
												<p class="comment-form-rating">
													<label>Rating</label>
												</p>
												<p class="stars">
													<div id="rateOverall"></div><input type="hidden" name="nilai_rating" id="nilaiRating" value="<?php echo (isset($my_review) ? $my_review->rate : 0) ?>" required>
													<input type="hidden" name="tour_id" value="<?php echo $tour->tourism_place_id?>"/>
													<input type="hidden" name="tour_slug" value="<?php echo $tour->slug?>"/>
												</p>
												
												<p class="comment-form-author"><label for="author">Judul Review
													<span class="required">*</span></label>
													<input id="judul" name="judul" type="text" value="<?php echo (isset($my_review) ? $my_review->judul : "") ?>" size="30" required>
												</p>

												<p class="comment-form-comment">
													<label for="comment">Isi Review
														<span class="required">*</span></label><textarea id="isiSummernote" name="isi" cols="45" rows="8" required><?php echo (isset($my_review) ? $my_review->review : "") ?></textarea>
												</p>
												
												<p class="comment-form-author" id="bs-datepicker-component">
													<label for="comment">Tanggal Berkunjung
														<span class="required">(Optional)</span></label>
													<input required type="text" name="tanggal_berkunjung" class="form-control" value="<?php echo (isset($my_review) ? date("m/d/Y", strtotime($my_review->tanggal_berkunjung)) : "") ?>">
												</p>

												<p class="comment-form-author"><label for="author">Masukkan Gambar (optional)
													<input id="gambar1" name="gambar1" type="file" size="30" required>
													<input id="gambar2" name="gambar2" type="file" size="30" required>
													<input id="gambar3" name="gambar3" type="file" size="30" required>
													<div class="row">
														<?php if(isset($my_review) && $my_review->picture_1 != ""){ ?>
														<div class="col-md-2">
															<img src="<?php echo base_url()?>uploads/review/<?php echo $slug?>/thumb/thumb_<?php echo $my_review->picture_1?>" />
														</div>
														<?php } ?>
														<?php if(isset($my_review) && $my_review->picture_2 != ""){ ?>
														<div class="col-md-2">
															<img src="<?php echo base_url()?>uploads/review/<?php echo $slug?>/thumb/thumb_<?php echo $my_review->picture_2?>" />
														</div>
														<?php } ?>
														<?php if(isset($my_review) && $my_review->picture_3 != ""){ ?>
														<div class="col-md-2">
															<img src="<?php echo base_url()?>uploads/review/<?php echo $slug?>/thumb/thumb_<?php echo $my_review->picture_3?>" />
														</div>
														<?php } ?>
													</div>
												</p>
												
												<p class="form-submit">
													<input name="submit" type="submit" id="submit" class="submit" value="Submit">
													<a href="<?php echo base_url()?>tour/detail/<?php echo $tour->slug?>" class="btn btn-danger">Batal</a>
												</p></form>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>