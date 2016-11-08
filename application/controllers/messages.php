<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('messages_view');
		$this->load->view('footer_view');
	}
	public function personalmessage()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('personalmessage_view');
		$this->load->view('footer_view');
	}
	public function groupmessage()
	{
		$this->load->helper('url');
		$this->load->view('header_view');
		$this->load->view('groupmessage_view');
		$this->load->view('footer_view');
	}

}
