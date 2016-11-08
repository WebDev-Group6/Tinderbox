<?php

public function personalmessage()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('personalmessage_view');
		$this->load->view('footer_view');
	}
}
