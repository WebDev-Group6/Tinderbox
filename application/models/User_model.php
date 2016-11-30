<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
    public $table1;
    function __construct($dateformat = "d.m.Y - H:i", $enforce_field_types = TRUE)
    {
        parent::__construct();
        $this->load->library('Table_model');
        $this->table1 = new table_model(TABLE_USERS, $dateformat, $enforce_field_types);
    }
    public function initialize($dateformat = "d.m.Y - H:i", $enforce_field_types = TRUE)
    {
        // Define the date format & whether db field types are enforced in PHP by type cast
        $this->table1->initialize($dateformat, $enforce_field_types);
    }
    public function get_userids($username, $exact = TRUE, $max_id_count = 10)
    {
        $this->db->select(TF_USER_ID);
        $this->db->from($this->table1->get_name());
        if($exact)
        {
            $this->db->where(TF_USER_NAME, $username);
            $this->db->limit(1, 0);
        }
        else
        {
            $this->db->like(TF_USER_NAME, $username);
            $this->db->limit($max_id_count, 0);
        }
        $retval = array();
        if($res = $this->table1->get_data())
            foreach($res as $row)
                array_push($retval, $row[TF_USER_ID]);
        return $retval;
    }
    public function get_username($id)
    {
        $this->db->select(TF_USER_NAME);
        $this->db->from($this->table1->get_name());
        $this->db->where(TF_USER_ID, $id);
        $this->db->limit(1, 0);
        $retval = '';
        if($res = $this->table1->get_data())
            $retval = $res[0][TF_USER_NAME];
        return $retval;
    }
    public function current_id()
    {
        $this->db->select(TF_USER_ID);
        $this->db->from($this->table1->get_name());
        $this->db->limit(1, 0);
        $retval = -1;
        if($res = $this->table1->get_data())
            $retval = $res[0][TF_USER_ID];
        return $retval;
    }
}
/* End of file User_model.php */