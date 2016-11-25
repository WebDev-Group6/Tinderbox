<?php
class Users_model extends CI_Model {
    
    public function get_all_users() {
        $result = $this->db->query('SELECT id, firstname, lastname, gender, dateofbirth, email, phone_number, address, city, zipcode, country, nationality, speak_danish, colleague, task
            FROM users
            ORDER BY created DESC');
        return $result->result();
    }

    public function get_user($id = null) {
        $query = sprintf('SELECT
        id, firstname, lastname, email, gender, dateofbirth, phone_number, address, city, zipcode, country, nationality, speak_danish, colleague, task
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
            (first_name, last_name, email, password, gender, dateofbirth, phone_number, address, city, zipcode, country, nationality, speak_danish, colleague, task)
            VALUES
            ("%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s") '
            , $this->db->escape_like_str($args['first_name'])
            , $this->db->escape_like_str($args['last_name'])
            , $this->db->escape_like_str($args['email'])
            , $this->db->escape_like_str($args['password'])
            , $this->db->escape_like_str($args['gender'])
            , $this->db->escape_like_str($args['dateofbirth'])
            , $this->db->escape_like_str($args['phone_number'])
            , $this->db->escape_like_str($args['address'])
            , $this->db->escape_like_str($args['zipcode'])
            , $this->db->escape_like_str($args['city'])
            , $this->db->escape_like_str($args['country'])
            , $this->db->escape_like_str($args['nationality'])
            , $this->db->escape_like_str($args['speak_danish'])
            , $this->db->escape_like_str($args['colleague'])
            , $this->db->escape_like_str($args['task']));
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
            first_name = "%s",
            last_name = "%s",
            email = "%s",
            password = "%s",
            gender = "%s",
            dateofbirth = "%s",
            phone_number = "%s",
            address = "%s",
            zipcode = "%s",
            city = "%s",
            country = "%s",
            nationality = "%s",
            speak_danish = "%s",
            colleague = "%s",
            task = "%s",
            WHERE id = %d '
            , $this->db->escape_like_str($args['first_name'])
            , $this->db->escape_like_str($args['last_name'])
            , $this->db->escape_like_str($args['email'])
            , $this->db->escape_like_str($args['password'])
            , $this->db->escape_like_str($args['gender'])
            , $this->db->escape_like_str($args['dateofbirth'])
            , $this->db->escape_like_str($args['phone_number'])
            , $this->db->escape_like_str($args['address'])
            , $this->db->escape_like_str($args['zipcode'])
            , $this->db->escape_like_str($args['city'])
            , $this->db->escape_like_str($args['country'])
            , $this->db->escape_like_str($args['nationality'])
            , $this->db->escape_like_str($args['speak_danish'])
            , $this->db->escape_like_str($args['colleague'])
            , $this->db->escape_like_str($args['task'])
            , $this->db->escape_like_str($args['id'])
            );
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
        $query = sprintf('SELECT id, first_name, last_name, email, password
            FROM users
            WHERE email = "%s"
            LIMIT 1'
            , $this->db->escape_like_str($email));
        $result = $this->db->query($query);
        $row = $result->row();

        if(password_verify($password, $row->password)) {
            $token = bin2hex(openssl_random_pseudo_bytes(21));
            $this->insert_token_user($row->id, $token);
            $res = [
                'id' => $row->id,
                'first_name' => $row->first_name,
                'last_name' => $row->last_name,
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



}