<section class="content-area">
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<?php echo form_open('login/do_login'); ?>
			<h2>Login</h2>
			<label>Username or Email Address</label>
			<input class="form-control" type="text" name="user">
			<label>Password</label>
			<input class="form-control" type="password" name="password">
			<div class="row login-btm">
				<div class="col-md-6">
						<p class="login-remember">
							<label><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label>
						</p>
						<p>
						<i>	<a href="<?php echo base_url() ?>regis_user/lost_password" title="Lost your password?" class="lost-pass">Lost your password?</a> </i>
						</p>
				</div>
				<div class="col-md-6">
					<button class="btn btn-primary btn-login" type="submit">Login</button>
				</div>	
			</div>
			<?php echo form_close(); ?>
			<?php if ($this->session->flashdata('form_error')): ?>
			<div class="alert alert-warning alert-dismissable">
  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong> <?php echo $this->session->flashdata('form_error'); ?>
			</div>
		<?php endif ?>

		<?php if ($this->session->flashdata('error_login_user')): ?>
						<div class="alert alert-warning alert-dismissable">
  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong> <?php echo $this->session->flashdata('error_login_user'); ?>
			</div>
		<?php endif ?>

		<?php if ($this->session->flashdata('success_save_user')): ?>
						<div class="alert alert-success alert-dismissable">
  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Thank's!</strong> <?php echo $this->session->flashdata('success_save_user'); ?>
			</div>
		<?php endif ?>

		<?php if ($this->session->flashdata('success_set_password')): ?>
						<div class="alert alert-success alert-dismissable">
  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Thank's!</strong> <?php echo $this->session->flashdata('success_set_password'); ?>
			</div>
		<?php endif ?>

		</div>
		<div class="col-md-3"></div>
	</div>
</div>
</section>
