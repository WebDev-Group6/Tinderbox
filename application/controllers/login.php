<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{

	// public function __construct()
	// {
	// 	parent::__construct();
	// 	$this->load->library('form_validation')
	// }

	public function index()
	{
		$data['title'] = 'Login to Tinderbox Volunteer';
		$data['headline'] = 'Tinderbox Volunteer';
		
		$this->load->view('main_view', $data);
	}

	// public function test()
	// {
	// 	$q = $this->db->get_where('users', ['id' => 1]);
	// 	print_r($q->result());
	// }

 }


