<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

public function index()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('registration_view');
		$this->load->view('footer_view');
	}
}
