<?php

class Controller {
    var $view;
    var $model;
    function __construct() {
        $this->view = new View();
    }
    public function loadModel($name){
        $path = 'models/' .$name. 'Model.php';
        if (file_exists($path)){
            require($path);
            $className = ucfirst($name) . 'Model';
            $this->model = new $className();
        }
    }
}