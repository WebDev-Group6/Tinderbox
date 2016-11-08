<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tinderbox</title>
</head>
<body>
<header>
	<div class="container-fluid">
		<a href="menu.html"><div id="logo" class="col-xs-2"><img src="images/tinderbox_logowhite_small.svg" alt="logo"></div></a>
	</div>
</header>
	<div class="headline container-fluid">
		<div class="row">
			<h1>LOGIN</h1>
			<div class="underline"><img src="images/tinderbox_single_line.svg"></div>
		</div>
	</div>
<div id="form-main">
  	<div id="form-div">
    	<form class="form" id="form1" action="menu.html">  
			<p class="email">
				<input name="email" type="text" class="validate[required,custom[onlyLetter],length[0,100]] feedback-input" placeholder="E-mail" id="email" />
			</p>
			<p class="password">
				<input name="password" type="password" class="validate[required,custom[password]] feedback-input" id="password" placeholder="Password" />
			</p>
			<div class="submit">
				<input type="submit" value="LOGIN" id="button-blue"/>
				<div class="ease"></div>
			</div>
		</form>
  		<div class="signup">
    		<button id="signup" onclick="javascript:location.href='registration.html'">SIGN UP</button>
  		</div>
	</div>
</div>

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