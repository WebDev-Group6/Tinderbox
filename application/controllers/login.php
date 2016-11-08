<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('login_view');
		$this->load->view('footer_view');
	}
}
