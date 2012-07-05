<?php

    class Usr_group_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        
        User::checkAccessable($this->session->userdata('userID'), 'user');

        $section = "usr_group";
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_group') => base_url('usr_group'))
        );
        
        $filter = array();
        
        $group = Usrgroup::getList();
        
        $this->data['group'] = $group;
        $this->data['filter'] = $filter;

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);

        $this->data['cfer'] = $cfer;
        $this->data['array_menus'] = $array_menus;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
    }
    
    
    function delete($id = null) {
        
        User::checkAccessable($this->session->userdata('userID'), 'usr_group/delete');
        $back = base_url('usr_group');
        
        $group = new Usrgroup();

        if ($id && !$group->get($id)) {
            redirect($back);
        }
        
        $group->delete($group->id);
        redirect($back);
    
    }
    
    function add() {
        
        User::checkAccessable($this->session->userdata('userID'), 'usr_group/add');
        $back = base_url('usr_group');
        $section = 'usr_group_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_group') => $back,
            lang('txt_add_group') => base_url('usr_group/add/')));
        
        $act = $this->input->get_post('act');
    
        $group = new Usrgroup();
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            $group->code = utf8_escape_textarea($this->input->post('code'));
            $group->name = '';
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $group->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            if ($group->validateInput()) {
                
               if ($group->insert()) {                        
                    redirect($back);
                    
                }
                
            }
            
        }
        

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }
    
    function edit($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'usr_group/edit');
        $back = base_url('usr_group');
        $section = 'usr_group_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_group') => $back,
            lang('txt_edit_group') => base_url('usr_group/edit/'.$id)));
        
        $act = $this->input->get_post('act');
    
        $group = new Usrgroup();
        
        if (!$id)
            redirect($back);
        
        if (!$group->get($id))
            redirect($back);
        
        
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            $group->code = utf8_escape_textarea($this->input->post('code'));
            $group->name = '';
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $group->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            if ($group->validateInput()) {
                
                if ($group->update($group->id)) {
                    redirect($back);
                    }
                              
            }
            
        }
        
        $group = Usrgroup::getList($id);

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['group'] = $group;
        $this->data['edit_group'] = TRUE;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
    }
}
