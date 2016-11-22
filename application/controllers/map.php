<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {

public function index()
	{
		$data['title'] = 'Tinderbox Map';
		$data['headline'] = 'Festival Map';
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->view('main_view', $data);
	}
}
