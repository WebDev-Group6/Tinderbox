<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration2 extends CI_Controller {

public function index()
	{
		$data['title'] = 'Tinderbox Volunteer Registration';
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->view('header_view', $data);
		$this->load->view('registration2_view');
		$this->load->view('footer_view');
	}
}
