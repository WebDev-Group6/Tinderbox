<?php

public function groupmessage()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('groupmessage_view');
		$this->load->view('footer_view');
	}
}
