
<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php echo ucwords($judul)?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <!-- <link rel="shortcut icon" href="<?php echo base_url()?>assets/images/Logo_circle.png" /> -->

  <!-- Open Sans font from Google CDN -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&amp;subset=latin" rel="stylesheet" type="text/css">

  <!-- Pixel Admin's stylesheets -->
  <link href="<?php echo base_url()?>assets/stylesheets/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url()?>assets/stylesheets/pixel-admin.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url()?>assets/stylesheets/pages.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url()?>assets/stylesheets/rtl.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url()?>assets/stylesheets/themes.min.css" rel="stylesheet" type="text/css">

  <!--[if lt IE 9]>
    <script src="<?php echo base_url()?>assets/javascripts/ie.min.js"></script>
  <![endif]-->

</head>


<!-- 1. $BODY ======================================================================================
  
  Body

  Classes:
  * 'theme-{THEME NAME}'
  * 'right-to-left'     - Sets text direction to right-to-left
-->
<body class="theme-clean page-signin-alt">
<!-- Demo script --> <script src="<?php echo base_url()?>assets/demo/demo.js"></script> <!-- / Demo script -->



<!-- 2. $MAIN_NAVIGATION ===========================================================================

  Main navigation
-->
  <div class="signin-header">
    <a href="<?php echo base_url()?>" class="logo">
      <!-- <div ><img src="<?php echo base_url()?>assets/images/Logo_circle.png" alt="" height="32px" style="margin-top: -4px;"></div>&nbsp; -->
      <strong>Admin</strong> 
    </a> <!-- / .logo -->
    <!--<a href="pages-signup-alt.html" class="btn btn-primary">Sign Up</a>-->
  </div> <!-- / .header -->

  <h1 class="form-header">Sign in to your Account</h1>


  <!-- Form -->
  <form action="<?php echo base_url()?>login/login_process" id="signin-form_id" class="panel" method="post">
    <?php
      $message = $this->session->flashdata('warning');
      echo $message == '' ? '' : '<div class="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-warning"></i> ' . $message . '</div>';
    ?>
    <?php
      $message = $this->session->flashdata('danger');
      echo $message == '' ? '' : '<div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-times"></i> ' . $message . '</div>';
    ?>
    <?php
      $message = $this->session->flashdata('success');
      echo $message == '' ? '' : '<div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-check"></i> ' . $message . '</div>';
    ?>
    <?php
      $message = $this->session->flashdata('info');
      echo $message == '' ? '' : '<div class="alert alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <i class="fa fa-exclamation"></i> ' . $message . '</div>';
    ?>

    <div class="form-group">
      <input type="text" name="signin_username" id="username_id" class="form-control input-lg" placeholder="Username" required>
    </div> <!-- / Username -->

    <div class="form-group signin-password">
      <input type="password" name="signin_password" id="password_id" class="form-control input-lg" placeholder="Password" required>
      <!--<a href="#" class="forgot">Forgot?</a>-->
    </div> <!-- / Password -->

    <div class="form-actions">
      <input type="submit" value="Sign In" class="btn btn-primary btn-block btn-lg">
    </div> <!-- / .form-actions -->
  </form>
  <!-- / Form -->

  <!--
  <div class="signin-with">
    <div class="header">or sign in with</div>
    <a href="index.html" class="btn btn-lg btn-facebook rounded"><i class="fa fa-facebook"></i></a>&nbsp;&nbsp;
    <a href="index.html" class="btn btn-lg btn-info rounded"><i class="fa fa-twitter"></i></a>&nbsp;&nbsp;
    <a href="index.html" class="btn btn-lg btn-danger rounded"><i class="fa fa-google-plus"></i></a>
  </div>
  -->

<!-- Get jQuery from Google CDN -->
<!--[if !IE]> -->
  <script type="text/javascript"> window.jQuery || document.write('<script src="<?php echo base_url()?>assets/javascripts/jquery.min.js">'+"<"+"/script>"); </script>
<!-- <![endif]-->
<!--[if lte IE 9]>
  <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
<![endif]-->


<!-- Pixel Admin's javascripts -->
<script src="<?php echo base_url()?>assets/javascripts/bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/javascripts/pixel-admin.min.js"></script>

<script type="text/javascript">
  window.PixelAdmin.start([
    function () {
      $("#signin-form_id").validate({ focusInvalid: true, errorPlacement: function () {} });
      
      // Validate username
      $("#username_id").rules("add", {
        required: true,
        minlength: 3
      });

      // Validate password
      $("#password_id").rules("add", {
        required: true,
        minlength: 3
      });
    }
  ]);
</script>

</body>

</html>
