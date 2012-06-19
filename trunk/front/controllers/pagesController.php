<?php
class PagesController extends Controller{

    function __construct() {
        parent::__construct();
    }
    public function index($value){
        $this->view->info = $this->model->get_page($value);
        $this->view->render('pages/index');
    }
}