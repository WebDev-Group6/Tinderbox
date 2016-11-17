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