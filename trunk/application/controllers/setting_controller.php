<?php

    class Setting_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        
        User::checkAccessable($this->session->userdata('userID'), 'setting');

        $section = "setting";
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_settings') => base_url('setting'))
        );
        
        $filter = array();
        $filter['id_param_group'] = $this->input->get_post('id_param_group');
        $filter['always_load'] = $this->input->get_post('always_load') == '1' ? TRUE : FALSE;
        
        $parameter = Parameter::getList($filter);
        
        $this->data['parameter'] = $parameter;

        $array_menus = array();
        $filter['parent_id'] = 0;
        $this->data['filter'] = $filter;
        Menu::getMenuTree($array_menus, $filter);

        $this->data['cfer'] = $cfer;
        $this->data['array_menus'] = $array_menus;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data); 
    }
}
