<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>CTI | Auth</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description"/>
	<meta content="" name="author"/>

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url() ?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url() ?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url() ?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url() ?>assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
	<!-- END GLOBAL MANDATORY STYLES -->

	<!-- BEGIN PAGE LEVEL STYLES -->
	<link href="<?php echo base_url() ?>assets/admin/pages/css/login.css" rel="stylesheet" type="text/css"/>
	<!-- END PAGE LEVEL SCRIPTS -->
	
	<!-- BEGIN THEME STYLES -->
	<link href="<?php echo base_url() ?>assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url() ?>assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url() ?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo base_url() ?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
	<link href="<?php echo base_url() ?>assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
	<!-- END THEME STYLES -->

	<link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico"/>
</head>
<body class="login">
	<div class="menu-toggler sidebar-toggler">
	</div>

	<div class="logo">
		<h1 style="color:#FFF">
	    <span style="font-weight:bold">CTI</span> TRAINING
	    </h1>
	</div>
	<div class="content">
		<!-- BEGIN LOGIN FORM -->
		<form class="login-form" action="<?php echo base_url() ?>auth/reset_password/<?php echo $code ?>" method="post">
			<h3 class="form-title">Reset Password</h3>
			<?php if ($message){ ?>
				<div class="alert alert-danger">
					<button class="close" data-close="alert"></button>
					<span>
					<?php echo $message ?> </span>
				</div>
			<?php } ?>

			<div class="alert alert-danger display-hide">
				<button class="close" data-close="alert"></button>
				<span>
				Masukkan Password Baru Anda </span>
			</div>

			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Password Baru</label>
				<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password Baru" name="new" id="new" value="<?php echo set_value('new') ?>" pattern="^.{8}.*$" />
			</div>
			<div class="form-group">
				<label class="control-label visible-ie8 visible-ie9">Ulangi Password Baru</label>
				<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Ulangi Password Baru" name="new_confirm" id="new_confirm" value="<?php echo set_value('new_confirm') ?>" pattern="^.{8}.*$" />
			</div>
			<?php echo form_input($user_id);?>
			<?php echo form_hidden($csrf); ?>
			<div class="form-actions">
				<button type="submit" class="btn btn-success uppercase">Reset</button>
			</div>
		</form>
	</div>

	<div class="copyright">
		 2017 © Metronic. Developed by <a href="https://www.dartdev.id" target="_blank">Digital Artisans</a>.
	</div>

	<script src="<?php echo base_url() ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>

	<script src="<?php echo base_url() ?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>

	<script src="<?php echo base_url() ?>assets/global/scripts/metronic.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
	<script src="<?php echo base_url() ?>assets/admin/pages/scripts/login.js" type="text/javascript"></script>

	<script>
		jQuery(document).ready(function() {     
		Metronic.init(); // init metronic core components
		Layout.init(); // init current layout
		Login.init();
		Demo.init();
		});
	</script>
</body>
</html>