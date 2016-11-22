	<div class="headline container-fluid">
		<div class="row">
      <div class="col-xs-4 nopadding">
        <button id="back-link" class="backbutton">Back</button>
      </div>
      <div class="col-xs-8 nopadding headline">
        <?php echo heading('Your Schedule', 1); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-offset-1 col-xs-11 nopadding">
        <?php echo img('/assets/img/tinderbox_single_line.svg'); ?>
      </div>
    </div>
	</div>

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="textbox">
          <div class="dropdown-headline">
            <span class="fa fa-angle-down"><?php echo heading('Team: ' . $team->team_name, 2); ?></span>
          </div>
          <div class="dropdown-text">
            <?php echo heading('Responsibility', 3) ?>
            <p><?php echo $team->team_info; ?></p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="textbox">
          <div class="dropdown-headline">
            <span class="fa fa-angle-down"><?php echo heading('Workhours', 2); ?></span>
          </div>
          <div class="dropdown-text">
            
            <?php 
              echo heading(date('l j M ', strtotime($shift1->shift_date)) . '<a href="#"><i class="fa fa-qrcode" aria-hidden="true"></i></a>', 3); 
              echo '<p>' . date('H:i - ', strtotime($shift1->shift_time));
              echo  date('H:i', strtotime($shift1->shift_time)+21600) . '</p>'; 
            ?>
            <?php 
              echo heading(date('l j M ', strtotime($shift2->shift_date)), 3); 
              echo '<p>' . date('H:i - ', strtotime($shift2->shift_time));
              echo date('H:i', strtotime($shift2->shift_time)+21600) . '</p>'; 
            ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="textbox">
          <div class="dropdown-headline">
            <span class="fa fa-angle-down"><?php echo heading('Meeting Place', 2); ?></span>
          </div>
          <div class="dropdown-text">
            <a href="<?php echo base_url('map'); ?>">
              <?php echo heading($team->team_place, 3, 'class="fa fa-map"') ?>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <div class="textbox">
          <div class="dropdown-headline">
            <span class="fa fa-angle-down"><?php echo heading('Team Leader', 2); ?></span>
          </div>
          <div class="dropdown-text">
            <div class="rounded-img">
              <?php echo img('/assets/img/teamleader_round.png'); ?>
            </div>
            <?php echo heading('Lars Lagerback', 3, 'class="fa fa-comments"'); ?>
            <?php echo heading('26 11 46 82', 3, 'class="fa fa-mobile"'); ?>
            <p>Your team leader is Responsible for scanning your <strong>QR Code</strong> and giving instruction during workhours.</p>
          </div>
        </div>
      </div>
    </div>

  </div>
    <div id="form-div">
<input type="submit" value="I have seen and accept my shifts" id="button-blue">
</div>
</center>
<br><br><br><br>
</div>