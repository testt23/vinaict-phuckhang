<?php

    class Menu_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        
    }

    function index(){
        
        $this->session->set_userdata('stored_url', selfURL());

        $section = "menu_list";
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_menu_list') => base_url('menu'))
        );
        
        $filter = array();
        
        $filter['name'] = $this->input->post('name');
        $filter['id_menu_parent'] = $this->input->post('id_menu_parent');
        $menu_item = Menu::getList($filter);
        
        $this->data['menu_item'] = $menu_item;
        $this->data['filter'] = $filter;

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $menu_list = new Menu();
        $menu_list->addWhere('menu.disabled = '.IS_NOT_DISABLED);
        $menu_list->find();

        $this->data['cfer'] = $cfer;
        $this->data['array_menus'] = $array_menus;
        $this->data['menu_list'] = $menu_list;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
    }

    function delete($id) {
        
        $back = $this->session->userdata('stored_url') ? $this->session->userdata('stored_url') : base_url('menu');
        
        $menu = new Menu();

        if ($id && !$menu->get($id)) {
            redirect($back);
        }
        
        $menu->delete();
        redirect($back);
    
    }
    
    function add() {
        
        $back = $this->session->userdata('stored_url') ? $this->session->userdata('stored_url') : base_url('menu');
        $section = 'menu_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_menu_list') => $back,
            lang('txt_add_menu') => base_url('menu/add/')));
        
        $act = $this->input->get_post('act');
    
        $menu = new Menu();
        
        if ($act == ACT_SUBMIT) {
            
            $menu->name = $this->input->post('name');
            $menu->link = $this->input->post('link');
            $menu->id_parent = $this->input->post('id_menu_parent');
            $menu->position = $this->input->post('position') == "0" ? 0 : $this->input->post('position');
            $menu->section = $this->input->post('section');
            
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
        $menu_list->find();

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
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
        
        $back = $this->session->userdata('stored_url') ? $this->session->userdata('stored_url') : base_url('menu');
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
            
            $menu->name = $this->input->post('name');
            $menu->link = $this->input->post('link');
            $menu->section = $this->input->post('section');
            $menu->id_parent = $this->input->post('id_menu_parent') ? $this->input->post('id_menu_parent') : 0;
            $menu->position = $this->input->post('position') == "0" ? 0 : $this->input->post('position');
            
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
                
                    if ($menu->position != $mn->position) {
                        $mn->query($sql);
                    }
                    
                }
                else {
                    
                    $sql = "UPDATE menu 
                            SET position = position - 1
                            WHERE position > $mn->position
                            AND id_parent = ".($mn->id_parent ? $mn->id_parent : 0)."
                            AND disabled = ".IS_NOT_DISABLED;
                    
                    $mn->query($sql);
                    
                    
                    $sql = "UPDATE menu
                            SET position = position + 1
                            WHERE position >= $menu->position
                            AND id_parent = ".($menu->id_parent ? $menu->id_parent : 0)."
                            AND disabled = ".IS_NOT_DISABLED;
                    
                    $mn->query($sql);
                }
                
                if ($menu->update()) {
                    redirect($back);
                }
                
            }
            
        }
        
        $menu_list = new Menu();
        $menu_list->addWhere('disabled = '.IS_NOT_DISABLED);
        $menu_list->find();

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
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
