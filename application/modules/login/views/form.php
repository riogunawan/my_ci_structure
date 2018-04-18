<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>
		<?php echo $title ?>
		</title>
		<meta name="description" content="<?php echo $title ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Base Styles -->
		<!--css vendor -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/font-awesome/css/font-awesome.min.css" />
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/sweetalert2/dist/sweetalert2.css">
		
		<!-- style -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/e-disi-admin/stylesheets/css/font.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/themes/e-disi-admin/stylesheets/css/style.css" />
		
		<style type="text/css">
			.form-group .error {
				color: red;
				font-weight: 500;
			}
		</style>
		<!-- <link rel="shortcut icon" href="<?php echo base_url() ?>assets/themes/metronic/images/Logo-Titian.png" /> -->
	</head>
	<!-- end::Head -->
	<!-- end::Body -->
	<body>
		<!-- begin:: Page -->
		<div class="col-md-12">
			<div class="col-md-12">
				<center>
				<h1><?= $title ?></h1>
				<h3>Login To Your Account</h3>
				</center>
				<hr>
			</div>
			<div class="col-md-4 col-md-offset-4">
				<form class="form" action="<?= base_url("login/login_proses") ?>" method="post">
					<?php echo $this->session->flashdata("msg") ?>
					<div class="form-group">
						<?php echo form_input($username) ?>
					</div>
					<div class="form-group">
						<?php echo form_input($password) ?>
					</div>
					<div class="">
						<button class="col-md-12 btn btn-focus btn-success">
						<i class="fa fa-sign-in"></i>&nbsp
						Login
						</button>
					</div>
				</form>
			</div>
		</div>
		<!-- end:: Page -->
		<!--begin::Base Scripts -->
		<!-- javascript vendor-->
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/jquery/jquery-3.1.1.min.js"></script>
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/moment/js/moment.min.js"></script>
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/sweetalert2/dist/sweetalert2.js"></script>
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/vendors/jquery-validate/jquery.validate.js"></script>
		
		<!-- main javascript -->
		<script src="<?php echo base_url() ?>assets/themes/e-disi-admin/javascripts/main.js"></script>
		<!--end::Page Snippets -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('.form').validate({
					// debug: true,
					ignore: [],
					errorClass: 'error',
					// showErrors: function(errorMap, errorList) {},
					invalidHandler: function(form, validator) {
						var errors = validator.numberOfInvalids();
						if (errors) {
							var msg = "";
							if (validator.errorList.length > 0) {
								for (x = 0; x < validator.errorList.length; x++) {
									msg += "<div class='text-danger'>" + validator.errorList[x].message + "</div>";
								}
							}
							swal({
								title: "Error Messages",
								html: msg,
								type: "error",
								animation: "slide-from-top",
								confirmButtonColor: "#D9534F"
							});
						}
						validator.focusInvalid();
					},
					rules: {
						username: { required: true },
						password: { required: true },
					},
					messages: {
						username: { required: "Username tidak boleh kosong" },
						password: { required: "Password tidak boleh kosong" },
					},
				});
			});
		</script>
	</body>
	<!-- end::Body -->
</html>