<?php

class Schedule_model extends CI_Model {

	public $team_id = '';
	public $team_name = '';
	public $team_info = '';
	public $team_place = '';

	public function __construct()
	{
		$this->load->database();		
	}

	public function getTeam($team_id){

		$query = sprintf('SELECT team_id, team_name, team_info, team_place
			FROM team
			WHERE team_id = "%s" '
			, $team_id);

		$result = $this->db->query($query);
  		
  		return $result->row();
	}

	public function shifts($shift_id) {

		$query = sprintf('
			SELECT shift_id
			, shift_date
			, shift_time 
			FROM shifts 
			WHERE shift_id = "%s" '
			, $shift_id);

		$result = $this->db->query($query);

		return $result->row();
	}
}