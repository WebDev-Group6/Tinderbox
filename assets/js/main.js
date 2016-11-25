// NEEDS REVIEW ==========
jQuery(function() {
	if(store.get('user') === undefined || jQuery.isEmptyObject(store.get('user'))) {
		loginPage();
	} else {
		frontPage();
	}

});

const URL = 'http://localhost/tinderbox/';
const RESS = 'assets/';

/*--------------------
	*-* Index Page *-*
----------------------*/

function loginPage() {
	storeCheck();
	localStorage.removeItem('user');
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
			+'<div id="form-div">'
				+'<p class="email">'
					+'<input name="email" type="text" class="feedback-input" placeholder="E-mail" id="email" />'
				+'</p>'
				+'<p class="password">'
					+'<input name="password" type="password" class="feedback-input" id="password" placeholder="Password" />'
				+'</p>'
				+'<div class="submit">'
					+'<button class="link-login-submit" type="submit" value="LOGIN" id="button-blue">Login</button>'
				+'</div>'
	  			+'<div id="signup">'
	    			+'<button class="signup">'
	    				+'SIGN UP'
	    			+'</button>'
	  			+'</div>'
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


/*----  End of Login  ----*/

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
			+'<form>'
				+'<input type="email" name="email" placeholder="Email">'
				+'<input type="password" name="password" placeholder="Password">'
				+'<input type="text" name="firstname" placeholder="First Name">'
				+'<input type="text" name="lastname" placeholder="Last Name">'
				+'<select name="gender" placeholder="Gender">'
					+'<option value="gender" label>Gender</option>'
					+'<option value="female">Female</option>'
					+'<option value="male">Male</option>'
				+'</select>'
				+'<label for="dateofbirth">Date of Birth</label>'
				+'<input placeholder="Date of Birth" type="date" name="dateofbirth" >'
				+'<select name="nationality">'
					+'<option value="nationality" label>Nationality</option>'
					+'<option value="Danish">Danish</option>'
					+'<option value="German">German</option>'
					+'<option value="norwegian">Norwegian</option>'
				+'</select>'
			+'<div class="upload-image">'
				+'<img src="images/picture.svg">'
				+'<p>Upload image</p>'
			+'</div>'
			+'<input type="number" name="phonenumber" placeholder="Phonenumber">'
			+'<input type="text" name="address" placeholder="Address">'
			+'<select name="country" placeholder="Country">'
				+'<option value="Denmark" label>Denmark</option>'
				+'<option value="germany">Germany</option>'
				+'<option value="Norway">Norway</option>'
			+'</select>'
			+'<input type="number" name="zipcode" placeholder="Zip code">'
			+'<input type="text" name="city" placeholder="City">'
			+'<select name="danish">'
				+'<option value="danish" label>Speak and understand Danish</option>'
				+'<option value="Yes">Yes</option>'
				+'<option value="No">No</option>'
			+'</select>'
			+'<select name="workingperiod">'
				+'<option value="Denmark" label>Preferred working period</option>'
				+'<option value="before">Before Festival</option>'
				+'<option value="during">During Festival</option>'
				+'<option value="after">After Festival</option>'
			+'</select>'
			+'<select name="worktasks">'
				+'<option value="tasks" label>Preferred work tasks</option>'
				+'<option value="fences">Building Fences</option>'
				+'<option value="bartender">Bartender</option>'
				+'<option value="it-work">IT Work</option>'
			+'</select>'
			+'<input type="text" name="workpartner" placeholder="I like to work with (name)">'
			+'<div class="submit"><a href="registration1.html">Register</a></div>'
		+'</form>'
	+'</div>';
	jQuery('#main').html(html);
}

/*-------------------------
	*-* Registration *-*
-------------------------*/

function register() {
	var email = jQuery('#email').val();
	var password = jQuery('#password').val();
	var first_name = jQuery('#first_name').val();
	var last_name = jQuery('#last_name').val();
	var phone_number = jQuery('#phone_number').val();
	var address = jQuery('#address').val();
	var city = jQuery('#city').val();
	var country = jQuery('#country').val();
	var nationality = jQuery('#nationality').val();
	var speak_danish = jQuery('#speak_danish').val();
	var colleague = jQuery('#colleague').val();
	var task = jQuery('#task').val();

	jQuery.ajax({
		beforeSend: function(xhr) {
			xhr.setRequestHeader()
		}
	});
}

/*=====================================
=            Back Navigation            =
=====================================*/
function headline(pagetitle) {
	var html =
		'<h1>' + pagetitle + '</h1>'
		// '<header class="z-depth-2">'
		// 	+'<div class="arrow-back btn-back">'
		// 		+'<img src="'+ RESS +'img/back-arrow.svg">'
		// 	+'</div>'
		// 	+'<div class="nav-header-text">'
		// 		+'<h4>'+ title +'</h4>'
		// 	+'</div>'
		// +'</header>'

	return html;
}

function back() {
	var html =
	'<button id="back-link" class="backbutton">Back</button>'

	return html;
}
/*=====  End of Back Navigation  ======*/


/*=============================================
=            frontPage // Menu                =
=============================================*/

function frontPage() {
	var user = store.get('user');
	console.log("Main menu loaded!");

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
			responseHandling(err);
		}
	}).done(function(data) {
		loadFrontPage(data);
	});

	function loadFrontPage(shifts) {
		var user = store.get('user');
		//console.log(shifts);


		var header =
			'<div class="dropdown">'
		  		+'<button onclick="toggleDropdown()" class="dropbtn"><i class="fa fa-bars" aria-hidden="true"></i></button>'
		  		+'<div id="myDropdown" class="dropdown-content">'
		    		+'<a class="fa fa-calendar-o link-schedule">SCHEDULE</a>'
		    		+'<a class="fa fa-qrcode" href="<?php echo base_url(qrcodes); ?>">QR CODES</a>'
		    		+'<a class="fa fa-map" href="<?php echo base_url(map); ?>">FESTIVAL MAP</a>'
		    		+'<a class="fa fa-lightbulb-o" href="<?php echo base_url(information); ?>">INFORMATION</a>'
		    		+'<a class="fa fa-comments" href="<?php echo base_url (messages) ?>">MESSAGES</a>'
		    		+'<a class="fa fa-user" href="<?php echo base_url(profile); ?>">Profile</a>'
		    		//<!-- Logout has no link or function yet -->
		    		+'<a class="fa fa-sign-out" href="">Logout</a>'
		  		+'</div>'
			+'</div>';

		var html =
			'<div class="container-fluid">'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-schedule" id="button-schedule">'
						+'<span class="fa fa-calendar-o">Schedule</span>'
						+'<?php echo img(/assets/img/tinderbox_single_line.svg); ?>'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-qrcode" id="button-qrcode">'
						+'<span class="fa fa-qrcode">QR Codes</span>'
						+'<?php echo img(/assets/img/tinderbox_single_line.svg); ?>'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-map" id="button-map">'
						+'<span class="fa fa-map">Festival Map</span>'
						+'<?php echo img(/assets/img/tinderbox_single_line.svg); ?>'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-info" id="button-information">'
						+'<span class="fa fa-question-circle">Information</span>'
						+'<?php echo img(/assets/img/tinderbox_single_line.svg); ?>'
					+'</div>'
				+'</div>'
				+'<div class="row">'
					+'<div class="col-xs-12 nopadding menu-button link-messages" id="button-messages">'
						+'<span class="fa fa-comments">Messages</span>'
						+'<?php echo img(/assets/img/tinderbox_single_line.svg); ?>'
					+'</div>'
				+'</div>'
			+'</div>';

		// '<input type="checkbox" id="sidebarToggler">'
		// +'<header class="z-depth-2">'
		// 	+'<div class="logo">'
		// 		+'<img src="'+ RESS +'img/logo.png">'
		// 	+'</div>'
		// 	+'<label class="toggle-sidebar" for="sidebarToggler">'
		// 		+'<img src="'+ RESS +'img/menu.png" alt="" style="padding-top: 15px;">'
		// 	+'</label>'

		// 	+'<div class="sidebar z-depth-2">'
		// 		+'<label class="toggle-close" for="sidebarToggler">✕</label>'
		// 		+'<div class="sidebar-wrapper">'
		// 			+'<div class="sidebar-profile">'
		// 				+'<img src="'+ RESS +'img/user.jpg" alt="">'
		// 				+'<h2>'
		// 					+ user.first_name
		// 				+'</h2>'
		// 				+'<p>'
		// 					+ user.email
		// 				+'</p>'
		// 			+'</div>'
		// 			+'<div class="sidebar-links">'
		// 				+'<ul>'
		// 					+'<li class="btn-notification">'
		// 						+'<img src="'+ RESS +'img/alarm.svg">Noticication'
		// 					+'</li>'
		// 					+'<li class="btn-settings">'
		// 						+'<img src="'+ RESS +'img/settings.svg">Settings'
		// 					+'</li>'
		// 					+'<li class="btn-logout">'
		// 						+'<img src="'+ RESS +'img/exit.svg">Logout'
		// 					+'</li>'
		// 				+'</ul>'
		// 			+'</div>'
		// 			+'<div class="sidebar-copy">'
		// 				+'<p>Tinderbox &copy; 2017<br>Version: Bravo Two Zero</p>'
		// 			+'</div>'
		// 		+'</div>'
		// 	+'</div>'
		// +'</header>';

		// var html =
		// 	'<h1>Front Page</h1>'
		// 		+ '<button class="waves-effect waves-light btn btn-map">Map</button>'
		// 		+ '<button class="waves-effect waves-light btn btn-chat">Chat</button>'
		// 		+ '<button class="waves-effect waves-light btn btn-info">Info</button>'
		// 		+ '<button class="waves-effect waves-light btn btn-faq">FAQ</button>';
		
		jQuery('#pagetitle').html(headline('Front'));
		jQuery('#dropdown').html(header);
		jQuery('#main').html(html); //overwrites the content from the view
	};
};

function map() {
	var html = 
	'<h1>Festival Map</h1>';
	jQuery('#main').html(html); //overwrites the content from the view
};

function messages() {
	var html =
	'<h1>Messages</h1>';

	jQuery('#main').html(html); //overwrites the content from the view
}

function information() {
	var html =
	'<h1>Information</h1>';

	
	jQuery('#pagetitle').html(headline('Information'));
	jQuery('#back-link').html(back());
	jQuery('#main').html(html); //overwrites the content from the view
}

function faq() {
	var html;
	var sendHtml = backNav('Faq') + html;
	jQuery('#main').html(sendHtml); //overwrites the content from the view
}

function schedule() {
	var html = 
	'<h1>SCHEDULE</h1>';
	jQuery('#main').html(html);
}

function qrcode() {
	var html = 
	'<h1>QRCODE</h1>';
	jQuery('#main').html(html);
}

/*=====  End of FrontPage  ======*/

/*==================================
=            Burgermenu            =
==================================*/
function changeImage() {
	var html =
		'<h1>changeImage</h1>'
		+'<button class="btn waves-effect btn-back">Back</button>';
	var sendHtml = backNav('Change Image') + html;
	jQuery('#main').html(sendhtml); //overwrites the content from the view
};

function settings() {
	var html;
	var sendHtml = backNav('Settings') + html;
	jQuery('#main').html(sendHtml); //overwrites the content from the view
};

function notification(event) {
	var html =
		'<h1>notification ' + event.data.title + '</h1>';
	var sendHtml = backNav('Notification') + html;
	jQuery('#main').html(sendHtml); //overwrites the content from the view
};


/*=====  End of Burgermenu  ======*/


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
jQuery('#main').on('click', '.link-map', map);
jQuery('#main').on('click', '.link-schedule', schedule);
jQuery('#main').on('click', '.link-qrcode', qrcode);
jQuery('#main').on('click', '.link-messages', messages);
jQuery('#main').on('click', '.link-info', information);
jQuery('#main').on('click', '.btn-faq', faq);
jQuery('#headline').on('click', '.backbutton', frontPage);
jQuery('#main').on('click', '.btn-notification', {title: "notification"}, notification);
jQuery('#main').on('click', '.btn-settings', settings);
jQuery('#main').on('click', '.btn-logout', loginPage);

//'<button id="signup" onclick="javascript:location.href='registration.html'">SIGN UP</button>'

/* =======  End of Buttons  ======= */