<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
    }

    public function play($share_id){
        $view['share_id'] = $share_id;

        $this->load->model('rooms_model');

        $user_id = $this->session->userdata('user_id');
        $view['has_rights'] = 0;
        if($this->rooms_model->is_player($user_id, $share_id)){
            $view['has_rights'] = 1;
        }

        $view['categories'] = $this->rooms_model->get_room_categories($share_id);

        $view['room_users'] = $this->rooms_model->get_room_users($share_id, $user_id);

        $this->load->view('header');
        $this->load->view('room', $view);
        $this->load->view('footer');
    }

    public function manage($share_id){
        $view['share_id'] = $share_id;

        $user_id = $this->session->userdata('user_id');
        $this->load->model('rooms_model');
        $room_details = $this->rooms_model->get_room_details($share_id);

        if($user_id === $room_details['ro_admin']){
            $view['has_rights'] = 1;
            $view['categories'] = $this->rooms_model->get_room_categories($share_id);
        }else{
            $view['has_rights'] = 0;
            if($this->rooms_model->is_player($user_id, $share_id)){
                $view['redirect_play'] = 1;
            }
        }

        $view['room_details'] = $room_details;

        $view['room_users'] = $this->rooms_model->get_room_users($share_id, $user_id);

        $this->load->view('header');
        $this->load->view('manage_room', $view);
        $this->load->view('footer');
    }

    public function ajax_send_private(){

        $this->load->model('messages_model');
        $this->load->model('rooms_model');

        $sender = $this->session->userdata('user_id');
        $recipient = $this->input->post('recipient');
        $room_share_id = $this->input->post('room');
        $message = $this->input->post('message');

        $room_id = $this->rooms_model->get_room_by_share_id($room_share_id);

        $this->messages_model->save_message($sender, $recipient, $room_id, $message);
    }

    public function ajax_fetch_messages(){

        $current = $this->session->userdata('user_id');
        $other = $this->input->post('other');
        $room_share_id = $this->input->post('room');
        $last_message_date = $this->input->post('last_message_date');

        $this->load->model('messages_model');

        $last_messages = $this->messages_model->get_last_messages($current, $other, $room_share_id, $last_message_date);

        echo json_encode($last_messages);
    }
}
