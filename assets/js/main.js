jQuery(function() {
	if(store.get('user') === undefined || jQuery.isEmptyObject(store.get('user'))) {
		loginPage();
	} else {
		frontPage();
	}

});

const URL = 'http://localhost:8888/Tinderbox/Tinderbox/';
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
			responseHandling(err);
		}
	}).done(function(data, status, response) {
		store.set('user', {
				id: data.id,
				first_name: data.first_name,
				last_name: data.last_name,
				email: data.email,
				token: data.secretToken
			});
			frontPage();
	});
};


/*----  Login Ends  ----*/


function logout(){
	var user = store.clear('user');
	window.location.replace("http://localhost:8888/tinderbox/tinderbox/")
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
			+'<div>'
				+'<input id="email" type="email" name="email" placeholder="Email">'
				+'<input id="password" type="password" name="password" placeholder="Password">'
				+'<input id="first_name" type="text" name="first_name" placeholder="First Name">'
				+'<input id="last_name" type="text" name="last_name" placeholder="Last Name">'
				+'<select id="gender" name="gender" placeholder="Gender">'
					+'<option value="" disabled selected>Gender</option>'
					+'<option value="1">Female</option>'
					+'<option value="0">Male</option>'
				+'</select>'
				+'<label for="dateofbirth">Date of Birth</label>'
				+'<input id="dateofbirth" placeholder="Date of Birth" type="date" name="dateofbirth" >'
				+'<select id="nationality" name="nationality" >'
					+'<option value="nationality" disabled selected>Nationality</option>'
					+'<option value="Danish">Danish</option>'
					+'<option value="German">German</option>'
					+'<option value="norwegian">Norwegian</option>'
				+'</select>'
				+'<div class="upload-image">'
					+'<img src="images/picture.svg">'
					+'<p>Upload image</p>'
				+'</div>'
				+'<input id="phonenumber" type="text" name="phonenumber" placeholder="Phonenumber">'
				+'<input id="address" type="text" name="address" placeholder="Address">'
				+'<select id="country" name="country" placeholder="Country">'
					+'<option value="Denmark">Country</option>'
					+'<option value="Denmark">Denmark</option>'
					+'<option value="germany">Germany</option>'
					+'<option value="Norway">Norway</option>'
				+'</select>'
				+'<input id="zipcode" type="text" name="zipcode" placeholder="Zip code">'
				+'<input id="city" input="city" type="text" name="city" placeholder="City">'
				+'<select id="speak_danish" name="speak_danish">'
					+'<option value="danish" disabled selected>Speak and understand Danish</option>'
					+'<option value="1">Yes</option>'
					+'<option value="0">No</option>'
				+'</select>'
				+'<select id="task" name="task">'
					+'<option value="tasks" label disabled selected>Preferred work tasks</option>'
					+'<option value="fences">Building Fences</option>'
					+'<option value="bartender">Bartender</option>'
					+'<option value="it-work">IT Work</option>'
				+'</select>'
				+'<input id="colleague" type="text" name="colleague" placeholder="I like to work with (name)">'
				+'<button class="link-register-user" type="submit" value="REGISTER">Register</button>'
			+'</div>'
		+'</div>';

	jQuery('#main').html(html);
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
	var taskVal = jQuery('#task').val();

	var sendData = {
			"email": jQuery('#email').val(),
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
			"task": taskVal
	};

// function validation() {
//     var at = document.getElementById("email").value.indexOf("@");
//     var age = document.getElementById("age").value;
//     var fname = document.getElementById("fname").value;
//     submitOK = "true";

//     if (fname.length > 10) {
//         alert("The name may have no more than 10 characters");
//         submitOK = "false";
//     } 

//     if (isNaN(age) || age < 1 || age > 100) {
//         alert("The age must be a number between 1 and 100");
//         submitOK = "false";
//     }

//     if (at == -1) {
//         alert("Not a valid e-mail!");
//         submitOK = "false";
//     }

//     if (submitOK == "false") {
//         return false;
//     }
// };

// Check BeforeSend ---------
	jQuery.ajax({
		url: URL + 'user/add_user',
		contentType: 'application/json',
		type: 'POST',
		data: JSON.stringify(sendData),
		success: function(data, status, response) {
			alert('Your Profile has been created, you can login now.');
			loginPage();
		},
			error: function(xhr, status, error) {
			var err = JSON.parse(xhr.responseText);
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
		url: URL + 'user/shifts/' + user.id, //load token
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

	function loadFrontPage(shifts) {
		var user = store.get('user');
		//console.log(shifts);
		var logo =
		'<img src="' + RESS +'img/tinderbox_volunteer.svg" class="tinderbox-logo">';

		var header =
			'<div class="dropdown">'
		  		+'<button onclick="toggleDropdown()" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>'
		  		+'<div id="myDropdown" class="dropdown-content">'
		    		+'<a class="fa fa-calendar-o" onclick="schedule();">SCHEDULE</a>'
		    		+'<a class="fa fa-qrcode" href="#" onclick="qrcode();">QR CODES</a>'
		    		+'<a class="fa fa-map" href="#" onclick="map();">FESTIVAL MAP</a>'
		    		+'<a class="fa fa-lightbulb-o" href="#" onclick="information();">INFORMATION</a>'
		    		+'<a class="fa fa-comments" href="#" onclick="messages();">MESSAGES</a>'
		    		+'<a class="fa fa-user" href="#" onclick="profile();">Profile</a>'
		    		//<!-- Logout has no link or function yet -->
		    		+'<div class="btn-logout">'
		    		+'<a class="fa fa-sign-out" href="#" onclick="logout();">Logout</a>'
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
			var username =
			store.get('user').first_name;

		console.log(username);

		jQuery('#pagetitle').html(headline('Welcome '+ username));
		jQuery('#dropdown').html(header);
		jQuery('#logo-tinderbox').html(logo);
		jQuery('#main').html(html); //overwrites the content from the view
	};
};

/*----  Frontpage Ends  ----*/

/*-------------------------
	*-* User Profile *-*
---------------------------*/



/*-------------------
	*-* Map *-*
-------------------*/

function map() {
	var html = 
		'<div class="container">'
			+ '<div class="col-xs-12 map">'
				+ '<h2>Overview of Festival Area</h2>'
				+'<img src="' + RESS + 'img/map.png">'
			+'</div>'
		+'</div>';

		jQuery('#main').html(html); //overwrites the content from the view
		jQuery('#pagetitle').html(headline('Festival Map'));
};
/*-----------------------
	*-* Messages *-*
-------------------------*/

function messages() {
	var html =
	'<h1>Messages</h1>';

	jQuery('#main').html(html); //overwrites the content from the view
}
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
				''
				+'<div class="container">' 
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
	jQuery('#back-link').html(back());
	 //overwrites the content from the view
}
/*-------------------------
	*-* Schedule *-*
---------------------------*/
function schedule() {
	var html = 
	'<h1>SCHEDULE</h1>';
	jQuery('#main').html(html);
}
/*-------------------------
	*-* Qr Codes *-*
---------------------------*/
function qrcode() {
	var html = 
	'<h1>QRCODE</h1>';
	jQuery('#main').html(html);
}

/*--------------------
	*-* Headline *-*
----------------------*/
function headline(pagetitle) {
		var html =
		'<h1>' + pagetitle + '</h1>'
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
 * ==========  Custom Functions  ========== *
 * ================================================== */
function responseHandling(data){
	Materialize.toast(data.message, 4000);
}

/* =======  End of Custom Functions  ======= */

/**================================================== *
 * ==========  Buttons  ========== *
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
jQuery('#headline').on('click', '.backbutton', frontPage);
jQuery('#main').on('click', '.btn-logout', logout);

//'<button id="signup" onclick="javascript:location.href='registration.html'">SIGN UP</button>'

/* =======  End of Buttons  ======= */