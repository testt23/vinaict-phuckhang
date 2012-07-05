<?php

class PagesController extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index($value) {

        
        $this->view->info = $this->model->get_page($value);
        if (!empty($this->view->info)){
            $this->view->render('pages/index');
        }else{
            echo 'Error! this page does not exist..';
        }
        
    }

}