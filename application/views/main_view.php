<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php echo link_tag('assets/bootstrap/css/bootstrap.min.css'); ?>
	<?php echo link_tag('assets/fonts/font-awesome/css/font-awesome.min.css'); ?>
	<?php echo link_tag('assets/css/style.css'); ?>
	<link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="assets/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="assets/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="assets/favicons/manifest.json">
	<link rel="mask-icon" href="assets/favicons/safari-pinned-tab.svg" color="#043540">
	<meta name="theme-color" content="#fff9f4">
	<title></title>
</head>
<body>
<header>
	<div class="container-fluid">
		<div class="row">
			<div id="logo-tuborg" class="col-xs-2 logo-header">
				<?php echo img('assets/img/tuborg.svg'); ?>
			</div>
			<div id="logo-tinderbox" class="link-front col-xs-8 logo-header">
			</div>
			<div id="dropdown" class="col-xs-2 nopadding"></div>
		</div>
	</div>
</header>
<div id="headline" class="headline container-fluid">
	<div class="row">
		<div id="back-link" class="col-xs-4 nopadding"></div>
		<div id="pagetitle" class="col-xs-8 nopadding"></div>
	</div>
	<div class="row">
		<div id="single-line" class="col-xs-12 nopadding"></div>
	</div>
</div>
<div id="main"></div>
<footer>
</footer>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url('assets/js/store.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/script.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
</body>
</html>