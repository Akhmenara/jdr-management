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

    public function check_room_exists($room_share_id){
        $room_exists = $this->db->select('ro_name')->from('rooms')->where('ro_share_id', $room_share_id)->get()->result_array();
        log_message("error", var_export($room_exists, TRUE));
        $exists = count($room_exists);
        $name = count($room_exists)? $room_exists[0]['ro_name'] : '';
        return array('exists' => $exists, 'name' => $name);
    }

    public function add_player($room_share_id, $user_id, $player_name){
        $room_exists = $this->check_room_exists($room_share_id);

        if(count($room_exists)){
            $room_id = $this->db->select('ro_id')->from('rooms')->where('ro_share_id', $room_share_id)->get()->result_array()[0]['ro_id'];
            $user_associated = $this->db->select('*')
                                        ->from('us_room_asso')
                                        ->where('us_id', $user_id)
                                        ->where('ro_id', $room_id)
                                        ->get()->result_array();
            if(count($user_associated)){
                $success = 'FAILURE';
                $message = 'Vous appartenez déjà à cette salle.';
            }else{
                $to_insert = array('us_id' => $user_id, 'ro_id' => $room_id, 'us_displayed_name' => $player_name);
                $this->db->insert('us_room_asso', $to_insert);
                $success = 'SUCCESS';
                $message = 'Vous avez bien été ajouté à cette aventure !';
            }
        }else {
            $success = 'FAILURE';
            $message = "Cette salle n'exite pas.";
        }
        return array('success' => $success, 'message' => $message);
    }
}
