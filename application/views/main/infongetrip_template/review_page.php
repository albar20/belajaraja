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