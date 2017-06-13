<?php 
/*================================================================================
	1.	NAVIGATION
	2.	SEARCH
	2.	LOGO
	3.	SHOPPING CART
	4.	CATEGORY NAVIGATION
================================================================================*/ ?>		
	


	<!-- Header Wrap Starts -->
	<header class="header-wrap">
	

		<!-- Slider Starts -->
		<div id="main-carousel" class="carousel slide carousel-fade" data-ride="carousel">
		<!-- Indicators Starts -->
			<ol class="carousel-indicators hidden-sm hidden-xs">
				<?php if( count($slider_list->result()) > 0 ): ?>
				<?php 
					
					$x = 0;
					foreach( $slider_list->result() as $sl ): 
						$active = '';
						if($x == 0){
							$active = 'active';
						}
				?>
					<li data-target="#main-carousel" data-slide-to="<?php echo $x; ?>" class="<?php echo $active; ?>"></li>
				<?php 
					$x++;
					endforeach; ?>
				<?php endif; ?>
			</ol>
		<!-- Indicators Ends -->
		<!-- Wrapper For Slides Starts -->


			<div class="carousel-inner">
				<!-- Wrapper For Slides Starts -->
				<?php if( count($slider_list->result()) > 0 ): ?>
				<?php 
					
					$x = 0;
					foreach( $slider_list->result() as $sl ): 
						$active = '';
						if($x == 0){
							$active = 'active';
						}
				?>
					<div class="item <?php echo $active; ?>">
						<a href="<?php echo $sl->slider_link?>" target="blank">
							<img src="<?php echo base_url()?>uploads/slider/thumb/<?php echo $sl->slider_picture ?>" alt="Slider" class="img-responsive slider-image" />
						</a>
						
						<!-- <div class="carousel-caption text-center hidden-xs">
							<h1>Full Frame Nikon SLR Cameras</h1>
							<p>
								Lorem Ipsum is simply dummy text of the printing<br> and typesetting industry.
							</p>
							<h2>Starts From <span>$899.90</span></h2>
						</div> -->
					</div>
				<?php 
					$x++;
					endforeach; ?>
				<?php endif; ?>
			</div>
		<!-- Wrapper For Slides Ends -->
		<!-- Controls Starts -->
			<a class="left carousel-control hidden-xs" href="#main-carousel" role="button" data-slide="prev">
				<span class="fa fa-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control hidden-xs" href="#main-carousel" role="button" data-slide="next">
				<span class="fa fa-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		<!-- Controls Ends -->
		</div>
		<!-- Slider Ends -->
	

	<!-- Header Top Starts -->
		<div class="header-top">
		<!-- Nested Container Starts -->
			<div class="container">
			<!-- Nested Row Starts -->
				<div class="row">
					<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/header-logo')?>
				
					<!-- Header Top Links Starts -->
					<?php 
					/*================================================================================
						1.	NAVIGATION
					================================================================================*/ ?>	
					<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/menu')?>
					<!-- Header Top Links Ends -->
				
					<!-- Shopping Cart Starts -->
					<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/header-shopping-cart')?>	
					<!-- Shopping Cart Ends -->
				</div>
			<!-- Nested Row Ends -->
			</div>
		<!-- Nested Container Ends -->
		</div>
		<!-- Header Top Ends -->


		<?php 
		/*================================================================================
			4.	CATEGORY NAVIGATION
		================================================================================*/ ?>
		<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/header-category-navigation')?>	

	</header>
<!-- Header Wrap Ends -->