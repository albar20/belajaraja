<section class="content-area">
<div class="container">
<div class="row">
	<div class="review">

	<div class="col-md-3">
		<img class="img-rounded" src="<?php echo base_url()?>uploads/infongetrip/user/WIN_20160113_15_57_26_Pro.jpg" alt="" title="">
		<h2>Cahyo Prabowo</h2>
		<p class="place-rev"> <i class="fa fa-map-marker marker" aria-hidden="true"></i> Lampung selatan, Join date:  <i>2 Jan 2017</i>  </p>
<ul class="list-group menu-profile">
<a href="">  <li class="list-group-item sub-menu"><i class="fa fa-user" aria-hidden="true"></i>
 <?php echo ucwords('profile') ?></li> </a>	
<a href="">  <li class="list-group-item sub-menu"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
 <?php echo ucwords('review') ?></li> </a>	
<a href="">  <li class="list-group-item sub-menu"><i class="fa fa-plane" aria-hidden="true"></i>
 <?php echo ucwords('planning') ?></li> </a>	
</ul> 
	</div>
		<div class="col-md-9">
			<h2><i class="fa fa-quote-right" aria-hidden="true"></i>
 Client Constribution</h2>
			  <ul class="breadcrumb">
    <li class="active">Reviews (5)</li>
    <li><a href="#">Beach</a></li>
    <li><a href="#">Island</a></li>
    <li ><a href="#"> Place </a></li>        
  </ul>	
  <div class="table-reponsive paging-review">
		  <table class="table table-condensed review">
			<thead>
				<tr>
					<th class="images">

					</th>
					<th ></th>
					<th >Rating</th>
					<th class="helpfull">Helpful Votes</th>
					<th class="points">Points</th>
				</tr>

				<?php foreach ($review as $rev) {?>
				<tr>
					<td>  <img class="image_review" src="<?php echo base_url() ?>uploads/wisata/asdasdsad/thumb/thumb_11DreadOut_branding_image.jpg"></td>
					<td class="desc">
							<a href=""><i class="fa fa-map-marker" aria-hidden="true"></i>
						
 Barcelona: Hotel The Serras</a>
								<h3> <i> "<?php echo $rev->judul; ?>" </i> </h3>
								<p><?php echo $rev->review; ?></p>
								<b><i class="fa fa-calendar" aria-hidden="true"></i>
 <?php echo date('d F Y', strtotime($rev->create_date))?> </b> </td>
					<td class="rating">
						<h2> <?php echo $rev->rate; ?> </h2>
						<?php 															
																	for($i=1;$i<=$rev->rate;$i++){?>
																	<i class="fa fa-star"></i>
																<?php } ?>	
																<?php if($rev->rate < $i and $rev->rate > $i-1){
																?>
																<i class="fa fa-star-half-o"></i>
																<?php } 
																	for($j=$i;$j<5;$j++){
																?>	
																	<i class="fa fa-star-o"></i>
																<?php } ?>

						
					</td>
					<td class="help"> <h3>10 <i class="fa fa-thumbs-up" aria-hidden="true"></i></h3> </td>
					<td class="points"> <h3>100</h3> </td>
				</tr>
				<?php } ?>


			</thead>
		</table>
		</div>
		
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
	</div>
</div>
</div>
</section>

<style type="text/css">
.menu-profile{
	width: 100%;
	margin: 0px;
	margin-top: 5px;
}
.menu-profile .sub-menu{
	background-color: #5b6366!important;
	color: white;
}
.list-group-item:first-child {
    border-top-left-radius: 0px;
    border-top-right-radius: 0px;
}
.list-group-item:last-child {
    margin-bottom: 0;
    border-bottom-right-radius: 0px;
    border-bottom-left-radius: 0px;
}
.review{
	border-right: 1px solid  #ddd;
}
.review td,th{
	border-right: 0px;
}

.image_review{
	width: 200px;
}
.images{
	width: 200px;
}
.desc{
	width: 353px;
}
.desc h3{
	margin: 10px 0px;
}
.rating b{
	font-weight: normal;
}
.rating{
	width: 100px;
	text-align: center;
}
.rating i{
	margin-top: 30px;
	color: #ffb300;
}
.help i{
color: #ffb300;	
}
.help{
	text-align: center;
	width: 100px;
}
.points{
	text-align: center;
	width: 100px;
}
.pagination {
	margin: auto;
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;
}

.pagination a.active {
    background-color: #ffb300;
    color: white;
    border: 1px solid #ffb300;
}
</style>