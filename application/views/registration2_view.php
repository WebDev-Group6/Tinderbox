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
			<input type="number" name="phonenumber" placeholder="Phonenumber">
			<input type="text" name="address" placeholder="Address">
			<select name="country" placeholder="Country">
				<option value="Denmark" label>Denmark</option>
				<option value="germany">Germany</option>
				<option value="Norway">Norway</option>
			</select>
			<input type="number" name="zipcode" placeholder="Zip code">
			<input type="text" name="city" placeholder="City">
			
			<select name="danish">
				<option value="danish" label>Speak and understand Danish</option>
				<option value="Yes">Yes</option>
				<option value="No">No</option>
			</select>
			<select name="workingperiod">
				<option value="Denmark" label>Preferred working period</option>
				<option value="before">Before Festival</option>
				<option value="during">During Festival</option>
				<option value="after">After Festival</option>
			</select>
			<select name="worktasks">
				<option value="tasks" label>Preferred work tasks</option>
				<option value="fences">Building Fences</option>
				<option value="bartender">Bartender</option>
				<option value="it-work">IT Work</option>
			</select>
			<input type="text" name="workpartner" placeholder="I like to work with (name)">

		<div class="pagebuttons">
			<div class="back"><a href="registration1.html">Back</a></div>
			<div class="next"><a href="menu.html">Finish</a></div>
		</div>
		</form>
	</div>