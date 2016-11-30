jQuery(function() {
	if(store.get('user') === undefined || jQuery.isEmptyObject(store.get('user'))) {
		loginPage();
	} else {
		frontPage();
	}

});

const URL = 'http://localhost:8888/tinderbox/tinderbox/';
const RESS = 'assets/';

/*--------------------
	*-* Index Page *-*
----------------------*/

function loginPage() {
	storeCheck();
	store.remove('user');
    function storeCheck() {
		// Use something else than alert()
        if (!store.enabled) {
            alert('Local storage is not supported by your browser. Please disable "Private Mode", or upgrade to a modern browser.');
            return false;
        }
    }

 	jQuery.ajax({
		url: URL,
		ContentType: 'application/json',
		type: 'GET',
		success: function(data, status, response)
		{
			var logo =
		'<img src="' + RESS +'img/tinderbox_volunteer.svg" class="tinderbox-logo">';

		var htmldata = 
		'<div class="container">'
			+'<div class="login-headline">'
				+'<h2>Login as a Volunteer For</h2>'
				+'<img src="' + RESS + 'img/tinderbox_date.svg">'
				+'<h4>Or Register below</h4>'
			+'</div>'
			+'<div class="form-div">'
				+'<div class="input-field">'
					+'<span class="fa fa-user input-login"></span>'
					+'<input name="email" type="text" class=" feedback-input" placeholder="E-mail" id="email">'
				+'</div>'
				+'<div class="input-field">'
					+'<span class="fa fa-lock input-login"></span>'
					+'<input name="password" type="password" class=" feedback-input" id="password" placeholder="password">'
				+'</div>'
				+'<button class="link-login-submit" type="submit" value="LOGIN" id="button-blue">Login</button>'
	    		+'<button class="signup">'
	    				+'SIGN UP'
	    		+'</button>'
			+'</div>'
		+'</div>';

		jQuery('#main').html(htmldata);
		jQuery('title').html(titletag('Signup or Login to Tinderbox Volunteer'));
		jQuery('#logo-tinderbox').html(logo);

		}
	});
}

/*--------------------
	*-* Login *-*
----------------------*/

function login() {
	var email = jQuery('#email').val();
	var password = jQuery('#password').val();

	jQuery.ajax({
		beforeSend: function(xhr) {
			xhr.setRequestHeader("Authorization", "Basic " + btoa(email + ":" + password));
		},
		url: URL + 'user/login',
		contentType: 'application/json',
		type: 'GET',
		success: function(data, status, response) {
		},
		error: function(xhr, status, error) {
			var err = JSON.parse(xhr.responseText);
			alert(err);
		}
	}).done(function(data, status, response) {
		store.set('user', {
				id: data.id,
				first_name: data.first_name,
				last_name: data.last_name,
				email: data.email,
				gender: data.gender,
				dateofbirth: data.dateofbirth,
				phone_number: data.phone_number,
				address: data.address,
				zipcode: data.zipcode,
				city: data.city,
				country: data.country,
				nationality: data.nationality,
				speak_danish: data.speak_danish,
				colleague: data.colleague,
				user_team_id: data.user_team_id,
				user_qr: data.user_qr,
				token: data.secretToken
			});
			frontPage();
			console.log('login');
	});
};


/*----  Login Ends  ----*/


function logout(){
	var user = store.clear('user');
	window.location.replace(URL);
};

/*-----------------------------
	*-* Registration Page *-*
------------------------------*/

function registrationPage() {
	var html =
		'<div class="register-text container">'
			+'<h3>You are about to register as a volunteer for</h3>'
			+'<img src="' + RESS +'img/tinderbox_date.svg">'
		+'</div>'
		+'<div class="register-input container">'
				+'<br>'
				+'<label for="email">Email Address</label>'
				+'<br>'
				+'<input id="email" type="email" name="email" placeholder="Email">'
				+'<br>'
				+'<label for="password">Password</label>'
				+'<br>'	
				+'<input id="password" type="password" name="password" placeholder="Password">'
				+'<br>'
				+'<label for="first_name">First Name</label>'
				+'<br>'
				+'<input id="first_name" type="text" name="first_name" placeholder="First Name">'
				+'<br>'
				+'<label for="last_name">Last Name</label>'
				+'<br>'
				+'<input id="last_name" type="text" name="last_name" placeholder="Last Name">'
				+'<br>'
				+'<label for="gender">Gender</label>'
				+'<br>'
				+'<div class="dropdown-style">'
				+'<select id="gender" name="gender">'
					+'<option value="Gender" disabled selected>Gender</option>'
					+'<option value="1">Female</option>'
					+'<option value="0">Male</option>'
				+'</select>'
				+'</div>'
				+'<br>'
				+'<label for="dateofbirth">Date of Birth</label>'
				+'<br>'
				+'<input id="dateofbirth" placeholder="Date of Birth" type="date" name="dateofbirth" >'
				+'<br>'
				+'<label for="nationality">Nationality</label>'
				+'<br>'
				+'<div class="dropdown-style">'
				+'<select id="nationality" name="nationality" >'
					+'<option value="nationality" disabled selected>Nationality</option>'
					+'<option value="Danish">Danish</option>'
					+'<option value="German">German</option>'
					+'<option value="norwegian">Norwegian</option>'
				+'</select>'
				+'</div>'
				+'<br>'
				+'<label for="upload-image">Upload Image</label>'
				+'<br>'

				+'<div class="upload-image">'
					+'<img src="images/picture.svg">'
					+'<p>Upload image</p>'
				+'</div>'
				+'<br>'
				+'<label for="phonenumber">Phonenumber</label>'
				+'<br>'
				+'<input id="phonenumber" type="text" name="phonenumber" placeholder="Phonenumber">'
				+'<br>'
				+'<label for="address">Address</label>'
				+'<br>'
				+'<input id="address" type="text" name="address" placeholder="Address">'
				+'<br>'
				+'<label for="countryId">Country</label>'
				+'<br>'
				+'<div class="dropdown-style">'
				+ '<select name="country" class="countries" id="country">'
				+ '<option value="">Select Country</option>'
				+ '</select>'
				+'</div>'
				+ '<script src="http://lab.iamrohit.in/js/location.js"></script>'
				+'<br>'
				+'<label for="zipcode">ZIP</label>'
				+'<br>'
				+'<input id="zipcode" type="text" name="zipcode" placeholder="Zip code">'
				+'<br>'
				+'<label for="city">City</label>'
				+'<br>'
				+'<input id="city" input="city" type="text" name="city" placeholder="City">'
				+'<br>'
				+'<label for="speak_danish">Speak and understand Danish</label>'
				+'<br>'
				+'<div class="dropdown-style">'
				+'<select id="speak_danish" name="speak_danish">'
					+'<option value="danish" disabled selected>Speak and understand Danish</option>'
					+'<option value="1">Yes</option>'
					+'<option value="0">No</option>'
				+'</select>'
				+'</div>'
				+'<br>'
				+'<label for="task">Preferred work tasks</label>'
				+'<br>'
				+'<div class="dropdown-style">'
				+'<select id="task" name="task">'
					+'<option value="tasks" label disabled selected>Preferred work tasks</option>'
					+'<option value="2">Building Fences</option>'
					+'<option value="3">Parking/Traffic Control</option>'
					+'<option value="4">Security</option>'
					+'<option value="7">ID Check</option>'
					+'<option value="8">Bartending</option>'
					+'<option value="11">Cleaning</option>'
					+'<option value="12">Sandwich seller</option>'
				+'</select>'
				+'</div>'
				+'<br>'
				+'<label for="colleague">Preferred Colleague</label>'
				+'<br>'
				+'<input id="colleague" type="text" name="colleague" placeholder="I like to work with (name)">'
				+'<button class="link-register-user" type="submit" value="REGISTER">Register</button>'	
		+'</div>';

	jQuery('#main').html(html);
	jQuery('title').html(titletag('Register as Tinderbox Volunteer'));
}

/*-------------------------
	*-* Registration *-*
-------------------------*/

function register() {
	
	var emailVal = jQuery('#email').val();
	var passwordVal = jQuery('#password').val();
	var first_nameVal = jQuery('#first_name').val();
	var last_nameVal = jQuery('#last_name').val();
	var genderVal = jQuery('#gender').val();
	var dateofbirthVal = jQuery('#dateofbirth').val();
	var phone_numberVal = jQuery('#phonenumber').val();
	var addressVal = jQuery('#address').val();
	var cityVal = jQuery('#city').val();
	var zipcodeVal = jQuery('#zipcode').val();
	var countryVal = jQuery('#country').val();
	var nationalityVal = jQuery('#nationality').val();
	var speak_danishVal = jQuery('#speak_danish').val();
	var colleagueVal = jQuery('#colleague').val();
	var user_team_idVal = jQuery('#task').val();

	var sendData = {
			"first_name": first_nameVal,
			"last_name": last_nameVal,
			"email": emailVal,
			"password": passwordVal,
			"gender": genderVal,
			"dateofbirth": dateofbirthVal,
			"phone_number": phone_numberVal,
			"address": addressVal,
			"zipcode": zipcodeVal,
			"city": cityVal,
			"country": countryVal,
			"nationality": nationalityVal,
			"speak_danish": speak_danishVal,
			"colleague": colleagueVal,
			"user_team_id": user_team_idVal
	};

	jQuery.ajax({
		url: URL + 'user/add_user',
		contentType: 'application/json',
		data: JSON.stringify(sendData),
		type: 'POST',
		success: function(data, status, response) {
			alert('Your Profile has been created, you can login now.');
			loginPage();
		},
			error: function(xhr, status, error) {
			//var err = JSON.parse(xhr.responseText);
			console.log(sendData);
			console.log('ERROR');
		}
	});	
}

/*----  Login Ends  ----*/

/*-------------------------
	*-* Frontpage *-*
---------------------------*/

function frontPage() {
	var user = store.get('user');
	//console.log("Main menu loaded!");

	jQuery.ajax({
		beforeSend: function(xhr) {
			xhr.setRequestHeader("SecretToken", user.token);
		},
		url: URL + 'user/team/' + user.id, //load token
		contentType: 'application/json',
		type: 'GET',
		success: function(data, status, response) {
		},
		error: function(xhr, status, error) {
			var err = JSON.parse(xhr.responseText);
		}
	}).done(function(data) {
		loadFrontPage(data);
	});

	function loadFrontPage(team) {
		var user = store.get('user');
		//console.log(shifts);
		var logo =
		'<img src="' + RESS +'img/tinderbox_volunteer.svg" class="tinderbox-logo">';

		var header =
			'<div class="dropdown">'
		  		+'<button onclick="toggleDropdown()" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>'
		  		+'<div id="myDropdown" class="dropdown-content">'
		    		+'<div class="dropdown-link fa fa-calendar-o" onclick="toggleDropdown(); schedule();">SCHEDULE</div>'
		    		+'<div class="dropdown-link fa fa-qrcode" onclick="toggleDropdown(); qrcode();">QR CODES</div>'
		    		+'<div class="dropdown-link fa fa-map" onclick="toggleDropdown(); map();">FESTIVAL MAP</div>'
		    		+'<div class="dropdown-link fa fa-lightbulb-o"  onclick="toggleDropdown(); information();">INFORMATION</div>'
		    		+'<div class="dropdown-link fa fa-comments" onclick="toggleDropdown(); messages();">MESSAGES</div>'
		    		+'<div class="dropdown-link fa fa-user" onclick="toggleDropdown(); profile();">Profile</div>'
		    		+'<div class="dropdown-link fa fa-sign-out" onclick="logout();">Logout</div>'
		    		+'</div>'
		  		+'</div>'
			+'</div>';

		var html =
			'<div class="container-fluid">'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-schedule" id="button-schedule">'
						+'<span class="fa fa-calendar-o">Schedule</span>'
						+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-qrcode" id="button-qrcode">'
						+'<span class="fa fa-qrcode">QR Codes</span>'
						+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-map" id="button-map">'
						+'<span class="fa fa-map">Festival Map</span>'
						+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-info" id="button-information">'
						+'<span class="fa fa-question-circle">Information</span>'
						+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-messages" id="button-messages">'
						+'<span class="fa fa-comments">Messages</span>'
					+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'
			+'</div>';
			var userFirstName =
			store.get('user').first_name;

		jQuery('#pagetitle').html(headline('Welcome '+ userFirstName));
		jQuery('title').html(titletag('Tinderbox Volunteer'));
		jQuery('#dropdown').html(header);
		jQuery('#logo-tinderbox').html(logo);
		jQuery('#main').html(html); //overwrites the content from the view
	};
};

/*----  Frontpage Ends  ----*/

/*-------------------------
	*-* User Profile *-*
---------------------------*/

function profile() {
	var user = store.get('user');
	var first_name = store.get('user').first_name;
	var last_name = store.get('user').last_name;
	var email = store.get('user').email;
	var gender = store.get('user').gender;
	var dateofbirth = store.get('user').dateofbirth;
	var phone_number = store.get('user').phone_number;
	var address = store.get('user').address;
	var city = store.get('user').city;
	var zipcode = store.get('user').zipcode;
	var country = store.get('user').country;
	var nationality = store.get('user').nationality;
	var speak_danish = store.get('user').speak_danish;
	var colleague = store.get('user').colleague;
	var user_team_id = store.get('user').user_team_id;
	var genderType ='';
	var danish = '';

	if(gender = '1') {
		genderType = '<i class="fa fa-female" aria-hidden="true"></i>Female';
	}
	else {
		genderType = 'i class="fa fa-male" aria-hidden="true"></i>Male';
	}

	if(speak_danish = '1') {
		danish = 'I Speak Danish';
	}
	else {
		danish = "I don't Speak Danish";
	}

	var task = '';
	 if(user_team_id = '2') {
			task = 'Building Fences';
	}
	else if(user_team_id = '3') {
			task = 'Parking/Traffic Control';
	}
	else if(user_team_id = '4') {
			task = 'Security';
	}
	else if(user_team_id = '7') {
			task = 'Id Check';
	}
	else if(user_team_id = '8') {

			task = 'Bartending';
	}
	else if(user_team_id = '11') {
			task = 'Cleaning';
	}
	else if(user_team_id = '12') {
			task = 'Sandwich Seller';
	}
	else {
		task = 'No team added';
	}
	var html =
	'<div id="profile">'
		+'<div class="container">'
			+'<h4 class="editprofile"><i class="fa fa-pencil" aria-hidden="true"></i>Edit Profile</h4>'
			+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
			+'<p><i class="fa fa-user" aria-hidden="true"></i>' + first_name + ' ' + last_name + '</p>'
			+'<p><i class="fa fa-envelope" aria-hidden="true"></i>' + email + '</p>'
			+'<p>' + genderType + '</p>'
			+'<p><i class="fa fa-birthday-cake" aria-hidden="true"></i>' + dateofbirth + '</p>'
			+'<p><i class="fa fa-mobile" aria-hidden="true"></i>' + phone_number + '</p>'
			+'<p><i class="fa fa-home" aria-hidden="true"></i>' + address + '</p>'
			+'<p><i class="fa fa-map-marker" aria-hidden="true"></i>' + zipcode + ' ' + city +'</p>'
			+'<p><i class="fa fa-globe" aria-hidden="true"></i>' + country + '</p>'
			+'<p><i class="fa fa-flag" aria-hidden="true"></i>' + nationality + '</p>'
			+'<p><i class="fa fa-commenting-o" aria-hidden="true"></i>' + danish + '</p>'
			+'<p><i class="fa fa-users" aria-hidden="true"></i>' + colleague + '</p>'
			+'<p><i class="fa fa-cog" aria-hidden="true"></i>' + task + '</p>'
		+'</div>'
	+'</div>';

	console.log(user);

	jQuery('#main').html(html); //overwrites the content from the view
	jQuery('#pagetitle').html(headline('Your Profile'));
	jQuery('title').html(titletag('Your Profile Page'));
	jQuery('#back-link').html(back());
}

/*--------------------------------
	*-* Edit User Profile Page *-*
----------------------------------*/

function editUserPage() {

	var user = store.get('user');

	var first_name = store.get('user').first_name;
	var last_name = store.get('user').last_name;
	var email = store.get('user').email;
	var gender = store.get('user').gender;
	var dateofbirth = store.get('user').dateofbirth;
	var phone_number = store.get('user').phone_number;
	var address = store.get('user').address;
	var city = store.get('user').city;
	var zipcode = store.get('user').zipcode;
	var country = store.get('user').country;
	var nationality = store.get('user').nationality;
	var speak_danish = store.get('user').speak_danish;
	var colleague = store.get('user').colleague;
	var user_team_id = store.get('user').user_team_id;
	var genderSelected ='';
	var danishSelected = '';
	var countrySelected = '';

 	if(gender = '1') {
 		genderSelected = 
 		'<select id="gender" name="gender" placeholder="Gender">'
			+'<option value="" disabled selected>Gender</option>'
			+'<option value="1" selected>Female</option>'
			+'<option value="0">Male</option>'
		+'</select>';
 	}
 	else {
 		genderSelected = 
 		'<select id="gender" name="gender" placeholder="Gender">'
			+'<option value="" disabled selected>Gender</option>'
			+'<option value="1">Female</option>'
			+'<option value="0" selected>Male</option>'
		+'</select>';
 	}

 	if(speak_danish = '1') {
 		danishSelected =
 		'<select id="speak_danish" name="speak_danish">'
					+'<option value="danish" disabled selected>Speak and understand Danish</option>'
					+'<option value="1" selected>Yes</option>'
					+'<option value="0">No</option>'
		+'</select>';
 	} 
 	else {
 		danishSelected =
 		'<select id="speak_danish" name="speak_danish">'
			+'<option value="danish" disabled selected>Speak and understand Danish</option>'
			+'<option value="1">Yes</option>'
			+'<option value="0" selected>No</option>'
		+'</select>';
 	}

 	var task = '';
	if(user_team_id = '2') {
		task = 
		'<select id="task" name="task">'
			+'<option value="tasks" label disabled selected>Preferred work tasks</option>'
			+'<option value="2" selected>Building Fences</option>'
			+'<option value="3">Parking/Traffic Control</option>'
			+'<option value="4">Security</option>'
			+'<option value="7">ID Check</option>'
			+'<option value="8">Bartending</option>'
			+'<option value="11">Cleaning</option>'
			+'<option value="12">Sandwich seller</option>'
		+'</select>';
	}
	else if(user_team_id = '3') {
		task = 
		'<select id="task" name="task">'
			+'<option value="tasks" label disabled selected>Preferred work tasks</option>'
			+'<option value="2">Building Fences</option>'
			+'<option value="3" selected>Parking/Traffic Control</option>'
			+'<option value="4">Security</option>'
			+'<option value="7">ID Check</option>'
			+'<option value="8">Bartending</option>'
			+'<option value="11">Cleaning</option>'
			+'<option value="12">Sandwich seller</option>'
		+'</select>';
	}
	else if(user_team_id = '4') {
		task = 
		'<select id="task" name="task">'
			+'<option value="tasks" label disabled selected>Preferred work tasks</option>'
			+'<option value="2">Building Fences</option>'
			+'<option value="3">Parking/Traffic Control</option>'
			+'<option value="4" selected>Security</option>'
			+'<option value="7">ID Check</option>'
			+'<option value="8">Bartending</option>'
			+'<option value="11">Cleaning</option>'
			+'<option value="12">Sandwich seller</option>'
		+'</select>';
	}
	else if(user_team_id = '7') {
		task = 
		'<select id="task" name="task">'
				+'<option value="tasks" label disabled selected>Preferred work tasks</option>'
				+'<option value="2">Building Fences</option>'
				+'<option value="3">Parking/Traffic Control</option>'
				+'<option value="4">Security</option>'
				+'<option value="7" selected>ID Check</option>'
				+'<option value="8">Bartending</option>'
				+'<option value="11">Cleaning</option>'
				+'<option value="12">Sandwich seller</option>'
			+'</select>';
	}
	else if(user_team_id = '8') {
		task = 
		'<select id="task" name="task">'
				+'<option value="tasks" label disabled selected>Preferred work tasks</option>'
				+'<option value="2">Building Fences</option>'
				+'<option value="3">Parking/Traffic Control</option>'
				+'<option value="4">Security</option>'
				+'<option value="7">ID Check</option>'
				+'<option value="8" selected>Bartending</option>'
				+'<option value="11">Cleaning</option>'
				+'<option value="12">Sandwich seller</option>'
			+'</select>';
	}
	else if(user_team_id = '11') {
		task = 
		'<select id="task" name="task">'
			+'<option value="tasks" label disabled selected>Preferred work tasks</option>'
			+'<option value="2">Building Fences</option>'
			+'<option value="3">Parking/Traffic Control</option>'
			+'<option value="4">Security</option>'
			+'<option value="7">ID Check</option>'
			+'<option value="8">Bartending</option>'
			+'<option value="11" selected>Cleaning</option>'
			+'<option value="12">Sandwich seller</option>'
		+'</select>';
	}
	else if(user_team_id = '12') {
		task = 
		'<select id="task" name="task">'
			+'<option value="tasks" label disabled selected>Preferred work tasks</option>'
			+'<option value="2">Building Fences</option>'
			+'<option value="3">Parking/Traffic Control</option>'
			+'<option value="4">Security</option>'
			+'<option value="7">ID Check</option>'
			+'<option value="8">Bartending</option>'
			+'<option value="11">Cleaning</option>'
			+'<option value="12" selected>Sandwich seller</option>'
		+'</select>';
	}
	else {
		task = 
		+'<select id="task" name="task">'
			+'<option value="tasks" label disabled selected>Preferred work tasks</option>'
			+'<option value="2">Building Fences</option>'
			+'<option value="3">Parking/Traffic Control</option>'
			+'<option value="4">Security</option>'
			+'<option value="7">ID Check</option>'
			+'<option value="8">Bartending</option>'
			+'<option value="11">Cleaning</option>'
			+'<option value="12">Sandwich seller</option>'
		+'</select>';
	}
 	// if(countrySelected = 'store.get('user').country;') {
 	// 	countrySelected = 
 	// 	'<select id="gender" name="gender" placeholder="Gender">'
		// 	+'<option value="" disabled selected>Gender</option>'
		// 	+'<option value="1" selected>Female</option>'
		// 	+'<option value="0">Male</option>'
		// +'</select>';
 	// }
 	// else {
 	// 	countrySelected = 
 	// 	'<select id="gender" name="gender" placeholder="Gender">'
		// 	+'<option value="" disabled selected>Gender</option>'
		// 	+'<option value="1">Female</option>'
		// 	+'<option value="0" selected>Male</option>'
		// +'</select>';
 	// }

 	var html = 
	'<div class="register-text container">'
			+'<h3>You are about to register as a volunteer for</h3>'
			+'<img src="' + RESS +'img/tinderbox_date.svg">'
		+'</div>'
		+'<div class="register-input container">'
				+'<br>'
				+'<label for="email">Email Address</label>'
				+'<br>'
				+'<input id="email" type="email" name="email" placeholder="Email" value="' + email + '">'
				+'<br>'
				+'<label for="password">Password</label>'
				+'<br>'	
				+'<input id="password" type="password" name="password" placeholder="Password">'
				+'<br>'
				+'<label for="first_name">First Name</label>'
				+'<br>'
				+'<input id="first_name" type="text" name="first_name" placeholder="First Name" value="' + first_name + '">'
				+'<br>'
				+'<label for="last_name">Last Name</label>'
				+'<br>'
				+'<input id="last_name" type="text" name="last_name" placeholder="Last Name" value="' + last_name + '">'
				+'<br>'
				+'<label for="gender">Gender</label>'
				+'<br>'
				+'<div class="dropdown-style">'
				+	genderSelected
				+'</div>'
				+'<br>'
				+'<label for="dateofbirth">Date of Birth</label>'
				+'<br>'
				+'<input id="dateofbirth" placeholder="Date of Birth" type="date" name="dateofbirth" value="' + dateofbirth + '">'
				+'<br>'
				+'<label for="nationality">Nationality</label>'
				+'<br>'
				+'<div class="dropdown-style">'
				+'<select id="nationality" name="nationality" >'
					+'<option value="nationality" disabled selected>Nationality</option>'
					+'<option value="Danish">Danish</option>'
					+'<option value="German">German</option>'
					+'<option value="norwegian">Norwegian</option>'
				+'</select>'
				+'</div>'
				+'<br>'
				+'<label for="upload-image">Upload Image</label>'
				+'<br>'

				+'<div class="upload-image">'
					+'<img src="images/picture.svg">'
					+'<p>Upload image</p>'
				+'</div>'
				+'<br>'
				+'<label for="phonenumber">Phonenumber</label>'
				+'<br>'
				+'<input id="phonenumber" type="text" name="phonenumber" placeholder="Phonenumber" value="' + phone_number + '">'
				+'<br>'
				+'<label for="address">Address</label>'
				+'<br>'
				+'<input id="address" type="text" name="address" placeholder="Address" value="' + address +'"">'
				+'<br>'
				+'<label for="countryId">Country</label>'
				+'<br>'
				+'<div class="dropdown-style">'
				+ '<select name="country" class="countries" id="countryId">'
				+ '<option selected="' + country + '" disabled>' + country +'</option>'
				+ '</select>'
				+'</div>'
				+ '<script src="http://lab.iamrohit.in/js/location.js"></script>'
				+'<br>'
				+'<label for="zipcode">ZIP</label>'
				+'<br>'
				+'<input id="zipcode" type="text" name="zipcode" placeholder="Zip code" value="' + zipcode + '">'
				+'<br>'
				+'<label for="city">City</label>'
				+'<br>'
				+'<input id="city" input="city" type="text" name="city" placeholder="City" value="' + city + '">'
				+'<br>'
				+'<label for="speak_danish">Speak and understand Danish</label>'
				+'<br>'
				+'<div class="dropdown-style">'
				+ danishSelected
				+'</div>'
				+'<br>'
				+'<label for="task">Preferred work tasks</label>'
				+'<br>'
				+'<div class="dropdown-style">'
				+ task
				+'</div>'
				+'<br>'
				+'<label for="colleague">Preferred Colleague</label>'
				+'<br>'
				+'<input id="colleague" type="text" name="colleague" placeholder="I like to work with (name)" value="' + colleague + '">'
				+'<button class="update-user" type="submit" value="UPDATE">Register</button>'	
		+'</div>';

	jQuery('#main').html(html);	
	jQuery('#back-link').html(back());

}

/*--------------------------------
	*-* Edit User Profile *-*
----------------------------------*/
function editUser() {

	var emailVal = jQuery('#email').val();
	var passwordVal = jQuery('#password').val();
	var first_nameVal = jQuery('#first_name').val();
	var last_nameVal = jQuery('#last_name').val();
	var genderVal = jQuery('#gender').val();
	var dateofbirthVal = jQuery('#dateofbirth').val();
	var phone_numberVal = jQuery('#phonenumber').val();
	var addressVal = jQuery('#address').val();
	var cityVal = jQuery('#city').val();
	var zipcodeVal = jQuery('#zipcode').val();
	var countryVal = jQuery('#country').val();
	var nationalityVal = jQuery('#nationality').val();
	var speak_danishVal = jQuery('#speak_danish').val();
	var colleagueVal = jQuery('#colleague').val();
	var user_team_idVal = jQuery('#task').val();

	var sendData = {
			"email": emailVal,
			"password": passwordVal,
			"first_name": first_nameVal,
			"last_name": last_nameVal,
			"gender": genderVal,
			"dateofbirth": dateofbirthVal,
			"phone_number": phone_numberVal,
			"address": addressVal,
			"city": cityVal,
			"zipcode": zipcodeVal,
			"country": countryVal,
			"nationality": nationalityVal,
			"speak_danish": speak_danishVal,
			"colleague": colleagueVal,
			"user_team_id": user_team_idVal
	};
	jQuery.ajax({
		url: URL + 'user/update_user',
		contentType: 'application/json',
		type: 'PATCH',
		data: JSON.stringify(sendData),
		success: function(data, status, response) {
			console.log(sendData);
		},
		error: function(xhr, status, error) {
			var err = JSON.parse(xhr.responseText);
			console.log(sendData);
		}
	});
}


/*-------------------
	*-* Map *-*
-------------------*/

function map() {
	var html = 
		'<div class="container-fluid">'
			+ '<div class="col-xs-12 map">'
				+ '<h2>Overview of Festival Area</h2>'
				+'<img src="' + RESS + 'img/map.png">'
			+'</div>'
		+'</div>';

		jQuery('#main').html(html); //overwrites the content from the view
		jQuery('#pagetitle').html(headline('Festival Map'));
		jQuery('title').html(titletag('Festival Map'));
		jQuery('#back-link').html(back());
};
/*-----------------------
	*-* Messages *-*
-------------------------*/

function messages() {
	var html =
	'<div class="container-fluid">'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-inbox" id="button-map">'
						+'<span class="fa fa-inbox">Inbox</span>'
						+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-new" id="button-schedule">'
						+'<span class="fa fa-envelope">New Message</span>'
						+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-sent" id="button-map">'
						+'<span class="fa fa-envelope-o">Sent Messages</span>'
						+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-contacts" id="button-schedule">'
						+'<span class="fa fa-fax" >Contacts</span>'
						+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'

	;
	jQuery('#pagetitle').html(headline('Messages'));
	jQuery('#main').html(html); //overwrites the content from the view
	jQuery('title').html(titletag('Messages'));
	jQuery('#back-link').html(back());

}

function msg_inbox(){
	var html = 
	'<div id="messages">'
	+'<div class="container">'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-inbox" id="button-map">'
						+'<span class="fa fa-address-book-o">Welcome Message</span>'
						+'<p >lorem ipsum stuff, content of the message seen here......</p>'
						+'<h1>From:  Tinderbox (staff)</h1>'
						+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-new" id="button-schedule">'
						+'<span class="fa fa-address-book-o">Hi mr, are you in?</span>'
						+'<p>lorem ipsum stuff, content sdafas and something just like....... </p>'
						+'<h1>From:  Torben (leader)</h1>'
						+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-sent" id="button-map">'
						+'<span class="fa fa-address-book-o">Final warning!!</span>'
						+'<p>Please answer this message or you will be banned from TB!!</p>'
						+'<h1>From:  Tinderbox (staff)</h1>'
						+'<img src="' + RESS + 'img/tinderbox_single_line.svg">'
					+'</div>'
				+'</div>'
	+'</div>'
	+'</div>'


	jQuery('#pagetitle').html(headline('Inbox'));
	jQuery('#main').html(html); //overwrites the content from the view
	jQuery('title').html(titletag('Messages'));
	jQuery('#back-link').html(back());

}

 	function msg_new(){
 	
 	var html = 
 	'<div class="container-fluid">'
	+'<div id="messages">'
	+'<label>Recipient</label>'
	+'<br>'
	+'<input type="text"></input>'
	+'<br>'
	+'<label>Subject</label>'
	+'<br>'
	+'<input type="text"></input>'
	+'<br>'
	+'<label>Message</label>'
	+'<br>'
	+'<textarea id="msg_field" type="text"></textarea>'
	+'<br>'
	+'<button onclick="send_msg_fake();" type="submit" value="Send">Send Message</button>'	
	+'</div>'
	+'</div>'
	


	jQuery('#pagetitle').html(headline('Write New Meassage'));
	jQuery('#main').html(html); //overwrites the content from the view
	jQuery('title').html(titletag('Messages'));
	jQuery('#back-link').html(back());


 }

 function send_msg_fake(){
 	alert('Message Sent!');
 	window.location.replace(URL);


 }

// function msg_sent(){
// 	var html = 




// }

// function msg_contacts(){
// 	var html = 



// }

/*-------------------------
	*-* Information *-*
---------------------------*/
function information() {
	
	jQuery.ajax({
		url: URL + 'information/get_info',
		contentType: 'application/json',
		type: 'GET',
		data: JSON.stringify(),
		success: function(data, status, response) {
			var title = '';
			for(var i in data) {
				title += 
				'<div class="row">'
					+ '<div class="col-xs-12">'
						+ '<div class="textbox">'
	        				+ '<div class="dropdown-headline fa fa-angle-down">'
								+'<h3>' 
									+ data[i].info_title 
								+ '</h3>'
							+ '</div>'
							+ '<div class="dropdown-text">'
								+ data[i].info_content
							+ '</div>'
					  	+ '</div>'
					+ '</div>'
				+ '</div>';
			}
			var html = 
				'<div class="container">' 
					+ title
				+ '</div>';

			jQuery('#main').html(html);
			jQuery('.dropdown-headline').on('click', function() {
  				$parent_box = $(this).closest('.textbox');
  				$parent_box.siblings().find('.dropdown-text').slideUp();
  				$parent_box.find('.dropdown-text').slideToggle(400, 'swing');
			});
		},
		error: function(xhr, status, error) {
			console.log('error');
		}
	})

	jQuery('#pagetitle').html(headline('Information'));
	jQuery('title').html(titletag('Information'));
	jQuery('#back-link').html(back());
	 //overwrites the content from the view	 
}
/*-------------------------
	*-* Schedule *-*
---------------------------*/
function schedule() {
	var user = store.get('user');
	var user_team = 'user/user_team/' + user.id;
	 
	jQuery.ajax({
		url: URL + 'user/user_team/' + user.id,
		contentType: 'application/json',
		type: 'GET',
		success: function(data, status, response) {
			
			var monthNames = [
  				'Jan', 'Feb', 'Mar',
  				'Apr', 'May', 'Jun', 
  				'Jul', 'Aug', 'Sep', 
  				'Oct', 'Nov', 'Dec'
			];
			var weekNames = [
			'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'
			]
			var first_date = new Date(data.first_shift_date);
			var first_day = first_date.getDate();
			var first_weekIndex = first_date.getDay();
			var first_monthIndex = first_date.getMonth();
			var first_year = first_date.getFullYear();

			var first_shift_date = weekNames[first_weekIndex] + ' ' + first_day + '-' + monthNames[first_monthIndex];
			
			var second_date = new Date(data.second_shift_date);
			var second_day = second_date.getDate();
			var second_weekIndex = second_date.getDay();
			var second_monthIndex = second_date.getMonth();
			var second_year = second_date.getFullYear();
			var second_shift_date = weekNames[second_weekIndex] + ' ' + second_day + '-' + monthNames[second_monthIndex];
			
			var time = data.first_shift_start;

			var d = new Date(data.first_shift_start);
			var hour = d.getHours();
			var min = d.getMinutes();

			var shiftTime = hour + ':' + min;
			console.log(shiftTime); 
			
			var schedule = 
				'<div class="row">'
					+ '<div class="col-xs-12">'
						+ '<div class="textbox">'
	        				+ '<div class="dropdown-headline fa fa-angle-down">'
								+'<h3>' 
									+'Your Team'
								+ '</h3>'
							+ '</div>'
							+ '<div class="dropdown-text">'
								+ '<h4>' + data.team_name + '</h4>'
								+ data.team_info
							+ '</div>'
					  	+ '</div>'
					+ '</div>'
				+ '</div>'
				+ '<div class="row">'
					+ '<div class="col-xs-12">'
						+ '<div class="textbox">'
	        				+ '<div class="dropdown-headline">'
								+'<h3>' 
									+ first_shift_date + ' ' + data.first_shift_start + '-' + data.first_shift_end
								+ '</h3>'
							+ '</div>'
					  	+ '</div>'
					+ '</div>'
				+ '</div>'
				+ '<div class="row">'
					+ '<div class="col-xs-12">'
						+ '<div class="textbox">'
	        				+ '<div class="dropdown-headline">'
								+'<h3>' 
									+ second_shift_date + ' ' + data.second_shift_start + '-' + data.second_shift_end
								+ '</h3>'
							+ '</div>'
					  	+ '</div>'
					+ '</div>'
				+ '</div>'
				+ '<div class="row">'
					+ '<div class="col-xs-12">'
						+ '<div class="textbox">'
	        				+ '<div class="dropdown-headline fa fa-angle-down">'
								+'<h3>' 
									+ 'Meeting Point'
								+ '</h3>'
							+ '</div>'
							+ '<div class="dropdown-text">'
								+ '<h4 class="meetingplace fa fa-map">'+ data.team_place +'</h4>'
							+ '</div>'
					  	+ '</div>'
					+ '</div>'
					+ '</div>';
				console.log(user.user_team_id);

				jQuery.ajax({
					url: URL + 'user/team_leader/' + user.user_team_id,
					contentType: 'application/json',
					type: 'GET',
					success: function(data, status, response) {
						console.log(data);
						var html_leader = 
							'<div class="row">'
								+ '<div class="col-xs-12">'
									+ '<div class="textbox">'
	        							+ '<div class="dropdown-headline fa fa-angle-down">'
											+'<h3>Team Leader</h3>' 
										+ '</div>'
										+ '<div class="dropdown-text">'
											+ '<p>' + data.first_name + ' ' + data.last_name + '</p>'
											+ '<p>Email: ' + data.email + '</p>'
											+ '<p>' + data.phone_number + '</p>'
											+ '<p>Your team leader is responseble for scanning your QR code and giving instructions during your shift.'
										+ '</div>'
					  				+ '</div>'
								+ '</div>'
							+ '</div>';
							var html = 
								'<div id="schedule" class="container">'
									+'<div class="row">'
										+'<div class="col-xs-12">'
											+ '<div class="textbox">'
												+ '<div class="dropdown-headline">'
													+'<p>Read about your team and responsibilites, when you have shifts, where you should check in and who your team leader is.</p>'
												+ '</div>'
											+ '</div>'
										+'</div>'
									+'</div>'
									+ schedule
									+ html_leader
								+ '</div>';

							jQuery('#main').html(html);
							jQuery('#pagetitle').html(headline('Schedule'));
							jQuery('title').html(titletag('Your Schedule'));

							jQuery('.dropdown-headline').on('click', function() {
			  				$parent_box = $(this).closest('.textbox');
			  				$parent_box.siblings().find('.dropdown-text').slideUp();
			  				$parent_box.find('.dropdown-text').slideToggle(300, 'swing');
			});
					},
					error: function(xhr, status, error) {
						var err = JSON.parse(xhr.responseText);
					}
				})
		},
		error: function(xhr, status, error) {
			var err = JSON.parse(xhr.responseText);
		}
	})
}
/*-------------------------
	*-* Qr Codes *-*
---------------------------*/
function qrcode() {

	var user = store.get('user');

	var user_qr = store.get('user').user_qr;
	var id = store.get('user').id;
	
	var html = 
	'<div id="qrcodepage" class="container">'
		+'<div class="row">'
			+ '<div class="col-xs-12">'
				+ '<div class="textbox">'
	        		+ '<div class="dropdown-headline fa fa-angle-down">'
						+'<h3>' 
							+'Your QR Code'
						+ '</h3>'
					+ '</div>'
					+ '<div class="dropdown-text">'
						+ '<p>The QR Code is used to verify that you have attended your shift. Your QR code can only be scanned <strong>ONCE</strong> and it must be done by your team leader.</p>'
					+ '</div>'
				+ '</div>'
			+ '</div>'
		+ '</div>'
		+ '<div class="qrwrapper">'
			+'<img src="https://api.qrserver.com/v1/create-qr-code/?data=' + URL + 'user/' + id + '/' + user_qr + ';&format=svg&color=4-53-64&bgcolor=255-249-244" alt="" title="" />'
		+'</div>'
	+'</div>';
	
	jQuery('#main').html(html);
	jQuery('#pagetitle').html(headline('QR Code'));
	jQuery('title').html(titletag('QR Codes'));

	jQuery('.dropdown-headline').on('click', function() {
  				$parent_box = $(this).closest('.textbox');
  				$parent_box.siblings().find('.dropdown-text').slideUp();
  				$parent_box.find('.dropdown-text').slideToggle(400, 'swing');
			});
}

/*--------------------
	*-* Headline *-*
----------------------*/
function headline(pagetitle) {
		var html =
		'<h1>' + pagetitle + '</h1>'
		return html;
}

/*----------------------
	*-*  View Titletag *-*
----------------------*/
function titletag(title) {
	var html = title
	return html;
}


/*----------------------------
	*-* Back to Frontpage *-*
-----------------------------*/

function back() {
	var html =
	'<button id="back-link" class="backbutton">Back</button>'

	return html;
}

/**================================================== *
 * ==========  Onclick event listeners  ========== *
 * ================================================== */
jQuery('#main').on('click', '.link-login-submit', login);
jQuery('#main').on('click', '.signup', registrationPage);
jQuery('#main').on('click', '.link-register-user', register);
jQuery('#logo-tinderbox').on('click', '.tinderbox-logo', frontPage);
jQuery('#main').on('click', '.link-map', map);
jQuery('#main').on('click', '.link-schedule', schedule);
jQuery('#main').on('click', '.link-qrcode', qrcode);
jQuery('#main').on('click', '.link-messages', messages);
jQuery('#main').on('click', '.link-info', information);
jQuery('#main').on('click', '.editprofile', editUserPage);
jQuery('#main').on('click', '.update-user', editUser);
jQuery('#headline').on('click', '.backbutton', frontPage);
jQuery('#main').on('click', '.link-inbox', msg_inbox);
jQuery('#main').on('click', '.link-new', msg_new);
// jQuery('#main').on('click', '.link-sent', msg_sent);
// jQuery('#main').on('click', '.link-contacts', msg_contacts);
jQuery('#main').on('click', '.btn-logout', logout);

//'<button id="signup" onclick="javascript:location.href='registration.html'">SIGN UP</button>'

/* =======  End of Buttons  ======= */