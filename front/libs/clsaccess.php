<?php
class clsaccess {
    function __construct() {
    }
    function list_menu(){
        $Db = new Database();
        $sql = 'select link, name from menu where type = 1 and disabled = 0';
        return  $Db->getList($sql);
    }

}