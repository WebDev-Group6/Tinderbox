<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {
	
	function __Construct(){
		parent::__Construct();
		$this->load->database();
		$this->load->model('Schedule_model');
	}

	public function index(){
		$data['title'] = 'Schedule';
		$this->data['team'] = $this->Schedule_model->getTeam();
		$this->load->helper(
			array('url', 'html')
		);
		$this->load->view('header_view', $data);
		$this->load->view('schedule_view', $this->data);
		$this->load->view('footer_view');
	}
}
