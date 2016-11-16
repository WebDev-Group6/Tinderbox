<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcodes extends CI_Controller {

function __Construct(){
	parent::__Construct();
	$this->load->database();
	$db = $this->load->database();
	$query = $db->get('users');  

	var_dump($query);

}

public function index()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('qr_view');
		$this->load->view('footer_view');
	}
}

  