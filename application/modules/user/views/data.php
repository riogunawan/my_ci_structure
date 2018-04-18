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
					<a href="<?= site_url('user/form') ?>" class="btn btn-success pull-right"><i class='fa fa-plus'></i>&nbsp Add</a>
				</div>
				<div class="panel-body">
					<div class="">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th style="width: 2%">#</th>
									<th style="width: 5%">Action</th>
									<th>Full Name</th>
									<th>Username</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end of content -->

</div>