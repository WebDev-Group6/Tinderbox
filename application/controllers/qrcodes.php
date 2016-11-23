<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcodes extends CI_Controller {

public function index()
	{
		$data['title'] = 'QR Codes';
		$data['headline'] = 'Messages';
		$this->load->view('main_view', $data);
	}
}


//('127.0.0.1:3306', 'root', 'root', 'tinderbox', '5306');

