<?php

class ProductsController extends Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->view->list = $this->model->listAll();
        $this->view->render('products/index'); 

    }
    
    public function category($value = false, $page = false){  
        if ($value == false){
            $this->index();
        }else{
            $arr = $this->model->lists($value, $page);
            $this->view->cate = $value;
            $this->view->list = $arr['list'];
            $this->view->paging = $arr['paging'];
            $this->view->render('products/index');  
        }
        
    }
    public function detail($value = false, $key = false){
        if ($value == false){
            $this->index();
        }else{
            $this->view->list = $this->model->detail($value, $key);
            $this->view->render('products/details');
        }
    }
    
    
}