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
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'localhost';
        $config['smtp_port'] = 80;
        $config['validate'] = 'TRUE';
        $this->email->initialize($config);
        $this->email->from('thehalfheart@gmail.com', 'Nguyen van cuong');
        $this->email->to('thehalfheart@gmail.com');
        $this->email->subject('Mail Tesst');
        $this->email->message('Chao ban chung toi dang test mail');
        
        if ($this->email->send()) {
            echo 'thanh cong';
        }else{
            echo 'that bai';
        }
        return FALSE;
    }

}