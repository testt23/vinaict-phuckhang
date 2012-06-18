<?php
class AboutController extends Controller{

    function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->view->render('about/index');
    }
}