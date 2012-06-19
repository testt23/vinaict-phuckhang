<?php
class ErrorController extends Controller{

    function __construct($function = false, $key = false) {
        parent::__construct();
    }
    public function index(){
        $this->view->render('error/index');
    }
}