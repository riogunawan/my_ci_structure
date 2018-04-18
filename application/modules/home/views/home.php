<article class="wrapper-identity" id="identity">
	<?php
		$banner = ( empty($home->banner) || !file_exists(FCPATH . "assets/upload/banner/$home->banner") ) ?
			base_url('assets/themes/public/images/cover-profile.jpg') :
			base_url('assets/upload/banner/'.$home->banner);
	 ?>
	<figure class="cover-photo">
		<img src="<?= $banner ?>" class="img-responsive-2" />
	</figure>
	<?php
		$foto = ( empty($home->foto) || !file_exists(FCPATH . "assets/upload/foto/thumb/$home->foto") ) ?
			base_url('assets/themes/public/images/cover-profile.jpg') :
			base_url('assets/upload/foto/thumb/'.$home->foto);
	 ?>
	<figure class="frame-photo-user">
		<img src="<?= $foto ?>" class="img-responsive-2"/>
	</figure>
	<hgroup class="identity-user">
		<h3><?= $home->nama_lengkap ?></h3>
		<h4><?= $home->title_user ?></h4>
	</hgroup>
	<p class="describe-user">
		<?php echo strip_tags($home->biografi) ?>
	</p>
</article>

<hr class="hr-style"/>

<article class="wrapper-experience" id="experience">
	<h3 class="main-title">Experience</h3>
	<div class="timeline">

		<?php
			$i_exp = 0;
		 ?>
		<?php foreach ($experience as $row): ?>
			<?php
				$arah = ( ($i_exp % 2) == 1 ) ? 'left' : 'right';

				if ($row->present == 'ya') {
					$tahun_akhir = 'Present';
				} else {
					$tahun_akhir = "$row->tahun_akhir";
				}
			 ?>
			<div class="item-timeline <?= $arah ?>">
				<span class="date-timeline"><?= $row->tahun_awal ?> - <?= $tahun_akhir ?></span>
				<hgroup>
					<h5 class="subtitle-timeline"><?= $row->jabatan ?></h5>
					<h4 class="title-timeline"><?= $row->nama_perusahaan ?></h4>
				</hgroup>
				<?= $row->deskripsi ?>
			</div>
			 <?php
				$i_exp++;
			 ?>
		<?php endforeach ?>

	</div>
</article>

<hr class="hr-style"/>

<article class="wrapper-achievement" id="achievement">
	<h3 class="main-title">PORTFOLIO</h3>

	<div class="owl-carousel">
		<?php foreach ($portofolio as $row): ?>
			<?php
				$foto_port = ( empty($row->foto) || !file_exists(FCPATH . "assets/upload/portfolio/thumb/$row->foto") ) ?
					"<!-- no image -->" :
					"<img src='".base_url('assets/upload/portfolio/thumb/'.$row->foto)."' class='img-responsive-2' />";
			 ?>
		  	<div class="item-achievement">
		  		<figure>
		  			<?= $foto_port ?>
		  		</figure>
		  		<h4><?= $row->judul ?></h4>
		  		<?= $row->deskripsi ?>
		  	</div>
		<?php endforeach ?>
	</div>
</article>

<hr class="hr-style"/>

<?php if ($agenda->num_rows() > 0): ?>
	<article class="wrapper-experience" id="agenda">
		<h3 class="main-title">Agenda</h3>
		<div class="timeline">

			<?php
				$i_exp = 0;
			 ?>
			<?php foreach ($agenda->result() as $row): ?>
				<?php
					$arah = ( ($i_exp % 2) == 1 ) ? 'left' : 'right';

					$date_agenda_create = date_create($row->date_agenda);
					$date_agenda =  date_format($date_agenda_create, "jS F Y");
				 ?>
				<div class="item-timeline <?= $arah ?>">
					<span class="date-timeline"><?= $date_agenda ?></span>
					<hgroup>
						<h5 class="subtitle-timeline"><?= $row->city ?></h5>
						<h4 class="title-timeline"><?= ucwords($row->title) ?></h4>
					</hgroup>
					<?= $row->deskripsi ?>
				</div>
				 <?php
					$i_exp++;
				 ?>
			<?php endforeach ?>

		</div>
	</article>

	<hr class="hr-style"/>

<?php else: ?>
	<article id="agenda">
		
	</article>
<?php endif ?>

<?php if ($pendidikan->num_rows() > 0): ?>
	<article class="wrapper-education" id="education">
		<h3 class="main-title">EDUCATION</h3>
		<div class="timeline">

			<?php foreach ($pendidikan->result() as $row): ?>
				<div class="item-timeline right mb-lg">
					<span class="date-timeline">
						<?= $row->tahun_awal ?>
						<?php
							echo ( $row->tahun_akhir != '') ? " - $row->tahun_akhir" : "";
						 ?>
					</span>
					<h4 class="title-timeline"><?= $row->nama_gelar . " " . $row->nama_pendidikan ?></h4>
				</div>
			<?php endforeach ?>

		</div>
	</article>

	<hr class="hr-style"/>
	
<?php else: ?>
	<article id="education">
	</article>
<?php endif ?>

<?php if ($blog_post->num_rows() > 0): ?>
	<article class="wrapper-blogpost" id="blogpost">
		<h3 class="main-title">BLOG POST</h3>

		<div class="row-blogpost">
			<?php foreach ($blog_post->result() as $row): ?>
				<?php
					$foto_blog = ( empty($row->foto) || !file_exists(FCPATH . "assets/upload/berita/thumb/$row->foto") ) ?
						"<!-- no image -->" :
						"<img src='".base_url('assets/upload/berita/thumb/'.$row->foto)."' class='img-responsive-2' />";
				 ?>

				<div class="item-blogpost">
					<figure>
						<?= $foto_blog ?>
					</figure>
					<a href="<?= site_url('home/detail/'.$row->slug) ?>" class="title-blogpost"><?= $row->judul ?></a>
					<span class="date">
						<?php
							$date_publish = date_create($row->date_publish);
							echo date_format($date_publish, "l, jS F Y");
						 ?>
					</span>
					<p><?= $row->sinopsis ?> ...</p>
					<a href="<?= site_url('home/detail/'.$row->slug) ?>" class="readmore">readmore <i class="fa fa-long-arrow-right"></i></a>
				</div>
			<?php endforeach ?>

		</div>

	</article>

	<hr class="hr-style"/>

<?php else: ?>
	<article id="blogpost">
		
	</article>
<?php endif ?>

<section class="wrapper-gallery" id="gallery">
	<h3 class="main-title">Latest Gallery</h3>

	<div class="gallery-wrapper grid" id="instafeed">
	</div>
</section>

<hr class="hr-style"/>

<section class="wrapper-gallery" id="video">
	<h3 class="main-title">Latest Video</h3>

	<div class="row">
		<?php 
			foreach($videoList->items as $item){
		    //Embed video
			    if(isset($item->id->videoId)){
			        echo '<div class="col-md-4 youtube-video" >
			                <iframe src="https://www.youtube.com/embed/'.$item->id->videoId.'" frameborder="0" allowfullscreen></iframe>
			            </div>';
			    }
			}
		 ?>
	</div>
</section>

<hr class="hr-style"/>

<article class="wrapper-contact" id="contact">

	<h3 class="main-title">CONTACT</h3>
	<div class="feed-socmed"></div>
	<div class="list-contact">
		<ul>
			<li><i class="fa fa-map-marker"></i> <span><?= $home->alamat ?></span></li>
			<li><i class="fa fa-phone"></i> <span><?= (empty($home->phone)) ? '-' : $home->phone; ?></span></li>
			<li><i class="fa fa-envelope"></i> <span><?= $home->email ?></span></li>
			<li class="socmed">
				<?php foreach ($sosial_media as $row): ?>
					<a href="<?= $row->link ?>" target="_blank"><?= $row->icon ?></a>
				<?php endforeach ?>
			</li>
		</ul>
	</div>
</article>