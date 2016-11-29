<?php

class Qrcode_model extends CI_Model {
	public function __construct()
    {
        parent::__construct();
    }
	function insert_data($data) {
		$this->db->insert('users', $data);
	}

	function get_qr($id) {
		$query = sprintf('SELECT * FROM users
			WHERE user_id = "%d"'
			, $id);

		$result = $this->db->query($query);
		return $result->result();
		
	}

	function check_bool()
		{ 	
			$query = sprintf('UPDATE users SET bool = NOT(bool)');
			$result = $this->db->query($query);
			return $result->result();
		}
}
