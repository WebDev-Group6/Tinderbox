<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontpage extends CI_Controller {


	//This fucntion lets you check if there is a session running
	//if there is not you are restricted, and we redirect u to the index/login page

	public function __construct()
	{
		parent::__construct();
		$id = $this->session->userdata('id');

		if(!$id){

			$this->logout();
		}

	}

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

	public function logout()
 	{
 		$this->session->sess_destroy();
 		//session_destroy();
 		redirect('/');
 	}


}

?>