	<div class="headline container-fluid">
		<div class="row">
			<h1>Registration</h1>
			<?php echo img('/assets/img/tinderbox_single_line.svg'); ?>
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