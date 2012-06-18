<?php

class Bootstrap {

    function __construct() {
        $url = isset($_GET['url'])? $_GET['url']: null;
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $url = str_replace('.html', '', $url);
        $url = str_replace('.php', '', $url);
        if (empty ($url[0])){
            $url[0] = 'index';
        }
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
            $error_file = 'controllers/errorController.php';
            if (file_exists($error_file))
            {
                require $error_file;
                $errorController = new ErrorController();
                $errorController->index();
            }
            else
            {
                echo '<h1>There are some thing error! please check again.</h1>';
            }
        }
    }
    function error(){
        require 'controllers/errorController.php';
        $controller = new ErrorController();
        $controller->index();
        return false;
    }
}