<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

public function index()
	{
		$data['title'] = 'Your Profile';
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->view('header_view', $data);
		$this->load->view('profile_view');
		$this->load->view('footer_view');
	}
}
