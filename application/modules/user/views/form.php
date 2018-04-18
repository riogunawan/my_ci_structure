<!-- breadcrumb -->
<div class="bread-crumb">
	<h4><?= $title ?></h4>
	<ul>
		<li><a href="<?= site_url('user') ?>"><?= $title ?></a></li>
		<li><?= $subtitle ?></li>
	</ul>
</div>
<!-- end of breadcrumb -->

<div class="container-fluid">
	
	<!-- content -->
	<div class="row">
		<div class="col-md-12">
			<?php echo $this->session->flashdata("msg") ?>
			<div class="panel panel-default">
				<div class="panel-heading">
					<?= $subtitle ?>
					<a href="<?= @$link_back ?>" class="btn btn-danger pull-right"><i class="fa fa-arrow-left"></i>&nbsp Back</a>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" action="<?= $form_action ?>" method="POST" role="form" enctype="multipart/form-data">

						<?= $input['hide']['id'] ?>

						<div class="form-group">
							<label class="control-label col-sm-3">Username</label>
							<div class="col-md-9">
								<?= $input['username'] ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Password</label>
							<div class="col-md-9">
								<?= $input['password'] ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Confirm Password</label>
							<div class="col-md-9">
								<?= $input['password_confirm'] ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Full Name</label>
							<div class="col-md-9">
								<?= $input['nama_lengkap'] ?>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-3"></div>
							<div class="col-md-9">
								<button class="btn btn-success"><i class="fa fa-check"></i>&nbsp Process</button>
								<a href="<?= $link_back ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i>&nbsp Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end of content -->

</div>