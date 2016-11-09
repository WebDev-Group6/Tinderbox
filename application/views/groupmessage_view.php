<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Group Messages</title>
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
			  		<button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>
			  		<div id="myDropdown" class="dropdown-content">
			    		<a href="schedule.html">SCHEDULE</a>
			    		<a href="messages.html">MESSAGES</a>
			    		<a href="qr.html">QR CODES</a>
			    		<a href="information.html">INFO</a>
			    		<a href="map.html">SITE MAP</a>
			    		<a href="security.html" class="call">CALL SECURITY</a>
			  		</div>
				</div>
				<button id="back-link" class="backbutton">Back</button>
			</div>
			<div class="col-xs-8 nopadding headline">
				<h1>Group Messages</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-offset-1 col-xs-11 nopadding">
				<img class="underline" src="images/tinderbox_single_line.svg">
			</div>
		</div>
	</div>


	<div class="container">
		<img class="image-size" src="images/group.png">
	</div>

<footer>
  <div class="footer">
    <div class="social-media">
      <span headline>Follow us</span>
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
<script src="js/scripts.js"></script>
<script type="text/javascript"> 
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

window.onclick = function(event) {
  if (event.target.matches('.dropdown')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<script type="text/javascript">
$( document ).ready(function() {
	$("#toc").append('<h2>Table of contents</h2><ul></ul>');
	$("h2").each(function(i) {
	    var current = $(this);
	    current.attr("id", "title" + i);
	    $("#toc ul").append("<li><a id='link" + i + "' href='#title" +
	        i + "' title='" + current.attr("tagName") + "'>" + 
	        current.html() + "</a></li>");
	});
});
</script>
 </body>
</html>