<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        $user_id = $this->session->userdata('user_id');
        $this->load->model('rooms_model');

        $view['rooms_list'] = $this->rooms_model->get_user_rooms($user_id);
        $view['rooms_owned'] = $this->rooms_model->get_rooms_by_owner($user_id);
        $view['user_id'] = $user_id;

        $this->load->view('header');
        $this->load->view('rooms', $view);
        $this->load->view('footer');
    }

    public function ajax_create_room() {

        $room_name = $this->input->post('room_name');
        $this->load->model('rooms_model');
        $share_id = $this->generate_share_id();
        while(count($this->rooms_model->share_id_exists($share_id)) > 0)
        {
            $share_id = $this->generate_share_id();
        }
        if (!empty($room_name)) {
            $this->rooms_model->create_room($room_name, $share_id, $this->session->userdata('user_id'));
        }
        echo $share_id;
    }

    public function ajax_check_room_exists(){
        $this->load->model('rooms_model');
        $room_share_id = $this->input->post('room_share_id');

        $exists = $this->rooms_model->check_room_exists($room_share_id);

        echo json_encode($exists);
    }

    public function ajax_join_room() {

        $this->load->model('rooms_model');
        $room_share_id = $this->input->post('room_share_id');
        $player_name = $this->input->post('player_name');

        $room_availability = $this->rooms_model->add_player($room_share_id, $this->session->userdata('user_id'), $player_name);

        echo json_encode($room_availability);
    }

    private function generate_share_id($length = 7) {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
