	<div class="headline container-fluid">
		<div class="row">
			<div class="col-xs-4 nopadding">
				<button id="back-link" class="backbutton">Back</button>
			</div>
			<div class="col-xs-8 nopadding headline">
				<h1>QR Codes</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-offset-1 col-xs-11 nopadding">
				<?php echo img('/assets/img/tinderbox_single_line.svg'); ?>
			</div>
		</div>
	</div>

<form action = "qrcodes.php" method="post">
	<div class="container">
		<center>
			<h3>Check-In:</h3>
			<?php if(is_array($qr)) {
				print_r($qr[0] -> user_qr);
			} ?>
		</center>
	</div>