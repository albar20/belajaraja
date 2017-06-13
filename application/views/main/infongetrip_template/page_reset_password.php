<section class="content-area">
<div class="container">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<?php if (validation_errors() == TRUE): ?>
			<div class="alert alert-warning alert-dismissable">
  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong> <?php echo validation_errors(); ?>
			</div>
		<?php endif ?>
	<h2> Hello <?php echo $name->user_name; ?> </h2>
	<div class="jumbotron lost-password">
			<?php echo form_open('regis_user/do_reset_password'); ?>
			<h2>Reset Password</h2>
			<input type="hidden" name="email_code" value="<?php echo $name->email_code; ?>">
			<input class="form-control" type="password" name="password" placeholder="type your Password"></input>
			<br>
			<input class="form-control" type="password" name="repassword" placeholder="Retype your Password"></input>
			<br>
			<button class="btn btn-danger" type="submit" name="reset">Reset My Password</button>
			<?php echo form_close(); ?>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>
</section>