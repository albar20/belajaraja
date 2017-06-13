<section class="content-area">
<div class="container">
	<div class="row">
		<div class="col-md-4">

			<?php echo form_open_multipart('regis_user/save_user'); ?>
			<h2>Register User</h2>
			<label>Full Name</label>
			<input class="form-control" type="text" name="name"></input>
			<label>Username</label>
			<input class="form-control" type="text" name="username"></input>
			<label>Email</label>
			<input class="form-control" type="email" name="email"></input>
		</div>
		<div class="col-md-4 row-password">
			
			<label >Password</label>
			<input class="form-control" type="password" name="password"></input>
			<label>Retype Passoword</label>
			<input class="form-control" type="password" name="repassword"></input>
			<label>Picture</label>
			 <input type="file" name="fileToUpload" id="fileToUpload"> <br>
			<button class="btn btn-primary btn-login btn-regis" type="submit">Register</button>
		</div>

		

		<?php echo form_close(); ?>
		<div class="col-md-4">
			
			<?php if ($error == TRUE): ?>
			<div class="alert alert-warning alert-dismissable">
  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong> <?php echo $error; ?>
			</div>
		<?php endif ?>	
	

			<?php if (validation_errors() == TRUE): ?>
			<div class="alert alert-warning alert-dismissable">
  				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong>Warning!</strong> <?php echo validation_errors(); ?>
			</div>
		<?php endif ?>	
		</div>
			
	</div>
</div>
	</section>

	<style type="text/css">
	.row-password{
		margin-top: 56px;
	}
	.btn-regis{
		margin-left: 225px;
	}
	</style>