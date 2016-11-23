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
			<?php echo img('/assets/img/tuborg.svg'); ?>
		</div>
		<a id="logo" class="col-xs-8" href="<?php echo base_url('frontpage'); ?>">
			<?php echo img('/assets/img/tinderbox_volunteer.svg'); ?>
		</a>
		<div class="col-xs-2 nopadding">
				<div class="dropdown">
			  		<button onclick="toggleDropdown()" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>
			  		<div id="myDropdown" class="dropdown-content">
			    		<a class="fa fa-calendar-o" href="<?php echo base_url('schedule'); ?>">SCHEDULE</a>
			    		<a class="fa fa-qrcode" href="<?php echo base_url('qrcodes'); ?>">QR CODES</a>
			    		<a class="fa fa-map" href="<?php echo base_url('map'); ?>">FESTIVAL MAP</a>
			    		<a class="fa fa-lightbulb-o" href="<?php echo base_url('information'); ?>">INFORMATION</a>
			    		<a class="fa fa-comments" href="<?php echo base_url ('messages') ?>">MESSAGES</a>
			    		<a class="fa fa-user" href="<?php echo base_url('profile'); ?>">Profile</a>
			    		<!-- Logout has no link or function yet -->
			    		<a class="fa fa-sign-out" href="">Logout</a>
			  		</div>
				</div>
			</div>
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
			<?php echo img('/assets/img/tinderbox_single_line.svg'); ?>
		</div>
	</div>
</div>
<div class="container">
	<div id="main">
	</div>
</div>

<footer>
	
</footer>

<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url('/assets/js/store.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/scripts.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/main.js'); ?>"></script>
<script src="<?php echo base_url('/assets/js/information.js'); ?>"></script>

</body>
</html>
