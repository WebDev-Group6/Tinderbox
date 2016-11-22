<?php

class Users_model extends CI_Model
{
	
	public function get_all_users() {
        $result = $this->db->query('SELECT id, firstname, lastname, email
            FROM users
            ORDER BY created DESC');
        return $result->result();
    }
    public function get_user($id = null) {
        $query = sprintf('SELECT
        id, firstname, lastname, email
        FROM users
        WHERE id = "%s" '
        , $this->db->escape_like_str($id));
        $result = $this->db->query($query);
        if($result) {
            return $result->row();
        }
        return false;
    }
    public function set_user($args = []) {
        $query = sprintf('INSERT INTO users
            (firstname, lastname, email, password)
            VALUES
            ("%s", "%s", "%s", "%s")'
            , $this->db->escape_like_str($args['firstname'])
            , $this->db->escape_like_str($args['lastname'])
            , $this->db->escape_like_str($args['email'])
            , $this->db->escape_like_str($args['password']));
        $this->db->query($query);
        $id = $this->db->insert_id();
        if(is_int($id) && $id > 0) {
            return $id;
        }
        return false;
    }
    public function update_user($args = []) {
        $query = sprintf('UPDATE users
            SET
            firstname = "%s",
            lastname = "%s",
            email = "%s",
            password = "%s"
            WHERE id = %d '
            , $this->db->escape_like_str($args['firstname'])
            , $this->db->escape_like_str($args['lastname'])
            , $this->db->escape_like_str($args['email'])
            , $this->db->escape_like_str($args['password'])
            , $this->db->escape_like_str($args['id']));
        $result = $this->db->query($query);
        return $args['id'];
    }
    public function delete_user($id = null) {
        $query = sprintf('DELETE FROM users WHERE id = %d'
            , $this->db->escape_like_str($id));
        $this->db->query($query);
        if($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
       
    }
    public function get_user_by_email_password($email, $password) {
        $query = sprintf('SELECT id, firstname, lastname, email, password
            FROM users
            WHERE email = "%s"
            LIMIT 1', 
            $this->db->escape_like_str($email));
        $result = $this->db->query($query);
        $row = $result->row();
        if(password_verify($password, $row->password)) {
            $token = bin2hex(openssl_random_pseudo_bytes(50));
            $this->insert_token_user($row->id, $token);
            $res = [
                'userid' => $row->id,
                'firstname' => $row->firstname,
                'lastname' => $row->lastname,
                'email' => $row->email,
                'token' => $token
            ];
            return $res;
            die();
        }
        return false;
        die();
    }
    public function insert_token_user($id = null, $token = null) {
        $query = sprintf('UPDATE users
            SET
            token_val = "%s",
            token_create = "%s"
            WHERE
            id = "%s"'
            , $this->db->escape_like_str($token)
            , date('Y-m-d H:i:s')
            , $this->db->escape_like_str($id));
        $this->db->query($query);
        
    }
    public function check_token($email = null, $token = null) {
        
        $query = sprintf('SELECT token_val FROM users WHERE email = "%s" LIMIT 1 '
        , $this->db->escape_like_str($email));
        $result = $this->db->query($query);
        $row = $result->row();
        if($row->token_val === $token) {
            return true;
            die();
        }
        return false;
        die();
    }
























/* Fra Redwans gide 	--ikke i brug--  */

	// public function get($id = null)
	// {
	// 	if ($id === null) 
	// 	{
	// 	$q = $this->db->get('users');
	// 	} elseif(is_array($id)) {
	// 		$q = $this->db->get_where('users', $id);
	// 	} else {
	// 		$q = $this->db->get_where('users', ['id' => $id]);
	// 		}
	// 		return $q->result_array();
	// }




	//  public function insert($data)
	// {
	// 	$this->db->insert('users' ,$data);
	// 	return $this->db->insert_id();
	// }

	 

	// public function update($data, $id)
	// {
	// 	$this->db->where(['id' => $id]);
	// 	$this->db->update('users', $data);

	// 	return $this->db->affected_rows();
	// }
	 

	// public function delete($id)
	// {
	// 	$this->db->delete('users', ['id' => $id]);
	// 	return $this->db->affected_rows();
	// }
=======
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
}