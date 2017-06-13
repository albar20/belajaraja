<?php 
/*==========================================================
	1.	HEAD 
	2.	HEADER
	3.	CONTENT
	4.	FOOTER
	5.	FOOTER COPYRIGHT
	5.	MODAL
	6.	SCRIPTS
==========================================================*/ ?>
<!doctype html>
<html lang="en">
<?php 
/*==========================================================
	1.	HEAD 
==========================================================*/ ?>
<head>
	<meta charset="utf-8">
	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="<?php echo $this->setting->website_meta_description ?>">
	<meta name="author" content="">
	
	<title><?php echo $title ?></title>
	
	<!-- Google Web Fonts -->
	<link href="http://fonts.googleapis.com/css?family=Roboto+Condensed:300italic,400italic,700italic,400,300,700" rel="stylesheet" type="text/css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	

	<!-- CSS Files -->
	<?php $this->carabiner->css("front_page/template/grocery/css/bootstrap.min.css"); ?>
	<?php $this->carabiner->css("front_page/template/grocery/font-awesome/css/font-awesome.min.css"); ?>
	<?php $this->carabiner->css("front_page/template/grocery/css/owl.carousel.css"); ?>
	<?php $this->carabiner->css("front_page/template/grocery/css/style.css"); ?>
	<?php $this->carabiner->css("front_page/template/grocery/css/responsive.css"); ?>
	<?php $this->carabiner->css("front_page/template/grocery/css/magnific-popup.css"); ?>
	<?php $this->carabiner->css("general/css/bootstrap-datepicker.min.css"); ?>
	<?php $this->carabiner->css("general/datatables/jquery.dataTables.min.css"); ?>
	<?php $this->carabiner->css("general/datatables/dataTables.bootstrap.min.css"); ?>
	<?php $this->carabiner->css("general/datatables/responsive.bootstrap.min.css"); ?>
	<?php $this->carabiner->css("general/datatables/datatables-responsive-custom.css"); ?>
	<?php $this->carabiner->css("front_page/css/custom_search.css"); ?>
	<?php $this->carabiner->css("front_page/css/galeri.css"); ?>
	<?php $this->carabiner->css("front_page/css/custom-style.css"); ?>
	<?php echo $this->carabiner->display('css'); ?>
	
	<!--[if lt IE 9]>
		<script src="js/ie8-responsive-file-warning.js"></script>
	<![endif]-->
	
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- Fav and touch icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url()?>assets/fashion/images/fav-144.html">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url()?>assets/fashion/images/fav-114.html">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url()?>assets/fashion/images/fav-72.html">
	<link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?>assets/fashion/images/fav-57.html">
	<link rel="shortcut icon" href="<?php echo base_url()?>assets/fashion/images/fav.html">
	
</head>
<body>
<?php echo $this->setting->analytics ?>

<!-- Wrapper Starts -->
<div id="wrapper" class="container">

	<?php 
	/*==========================================================
		2.	HEADER
	==========================================================*/ ?>
	<!-- Header Wrap Starts -->
		<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/header'); ?>
	<!-- Header Wrap Ends -->
	<!-- Main Container Starts -->
	
	
	<?php 
	/*==========================================================
		3.	CONTENT
	==========================================================*/ ?>
	<?php $this->load->view($page)?>


	<?php 
	/*==========================================================
		4.	FOOTER
	==========================================================*/ ?>
	<!-- Footer Section Starts -->
	<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/footer')?>
	<!-- Footer Section Ends -->

</div>
<!-- Wrapper Ends -->

<?php 
/*==========================================================
	5.	FOOTER COPYRIGHT
==========================================================*/ ?>
<!-- Footer Section Starts -->
<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/footer-copyright')?>
<!-- Footer Section Ends -->		


	<?php 
	/*==========================================================
		5.	MODAL
	==========================================================*/ ?>
	<div id="productSummary" class="modal fade" data-backdrop="false" role="dialog">
	  	<div class="modal-dialog modal-lg">
		    <!-- Modal content-->
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		       		<h4 class="modal-title">Please Wait</h4>
		      	</div>
		      	<div class="modal-body">
					<div id="responseCart">
					</div>
					<div class="progress progress-striped active" style="margin-bottom:0;" id="loadingModalCart"><div class="progress-bar" style="width: 100%"></div></div>
		      	</div>
		      	<div class="modal-footer">
		      	</div>
		    </div>
	  	</div>
	</div>



	<?php 
	/*==========================================================
		6.	SCRIPTS
	==========================================================*/ ?>
	<!-- JavaScript Files -->
	<input type="hidden" id="base_url" value="<?php echo base_url() ?>" />
	<script>var baseurl		= "<?php echo base_url()?>"</script>

	<?php $this->carabiner->js("front_page/template/grocery/js/jquery-1.11.1.min.js","","false"); ?>
	<?php $this->carabiner->js("front_page/template/grocery/js/jquery-migrate-1.2.1.min.js","","false"); ?>
	<?php $this->carabiner->js("front_page/template/grocery/js/bootstrap.min.js","","false"); ?>
	<?php $this->carabiner->js("front_page/template/grocery/js/bootstrap-hover-dropdown.min.js","","false"); ?>
	<?php $this->carabiner->js("front_page/template/grocery/js/jquery.magnific-popup.min.js","","false"); ?>
	<?php $this->carabiner->js("front_page/template/grocery/js/owl.carousel.min.js","","false"); ?>
	<?php $this->carabiner->js("front_page/template/grocery/js/custom.js","","false"); ?>
	<?php $this->carabiner->js("general/datatables/jquery.dataTables.min.js","","false"); ?>
	<?php $this->carabiner->js("general/datatables/dataTables.bootstrap.min.js","","false"); ?>
	<?php $this->carabiner->js("general/datatables/dataTables.responsive.min.js","","false"); ?>
	<?php $this->carabiner->js("general/datatables/responsive.bootstrap.min.js","","false"); ?>
	<?php $this->carabiner->js("general/datatables/datatables-initialize.js","","false"); ?>
	<?php $this->carabiner->js("general/js/bootstrap-datepicker.js","","false"); ?>
	<?php $this->carabiner->js("general/js/bootstrap-init.js","","false"); ?>
	<?php $this->carabiner->js("front_page/js/my_account.js","","false"); ?>
	<?php $this->carabiner->js("front_page/js/product.js","","false"); ?>
	<?php $this->carabiner->js("front_page/js/custom_search.js","","false"); ?>
	<?php $this->carabiner->js("front_page/js/wishlist.js","","false"); ?>
	<?php $this->carabiner->js("front_page/js/custom.js","","false"); ?>
	<?php echo $this->carabiner->display('js'); ?>
</body>
</html>