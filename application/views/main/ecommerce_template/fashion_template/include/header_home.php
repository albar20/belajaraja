<header class="header-wrap">
	
	<!-- Top Bar Starts -->
	<!-- <div class="top-bar hidden-xs"> -->
	<div class="top-bar">
	<!-- Nested Container Starts -->
		<div class="container">
		<!-- Nested Row Starts -->
			<div class="row">
			<!-- Top Links Starts -->
				<div class="col-md-7 col-sm-8 col-xs-12">
					<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/menu')?>
				</div>
			<!-- Top Links Ends -->
			<!-- Currency & Languages Starts -->
				<!-- <div class="col-md-2 col-sm-4 col-xs-12">
					<div class="pull-right">						
						<?php //$this->load->view('main/'.$this->themes_folder_name.'/include/header_translator')?>
					</div>
				</div> -->
			<!-- Currency & Languages Ends -->
			<!-- Search Starts -->
				<div class="col-md-3 col-sm-6 col-xs-12">
					<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/header_search_bar')?>
				</div>
			<!-- Search Ends -->
			<!-- Shopping Cart Starts -->
				<div class="col-md-2 col-sm-6 col-xs-12">
					<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/header_shopping_cart')?>
				</div>
			<!-- Shopping Cart Ends -->
			</div>
		<!-- Nested Row Ends -->
		</div>
	<!-- Nested Container Ends -->
	</div>
	<!-- Top Bar Ends -->

	<!-- Main Menu Starts -->
	<nav id="main-menu" class="navbar" role="navigation">
		<!-- Nested Container Starts -->
		<div class="container">
			<!-- Nav Header Starts -->
			<div class="navbar-header">
				<button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-cat-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<i class="fa fa-bars"></i>
				</button>
			</div>
			<!-- Nav Header Ends -->
			<!-- Navbar Cat collapse Starts -->
			<div class="collapse navbar-collapse navbar-cat-collapse">
				<ul class="nav navbar-nav">
					<?php
						$category_product_list = $this->category_product;
						$category_product = $category_product_list->result();
						if( count($category_product) > 0 ): ?>
					<?php foreach($category_product as $cp ): ?>
					<?php 
						$sub_category_product_list = $this->subcategory_product;
						$class_drop_down = '';
						if( count($sub_category_product_list->result()) > 0 ){
							$class_drop_down = 'dropdown';
						} 
					?>
					<li class="<?php echo $class_drop_down; ?>">
						<a class="dropdown-toggle" data-toggle="dropdown" data-delay="10"> <?php echo $cp->category_product_name ?></a>
						<?php if( count($sub_category_product_list->result()) > 0 ): ?>
							<ul class="dropdown-menu" role="menu">
									<?php foreach($sub_category_product_list->result() as $scp ): ?>
										<?php if( $scp->category_product_id == $cp->category_product_id ): ?>
										
											<li><a tabindex="-1" href="<?php echo base_url() ?>product/category/<?php echo $scp->slug ?>">
												<?php echo $scp->subcategory_product_name; ?></a></li>
										<?php endif; ?>
									<?php endforeach; ?>
									</ul>
								
						<?php endif; ?>
					</li>
					<?php endforeach;?>
					<?php endif; ?>
				</ul>
			</div>
			<!-- Navbar Cat collapse Ends -->
		</div>
		<!-- Nested Container Starts -->
	</nav>
	<!-- Main Menu Ends -->

	<!-- Slider Starts -->
	<div id="main-carousel" class="carousel slide" data-ride="carousel">
	<!-- Wrapper For Slides Starts -->
		<div class="carousel-inner">
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
				</div>
			<?php 
				$x++;
				endforeach; ?>
			<?php endif; ?>


			<!-- <div class="item active">
				<img src="<?php //echo base_url()?>assets/fashion/images/slider-imgs/slider-img1.jpg" alt="Slider" class="img-responsive" />
			</div>
			<div class="item">
				<img src="<?php //echo base_url()?>assets/fashion/images/slider-imgs/slider-img2.jpg" alt="Slider" class="img-responsive" />
			</div> -->
		</div>
	<!-- Wrapper For Slides Ends -->
	<!-- Controls Starts -->
		<a class="left carousel-control" href="#main-carousel" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		</a>
		<a class="right carousel-control" href="#main-carousel" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		</a>
	<!-- Controls Ends -->
	</div>
	<!-- Slider Ends -->
	
	
		
	<!-- Logo Wrap Starts -->
	<div class="logo-wrap container">

	</div>
	<!-- Logo Wrap Ends -->
	</header>