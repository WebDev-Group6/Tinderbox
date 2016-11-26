	<div class="headline container-fluid">
		<div class="row">
			<h1>LOGIN</h1>
			<?php echo img('/assets/img/tinderbox_single_line.svg'); ?>
		</div>
	</div>
<div id="form-main">
  	<div id="form-div">
    	<form id="login_form" class="form" action="<?=site_url('user/login')?>">  

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

<script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>

<script type="text/javascript">
	$(function() {

		$("#login_form").submit(function(evt) {
			evt.preventDefault();
			var url = $(this).attr('action');
			var postData = $(this).serialize();

			$.post(url, postData, function(o) {

			}, 'json');

			/*jQuery.ajax({
				url: '',
				contentType: 'application/json',
				type: 'POST',
				success: function(data, status, response)
				{
					
				}
			}); */

			
			// $.ajax({
			// 	type: "post",
			// 	url: "",
			// 	dataType: "application/json",
			// 	data: {
			// 		email: Email,
			// 		password: Password,
			// 	},
			// 	success: function(data) {

			// 	},
			// 	error: function(data) {

			// 	}

			
			
		});
	});

</script>