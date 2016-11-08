<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	
	<title>Menu</title>
</head>
<body>
<header>
	<div class="container-fluid">
		<a href="menu.html"><div id="logo" class="col-xs-2"><img src="images/tinderbox_logowhite_small.svg" alt="logo"></div></a>
		<a href="profile.html"><div id="user" class="glyphicon glyphicon-user"></div></a>
	</div>
</header>

	<div class="headline container-fluid">
		<div class="row">
			<div class="col-xs-4 nopadding">
				<div class="dropdown">
			  		<button onclick="toggleDropdown()" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>
			  		<div id="myDropdown" class="dropdown-content">
			    		<a href="schedule.html">SCHEDULE</a>
			    		<a href="messages.html">MESSAGES</a>
			    		<a href="qr.html">QR CODES</a>
			    		<a href="information.html">INFO</a>
			    		<a href="map.html">FESTIVAL MAP</a>
			    		<a href="security.html" class="call">CALL SECURITY</a>
			  		</div>
				</div>
				<button id="back-link" class="backbutton">Back</button>
			</div>
			<div class="col-xs-8 nopadding headline">
				<h1>Tinderbox Volunteer</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-offset-1 col-xs-11 nopadding">
				<img class="underline" src="images/tinderbox_single_line.svg">
			</div>
		</div>
	</div>

<a href="information.html"><button class="menu-button" id="button-information">Information</button></a>
<a href="schedule.html"><button class="menu-button" id="button-schedule">Schedule</button></a>
<a href="qr.html"><button class="menu-button" id="button-qrcode">QR code</button></a>
<a href="map.html"><button class="menu-button" id="button-map">Map</button></a>
<a href="security.html"><button class="menu-button" id="button-security">Security</button></a>
<div class="newsfeed container">
	<h1>News</h1>
	<div class="news">
		<img src="images/concert.jpg">
		<div class="gradient-background">
			<h4>
				Festival schedule ready
			</h4>
			<p>Schedule is ready on Tinderbox.dk and volunteers can now see their schedule in...</p>
		</div>
	</div>
</div>
<!--Footer-->

<footer>
	<div class="footer">
		<div class="social-media">
			<span>Follow us</span>
			<div class="social-media-icons">
				<i class="fa fa-facebook-official" aria-hidden="true"></i>
				<i class="fa fa-instagram" aria-hidden="true"></i>
				<i class="fa fa-twitter" aria-hidden="true"></i>
				<i class="fa fa-spotify" aria-hidden="true"></i>
			</div>
		</div>

		<div class="tuborg">
			<img src="images/tuborg.svg">
		</div>
	</div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
var cw = $('.menu-button').width();
$('.menu-button').css({'height':cw+'px'});
</script>
<script src="js/scripts.js"></script>

</body>
</html>