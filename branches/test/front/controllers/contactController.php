<?php
class ContactController extends Controller{

    function __construct($function = false, $key = false) {
        parent::__construct();
    }
    public function index(){
        $this->view->render('contact/index');
    }
    public function send(){
        $this->model->sendContact();
        $this->view->render('contact/index');
    }
}