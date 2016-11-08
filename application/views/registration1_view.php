<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Registration</title>
</head>
<body>
<header>
	<div class="container-fluid">
		<div id="logo" class="col-xs-2"><img src="images/tinderbox_logowhite_small.svg" alt="logo"></div>
	</div>
</header>

	<div class="headline container-fluid">
		<div class="row">
			<h1>Registration</h1>
			<div class="underline"><img src="images/tinderbox_single_line.svg"></div>
		</div>
	</div>
	<div class="register-input container">
		<form>
			<input type="text" name="firstname" placeholder="First Name">
			<input type="text" name="lastname" placeholder="Last Name">
			<select name="gender" placeholder="Gender">
				<option value="gender" label>Gender</option>
				<option value="female">Female</option>
				<option value="male">Male</option>
			</select>
			<input type="date" name="dateofbirth" placeholder="Date of Birth">
			<select name="nationality">
				<option value="nationality" label>Nationality</option>
				<option value="Danish">Danish</option>
				<option value="German">German</option>
				<option value="norwegian">Norwegian</option>
			</select>
		<div class="upload-image">
			<img src="images/picture.svg">
			<p>Upload image</p>
		</div>
		<div class="pagebuttons">
			<div class="next"><a href="registration2.html">Next</a></div>
		</div>
		</form>
	</div>