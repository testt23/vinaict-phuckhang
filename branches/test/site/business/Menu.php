<?php

class Menu extends Menu_model {

    function __construct() {
        parent::__construct();
    }
    public function getList(){
        $Menu = new Menu();
        $Menu->addSelect();
        $Menu->addSelect('menu.name, menu.link');
        $Menu->addWhere('menu.disabled = 0');
        $Menu->addWhere('type = 1');
        $Menu->find();
        return $Menu;
    }
    public function the_link(){
        return base_url() . '' .$this->link;
    }
    public function the_name(){
        return getI18n($this->name, 'vi');
    }
}
