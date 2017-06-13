	
	<style type="text/css">
	<?php
		$banner_list =	$this->banner_list->result(); 	
	?>
	.header-wrap.inner {
		background-image: url("<?php echo base_url().'uploads/banner/'.$banner_list[0]->banner_slug ?>/thumb/<?php echo $banner_list[0]->banner_picture ?>");
	}
	</style>

	<!-- Header Wrap Starts -->
	<header class="header-wrap inner">
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
			4.	CATEGORY NAVIGATION & SEARCH BAR
		================================================================================*/ ?>
		<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/header-category-navigation')?>

		
	</header>
<!-- Header Wrap Ends -->