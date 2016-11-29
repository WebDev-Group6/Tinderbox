<?php

class Qrcode_model extends CI_Model {
	public function __construct()
    {
        parent::__construct();
    }
	function insert_data($data) {
		$this->db->insert('qruser', $data);
	}

	function get_qr($id) {
		$query = sprintf('SELECT * FROM qruser
			WHERE user_id = "%d"'
			, $id);

		$result = $this->db->query($query);
		return $result->result();
		
	}

	
}
