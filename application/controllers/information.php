<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information extends CI_Controller {

public function index()
	{
		$data['title'] = 'Information';
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->view('header_view', $data);
		$this->load->view('information_view');
		$this->load->view('footer_view');
	}
}
