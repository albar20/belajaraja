<section class="content-area">
<div class="container">
	<div class="col-md-3"></div>
	<div class="col-md-6">


		<?php if ($this->session->flashdata('success_send')): ?>
						<div class="alert alert-success alert-dismissable">
  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Success!</strong> <?php echo $this->session->flashdata('success_send'); ?>
			</div>
		<?php endif ?>

		<?php if ($this->session->flashdata('wrong_captcha')): ?>
						<div class="alert alert-warning alert-dismissable">
  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong> <?php echo $this->session->flashdata('wrong_captcha'); ?>
			</div>
		<?php endif ?>

		<?php if ($this->session->flashdata('not_found_email')): ?>
						<div class="alert alert-warning alert-dismissable">
  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong> <?php echo $this->session->flashdata('not_found_email'); ?>
			</div>
		<?php endif ?>

		<?php if (validation_errors() == TRUE): ?>
			<div class="alert alert-warning alert-dismissable">
  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong> <?php echo validation_errors(); ?>
			</div>
		<?php endif ?>
		<div class="jumbotron lost-password">
			<?php echo form_open('regis_user/do_lost_password'); ?>
			<h2>Forgot Password</h2>
			<input class="form-control" type="text" name="email" placeholder="type your e-Mail">
			
			<b>Enter the contents of image</b> <br>
			<input  type="text" name="captcha" placeholder="type your captcha"> <?php echo $captcha['image']; ?> 
			<input type="hidden" name="text_cap" value="<?php echo $captcha['word']; ?> ">
			<?php echo $captcha['word']; ?>
			<br> <br>
			<button class="btn btn-danger">Reset My Password</button>
			<?php echo form_close(); ?>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>
</section>
