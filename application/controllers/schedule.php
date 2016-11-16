<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {

public function index()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('schedule_view');
		$this->load->view('footer_view');
	}
}
