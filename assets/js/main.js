// NEEDS REVIEW ==========
//jQuery(function() {
	// if(store.get('user') === undefined || jQuery.isEmptyObject(store.get('user'))) {
	// 	loginPage();
	// } else {
	// 	frontPage();
	// }
	// frontPage();
//});

const URL = 'http://localhost:8888/';
const RESS = 'assets/';

/*=============================
=          Welcome            =
=============================*/
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
	var html = 
	'<div id="form-div">'
    	+'<form id="login_form" class="form" action="#">'
			+'<p class="email">'
				+'<input name="email" type="text" class="' + validate[required,custom[onlyLetter],length[0,100]] + 'feedback-input" placeholder="E-mail" id="email" />'
			+'</p>'
			+'<p class="password">'
				+'<input name="password" type="password" class="'+ validate[required,custom[password], length[8, 100]]+ 'feedback-input" id="password" placeholder="Password" />'
			+'</p>'
			+'<div class="submit">'
				+'<input type="submit" value="LOGIN" id="button-blue"/>'
				+'<div class="ease"></div>'
			+'</div>'
		+'</form>'
  		+'<div class="signup">'
    		+'<button id="signup">'
    			+'SIGN UP'
    		+'</button>'
  		+'</div>'
	+'</div>';

	console.log(html);

	jQuery('#main').html(html);

	//COPY PASTE CODE HERE BELOW ==================	
		'<div class="row">'
			+'<div class="col s12">'
				+'<div class="login-container">'
					+'<div class="login-logo center">'
						+'<img src="'+ RESS +'img/login-logo.png">'
					+'</div>'
					+'<div class="login-input">'
						+'<div class="row">'
							+'<div class="input-field col s12">'
								+'<input id="email" name="email" type="email" class="" required>'
								+'<label for="email">Email</label>'
							+'</div>'
						+'</div>'
						+'<div class="row">'
							+'<div class="input-field col s12">'
								+'<input id="password" name="password" type="password" class="" required>'
								+'<label for="password">Password</label>'
								+'<div class="forgot-pw">'
									+'<a href="#">Forgot Password?</a>'
								+'</div>'
							+'</div>'
						+'</div>'
						+'</div class="row">'
							+'<div class="col s12 center">'
								+'<button class="btn waves-effect waves-dark btn-login-submit">'
									+'Login'
								+'</button>'
							+'</div>'
						+'</div>'
					+'</div>'
				+'</div>'
			+'</div>'
		+'</div>';

	jQuery('#app').html(html);

}


/*=============================
=            Login            =
=============================*/

function login() {
	var email = jQuery('#email').val();
	var password = jQuery('#password').val();

	jQuery.ajax({
		beforeSend: function(xhr) {
			xhr.setRequestHeader("Authorization", "Basic " + btoa(email + ":" + password));
		},
		url: URL + 'api/login',
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
				userid: data.userid,
				firstname: data.firstname,
				lastname: data.lastname,
				email: data.email,
				token: data.secretToken
			});
			frontPage();
	});
};


/*=====  End of Login  ======*/


/*=====================================
=            Back Navigation            =
=====================================*/
function backNav(title) {
	var html =
		'<header class="z-depth-2">'
			+'<div class="arrow-back btn-back">'
				+'<img src="'+ RESS +'img/back-arrow.svg">'
			+'</div>'
			+'<div class="nav-header-text">'
				+'<h4>'+ title +'</h4>'
			+'</div>'
		+'</header>'

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
		url: URL + 'api/shifts/' + user.userid, //load token
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
		console.log(shifts);
		var header =
		'<input type="checkbox" id="sidebarToggler">'
		+'<header class="z-depth-2">'
			+'<div class="logo">'
				+'<img src="'+ RESS +'img/logo.png">'
			+'</div>'
			+'<label class="toggle-sidebar" for="sidebarToggler">'
				+'<img src="'+ RESS +'img/menu.png" alt="" style="padding-top: 15px;">'
			+'</label>'

			+'<div class="sidebar z-depth-2">'
				+'<label class="toggle-close" for="sidebarToggler">✕</label>'
				+'<div class="sidebar-wrapper">'
					+'<div class="sidebar-profile">'
						+'<img src="'+ RESS +'img/user.jpg" alt="">'
						+'<h2>'
							+ user.firstname
						+'</h2>'
						+'<p>'
							+ user.email
						+'</p>'
					+'</div>'
					+'<div class="sidebar-links">'
						+'<ul>'
							+'<li class="btn-notification">'
								+'<img src="'+ RESS +'img/alarm.svg">Noticication'
							+'</li>'
							+'<li class="btn-settings">'
								+'<img src="'+ RESS +'img/settings.svg">Settings'
							+'</li>'
							+'<li class="btn-logout">'
								+'<img src="'+ RESS +'img/exit.svg">Logout'
							+'</li>'
						+'</ul>'
					+'</div>'
					+'<div class="sidebar-copy">'
						+'<p>Tinderbox &copy; 2017<br>Version: Bravo Two Zero</p>'
					+'</div>'
				+'</div>'
			+'</div>'
		+'</header>';

		var html =
			'<h1>Front Page</h1>'
				+ '<button class="waves-effect waves-light btn btn-map">Map</button>'
				+ '<button class="waves-effect waves-light btn btn-chat">Chat</button>'
				+ '<button class="waves-effect waves-light btn btn-info">Info</button>'
				+ '<button class="waves-effect waves-light btn btn-faq">FAQ</button>';
		var sendHtml = header + html;
		jQuery('#app').html(sendHtml); //overwrites the content from the view
	};
};

function map() {
	var html;
	var sendHtml = backNav('Map') + html;
	jQuery('#app').html(sendHtml); //overwrites the content from the view
};

function chat() {
	var html;
	var sendHtml = backNav('Chat') + html;
	jQuery('#app').html(sendHtml); //overwrites the content from the view
}

function information() {
	var html;
	var sendHtml = backNav('Information') + html;
	jQuery('#app').html(sendHtml); //overwrites the content from the view
}

function faq() {
	var html;
	var sendHtml = backNav('Faq') + html;
	jQuery('#app').html(sendHtml); //overwrites the content from the view
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
	jQuery('#app').html(sendhtml); //overwrites the content from the view
};

function settings() {
	var html;
	var sendHtml = backNav('Settings') + html;
	jQuery('#app').html(sendHtml); //overwrites the content from the view
};

function notification(event) {
	var html =
		'<h1>notification ' + event.data.title + '</h1>';
	var sendHtml = backNav('Notification') + html;
	jQuery('#app').html(sendHtml); //overwrites the content from the view
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
jQuery('#app').on('click', '.btn-login-submit', login);
jQuery('#app').on('click', '.btn-map', map);
jQuery('#app').on('click', '.btn-chat', chat);
jQuery('#app').on('click', '.btn-info', information);
jQuery('#app').on('click', '.btn-faq', faq);
jQuery('#app').on('click', '.btn-back', frontPage);
jQuery('#app').on('click', '.btn-notification', {title: "notification"}, notification);
jQuery('#app').on('click', '.btn-settings', settings);
jQuery('#app').on('click', '.btn-logout', loginPage);

//'<button id="signup" onclick="javascript:location.href='registration.html'">SIGN UP</button>'

/* =======  End of Buttons  ======= */