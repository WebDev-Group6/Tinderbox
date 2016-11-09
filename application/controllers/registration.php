<?php

public function registration()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('registration_view');
		$this->load->view('footer_view');
	}
}
