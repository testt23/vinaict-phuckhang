<?php

    class Menu_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        
        User::checkAccessable($this->session->userdata('userID'), 'menu');

        $section = "menu_list";
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_menu_list') => base_url('menu'))
        );
        
        $filter = array();
        
        $filter['name'] = $this->input->get_post('name');
        $filter['id_menu_parent'] = $this->input->get_post('id_menu_parent');

        $array_menus = array();
        $filter['parent_id'] = 0;
        
        Menu::getMenuTree($array_menus, $filter);

        $filter['menu_type'] = $this->input->get_post('menu_type') ? $this->input->get_post('menu_type') : FO;
        
        $menu_item = Menu::getList($filter);
        $this->data['menu_item'] = $menu_item;
        
        $menu_list = new Menu();
        $menu_list->addWhere('menu.disabled = '.IS_NOT_DISABLED);
        $menu_list->find();
        
        $this->data['cfer'] = $cfer;
        $this->data['array_menus'] = $array_menus;
        $this->data['menu_list'] = $menu_list;
        $this->data['section'] = $section;
        $this->data['filter'] = $filter;
        
        $this->load->view('main', $this->data);
    }

    function delete($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'menu/delete');
        $back = base_url('menu');
        
        $menu = new Menu();

        if ($id && !$menu->get($id)) {
            redirect($back);
        }
        
        $menu->delete();
        redirect($back);
    
    }
    
    function add($menu_type = false) {
        
        if (!$menu_type || $menu_type != BO)
            $menu_type = FO;
        
        
        User::checkAccessable($this->session->userdata('userID'), 'menu/add');
        $back = base_url('menu');
        $section = 'menu_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_menu_list') => $back,
            lang('txt_add_menu') => base_url('menu/add/'.$menu_type)));
        
        $act = $this->input->get_post('act');
    
        $menu = new Menu();
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $menu->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            $menu->link = utf8_escape_textarea($this->input->post('link'));
            $menu->id_parent = $this->input->post('id_menu_parent');
            $menu->position = $this->input->post('position') == "0" ? 0 : $this->input->post('position');
            $menu->section = utf8_escape_textarea($this->input->post('section'));
            $menu->type = $menu_type;
            
            if ($menu->validateInput()) {
                
                $menu->position = round($menu->position);
                
                $sql = "UPDATE menu 
                    SET position = position + 1 
                    WHERE position >= $menu->position ";
                
                if (!$menu->id_parent || $menu->id_parent == "")
                    $sql .= " AND id_parent = 0";
                else
                    $sql .= " AND id_parent = $menu->id_parent";
                
                $sql .= " AND disabled = ".IS_NOT_DISABLED;
                $sql .= " AND type = ".$menu->type;
                
                $mn = new Menu();
                $mn->query($sql);
                
                if ($menu->insert()) {
                    
                    Permission::updatePermission($menu->link, array(PERM_VIEW, PERM_ADD, PERM_EDIT, PERM_DELETE));
                    
                    redirect($back);
                }
                   
            }
            
        }
        
        $menu_list = new Menu();
        $menu_list->addWhere('disabled = '.IS_NOT_DISABLED);
        $menu_list->addWhere('type = '.$menu_type);
        $menu_list->find();

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['menu'] = $menu;
        $this->data['menu_list'] = $menu_list;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }
    
    function edit($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'menu/edit');
        $back = base_url('menu');
        $section = 'menu_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_menu_list') => $back,
            lang('txt_edit_menu') => base_url('menu/edit/'.$id)));
        
        $act = $this->input->get_post('act');
    
        $menu = new Menu();
        
        if (!$id)
            redirect($back);
        
        if (!$menu->get($id))
            redirect($back);
        
        if ($menu->disabled == IS_DISABLED)
            redirect($back);
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            $menu->name = '';
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $menu->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            $menu->link = utf8_escape_textarea($this->input->post('link'));
            $menu->section = utf8_escape_textarea($this->input->post('section'));
            $menu->id_parent = $this->input->post('id_menu_parent') ? $this->input->post('id_menu_parent') : 0;
            $menu->position = $this->input->post('position') == "0" ? 0 : $this->input->post('position');
            
            $categories = ProductCategory::getTree();
            
            if ($menu->validateInput()) {
                
                $menu->position = round($menu->position);
                
                $mn = new Menu();
                $mn->get($menu->id);
                
                if ($menu->id_parent == $mn->id_parent) {
                    
                    if ($menu->position > $mn->position) {

                        $sql = "UPDATE menu 
                            SET position = position - 1 
                            WHERE (position > $mn->position AND position <= $menu->position) ";

                    }
                    elseif ($menu->position < $mn->position) {

                        $sql = "UPDATE menu 
                            SET position = position + 1 
                            WHERE (position < $mn->position AND position >= $menu->position) ";

                    }

                    if (!$menu->id_parent || $menu->id_parent == "")
                        $sql .= " AND id_parent = 0";
                    else
                        $sql .= " AND id_parent = $menu->id_parent";

                    $sql .= " AND disabled = ".IS_NOT_DISABLED;
                    $sql .= " AND type = ".$menu->type;
                
                    if ($menu->position != $mn->position) {
                        $mn->query($sql);
                    }
                    
                }
                else {
                    
                    $sql = "UPDATE menu 
                            SET position = position - 1
                            WHERE position > $mn->position
                            AND id_parent = ".($mn->id_parent ? $mn->id_parent : 0)."
                            AND disabled = ".IS_NOT_DISABLED."
                            AND type = ".$mn->type;
                    
                    $mn->query($sql);
                    
                    
                    $sql = "UPDATE menu
                            SET position = position + 1
                            WHERE position >= $menu->position
                            AND id_parent = ".($menu->id_parent ? $menu->id_parent : 0)."
                            AND disabled = ".IS_NOT_DISABLED."
                            AND type = ".$menu->type;
                    
                    $mn->query($sql);
                }
                
                if ($menu->update()) {
                    redirect($back);
                }
                
            }
            
        }
        
        $menu_list = new Menu();
        $menu_list->addWhere('disabled = '.IS_NOT_DISABLED);
        $menu_list->addWhere('type = '.$menu->type);
        $menu_list->find();

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['menu'] = $menu;
        $this->data['menu_list'] = $menu_list;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
    }
    
}
