<?php

class Messages_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save_message($sender, $recipient, $room_id, $message){
        if(!empty($message)){
            $data = array('me_content' => $message, 'me_sender' => $sender, 'me_recipient' => $recipient, 'me_room' => $room_id);
            $this->db->insert('private_messages', $data);
        }
    }

    public function get_last_messages($current, $other, $room_share_id, $last_message_date=''){

        if(!empty($last_message_date)){
            $last_date = date('Y-m-d H:i:s', $last_message_date);
            $this->db->where("me_created > '$last_date'");
        }

        $last_messages = $this->db->select("me_content, me_sender, me_recipient, me_created, CASE me_sender WHEN $current THEN 'sent' WHEN $other THEN 'received' END AS me_type")
                        ->from('private_messages')
                        ->join('rooms', 'private_messages.me_room = rooms.ro_id')
                        ->where("me_sender IN ($current, $other)")
                        ->where("me_recipient IN ($current, $other)")
                        ->where('ro_share_id', $room_share_id)
                        ->limit(15)
                        ->get()->result_array();

        foreach($last_messages as $index => $message){
            $last_messages[$index]['me_created'] = strtotime($message['me_created']);
        }

        return $last_messages;
    }
}
