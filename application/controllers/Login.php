<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        if(empty($this->session->userdata('user_id'))){
            $this->load->view('login');
        }else {
            redirect('/Rooms');
        }
    }

    public function login() {

        $this->load->model('users_model');
        $name = $this->input->post('name');

        $result = $this->users_model->user_login($name);

        $this->session->set_userdata('user_id', $result[0]->us_id);
        redirect('/Rooms');
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect("Login");
    }

}
