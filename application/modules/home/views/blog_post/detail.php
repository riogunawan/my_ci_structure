<article class="wrapper-blogpost" id="blogpost">
	<h3 class="main-title">BLOG POST</h3>

	<div class="row-blogpost">
		<div class="col-md-12">
			<h1><?= ucwords($row->judul) ?></h1>
		</div>
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3">
					<i class="fa fa-calendar-check-o"></i>&nbsp
					<span>
						<?php
							$date_publish = date_create($row->date_publish);
							echo date_format($date_publish, "l, jS F Y");
						?>
					</span>
				</div>
				<div class="col-md-4">
					<i class="fa fa-user-circle"></i>&nbsp
					<span>
						<?= $row->nama_lengkap ?>
					</span>
				</div>
				<div class="col-md-5 text-right">
					<i class="fa fa-tag"></i>&nbsp
					<span>
						<?= $row->kategori ?>
					</span>
				</div>
			</div>
			<br />
		</div>
		<div class="col-md-12">
			<?php
				$foto_blog = ( empty($row->foto) || !file_exists(FCPATH . "assets/upload/berita/$row->foto") ) ?
					"<img src='' class='img-responsive' alt='No Image' />" :
					"<img src='".base_url('assets/upload/berita/'.$row->foto)."' class='img-responsive' />";

				echo $foto_blog;
			 ?>
			 <br>
		</div>
		<div class="col-md-12">
			<p><?= $row->isi ?></p>
		</div>
	</div>

	<hr class="hr-style" style="margin-top: 40px; margin-bottom: 40px;" />

	<h3 class="main-title">LATEST BLOG POST</h3>

	<div class="row-blogpost">
		<?php foreach ($list->result() as $row): ?>
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