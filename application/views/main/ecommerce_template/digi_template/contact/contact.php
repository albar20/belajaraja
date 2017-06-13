	<!-- Breadcrumb Starts -->
	<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/breadcrumb'); ?>
	<!-- Breadcrumb Ends -->
	
	<!-- Main Container Starts -->
	<div class="main-container container">
		
	<!-- Main Heading Starts -->
		<h2 class="main-heading text-center">
			Contact Us
		</h2>
	<!-- Main Heading Ends -->
	<!-- Google Map Starts -->
		<div id="map-wrapper">
			<div id="map-block">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d79444.64391671501!2d-0.21428374128957384!3d51.51972634746694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4876045108e9cad3%3A0x6514817fa6d57c9!2sThe+Web+Kitchen!5e0!3m2!1sen!2suk!4v1469624353093" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	<!-- Google Map Ends -->
	<!-- Starts -->
		<div class="row">
		<!-- Contact Details Starts -->
			<div class="col-sm-4">
				<div class="panel panel-smart">
					<div class="panel-heading">
						<h3 class="panel-title">Contact Details</h3>
					</div>
					<div class="panel-body">
						<ul class="list-unstyled contact-details">
							<li class="clearfix">
								<i class="fa fa-home pull-left"></i>
								<span class="pull-left">
									<?php echo $this->setting->nama_perusahaan ?>
									<br/>
									<?php echo $this->setting->alamat_perusahaan ?>
								</span>
							</li>
							<li class="clearfix">
								<i class="fa fa-phone pull-left"></i>
								<span class="pull-left">
									<?php echo $this->setting->telepon_perusahaan ?>
								</span>
							</li>
							<li class="clearfix">
								<i class="fa fa-envelope-o pull-left"></i>
								<span class="pull-left">
									<a href="mailto:<?php echo $this->setting->email_perusahaan ?>"><?php echo $this->setting->email_perusahaan ?></a>
								</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		<!-- Contact Details Ends -->
		<!-- Contact Form Starts -->
			<div class="col-sm-8">
				<div class="panel panel-smart">
					<div class="panel-heading">
						<h3 class="panel-title">Send us a mail</h3>
					</div>
					<?php $this->load->view('main/field/message_info'); ?>
					<div class="panel-body">
						<form id="contact-form" class="contact-form form form-horizontal" method="post" action="<?php echo $form_action?>">    
							<div class="form-group">
								<label for="name" class="col-sm-2 control-label">
									Name
								</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="cname" name="nama" placeholder="Your name" minlength="2"  value="<?php echo set_value('nama', isset($default['nama']) ? $default['nama'] : ''); ?>" />
									<?php echo form_error('nama', '<span class="help-block" style="background-color:yellow"><i class="fa fa-warning"></i>', '</span>'); ?> 
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="col-sm-2 control-label">
									Email
								</label>
								<div class="col-sm-10">
									<input type="email" class="form-control" id="cemail" name="email" placeholder="Your email address"  value="<?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?>" />
									<?php echo form_error('email', '<span class="help-block" style="background-color:yellow"><i class="fa fa-warning"></i>', '</span>'); ?>  
								</div>
							</div>
							<div class="form-group">
								<label for="message" class="col-sm-2 control-label">
									Message
								</label>
								<div class="col-sm-10">
									 <textarea class="form-control" id="cmessage" name="message" placeholder="Enter your message" rows="12" /><?php echo set_value('message', isset($default['message']) ? $default['message'] : ''); ?></textarea/>
									<?php echo form_error('message', '<span class="help-block" style="background-color:yellow"><i class="fa fa-warning"></i>', '</span>'); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="message" class="col-sm-2 control-label">
									Captcha
								</label>
								<div class="col-sm-10">
									<input type="text" id="captchaEquotation" value="<?php echo $captcha; ?>" disabled>
									<div class="clear"></div>
									<br/>
                                	<input style="width:100%" type="text" autocomplete="off" placeholder="<?php echo isset($captcha_salah) ? 'Hasil Salah' : 'Silahkan Masukkan Jawaban Yang Benar'; ?>" name="login_equotation" class="form-control" value="" />
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" name="submit_button" class="btn btn-black text-uppercase">Submit</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		<!-- Contact Form Ends -->
		</div>
	<!-- Ends -->
	</div>
<!-- Main Container Ends -->