<?php

class Information_model extends CI_Model 
{
	private $info = [];
	private $info_id = '';
	private $info_title = '';
	private $info_content = '';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

		$result = $this->db->query('SELECT info_id, info_title, info_content FROM information');

		$this->information = $result->result();
	}

	public function get_info()
	{
		$query = sprintf('SELECT info_id, info_title, info_content
			FROM information');

		$result = $this->db->query($query);
		
		return $result->result();
	}

	public function set_info($args = [])
	{
		$query = sprintf('INSERT INTO information(info_title, info_content)
			VALUES
			("%s", "%s")'
			, $args['info_title']
			, $args['info_content']);
		$this->db->query($query);

		$info_id = $this->db->insert_id();

		if(is_int($info_id) && $info_id > 0)
		{
			return $info_id;
		}

		return false;
	}
}