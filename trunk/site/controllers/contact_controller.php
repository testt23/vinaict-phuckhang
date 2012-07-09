<?php

class Contact_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {     
        $data['content'] = 'contact';
        $this->load->view('temp', $data);
    }

    
    
    

}