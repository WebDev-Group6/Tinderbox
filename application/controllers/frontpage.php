<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontpage extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Tinderbox Volunteer';
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->view('header_view', $data);
		$this->load->view('frontpage_view');
		$this->load->view('footer_view');
	}
}
