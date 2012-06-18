<?php
class Model {

    var $Db;
    function __construct() {
        $this->Db = new Database();
    }
    
}