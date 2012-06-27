<?php

class Contact_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {     
        $data['content'] = 'contact';
        $this->load->view('temp', $data);
    }

    public function sendmail() {
        $this->load->library('email');
        $this->email->from('TheHalfHeart@gmail.com', 'Your Name');
        $this->email->to('ngvancuong_thienduongmangtenem@yahoo.com');

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');

        $this->email->send();

        echo $this->email->print_debugger();
    }

}