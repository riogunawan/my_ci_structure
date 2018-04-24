<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?= $title ?></title>
    <!-- Favicon-->
    <link rel="icon" href="<?= base_url("assets/themes/AdminBSBMaterialDesign/images/") ?>favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>plugins/animate-css/animate.css" rel="stylesheet" />

	<!-- OTHERS Css -->
    <?php 
		foreach ($css as $file) {
			echo "\n\t\t";
			?>
				<link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" />
			<?php
		} 
		echo "\n\t";
	?>
	
    <!-- Custom Css -->
    <link href="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>css/themes/all-themes.css" rel="stylesheet" />

    <!-- Custom Css FROM PROGRAMMER -->
	<?php echo $script_head ?>

	<!-- Jquery Core Js -->
    <script src="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>plugins/node-waves/waves.js"></script>

    <!-- OTHERS JS -->
    <?php 
		foreach ($js as $file) {
			echo "\n\t\t";
			?>
			<script src="<?php echo $file; ?>"></script>
			<?php
		} 
		echo "\n\t";
	?>

    <!-- Custom Js -->
    <script src="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>js/admin.js"></script>

    <!-- Custom Js FROM PROGRAMMER-->
    <?php echo $script_foot ?>
    
    <!-- Demo Js Color setting-->
    <script src="<?= base_url("assets/themes/AdminBSBMaterialDesign/") ?>js/demo.js"></script>
	
</head>

<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- MENU TOP -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    	<?php $this->load->view("themes/admin/top_bar"); ?>
    <!-- #Top Bar -->
    <!-- CLOSE MENU TOP -->

    <!-- SIDE MENU LEFT & RIGHT-->
    <section>
        <!-- Left Sidebar -->
        	<?php $this->load->view("themes/admin/left_sidebar"); ?>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        	<?php $this->load->view("themes/admin/right_sidebar"); ?>
        <!-- #END# Right Sidebar -->
    </section>
    <!-- CLOSE SIDE MENU LEFT & RIGHT-->

    <!-- CONTENT-->
    	<?php echo $output ?>
    <!-- CLOSE CONTENT-->

</body>

</html>