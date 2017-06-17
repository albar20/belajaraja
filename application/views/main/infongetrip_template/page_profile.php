<section class="content-area">
<div class="container">

<div class="row">
<style type="text/css">
/*input[type='file'] {
  color: transparent;
}*/
</style>
	<div class="col-md-4">
<!-- <input type="file" > -->
					<div class="item-tour">
								<div class="item_border">
									<div class="item_content">
										<div class="post_images">
											<a href="<?php echo base_url()?>tour/detail/<?php  ?>" class="travel_tour-LoopProduct-link">
												<img src="<?php echo base_url()?>uploads/infongetrip/user/<?php echo $user->picture;  ?>" alt="" title="">
											</a>
											
										</div>
								
									</div>
									<div class="read_more">
										<div class="item_rating">
											<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
										</div>
										<a href="" class="read_more_button">VIEW MORE
											<i class="fa fa-long-arrow-right"></i></a>
										<div class="clear"></div>
									</div>
								</div>
							</div>	
							<div class="rank">Recent Review </div>
							<div class="paging_user">
							<?php
							$page = 4;
							$awal_data = 1;
							$offset = ($awal_data-1) * $page;
							$sql = "SELECT * FROM tourism_place LIMIT $offset,$page";
							$pagings  = $this->db->query($sql);

							 foreach ($pagings->result() as $rev ) {
							?>
							<div class="review-user">
										<div class="res">
									<h4 class="title-rev"><?php echo $rev->tourism_place_id; ?> Teluk Kiluan</h4>
								 <a href="">	<i class="when"> Read More </i> </a>
									</div>
									<div class="cleaner"></div>
									<p class="place-rev"> <i class="fa fa-map-marker marker" aria-hidden="true"></i> Lampung selatan, Sumatera Selatan / Jan 2017 </p>
									<hr>
							</div>
							<?php } ?>
							</div>
							 <?php
							 $link = ceil($paging/$page);
							  for ($i=1; $i <=$link ; $i++) { 
							  ?>
							  <a class="page_user" link="<?php echo $i; ?>" href="javascript:"> <?php echo $i; ?> </a>
							  <?php } ?>
	</div>
	<div class="col-md-8">

	</div>
</div>

</div>
</section>