<?php 
/*===================================================================
	1.	INFORMATION
	2.	SOCIAL MEDIA
	9.	payment gateway
	10.	Tawkto 
===================================================================*/ ?>		


	<!-- Footer Section Starts -->
	<footer id="footer-area">
	<!-- Footer Links Starts -->
		<div class="footer-links">
		<!-- Container Starts -->
			<div class="container">
				<!-- Information Links Starts -->
					<div class="col-md-2 col-sm-6">
						<h5>Information</h5>
						<ul>
							<li><a href="<?php echo base_url()?>kontak">Contact Us</a></li>
							<li><a href="<?php echo base_url()?>about-us">About Us</a></li>
							<li><a href="<?php echo base_url()?>privacy-policy">Privacy Policy</a></li>
							<li><a href="<?php echo base_url()?>term-and-conditions">Terms &amp; Conditions</a></li>
						</ul>
					</div>
				<!-- Information Links Ends -->
				<!-- My Account Links Starts -->
					<div class="col-md-2 col-sm-6 follow-us">
						<h5>Follow Us</h5>
						<ul>
							<li>
								<i class="fa fa-facebook"></i>
								<a href="<?php echo $this->setting->facebook ?>">Facebook</a>
							</li>
							<li>
								<i class="fa fa-twitter"></i>
								<a href="<?php echo $this->setting->twitter ?>">Twitter</a>
							</li>
							<li>
								<i class="fa fa-google-plus"></i>
								<a href="<?php echo $this->setting->google ?>">Google</a>
							</li>
							<li>
								<i class="fa fa-instagram"></i>
								<a href="<?php echo $this->setting->instagram ?>">Instagram</a>
							</li>
						</ul>
					</div>
				<!-- My Account Links Ends -->
				<div class="col-md-4 col-sm-6 col-xs-12">
					<h5>Product Partner:</h5>
					
					<div class="col-md-6 col-sm-6">
						
					</div>
				
					<div class="col-md-6 col-sm-6">
						
					</div>
				
				</div>
				<!-- Contact Us Starts -->
					<div class="col-md-4 col-sm-12 last">
						<h5>Contact Us</h5>
						<ul>
							<li><?php echo $this->setting->nama_perusahaan ?></li>
							<li><pre class="footer_alamat"><?php echo $this->setting->alamat_perusahaan ?></pre></li>
							<li>
								Email: 
								<a href="mailto:<?php echo $this->setting->email_perusahaan ?>"><?php echo $this->setting->email_perusahaan ?></a>
							</li>								
						</ul>
						<h4 class="lead">
							Tel: <span><?php echo $this->setting->telepon_perusahaan ?></span>
						</h4>
					</div>
				<!-- Contact Us Ends -->
			</div>
		<!-- Container Ends -->
		</div>
	<!-- Footer Links Ends -->
	<!-- Copyright Area Starts -->
		<div class="copyright">
		<!-- Container Starts -->
			<div class="container">
			<!-- Starts -->
				<p class="pull-left">
					&copy; <?php echo $this->setting->copyright ?>
				</p>
			<!-- Ends -->
			</div>
		<!-- Container Ends -->
		</div>
	<!-- Copyright Area Ends -->
	</footer>
<!-- Footer Section Ends -->
<?php 
	/*===================================================================
		10.	Tawkto 
	===================================================================*/ ?>	
	<?php echo $this->setting->chat ?>