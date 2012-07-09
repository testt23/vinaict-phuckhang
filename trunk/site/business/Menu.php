<?php

class Menu extends Menu_model {
    var $lang;
    function __construct() {
        parent::__construct();
        $this->lang = get_system_language();
    }
    public function getList(){
        $Menu = new Menu();
        $Menu->addSelect();
        $Menu->addSelect('menu.name, menu.link, menu.id_parent');
        $Menu->addWhere('menu.disabled = 0');
        $Menu->addWhere('type = 1');
        $Menu->find();
        
        return $Menu;
    }
    
    public function drawMenu(){
        $menu = $this->getList();
        var_dump($menu);
    }
    
    
    
    public function the_link(){
        return base_url() . '' .$this->link;
    }
    public function the_name($lang_true_false = false){
        if ($lang_true_false == false){
            return getI18n($this->name, $this->lang);
        }
        return $this->name;
    }
}
