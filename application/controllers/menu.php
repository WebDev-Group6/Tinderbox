<?php

public function menu()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('menu_view');
		$this->load->view('footer_view');
	}
}
