<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Messages';
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->view('header_view', $data);
		$this->load->view('messages_view');
		$this->load->view('footer_view');
	}
	public function personalmessage()
	{
		$data['title'] = 'Personal Messages';
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->view('header_view', $data);
		$this->load->view('personalmessage_view');
		$this->load->view('footer_view');
	}
	public function groupmessage()
	{
		$data['title'] = 'Group Messages';
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->view('header_view', $data);
		$this->load->view('groupmessage_view');
		$this->load->view('footer_view');
	}
}
