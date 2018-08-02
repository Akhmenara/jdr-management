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
        }else{
            $view['has_rights'] = 0;
            if($this->rooms_model->is_player($user_id, $share_id)){
                $view['redirect_play'] = 1;
            }
        }

        $view['room_details'] = $room_details;

        $this->load->view('header');
        $this->load->view('manage_room', $view);
        $this->load->view('footer');
    }
}