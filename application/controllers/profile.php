<?php

public function profile()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('profile_view');
		$this->load->view('footer_view');
	}
}
