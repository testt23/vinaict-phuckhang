<?php

    class Webpage_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        
        User::checkAccessable($this->session->userdata('userID'), 'webpage');

        $section = "webpage";
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_web_page') => base_url('webpage'))
        );
        
        $filter = array();
        $filter['title'] = $this->input->get_post('title');
        $filter['content'] = $this->input->get_post('content');
        $filter['keywords'] = $this->input->get_post('keywords');
        $page = WebPage::getList($filter);
        
        $this->data['page'] = $page;
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
    
    function toggleStatus($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'webpage/toggleStatus');
        $back = base_url('webpage');
        
        $page = new WebPage();
        
        if ($id && $page->get($id)) {
            $page->toggleStatus();
        }
        
        redirect($back);
        
    }

    function delete($id = null) {
        
        User::checkAccessable($this->session->userdata('userID'), 'webpage/delete');
        $back = base_url('webpage');
        
        $page = new WebPage();

        if ($id && !$page->get($id)) {
            redirect($back);
        }
        
        $page->delete();
        redirect($back);
    
    }
    
    function add() {
        
        User::checkAccessable($this->session->userdata('userID'), 'webpage/add');
        $back = base_url('webpage');
        $section = 'webpage_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_web_page') => $back,
            lang('txt_add_page') => base_url('webpage/add/')));
        
        $act = $this->input->get_post('act');
    
        $page = new WebPage();
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('title_'.$lang->code)) {
                    $page->title .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('title_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('content_'.$lang->code)) {
                    $page->content .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('content_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            if ($this->input->post('link')) {
                $page->link = $this->input->post('link');
            }
            
            if ($this->input->post('keywords')) {
                $page->keywords = $this->input->post('keywords');
            }
            
            if ($this->input->post('is_disabled')) {
                $page->is_disabled = $this->input->post('is_disabled');
            }
            
            if ($page->validateInput()) {
                $page->insert();
                redirect($back);
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['page'] = $page;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }
    
    function edit($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'webpage/edit');
        $back = base_url('webpage');
        $section = 'webpage_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_web_page') => $back,
            lang('txt_edit_page') => base_url('webpage/edit/')));
        
        $act = $this->input->get_post('act');
    
        $page = new WebPage();
        
        if (!$id)
            redirect($back);
        elseif (!$page->get($id)) {
            redirect($back);
        }
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            $page->title = '';
            $page->content = '';
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('title_'.$lang->code)) {
                    $page->title .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('title_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('content_'.$lang->code)) {
                    $page->content .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('content_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            if ($this->input->post('link')) {
                $page->link = $this->input->post('link');
            }
            
            if ($this->input->post('keywords')) {
                $page->keywords = $this->input->post('keywords');
            }
            
            if ($this->input->post('is_disabled')) {
                $page->is_disabled = $this->input->post('is_disabled');
            }
            
            if ($page->validateInput()) {
                $page->update();
                redirect($back);
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['page'] = $page;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
    }
}
