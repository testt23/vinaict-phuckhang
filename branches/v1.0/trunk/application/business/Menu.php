<?php

class Menu extends Menu_model {

    function __construct() {
        parent::__construct();
    }
    
    public static function getList($filter = array()) {
        
        $menu = new Menu();
        
        $sql = "SELECT menu.*, parent_menu.name parent_name, IF(parent_menu.position IS NULL, menu.position, CONCAT(parent_menu.position,'.',menu.position)) ordering
                    FROM menu
                    LEFT JOIN (SELECT * FROM menu) parent_menu
                    ON (menu.id_parent = parent_menu.id)
                    WHERE menu.disabled = ".IS_NOT_DISABLED;
        
        if (isset($filter['name']) && $filter['name'])
            $sql .= " AND menu.name LIKE '%".$filter['name']."%'";
        
        if (isset($filter['id_menu_parent']) && $filter['id_menu_parent'])
            $sql .= " AND menu.id_parent = ".$filter['id_menu_parent'];
        
        if (isset($filter['menu_type']) && $filter['menu_type'] == BO)
            $sql .= " AND menu.type = ".BO;
        else
            $sql .= " AND menu.type = ".FO;
        
        $menu->query($sql);
        
        return $menu;
        
    }

    public static function getMenuTree(&$array_menus = array(), $filter = array(), $menu_type = false) {
        
        if (!$menu_type || $menu_type != FO)
            $menu_type = BO;
        
        $menu = new Menu();
        
        $logged_user = $menu->session->userdata("userID");
        
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
            $menu_array['PERMISSION'] = User::getPermission($logged_user, $menu->link);
            
            if ($menu->id_parent == 0) {
                $array_menus[$menu->id]['root'] = $menu_array;
            } else {
                $array_menus[$menu->id]['node'] = $menu_array;
            }
            
            $filter['parent_id'] = $menu->id;
            self::getMenuTree($array_menus[$menu->id]['childs'], $filter);
            
        }
    }
    
    function validateInput() {

        $this->name = trim($this->name);
        $this->link = trim($this->link);
        
        if ($this->name == "") {
            MessageHandler::add (lang('err_empty_menu_name'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->link == "") {
            MessageHandler::add (lang('err_empty_uri'), MSG_ERROR, MESSAGE_ONLY);
        }
        else if (strlen($this->link) > MAX_LENGTH_NAME) {
            MessageHandler::add (lang('err_url_too_long'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->section == "") {
            MessageHandler::add (lang('err_empty_section'), MSG_ERROR, MESSAGE_ONLY);
        }
        else if (strlen($this->section) > MAX_LENGTH_NAME) {
            MessageHandler::add (lang('err_section_too_long'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        $mn = new Menu();
        $mn->addSelect();
        $mn->addSelect("COUNT(*) count");
        $mn->addWhere("disabled = ".IS_NOT_DISABLED);
        $mn->addWhere("type = ".$this->type);

        if (!$this->id_parent || $this->id_parent == "")
            $mn->addWhere("id_parent = 0");
        else
            $mn->addWhere("id_parent = ".$this->id_parent);
        
        $mn->find();
        $mn->fetchNext();

        $max_pos = $mn->count;
        
        if (!$this->position || $this->position == "" || $this->position == null) {
            if (!$this->id)
                $this->position = $max_pos + 1;
            else
                MessageHandler::add (lang('err_empty_position'), MSG_ERROR, MESSAGE_ONLY);
        }
        elseif (!is_numeric($this->position)) {
            MessageHandler::add (lang('err_invalid_position'), MSG_ERROR, MESSAGE_ONLY);
        }
        elseif ($this->position <= 0) {
            if (!$this->id)
                $this->position = $max_pos + 1;
            else
                MessageHandler::add (lang('err_invalid_position'), MSG_ERROR, MESSAGE_ONLY);
        }
        elseif (!$this->id && ($this->position > $max_pos + 1)) {
            MessageHandler::add (lang('err_position_too_big').
                    " (".lang('err_max_position_is')." <b>".$max_pos."</b>".
                    ". ".lang('err_max_allowed_position_is')." <b>".($max_pos + 1)."</b>)", MSG_ERROR, MESSAGE_ONLY);
        }
        elseif ($this->id && $max_pos > 0 && ($this->position > $max_pos)) {
            MessageHandler::add (lang('err_position_too_big').
                    " (".lang('err_max_allowed_position_is')." <b>".$max_pos."</b>)", MSG_ERROR, MESSAGE_ONLY);
        }
        
        return MessageHandler::countError() > 0 ? false : true;
    }
    
    function delete() {
        
        $mn = new Menu();
        $mn->query("UPDATE menu 
                    SET position = position - 1
                    WHERE position > $this->position
                    AND id_parent = $this->id_parent
                    AND disabled = ".IS_NOT_DISABLED."
                    AND type = ".$this->type);
        
        $this->name = appendIdtoName($this->id, $this->name);
        $this->disabled = IS_DISABLED;
        $this->update();
        
    }
    
    public static function drawMenu($array_menus, $selected_section) {
        
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
            
            if ($self_menu["PERMISSION"] != '') {
                
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
                
            }
            
        }
        
        if (!$is_root)
            echo "</ul>\n";
        
    }
}
