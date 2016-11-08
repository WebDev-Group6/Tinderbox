<?php

public function schedule()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('schedule_view');
		$this->load->view('footer_view');
	}
}
