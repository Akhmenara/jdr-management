<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
    }

    public function see($share_id){
        $view['share_id'] = $share_id;

        $this->load->view('header');
        $this->load->view('room', $view);
        $this->load->view('footer');
    }
}