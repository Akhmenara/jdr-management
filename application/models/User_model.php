<?php

class User_model extends CI_Model {

    protected $table = 'users';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function user_login($name) {
        $user_id = $this->db->select('us_id')
                        ->from($this->table)
                        ->where('us_name', $name)
                        ->get()
                        ->result();
        if(empty($user_id)){
            $this->db->insert('users', array('us_name' => $name));
            $user_id = $this->db->insert_id();
        }
        return $user_id;
    }

    public function get_name_by_id($id){
        return $this->db->select('us_name')
                    ->from($this->table)
                    ->where('us_id', $id)
                    ->get()
                    ->result();
    }
}
?>