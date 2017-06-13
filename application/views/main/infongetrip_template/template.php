<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta name="viewport" content="width=device-width">
	<title>Tours</title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="xmlrpc.php">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
	<?php $this->carabiner->css("front_page/template/infongetrip/css/bootstrap.min.css"); ?>
	<?php $this->carabiner->css("front_page/template/infongetrip/css/font-awesome.min.css"); ?>
	<?php $this->carabiner->css("front_page/template/infongetrip/css/flaticon.css"); ?>
	<?php $this->carabiner->css("front_page/template/infongetrip/css/font-linearicons.css"); ?>
	<?php $this->carabiner->css("front_page/template/infongetrip/css/style.css"); ?>
	<?php $this->carabiner->css("front_page/template/infongetrip/css/travel-setting.css"); ?>
	<?php $this->carabiner->css("front_page/template/infongetrip/css/custom.css") ?>
	<?php $this->carabiner->css("front_page/css/jquery.rateyo.min.css"); ?>
	<?php echo $this->carabiner->display('css'); ?>
	<link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
</head>

<body class="archive travel_tour travel_tour-page">
<div class="wrapper-container">
	
	<!-- Start Header -->
	<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/header')?>
	<!-- End Header -->
	
	<div class="site wrapper-content">
		
		<!-- Start Breadcrumb -->
		<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/breadcrumb')?>
		<!-- End Breadcrumb -->
		
		<!-- Start Page -->
		<?php $this->load->view($page)?>
		<!-- End Page -->
		
	</div>
	
	<!-- Start Footer -->
	<?php $this->load->view($this->front_folder.$this->themes_folder_name.'/include/footer')?>
	<!-- End Footer -->
	
</div>
<!--end coppyright-->
<script>var baseurl = "<?php echo base_url()?>"</script>
<?php $this->carabiner->js("front_page/template/infongetrip/js/jquery-1.11.1.min.js","","false"); ?>
<?php $this->carabiner->js("front_page/template/infongetrip/js/bootstrap.min.js","","false"); ?>
<?php $this->carabiner->js("front_page/template/infongetrip/js/vendors.js","","false"); ?>
<?php $this->carabiner->js("front_page/template/infongetrip/js/jquery.swipebox.min.js","","false"); ?>
<?php $this->carabiner->js("front_page/template/infongetrip/js/theme.js","","false"); ?>
<?php $this->carabiner->js("front_page/js/jquery.rateyo.min.js","","false"); ?>	
<?php $this->carabiner->js("front_page/js/rating.js","","false"); ?>
<?php $this->carabiner->js("front_page/template/infongetrip/js/review.js","","false"); ?>
<?php echo $this->carabiner->display('js'); ?>
</body>
</html>