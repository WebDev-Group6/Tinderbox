	<div class="headline container-fluid">
		<div class="row">
			<h1>LOGIN</h1>
			<div class="underline"><img src="assets/img/tinderbox_single_line.svg"></div>
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