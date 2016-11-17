<?php

class Users_model extends CI_Model
{
	public function get($id = null)
	{
		if ($id === null) 
		{
		$q = $this->db->get('users');
		} else 
			{
			$q = $this->db->get_where('users', ['id' => $id]);
			}
			return $q->result_array();
	}

	 public function insert($data)
	{
		$this->db->insert('users' ,$data);
		return $this->db->insert_id();
	}
	 

	public function update($data, $id)
	{
		$this->db->where(['id' => $id]);
		$this->db->update('users', $data);

		return $this->db->affected_rows();
	}
	 

	public function delete($id)
	{
		$this->db->delete('users', ['id' => $id]);
		return $this->db->affected_rows();
	}
	 






	// public function get_users()
	// {
	// 	$query = $this->db->query('SELECT * FROM users');
	// 	return $query->result();
	// }
	// public function set_user($userdata)
	// {
	// 	$query = sprintf('INSERT INTO users 
	// 		(firstname, lastname, email, password)
	// 		VALUES
	// 		("%s", "%s", "%s", "%s")'
	// 	, $userdata['firstname']
	// 	, $userdata['lastname']
	// 	, $userdata['email']
	// 	, $userdata['password']);

	// 	$this->db->query($query);
	// 	return $this->db->insert_id();
	// }

	// public function get_user_by_email_password($email, $password)
	// {
	// 	$query = sprintf('SELECT * FROM users WHERE email = "%s" AND password = "%s" LIMIT 1 '
	// 	, $email
	// 	, $password);

	// 	$result = $this->db->query($query);
	// 	return $result->row();
	// }
}