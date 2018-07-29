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

        $this->load->view('header');
        $this->load->view('rooms', $view);
        $this->load->view('footer');
    }
}