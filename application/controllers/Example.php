<?php
// This controller only loads the main view
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller 
{
	public function index()
	{	
		$this->load->view('main_view');
	}
};