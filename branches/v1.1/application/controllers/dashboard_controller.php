<?php

    class Dashboard_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        
        User::checkAccessable($this->session->userdata('userID'), 'user');

        $section = "dashboard";
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'))
        );
        
        $filter = array();

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);

        $this->data['cfer'] = $cfer;
        $this->data['array_menus'] = $array_menus;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
    }
    
    
}
