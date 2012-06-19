<?php

class PagesModel extends Model{

    function __construct() {
        parent::__construct();
    }
    public function get_page($value){
        $sql = "select * from web_page where link = '".$value."'";
        return $this->Db->getObject($sql);
    }
    
}