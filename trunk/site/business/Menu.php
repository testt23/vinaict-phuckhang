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
    
//    public function drawMenu(){
//        $menu = $this->getList();
//        var_dump($menu);
//    }
    
    public static function getMenuTree(&$array_menus = array(), $filter = array(), $menu_type = false) {
        
        if (!$menu_type || $menu_type != BO)
            $menu_type = FO;
        
        $menu = new Menu();
        
        //$logged_user = $menu->session->userdata("userID");
        
        if (isset ($filter['parent_id'])) {
            $menu->addWhere("menu.id_parent = ".$filter['parent_id']);
        }
        
        $menu->addWhere("menu.type = ".$menu_type);
        
        $menu->addWhere('menu.disabled = '.IS_NOT_DISABLED);
        $menu->orderBy('menu.position');
        $menu->find();
        
        while($menu->fetchNext()) {
            
            $menu_array = array();
            $menu_array['ID'] = $menu->id;
            $menu_array['NAME'] = getI18n($menu->name);
            $menu_array['POSITION'] = $menu->position;
            $menu_array['LINK'] = $menu->link;
            $menu_array['SECTION'] = $menu->section;
            $menu_array['ID_PARENT'] = $menu->id_parent;
            //$menu_array['PERMISSION'] = User::getPermission($logged_user, $menu->link);
            
            if ($menu->id_parent == 0) {
                $array_menus[$menu->id]['root'] = $menu_array;
            } else {
                $array_menus[$menu->id]['node'] = $menu_array;
            }
            
            $filter['parent_id'] = $menu->id;
            self::getMenuTree($array_menus[$menu->id]['childs'], $filter);
            
        }
    }
    
     public static function drawMenu($array_menus, $selected_section = 'home') {
        
        $index = 0;
        $is_root = false;
        
        foreach ($array_menus as $pid=>$pmenu) {
            
            if ($index == 0) {
                if (isset($pmenu['root'])) {
                    $is_root = true;
                }
                else {
                    echo '<ul>';
                }
            }
            
            $index ++;
            
            if (isset($pmenu['root']))
                $self_menu = $pmenu['root'];
            else
                $self_menu = $pmenu['node'];
            
            //if ($self_menu["PERMISSION"] != '') {
                
                echo '<li ';
                
                if ($selected_section == $self_menu['SECTION'])
                    echo 'class="selected">';
                else
                    echo '>';
                
                echo "\n";
                
                echo '<a href="'.base_url($self_menu['LINK']).'">'.$self_menu['NAME'].'</a>';
                echo "\n";
                
                if(count($pmenu['childs']) > 0) {
                    Menu::drawMenu($pmenu['childs'], $selected_section);
                }
                
                echo "</li>\n";
                
            //}
            
        }
        
        if (!$is_root)
            echo "</ul>\n";
        
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
