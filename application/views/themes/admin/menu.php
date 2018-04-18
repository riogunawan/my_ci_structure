<!-- profile user -->
<div class="profile-user">
	<div class="frame-photo">
		<?php 
			$foto = $this->session->userdata('foto');
			$image = ( empty($foto) && !file_exists($foto) ) ? base_url("assets/themes/e-disi-admin/images/thumb-user-photo.png") : $foto;
		 ?>
		<img src="<?= $image ?>" />
	</div>
	<a class="user-identity" href="#">
		<span><?= $this->session->userdata('nama_lengkap'); ?></span>
		<span><?= $this->session->userdata('title_user'); ?></span>
	</a>
</div>
<!-- end of profile user -->

<ul class="sidebar-menu">
	<li class="mn-profile">
		<a href="<?= site_url('profile') ?>">
			<i class="fa fa-vcard-o"></i>
			<span>Profile</span>
		</a>
	</li>
	<li class="mn-education">
		<a href="<?= site_url('education') ?>">
			<i class="fa fa-graduation-cap"></i>
			<span>Education</span>
		</a>
	</li>
	<li class="mn-employment">
		<a href="<?= site_url('employment') ?>">
			<i class="fa fa-briefcase"></i>
			<span>Employment</span>
		</a>
	</li>
	<li class="mn-portfolio dropdown-sidebar">
		<a href="#">
			<i class="fa fa-trophy"></i>
			<span>Portfolio</span>
		</a>
		<ul>
			<li class="mn-kategori"><a href="<?= site_url('portfolio/kategori') ?>">Categories</a></li>
			<li class="mn-data"><a href="<?= site_url('portfolio') ?>">Portfolio</a></li>
		</ul>
	</li>
	<li class="mn-skills dropdown-sidebar">
		<a href="#">
			<i class="fa fa-line-chart"></i>
			<span>Skills</span>
		</a>
		<ul>
			<li class="mn-kategori"><a href="<?= site_url('skills/kategori') ?>">Categories</a></li>
			<li class="mn-data"><a href="<?= site_url('skills') ?>">Skills</a></li>
		</ul>
	</li>
	<li class="mn-agenda">
		<a href="<?= site_url('agenda') ?>">
			<i class="fa fa-calendar"></i>
			<span>Agenda</span>
		</a>
	</li>
	<li class="mn-blog-post dropdown-sidebar">
		<a href="#">
			<i class="fa fa-newspaper-o"></i>
			<span>Blog Post</span>
		</a>
		<ul>
			<li class="mn-kategori"><a href="<?= site_url('blog_post/kategori') ?>">Categories</a></li>
			<li class="mn-data"><a href="<?= site_url('blog_post') ?>">Blog Post</a></li>
		</ul>
	</li>
	<li class="mn-social-profiles dropdown-sidebar">
		<a href="#">
			<i class="fa fa-chain"></i>
			<span>Social Profiles</span>
		</a>
		<ul>
			<!-- <li class="mn-kategori"><a href="<?= site_url('social_profiles/kategori') ?>">Categories</a></li> -->
			<li class="mn-data"><a href="<?= site_url('social_profiles') ?>">Social Profiles</a></li>
		</ul>
	</li>
	<li class="mn-manage-account">
		<a href="<?= site_url('manage_account') ?>">
			<i class="fa fa-cog"></i>
			<span>Manage Account</span>
		</a>
	</li>
	<li class="mn-theme-settings">
		<a href="<?= site_url('theme_settings') ?>">
			<i class="fa fa-cogs"></i>
			<span>Theme Settings</span>
		</a>
	</li>
	<li class="mn-language">
		<a href="<?= site_url('language') ?>">
			<i class="fa fa-language"></i>
			<span>Language</span>
		</a>
	</li>
	<li>
		<a href="<?= site_url('login/logout') ?>">
			<i class="fa fa-sign-out"></i>
			<span>Log-Out</span>
		</a>
	</li>

</ul>