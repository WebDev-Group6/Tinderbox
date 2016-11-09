<?php

public function registration1()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('registration1_view');
		$this->load->view('footer_view');
	}
}
