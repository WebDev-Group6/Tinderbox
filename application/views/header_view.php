<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/bootstrap/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/fonts/font-awesome/css/font-awesome.min.css'); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/css/style.css'); ?>">
</head>
<body>
<header>
	<div class="container-fluid">
		<div class="row">
		<div id="logo" class="col-xs-2"><img src="<?php echo base_url('/assets/img/tuborg.svg'); ?>" alt="Tuborg logo"></div>
		<a id="logo" class="col-xs-8" href="<?php echo base_url('frontpage'); ?>">
			<img src="<?php echo base_url('/assets/img/tinderbox_volunteer.svg') ?>">
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















