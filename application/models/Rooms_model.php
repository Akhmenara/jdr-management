<?php

class Rooms_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_rooms($user_id){
        return $this->db->select('rooms.ro_name, users.us_name AS admin')
                    ->from('us_room_asso')
                    ->join('rooms', 'us_room_asso.ro_id = rooms.ro_id')
                    ->join('users', 'rooms.ro_admin = users.us_id')
                    ->where('us_room_asso.us_id', $user_id)
                    ->get()->result_array();
    }

    public function get_rooms_by_owner($user_id){
        return $this->db->select('ro_name, users.us_name as admin')
                    ->from('rooms')
                    ->join('users', 'rooms.ro_admin = users.us_id')
                    ->where('ro_admin', $user_id)
                    ->get()->result_array();
    }
}
