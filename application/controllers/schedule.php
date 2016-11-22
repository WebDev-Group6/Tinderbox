<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {
	
	function __Construct(){
		parent::__Construct();
		$this->load->model('Schedule_model');
	}

	public function index(){

		$data['title'] = 'Schedule';
		$this->data['team'] = $this
		->Schedule_model
		->getTeam($team_id = '1');

		$this->data['shift1'] = 
		$this->Schedule_model
		->shifts($shift_id = '1');

		$this->data['shift2'] =
		$this->Schedule_model
		->shifts($shift_id = '2');
		
		$this->load->helper(
			array('url', 'html', 'date')
		);

		$this->load->view('header_view', $data);
		$this->load->view('schedule_view', $this->data);
		$this->load->view('footer_view');
	}
}
