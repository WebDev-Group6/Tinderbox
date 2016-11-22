<div class="container-fluid">
	<div class="row">
		<div class="col-xs-4 nopadding">
			<button id="back-link" class="backbutton">Back</button>
		</div>
		<div class="col-xs-8 headline">
			<?php echo img('/assets/img/tinderbox_volunteer_logo.svg'); ?>
		</div>
	</div>
	<div class="row">
		<a href="<?php echo base_url('schedule'); ?>">
			<div class="col-xs-12 nopadding menu-button" id="button-schedule">
				<span class="fa fa-calendar-o">Schedule</span>
				<?php echo img('/assets/img/tinderbox_single_line.svg'); ?>
			</div>
		</a>
	</div>
	<div class="row">
		<a href="<?php echo base_url('qrcodes'); ?>">
			<div class="col-xs-12 nopadding menu-button" id="button-qrcode">
				<span class="fa fa-qrcode">QR Codes</span>
				<?php echo img('/assets/img/tinderbox_single_line.svg'); ?>
			</div>
		</a>
	</div>
	<div class="row">
		<a href="<?php echo base_url('map'); ?>">
			<div class="col-xs-12 nopadding menu-button" id="button-map">
				<span class="fa fa-map">Festival Map</span>
				<?php echo img('/assets/img/tinderbox_single_line.svg'); ?>
			</div>
		</a>
	</div>
	<div class="row">
		<a href="<?php echo base_url('information'); ?>">
			<div class="col-xs-12 nopadding menu-button" id="button-information">
				<span class="fa fa-question-circle">Information</span>
				<?php echo img('/assets/img/tinderbox_single_line.svg'); ?>
			</div>
		</a>
	</div>
	<div class="row">
		<a href="<?php echo base_url('messages'); ?>">
			<div class="col-xs-12 nopadding menu-button" id="button-messages">
				<span class="fa fa-comments">Messages</span>
				<?php echo img('/assets/img/tinderbox_single_line.svg'); ?>
			</div>
		</a>
	</div>

</div>