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
								if( count($sub_category_product_list->result()) > 0 ):
							?>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" data-delay="10"> <?php echo $cp->category_product_name ?></a>
									<?php if( count($sub_category_product_list->result()) > 0 ): ?>
										<ul class="dropdown-menu" role="menu">
											<?php foreach($sub_category_product_list->result() as $scp ): ?>
												<?php if( $scp->category_product_id == $cp->category_product_id ): ?>
													<li>
														<a tabindex="-1" href="<?php echo base_url() ?>product/category/<?php echo $scp->slug ?>">
														<?php echo $scp->subcategory_product_name; ?></a>
													</li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									<?php endif; ?>
								</li>
							<?php else: ?>
								<li><a href="<?php echo base_url() ?>product/category/<?php echo $scp->slug ?>"><?php echo $cp->category_product_name ?></a></li>
							<?php endif; ?>
						<?php endforeach;?>
						<?php endif; ?>
					</ul>

					<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/header-search')?>	
				</div>
			<!-- Navbar Cat collapse Ends -->
			</div>
		<!-- Nested Container Ends -->
		</nav>