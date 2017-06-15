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
								<div id="review_form_wrapper">
									<div id="review_form">
										<div id="respond" class="comment-respond">
											<h3 id="reply-title" class="comment-reply-title">Silakan masukkan data tempat wisata yang ingin ada rekomendasikan.</h3>
											<form action="<?php echo $form_action?>" method="post" id="commentform" class="comment-form" novalidate="" enctype='multipart/form-data'>
												
												<p class="comment-form-author"><label for="author">Nama Wisata
													<span class="required">*</span></label>
													<input id="nama" name="nama" type="text" value="<?php echo (isset($rekomendasi) ? $rekomendasi->tour_name : "") ?>" size="30" required>
												</p>
												
												<p class="comment-form-author"><label for="author">Propinsi
													<span class="required">*</span></label>
													<select name="province_id" class="form-control" onchange="ambil_kota(this.value)" required>
														<option value="">-- Pilih Propinsi --</option>
														<?php foreach($province->result() as $row){ ?>
														<option value="<?php echo $row->id?>" <?php echo (isset($rekomendasi) && $rekomendasi->province_id == $row->id ? "selected" : "")?>><?php echo $row->name?></option>
														<?php } ?>
												   </select>
												</p>
												
												<p class="comment-form-author"><label for="author">Kota
													<span class="required">*</span></label>
													<select name="city_id" id="city" class="form-control" required>
														<?php if(isset($rekomendasi) && $rekomendasi->city_id != 0){ ?>
															<option value="<?php echo $rekomendasi->city_id ?>"><?php echo $rekomendasi->city_name ?> </option>
														<?php } else { ?>
															<option value="">-- Pilih Kota --</option>
														<?php } ?>
												   </select>
												</p>

												<p class="comment-form-comment">
													<label for="comment">Deskripsi
														<textarea id="deskripsi" name="deskripsi" cols="45" rows="8"><?php echo (isset($rekomendasi) ? $rekomendasi->tour_description : "") ?></textarea>
												</p>
												
												<p class="comment-form-author"><label for="author">Gambar Wisata
													<input id="gambar1" name="gambar1" type="file" value="<?php echo (isset($my_review) ? $my_review->judul : "") ?>" size="30" required>
													<input id="gambar2" name="gambar2" type="file" value="<?php echo (isset($my_review) ? $my_review->judul : "") ?>" size="30" required>
													<input id="gambar3" name="gambar3" type="file" value="<?php echo (isset($my_review) ? $my_review->judul : "") ?>" size="30" required>
												</p>
										<hr>		
												<p class="comment-form-rating">
													<label>Rating<span class="required">(optional)</span></label>
												</p>
												<p class="stars">
													<div id="rateOverall"></div><input type="hidden" name="nilai_rating" id="nilaiRating" value="<?php echo (isset($rekomendasi) ? $rekomendasi->rate : 0) ?>" required>
													<input type="hidden" name="tour_id" value=""/>
													<input type="hidden" name="tour_slug" value=""/>
												</p>
												
												<p class="comment-form-author"><label for="author">Judul Review
													<span class="required">(optional)</span></label>
													<input id="judul" name="judul" type="text" value="<?php echo (isset($rekomendasi) ? $rekomendasi->judul_review : "") ?>" size="30">
												</p>

												<p class="comment-form-comment">
													<label for="comment">Isi Review
														<span class="required">(optional)</span></label><textarea id="isi" name="isi" cols="45" rows="8"><?php echo (isset($rekomendasi) ? $rekomendasi->isi_review : "") ?></textarea>
												</p>

												<p class="form-submit">
													<input name="submit" type="submit" id="submit" class="submit" value="Submit">
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