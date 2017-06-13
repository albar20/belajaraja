<!DOCTYPE html>

<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo ucwords($title)?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/image" />
    
    <!-- Pixel Admin's stylesheets -->
    <link href="<?php echo base_url()?>assets/general/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/admin/css/pixel-admin.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/admin/css/widgets.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/admin/css/pages.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/admin/css/rtl.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/admin/css/themes.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url()?>assets/admin/css/custom-admin.css" rel="stylesheet" type="text/css">

    <!--[if lt IE 9]>
        <script src="<?php echo base_url()?>assets/javascripts/ie.min.js"></script>
    <![endif]-->

</head>


<!-- 1. $BODY ======================================================================================
    
    Body

    Classes:
    * 'theme-{THEME NAME}'
    * 'right-to-left'      - Sets text direction to right-to-left
    * 'main-menu-right'    - Places the main menu on the right side
    * 'no-main-menu'       - Hides the main menu
    * 'main-navbar-fixed'  - Fixes the main navigation
    * 'main-menu-fixed'    - Fixes the main menu
    * 'main-menu-animated' - Animate main menu
-->
<body class="theme-clean main-menu-animated page-invoice">

<script>var init = [];</script>
<!-- Demo script --> <script src="<?php echo base_url()?>assets/admin/demo/demo.js"></script> <!-- / Demo script -->

<div id="main-wrapper">


<!-- 2. $MAIN_NAVIGATION ===========================================================================

    Main navigation
-->
   <?php $this->load->view('admin/include/main_navigation'); ?>
<!-- /2. $END_MAIN_NAVIGATION -->


<!-- 4. $MAIN_MENU =================================================================================

        Main menu
        
        Notes:
        * to make the menu item active, add a class 'active' to the <li>
          example: <li class="active">...</li>
        * multilevel submenu example:
            <li class="mm-dropdown">
              <a href="#"><span class="mm-text">Submenu item text 1</span></a>
              <ul>
                <li>...</li>
                <li class="mm-dropdown">
                  <a href="#"><span class="mm-text">Submenu item text 2</span></a>
                  <ul>
                    <li>...</li>
                    ...
                  </ul>
                </li>
                ...
              </ul>
            </li>
-->
<?php if($this->session->userdata('login_admin') == true) : ?>
    <?php $this->load->view('admin/include/main_menu'); ?>
<?php elseif($this->session->userdata('login_user') == true) : ?>
    <?php $this->load->view('user/include/main_menu'); ?>
<?php endif; ?>
<!-- /4. $MAIN_MENU -->


    <?php $this->load->view($page); ?>

</body>

</html>