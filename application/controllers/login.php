<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{


	public function index()
	{
		$data['title'] = 'Login to Tinderbox Volunteer';
		$data['headline'] = 'Tinderbox Volunteer';
		
		$this->load->view('main_view', $data);
	}

 }


