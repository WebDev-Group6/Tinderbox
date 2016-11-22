<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller {

public function index()
	{
		$data['title'] = 'Tinderbox Map';
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->view('header_view', $data);
		$this->load->view('map_view');
		$this->load->view('footer_view');
	}
}
