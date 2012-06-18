<?php
class orderController extends Controller{

    function __construct() {
        parent::__construct();
    }
    public function index(){
        $this->view->list = $this->model->addCart();
        $this->view->render('order/index');
    }
    public function delete($id = false){
        if ($id == false){
            $this->index();
        }else{
            $this->model->delete($id);
            $this->index();
        }
        
    }
    
}