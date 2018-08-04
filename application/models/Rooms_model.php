<?php

class Rooms_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_rooms($user_id) {
        return $this->db->select('rooms.ro_id, rooms.ro_name, users.us_name AS admin, ro_share_id')
                        ->from('us_room_asso')
                        ->join('rooms', 'us_room_asso.ro_id = rooms.ro_id')
                        ->join('users', 'rooms.ro_admin = users.us_id')
                        ->where('us_room_asso.us_id', $user_id)
                        ->get()->result_array();
    }

    public function get_rooms_by_owner($user_id) {
        return $this->db->select('ro_id, ro_name, users.us_name as admin, ro_share_id')
                        ->from('rooms')
                        ->join('users', 'rooms.ro_admin = users.us_id')
                        ->where('ro_admin', $user_id)
                        ->get()->result_array();
    }

    public function share_id_exists($share_id) {
        return $this->db->select('ro_share_id')
                        ->from('rooms')
                        ->where('ro_share_id', $share_id)
                        ->get()->result_array();
    }

    public function create_room($room_name, $share_id, $admin_id) {
        return $this->db->insert('rooms', array('ro_name' => $room_name, 'ro_admin' => $admin_id, 'ro_share_id' => $share_id));
    }

    public function get_room_details($share_id) {
        return $this->db->select('*')->from('rooms')->where('ro_share_id', $share_id)->get()->row_array();
    }

    public function is_player($user_id, $share_id) {
        $asso = $this->db->select('*')
                ->from('us_room_asso')
                ->join('rooms', 'us_room_asso.ro_id = rooms.ro_id')
                ->where('us_id', $user_id)
                ->where('ro_share_id', $share_id)
                ->get()->result_array();
        if(count($asso)){
            return true;
        }else{
            return false;
        }
    }

    public function get_room_categories($share_id) {
        $categories = $this->db->select('cat_id, cat_name')
                        ->from('categories')
                        ->join('rooms', 'cat_room = rooms.ro_id')
                        ->where('ro_share_id', $share_id)
                        ->get()->result_array();

        foreach ($categories as $index => $category) {
            $content = $this->db->select('content.co_content, co_order as order, co_type')
                            ->from('content')
                            ->where('co_category', $category['cat_id'])
                            ->where('co_displayed', 1)
                            ->get()->result_array();

            usort($content, function($a, $b){return $a['order']-$b['order'];});
            $categories[$index]['content'] = $content;
        }

        return $categories;
    }
}
