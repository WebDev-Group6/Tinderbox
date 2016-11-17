<?php

class Schedule_model extends CI_Model {

	public function getTeam(){
		$this->load->database();
		$this->db->select('team_id,team_name,team_info, team_place');
  		$this->db->from('team');

  		$query = $this->db->get();
  		
  		return $query->row();
	}
}