<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rooms extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        log_message("error", "controller rooms");
        $this->load->view('rooms');
    }
}