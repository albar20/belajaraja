<?php
/*=========================================================================
	1.	BANNER
	2.	MENU
	3.	TRANSLATOR
	4.	CURRENCY
	5.	SEARCH
	6.	SHOPPING CART 
	7.	

=========================================================================*/ ?>
<header class="header-wrap inner">
	<!-- Top Bar Starts -->
		<div class="top-bar">
		<!-- Nested Container Starts -->
			<div class="container">
			<!-- Nested Row Starts -->
				<div class="row">
				<!-- Top Links Starts -->
					<div class="col-md-7 col-sm-8 col-xs-12">
						<?php $this->load->view('main/'.$this->themes_folder_name.'/include/menu')?>
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
						<?php $this->load->view('main/'.$this->themes_folder_name.'/include/header_search_bar')?>
					</div>
				<!-- Search Ends -->
				<!-- Shopping Cart Starts -->
					<div class="col-md-2 col-sm-6 col-xs-12">
						<?php $this->load->view('main/'.$this->themes_folder_name.'/include/header_shopping_cart')?>
					</div>
				<!-- Shopping Cart Ends -->
				</div>
			<!-- Nested Row Ends -->
			</div>
		<!-- Nested Container Ends -->
		</div>
		<div class="clear"></div>

	<!-- Top Bar Ends -->
	
	<!-- Banner Starts -->
		<div id="main-carousel" class="carousel slide" data-ride="carousel">
			<img src="<?php echo base_url()?>assets/fashion/images/banners/main-banner-img1.jpg" alt="Slider" class="img-responsive" />
			<img src="<?php echo base_url()?>assets/fashion/images/banners/main-banner-img1.jpg" alt="Slider" class="img-responsive" />
			<img src="<?php echo base_url()?>assets/fashion/images/banners/main-banner-img1.jpg" alt="Slider" class="img-responsive" />
		</div>
	<!-- Banner Ends -->
	
	<!-- Main Menu Starts -->
		<nav id="main-menu" class="navbar" role="navigation">
		<!-- Nested Container Starts -->
			<div class="container">
			<!-- Nav Header Starts -->
				<div class="navbar-header hidden-xs">
					<button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-cat-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<i class="fa fa-bars"></i>
					</button>
				</div>
			<!-- Nav Header Ends -->
			<!-- Navbar Cat collapse Starts -->
				<div class="collapse navbar-collapse navbar-cat-collapse hidden-xs">
					<ul class="nav navbar-nav">
						<li><a href="category-list.html">Mens</a></li>
						<li class="dropdown">
							<a href="category-list.html" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="10">
								Womens
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a tabindex="-1" href="#">Wodden Chairs</a></li>
								<li><a tabindex="-1" href="#">Glass Table</a></li>
								<li><a tabindex="-1" href="#">Softwood Chairs</a></li> 
							</ul>
						</li>
						<li class="dropdown">
							<a href="category-list.html" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="10">Boys</a>
							<div class="dropdown-menu">
								<div class="dropdown-inner">
									<ul class="list-unstyled">
										<li class="dropdown-header">Sub Category</li>
										<li><a tabindex="-1" href="#">item 1</a></li>
										<li><a tabindex="-1" href="#">item 2</a></li>
										<li><a tabindex="-1" href="#">item 3</a></li>
									</ul>										
									<ul class="list-unstyled">
										<li class="dropdown-header">Sub Category</li>
										<li><a tabindex="-1" href="#">item 1</a></li>
										<li><a tabindex="-1" href="#">item 2</a></li>
										<li><a tabindex="-1" href="#">item 3</a></li>
									</ul>
									<ul class="list-unstyled">
										<li class="dropdown-header">Sub Category</li>
										<li><a tabindex="-1" href="#">item 1</a></li>
										<li><a tabindex="-1" href="#">item 2</a></li>
										<li><a tabindex="-1" href="#">item 3</a></li>
									</ul>
								</div>
							</div>
						</li>
						<li><a href="category-list.html">Girls</a></li>
						<li><a href="category-list.html">UniSex</a></li>
						<li><a href="category-list.html">Teens</a></li>
						<li><a href="category-list.html">Offers</a></li>
						<li class="dropdown">
							<a href="category-list.html" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="10">
								Pages
							</a>
							<ul class="dropdown-menu" role="menu">
								<li><a tabindex="-1" href="index-2.html">Home</a></li>
								<li><a tabindex="-1" href="about.html">About</a></li>
								<li><a tabindex="-1" href="category-list.html">Category List</a></li>
								<li><a tabindex="-1" href="category-grid.html">Category Grid</a></li>
								<li><a tabindex="-1" href="product.html">Product</a></li>
								<li><a tabindex="-1" href="product-full.html">Product Full Width</a></li>
								<li><a tabindex="-1" href="cart.html">Cart</a></li>
								<li><a tabindex="-1" href="login.html">Login</a></li>
								<li><a tabindex="-1" href="compare.html">Compare Products</a></li>
								<li><a tabindex="-1" href="typography.html">Typography</a></li>
								<li><a tabindex="-1" href="register.html">Register</a></li>
								<li><a tabindex="-1" href="contact.html">Contact</a></li>
								<li><a tabindex="-1" href="404.html">404</a></li>
							</ul>
						</li>
					</ul>
				</div>
			<!-- Navbar Cat collapse Ends -->
			</div>
		<!-- Nested Container Starts -->
		</nav>
	<!-- Main Menu Ends -->
	<!-- Logo Wrap Starts -->
		<div class="logo-wrap container">
			<h1>Elite <span>Fashion</span></h1>
		</div>
	<!-- Logo Wrap Ends -->
	</header>
<!-- Header Wrap Starts -->