<!-- breadcrumb -->
<div class="bread-crumb">
	<h4><?= $title ?></h4>
	<ul>
		<li><a href="<?= site_url('agenda') ?>"><?= $title ?></a></li>
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
							<label class="control-label col-sm-3">Title</label>
							<div class="col-md-9">
								<?= $input['title'] ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Cover &nbsp<span class="badge" data-toggle="tooltip" data-placement="top" title="recommended upload landscape Pictures">?</span></label>
							<div class="col-md-9">
								<p class="label label-danger">max file size 3MB</p><p class="label label-success">recommended file size below	 1MB</p>
								<label class="control-label cover" data-cover="<?= @$cover ?>"></label>
								<input id="cover" name="cover" type="file" class="file-loading">
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">City</label>
							<div class="col-md-9">
								<?= $input['city'] ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Description</label>
							<div class="col-md-9">
								<?= $input['deskripsi'] ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Date Agenda</label>
							<div class="col-md-9">
								<?= $input['date_agenda'] ?>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3">Publish</label>
							<div class="col-md-9">
								<label class="radio-inline">
								  <?php echo $input['publish']['ya'] ?> Yes
								</label>
								<label class="radio-inline">
								  <?php echo $input['publish']['tidak'] ?> No
								</label>
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