<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

public function index()
	{
		$data['title'] = 'Your Profile';
		$data['headline'] = 'Messages';
		$this->load->view('header_view', $data);
	}
}
