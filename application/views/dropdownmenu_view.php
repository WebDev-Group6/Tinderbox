<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Dropdown menu</title>
</head>
<body>
<header>
	<div class="container-fluid">
		<div id="logo" class="col-xs-2"><img src="images/tinderbox_logowhite_small.svg" alt="logo"></div>
		<div id="user" class="glyphicon glyphicon-user"></div>
	</div>
</header>

	<div class="headline container-fluid">
		<div class="row">
			<h1>Headline</h1>
			<div class="underline"><img src="images/tinderbox_single_line.svg"></div>
		</div>
	</div>


 <div class="dropdown">
  <button onclick="myFunction()" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i>
</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="#">SCHEDULE</a>
    <a href="#">MESSAGES</a>
    <a href="#">QR CODES</a>
    <a href="#">FYI</a>
    <li class="call"><a href="#">CALL SECURITY</a></li>
  </div>
</div>
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


</body>
</html>