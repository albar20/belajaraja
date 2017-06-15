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
							<div class="rank">Recent Review</div>
							<?php foreach ($paging as $rev ) {
							?>
							<div class="review-user">
										<div class="res">
									<h4 class="title-rev"> Teluk Kiluan</h4>
								 <a href="">	<i class="when"> Read More </i> </a>
									</div>
									<div class="cleaner"></div>
									<p class="place-rev"> <i class="fa fa-map-marker marker" aria-hidden="true"></i> Lampung selatan, Sumatera Selatan / Jan 2017 </p>
									<hr>
							</div>
							<?php } ?>
	</div>
	<div class="col-md-8">
		<div class="line-header">
		<h1><?php echo ucwords($user->user_name);  ?></h1> </div> <i class="fa fa-map-marker marker" aria-hidden="true"> <?php echo $user->location; ?> </i> 
		<h4 class="job"><i class="fa fa-briefcase" aria-hidden="true"></i> &nbsp; <i><?php echo ucwords($user->job); ?></i> </h4>
		<div class="cleaner"></div>

		<h6 class="rank"> <?php echo strtoupper('thumbs'); ?> </h6>
	    <h4 >8.6 &nbsp; <i class="fa fa-thumbs-up orange" aria-hidden="true"> </i>
	    <h6 class="rank"> <?php echo strtoupper('total review'); ?> </h6>
	    <h4 >7 &nbsp; <i class="fa fa-pencil-square-o orange" aria-hidden="true"></i>
  </h4>	

<ul class="nav nav-tabs tab">
    <li class="active"><a data-toggle="tab" href="#home">  Contacs</a></li>
    <li><a data-toggle="tab" href="#menu1">View Message</a></li>
<!--     <li><a data-toggle="tab" href="#menu2">Review</a></li>
    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li> -->
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <div class="rank">CONTACT INFORMATION</div> 
      <a href="javascript:" class="update_user" id="update_user">Update Data</a>
    
      <table class="info-table">
  	
      </table> 
      
            <table  class="update-table">
      	<tr>
      		<td> <b>Phone</b> </td>
      		<td>:</td>
      		<td> <input type="text" id="phone"> </td>
      	</tr>
      	 <tr>
      		<td> <b>Address</b> </td>
      		<td>:</td>
      		<td> <textarea id="address" name="address"></textarea>    </td>
      	</tr>
      	 <tr>
      		<td> <b>Email</b> </td>
      		<td>:</td>
      		<td><?php echo $user->email ?></td>
      	</tr>
      	 <tr>
      		<td> <b>Site</b> </td>
      		<td>:</td>
      		<td> <input type="text" id="site"></td>
      	</tr>
      	      	<tr>
      		<td> <b>Birthday</b> </td>
      		<td>:</td>
      		<td><input type="text" id="birthday"></td>
      	</tr>
      	 <tr>
      		<td> <b>Gender</b> </td>
      		<td>:</td>
      		<td> <select  name="gender" id="gender">
      			<?php if ($user->gender == 'Male'): ?>
		      		<option value="Male" selected> Male </option>
      				<option value="Female"> Female </option>      				
      			<?php else: ?>
      			      			<option value="Male"> Male </option>
      				<option value="Female" selected> Female </option>
      			<?php endif ?>

      		</select> </td>
      	</tr>
      </table> 
   <a href="javascript:" class="update_user" id="save_user">Save Data</a>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3 >REVIEW</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>

  </div>

		<style type="text/css">

		.line-header{
			float: left;
			margin-bottom: -12px;
		}
		.marker{
			margin-top: 30px;
			margin-left: 10px;
		}
		.cleaner{
			clear: both;
		}
		.job{
			font-size: 16px;
			color: #ffb300;
		}
		.res{
			overflow: hidden;
		}
		.rank{
			margin-top: 20px;
			/*margin-bottom: px;*/
			font-weight: bolder;
			font-size: 10px;
		}
		.orange{
			color: #ffb300;
		}
		.tab{
			margin-left: -6px;
			margin-top: 40px;
		}
		.info-table,tr,td{
			border: none;
		}
		.info-table td{
		
			padding: 10px 10px;
		}
				.update-table,tr,td{
			border: none;
		}
		.update-table td{
		
			padding: 10px 10px;
		}
		.when{
			background-color:  #ffb300;
			color: white;
			padding: 2px 5px;
			float: right;
			font-size: 9px;
			margin-right: 15px;
		}
		.title-rev{
			float: left;
			
		}
		.review-user h5{
			font-size: 12px;
			margin-top: -20px;
		}
		.place-rev{
			margin-top: -28px;
			margin-left: -10px;
			font-size: 10px;
			/*float: left;*/
		}
		.update_user{
			background-color: #ffb300;
			padding: 5px 10px;
			color: white;
			border-radius: 2px;
		}
		.update_user:hover{
			color: white;
			background-color: #23527c;
		}

		</style>
	</div>
</div>

</div>
</section>