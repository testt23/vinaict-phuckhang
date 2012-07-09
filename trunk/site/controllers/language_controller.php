<?php

class Language_controller extends CI_Controller{

    function __construct() {
        parent::__construct();
    }
    public function index($lang){
        $this->session->set_userdata('lang', $lang);
        redirect($this->session->userdata('lang_url'));
    }

}