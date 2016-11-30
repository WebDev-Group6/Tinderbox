<?php

class Teams_model extends CI_Model {

	public function get_all_teams() {
		$query = sprintf('SELECT team_id, team_name, team_info, first_shift_date, first_shift_start, first_shift_end, second_shift_date, second_shift_start, second_shift_end, team_place, team_leader_id 
			FROM team 
			ORDER BY team_name ASC');
		$result = $this->db->query($query);

		return $result->result();
	}

	public function get_team($team_id) {
		$query = sprintf('SELECT 
			`team`.`team_id`
			, `team`.`team_name`
			, `team`.`team_info`
			, `team`.`first_shift_date`
			, `team`.`first_shift_start`
			, `team`.`first_shift_end`
			, `team`.`second_shift_date`
			, `team`.`second_shift_start`
			, `team`.`second_shift_end`
			, `team`.`team_place`
			, `team`.`team_leader_id`
			, `users`.`id`
			, `users`.`first_name`
			 FROM team INNER JOIN users 
			 on `users`.`user_team_id` = `team`.team_id 
			 WHERE `team`.`team_id` = "%s" '
			, $this->db->escape_like_str($team_id));

		$result = $this->db->query($query);
  		
  		return $result->result();
	}

	public function get_team_members($team_id) {
		$query = sprintf('SELECT `team`.`team_id`, `team`.`team_name`, `users`.`id`, `users`.`first_name`, `users`.`last_name`, `users`.`email`, `users`.`gender`, `users`.`phone_number`, `users`.`id`, `users`.`first_name`, `users`.`address`, `users`.`zipcode`, `users`.`city`, `users`.`country`, `users`.`nationality`, `users`.`speak_danish`, `users`.`colleague` FROM team INNER JOIN users on `users`.`user_team_id` = team_id WHERE team_id = "%s" '
			, $this->db->escape_like_str($team_id));
		$result = $this->db->query($query);

		return $result->result();
	}

	public function set_team($args = []) {
		$query = sprintf('INSERT INTO team(team_name, team_info, first_shift_date, first_shift_start, first_shift_end, second_shift_date, second_shift_start, second_shift_end, team_place, team_leader_id) 
			VALUES ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s") '
			, $this->db->escape_like_str($args['team_name'])
			, $this->db->escape_like_str($args['team_info'])
			, $this->db->escape_like_str($args['first_shift_date'])
			, $this->db->escape_like_str($args['first_shift_start'])
			, $this->db->escape_like_str($args['first_shift_end'])
			, $this->db->escape_like_str($args['second_shift_date'])
			, $this->db->escape_like_str($args['second_shift_start'])
			, $this->db->escape_like_str($args['second_shift_end'])
			, $this->db->escape_like_str($args['team_place'])
			, $this->db->escape_like_str($args['team_leader_id']));

		$this->db->query($query);
		$id = $this->db->insert_id();
		if(is_int($id) && $id > 0) {
			return $id;
		}
		return false;
	}

	public function update_team($args = []) {
		$query = sprintf('UPDATE team SET 
			team_name = "%s", 
			team_info = "%s", 
			first_shift_date = "%s", 
			first_shift_start = "%s", 
			first_shift_end = "%s", 
			second_shift_date = "%s", 
			second_shift_start = "%s", 
			second_shift_end = "%s", 
			team_place = "%s", 
			team_leader_id = "%s" '
			, $this->db->escape_like_str($args['team_name'])
			, $this->db->escape_like_str($args['team_info'])
			, $this->db->escape_like_str($args['first_shift_date'])
			, $this->db->escape_like_str($args['first_shift_start'])
			, $this->db->escape_like_str($args['first_shift_end'])
			, $this->db->escape_like_str($args['second_shift_date'])
			, $this->db->escape_like_str($args['second_shift_start'])
			, $this->db->escape_like_str($args['second_shift_end'])
			, $this->db->escape_like_str($args['team_place'])
			, $this->db->escape_like_str($args['team_leader_id']));
		
		$result = $this->db->query($query);
		return $args['team_id'];
	}

	public function delete_team($id = null) {
		$query = sprintf('DELETE FROM team WHERE team_id = %d'
			, $this->db->escape_like_str($id));
		$this->db->query($query);
		if($this->db->affected_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}