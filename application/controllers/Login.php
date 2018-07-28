<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {

        if(empty($this->session->userdata('id_user'))){
            $this->load->view('login');
        }else {
            redirect('/Rooms');
        }
    }

    public function login() {

        //log_message("error", var_export($name, TRUE));
        $this->load->model('user_model');
        $name = $this->input->post('name');

        $result = $this->user_model->user_login($name);
        //log_message("error", var_export($result, TRUE));

        $this->session->set_userdata('id_user', $result[0]->us_id);
        redirect('/Rooms');
    }

    public function logout() {
        //removing session
        $this->session->unset_userdata('id_user');
        redirect("Login");
    }

}
