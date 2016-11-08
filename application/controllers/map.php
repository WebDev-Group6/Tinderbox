<?php

public function map()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('map_view');
		$this->load->view('footer_view');
	}
}
