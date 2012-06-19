<?php
class IndexController extends Controller{

    function __construct() {
        parent::__construct();
    }
    public function init($function=false, $param=false){
        if ($function == false){
            $this->index();
        }
    }
    public function index($page=false){
        $list = $this->model->list_new_product($page);
        $this->view->list = $list['list'];
        $this->view->paging = $list['paging'];
        
        $this->view->render('index/index');   
    }
}