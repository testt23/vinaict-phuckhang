<?php

class View {

    function __construct() {
    }
    
    public function render($name, $noinclude = false){
        if ($noinclude == true){
            require 'views/'. $name . '.php';
        }else{
            require 'views/together/header.php';
            require 'views/'. $name . '.php';
            require 'views/together/footer.php';
        }   
    }
}