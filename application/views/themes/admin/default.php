<!DOCTYPE html>
<html>
	<head>
		<title>
            <?php echo $title; ?>
        </title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<!-- css vendor-->
		<?php
        if (!empty($meta)) {
            foreach($meta as $name=>$content){
                echo "\n\t\t";
                ?>
                    <meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" />
                <?php
            }
        }
        echo "\n";

        if (!empty($canonical)) {
            echo "\n\t\t";
            ?>
                <link rel="canonical" href="<?php echo $canonical?>" />
            <?php

        }
        echo "\n\t";
        ?>


		<!--css vendor -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/custom-scroll/css/jquery.mCustomScrollbar.min.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/sweetalert2/dist/sweetalert2.css">
		
		<!-- style -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/e-disi-admin/stylesheets/css/font.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/e-disi-admin/stylesheets/css/style.css" />

		<style type="text/css">
			.form-group .error {
				color: red;
				font-weight: 500;
				border-color: red;
			}
		</style>

		<!-- custom css-->
		<?php 
            foreach ($css as $file) {
                echo "\n\t\t";
                ?>
                    <link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" />
                <?php
            } 
            echo "\n\t";
        ?>

		<?php echo $script_head ?>

		<!-- <link rel="shortcut icon" href="<?php echo base_url() ?>assets/themes/metronic/images/Logo-Titian.png" /> -->
	</head>
	<body>
		<div class="check-device"></div>
		
		<!-- sidebar -->
		<aside class="sidebar">
		<?php echo $this->load->view('themes/admin/menu'); ?>
		</aside>
		<!-- end of aside -->

		<section class="wrapper">

			<!-- header -->
			<header>
				<div class="body-header">
					<div class="sidebar-action">
						<i class="fa fa-bars"></i>
					</div>

					<!-- logo -->
					<a href="#" class="logo-header">
						<img src="<?= base_url('assets/themes/e-disi-admin/') ?>images/logo-dummy.jpg" />
						<div class="logo-text">
							<span class="title-logo">TITLE LOGO</span>
							<span class="subtitle-logo">Subtitle Logo</span>
						</div>
					</a>
					<!-- end of logo -->

				</div>
			</header>
			<!-- end of header -->			

			<?php echo $output;?>
			
		</section>

		<!--begin::Base Scripts -->
		<!-- javascript vendor-->
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/jquery/jquery-3.1.1.min.js"></script>
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/custom-scroll/js/jquery.mCustomScrollbar.concat.min.js"></script>
		
		<!-- main javascript -->
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/javascripts/main.js"></script>

		<!-- dashboard plugins -->
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/javascripts/sidebar-plugins.js"></script>
		<!-- specific js on page-->
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/sweetalert2/dist/sweetalert2.js"></script>
        <?php 
            foreach ($js as $file) {
                echo "\n\t\t";
                ?>
                <script src="<?php echo $file; ?>"></script>
                <?php
            } 
            echo "\n\t";
        ?>

		<?php echo $script_foot ?>
	</body>
</html>