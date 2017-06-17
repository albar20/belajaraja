<section class="content-area">
<div class="container">
<div class="row">
	<div class="review">

	<div class="col-md-3">
		<img class="img-rounded" src="<?php echo base_url()?>uploads/infongetrip/user/WIN_20160113_15_57_26_Pro.jpg" alt="" title="">
		<h2>Cahyo Prabowo</h2>
		<p class="place-rev"> <i class="fa fa-map-marker marker" aria-hidden="true"></i> Lampung selatan, Join date:  <i>2 Jan 2017</i>  </p>
<ul class="list-group menu-profile">
<a  href="<?php echo base_url() ?>review/?review">  <li class="list-group-item sub-menu"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
 <?php echo ucwords('Review') ?></li> </a>	
<a  href="<?php echo base_url() ?>review/?profile">  <li class="list-group-item sub-menu"><i class="fa fa-user" aria-hidden="true"></i>
 <?php echo ucwords('Profile') ?></li> </a>	
<a  href="<?php echo base_url() ?>review/?planning">  <li class="list-group-item sub-menu"><i class="fa fa-plane" aria-hidden="true"></i>
 <?php echo ucwords('planning') ?></li> </a>	
</ul> 
	</div>
		<div class="col-md-9">
    
			<?php if (isset($_GET['review'])) {
        $page_menuku = 'main/infongetrip_template/review_page';
      }elseif (isset($_GET['profile'])) {
        $page_menuku = 'main/infongetrip_template/profile_page';
      }else{
        $page_menuku = 'main/infongetrip_template/review_page';
      } ?>
      <?php $this->load->view($page_menuku); ?>


		</div>
	</div>
</div>
</div>
</section>

