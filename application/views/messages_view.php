	<div class="headline container-fluid">
		<div class="row">
			<div class="col-xs-4 nopadding">
				<button id="back-link" class="backbutton">Back</button>
			</div>
			<div class="col-xs-8 nopadding headline">
				<h1>Messages</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-offset-1 col-xs-11 nopadding">
				<img class="underline" src="<?php echo base_url('/assets/img/tinderbox_single_line.svg'); ?>">
			</div>
		</div>
	</div>


	<div class="container">
		<a href="<?php echo ('messages/groupmessage') ?>"><button id="group-button" class="message-button">Group Messages</button></a>
		<a href="<?php echo ('messages/personalmessage') ?>"><button id="personal-button" class="message-button">Personal Messages</button></a>
	</div>