<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php echo link_tag('assets/bootstrap/css/bootstrap.min.css'); ?>
	<?php echo link_tag('assets/fonts/font-awesome/css/font-awesome.min.css'); ?>
	<?php echo link_tag('assets/css/style.css'); ?>
	<title><?php echo $title; ?></title>
</head>
<body>
<header>
	<div class="container-fluid">
		<div class="row">
			<div id="logo" class="col-xs-2">
				<?php echo img('assets/img/tuborg.svg'); ?>
			</div>
			<a id="logo" class="col-xs-8" href="<?php echo base_url('frontpage'); ?>">
			<?php echo img('assets/img/tinderbox_volunteer.svg'); ?>
			</a>
			<div id="dropdown" class="col-xs-2 nopadding"></div>
		</div>
	</div>
</header>
<div class="headline container-fluid">
	<div class="row">
		<div class="col-xs-4 nopadding">
			<button id="back-link" class="backbutton">Back</button>
		</div>
		<div class="col-xs-8 nopadding headline">
			<?php echo heading($headline, 1); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-offset-1 col-xs-11 nopadding">
			<?php echo img('assets/img/tinderbox_single_line.svg'); ?>
		</div>
	</div>
</div>

<div id="main"></div>

<footer>
	
</footer>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url('assets/js/store.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/scripts.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/information.js'); ?>"></script>

</body>
</html>
