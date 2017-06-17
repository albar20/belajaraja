<section class="content-area">
<div class="container">
<div class="row">
	<div class="review">

	<div class="col-md-3">
		<img class="img-rounded" src="<?php echo base_url()?>uploads/infongetrip/user/WIN_20160113_15_57_26_Pro.jpg" alt="" title="">
		<h2>Cahyo Prabowo</h2>
		<p class="place-rev"> <i class="fa fa-map-marker marker" aria-hidden="true"></i> Lampung selatan, Join date:  <i>2 Jan 2017</i>  </p>
<ul class="list-group menu-profile">
<a data-toggle="pill" href="#review">  <li class="list-group-item sub-menu"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
 <?php echo ucwords('Review') ?></li> </a>	
<a data-toggle="pill" href="#profile">  <li class="list-group-item sub-menu"><i class="fa fa-user" aria-hidden="true"></i>
 <?php echo ucwords('Profile') ?></li> </a>	
<a data-toggle="pill" href="#planning">  <li class="list-group-item sub-menu"><i class="fa fa-plane" aria-hidden="true"></i>
 <?php echo ucwords('planning') ?></li> </a>	
</ul> 
	</div>
		<div class="col-md-9">
			
		
<!-- tab  -->
  <div class="tab-content">
<!-- profile -->

    <div id="review" class="tab-pane fade in active">
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
<!-- end of profile -->


<!--    review --> 
    <div id="profile" class="tab-pane fade">
      <div class="line-header">
      <h1><?php echo ucwords($user->user_name);  ?></h1> </div> <i class="fa fa-map-marker marker" aria-hidden="true"> <?php echo $user->location; ?> </i> 
      <h4 class="job"><i class="fa fa-briefcase" aria-hidden="true"></i> &nbsp; <i><?php echo ucwords($user->job); ?></i> </h4>
      <div class="cleaner"></div>

      <h6 class="rank"> <?php echo strtoupper('thumbs'); ?> </h6>
       <h4 >8.6 &nbsp; <i class="fa fa-thumbs-up orange" aria-hidden="true"> </i>
       <h6 class="rank"> <?php echo strtoupper('total review'); ?> </h6>
       <h4 > <?php echo $total_rows; ?>  &nbsp; <i class="fa fa-pencil-square-o orange" aria-hidden="true"></i>
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
    </div>
<!--     end of review -->

<!--     planning -->
    <div id="planning" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
<!-- end of planning -->
  </div>
<!-- end of tab -->


		</div>
	</div>
</div>
</div>
</section>

