<?php

class Bootstrap {

    function __construct() {
        !Session::init();
        if (!Session::isHave('language')){
            $_SESSION['language'] = 'vi';
        }
        $url = isset($_GET['url'])? $_GET['url']: null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $url = str_replace('.html', '', $url);
        $url = str_replace('.php', '', $url);
        if (empty ($url[0])){
            $url[0] = 'index';
        }
        var_dump($url);
        $file_controllers =  'controllers/' . $url[0] . 'Controller.php';

        if (file_exists($file_controllers))
        {
            require $file_controllers;
            $class_controllers = ucfirst($url[0]) . 'Controller';
            $controllers = new $class_controllers();
            $controllers->loadModel($url[0]);
                    
            if (isset($url[1])) 
            {
                if (method_exists($controllers, $url[1])){
                    if (isset($url[3])){
                        $controllers->{$url[1]}($url[2], $url[3]);
                    }elseif (isset($url[2])){
                        $controllers->{$url[1]}($url[2]);
                    }else{
                        $controllers->{$url[1]}();
                    }
                }else{
                    $controllers->index($url[1]);
                }
                
            }else{
                $controllers->index();
            }   
        }
        else
        {
            
                require 'controllers/indexController.php';
                $controllers = new IndexController();
                $controllers->loadModel('index');
                $controllers->index(false);
                
        }
    }
    function error(){
        require 'controllers/errorController.php';
        $controller = new ErrorController();
        $controller->index();
        return false;
    }
}