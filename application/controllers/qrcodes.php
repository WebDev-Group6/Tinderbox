<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcodes extends CI_Controller {

public function index()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('qr_view');
		$this->load->view('footer_view');
	}
}


//('127.0.0.1:3306', 'root', 'root', 'tinderbox', '5306');

