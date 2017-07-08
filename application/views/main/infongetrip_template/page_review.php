<style type="text/css">
	#modal1{
		z-index: 430;

	}
	.easy-modal{
				z-index: 430;
		width: 600px;
		padding: 2em;
		box-shadow: 1px 1px 3px rgba(0,0,0,0.35);
		background-color: white;
	}
	.easy-modal-inner{
		z-index: 50;
		
	}
</style>
<section class="content-area">
<div class="container">
<div class="row">
	<div class="review">

	<div class="col-md-3">
		<button class="easy-modal-open" href="#modal1">Open modal #1</button> 
			<div class="easy-modal" id="modal1">
		<div class="easy-modal-inner">
			<h1>HTML Ipsum Presents</h1>

			<p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>

			<h2>Header Level 2</h2>

			<ol>
				<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
				<li>Aliquam tincidunt mauris eu risus.</li>
			</ol>

			<blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</p></blockquote>

			<h3>Header Level 3</h3>

			<ul>
				<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
				<li>Aliquam tincidunt mauris eu risus.</li>
			</ul>
			
			<button class="easy-modal-close" title="Close">&times;</button>
		</div>
	</div>
		<img class="img-rounded" src="<?php echo base_url()?>uploads/infongetrip/user/<?php echo $user->picture ?>" alt="" title="">
		<h2> <?php echo ucwords($user->user_name)  ?>  </h2>
		<p class="place-rev"> <i class="fa fa-map-marker marker" aria-hidden="true"></i> <?php echo $user->name; ?>, Join date:  <i><?php echo date('d F Y',strtotime($user->create_date)) ?></i>  </p>
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

