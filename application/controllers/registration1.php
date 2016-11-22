<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration1 extends CI_Controller {

public function index()
	{
		$data['title'] = 'Tinderbox Volunteer Registration';
		$data['headline'] = 'Messages';
		
		$this->load->view('main_view', $data);
	}
}
