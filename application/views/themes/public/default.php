<!DOCTYPE html>
<html>
	<head>
		<title><?= $title ?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

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
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/themes/public/') ?>vendors/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/themes/public/') ?>vendors/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/themes/public/') ?>vendors/owl-carousel/assets/owl.carousel.min.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/themes/public/') ?>vendors/owl-carousel/assets/owl.theme.default.min.css" />

		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/themes/public/') ?>stylesheets/css/font.css" />
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/themes/public/') ?>stylesheets/css/style.css" />

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

		<link rel="icon" href="<?php echo base_url('assets/themes/public/images/logo_rajatulalam.jpg') ?>">
	</head>
	<body>
		<div class="btn-mobile">
			<span></span>
			<span></span>
			<span></span>
		</div>
		<aside class="sidebar">
			<ul>
				<?php 
					$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
					$uri_segments = explode('/', $uri_path);

					if (@$uri_segments[2] == "detail") {
						$url_home = site_url();
					} else {
						$url_home = "#identity";
					}
				 ?>
				<li><a href="<?php echo $url_home ?>" class="mn-home active"><i class="fa fa-angle-right"></i> HOME</a></li>
				<li><a href="#experience"><i class="fa fa-angle-right"></i> EXPERIENCE</a></li>
				<li><a href="#achievement"><i class="fa fa-angle-right"></i> PORTFOLIO</a></li>
				<li><a href="#agenda"><i class="fa fa-angle-right"></i> AGENDA</a></li>
				<li><a href="#education"><i class="fa fa-angle-right"></i> EDUCATION</a></li>
				<li><a href="#blogpost" class="mn-blog_post"><i class="fa fa-angle-right"></i> BLOG POST</a></li>
				<li><a href="#gallery"><i class="fa fa-angle-right"></i> GALLERY</a></li>
				<li><a href="#video"><i class="fa fa-angle-right"></i> VIDEO</a></li>
				<li><a href="#contact"><i class="fa fa-angle-right"></i> CONTACT</a></li>
			</ul>
		</aside>

		<section class="wrapper">
			<?php echo $output;?>
		</section>

		<!-- vendor javascripts -->
		<script src="<?= base_url('assets/themes/public/') ?>vendors/jquery/jquery-3.3.1.min.js"></script>
		<script src="<?= base_url('assets/themes/public/') ?>vendors/jquery/jquery.easing.min.js"></script>
		<script src="<?= base_url('assets/themes/public/') ?>vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?= base_url('assets/themes/public/') ?>vendors/instafeed/instafeed.min.js"></script>
		<script src="<?= base_url('assets/themes/public/') ?>vendors/owl-carousel/owl.carousel.min.js"></script>
		<script src="<?= base_url('assets/themes/public/') ?>vendors/masonry/masonry.pkgd.min.js"></script>

		<!-- main javascripts -->
		<script src="<?= base_url('assets/themes/public/') ?>javascripts/main.js"></script>

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
