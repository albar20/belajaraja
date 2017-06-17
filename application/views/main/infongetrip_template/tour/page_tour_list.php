<section class="content-area">
			<div class="container">
				<div class="row">
					<div class="site-main col-sm-9 alignright">
						<ul class="tours products wrapper-tours-slider">
							<?php foreach($tour_list->result() as $row) { ?>
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
											echo '<span style="font-size:11px">Belum ada review</span>' ;
										}
										else
										{
											$rate = $row->nilai_rating/$row->total_review;
											for($i=1;$i<=$rate;$i++){?>
												<i class="fa fa-star"></i>
											<?php } ?>	
											<?php if($rate < $i and $rate > $i-1){
											?>
											<i class="fa fa-star-half-o"></i>
											<?php } 
												for($j=$i;$j<5;$j++){
											?>	
												<i class="fa fa-star-o"></i>
											<?php } 
										}	
											?>
										</div>
										<a rel="nofollow" href="<?php echo base_url()?>tour/detail/<?php echo $row->slug?>" class="button product_type_tour_phys add_to_cart_button">Read more</a>
									</div>
								</div>
							</li>
							<?php } ?>
						</ul>
						<div class="navigation paging-navigation" role="navigation">
							<?php echo $this->pagination->create_links(); ?>
							<!--<ul class="page-numbers">
								<li><span class="page-numbers current">1</span></li>
								<li><a class="page-numbers" href="#">2</a></li>
								<li><a class="next page-numbers" href="#"><i class="fa fa-long-arrow-right"></i></a>
								</li>
							</ul>-->
						</div>
					</div>
					<div class="widget-area align-left col-sm-3">
						<div class="search_tour">
							<div class="form-block block-after-indent">
								<h3 class="form-block_title">Search Tour</h3>
								<div class="form-block__description">Find your dream tour today!</div>
								<?php echo form_open('tour'); ?>
									<input type="hidden" name="tour_search" value="1">
									<input type="text" placeholder="Search Tour" value="" name="name_tour">

									<select id="cari" name="cari">
										<option value="">Cari Berdasarkan</option>
										<option value="kota">Kota</option>
										<option value="provinsi">Provinsi</option>
									</select>
										
									<select id="provinsi" name="provinsi">
										<option value="0">Pilih Provinsi</option>
										<?php foreach ($prov as $row) {
										?>
										<option value="<?php echo $row->id; ?>"><?php echo ucwords($row->name) ; ?></option>
										<?php } ?>
									</select>
									<select name="kota" id="kota">
										<option value="0">Pilih kota</option>
									</select>
									<select name="tourtax[pa_month]" id="desa">
										<option value="0">Desa</option>
									</select>
									<button type="submit" name="find">Find Tours</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>