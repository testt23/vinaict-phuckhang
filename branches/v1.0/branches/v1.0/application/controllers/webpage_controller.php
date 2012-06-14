<?php

    class Webpage_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        
        User::checkAccessable($this->session->userdata('userID'), 'webpage');
        $this->session->set_userdata('stored_url', selfURL());

        $section = "webpage";
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_webpage') => base_url('webpage'))
        );
        
        $filter = array();
        $filter['title'] = $this->input->get_post('title');
        $filter['content'] = $this->input->get_post('content');
        $filter['keywords'] = $this->input->get_post('keywords');
        $filter[PAGINATION_QUERY_STRING_SEGMENT] = $this->input->get(PAGINATION_QUERY_STRING_SEGMENT);
        $page = Page::getList($filter, true);
        
        $this->data['page'] = $page;
        $this->data['filter'] = $filter;

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);

        $this->data['cfer'] = $cfer;
        $this->data['array_menus'] = $array_menus;
        $this->data['section'] = $section;
        $this->data['pagination'] = $page->pagination;
        
        $this->load->view('main', $this->data);
    }
    
    function change_password($id){

	User::checkAccessable($this->session->userdata('userID'), 'user/change_password');
        $section = 'user_form';
        
        $back = $this->session->userdata('stored_url') ? $this->session->userdata('stored_url') : base_url('user');
	
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_user') => $back,
            lang('txt_change_password') => base_url('user/change_password/'.$id)));
        
        $act = $this->input->get_post('act');
    
        $user = new User();

        if (!$id || !$user->get($id)) {
            redirect($back);
        }
        
        $new_password = '';
        $confirm_password = '';
        
        if ($act == ACT_SUBMIT) {
      
            $new_password = utf8_escape_textarea($this->input->post('password'));
            $confirm_password = utf8_escape_textarea($this->input->post('confirm_password'));
            if ($user->validateChangePassword($new_password, $confirm_password)) {
                $user->pass = do_hash($new_password);
                $user->update();
                redirect($back);
            }
        }

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['new_password'] = $new_password;
        $this->data['confirm_password'] = $confirm_password;
        $this->data['user'] = $user;

        $this->data['array_menus'] = $array_menus;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        $this->data['only_change_password'] = true;
        $this->data['cfer'] = $cfer;
        
        $this->load->view('main', $this->data);
    }

    function delete($id = null) {
        
        User::checkAccessable($this->session->userdata('userID'), 'user/delete');
        $back = $this->session->userdata('stored_url') ? $this->session->userdata('stored_url') : base_url('user');
        
        $user = new User();

        if ($id && !$user->get($id)) {
            redirect($back);
        }
        
        $user->delete();
        redirect($back);
    
    }
    
    function add() {
        
        User::checkAccessable($this->session->userdata('userID'), 'user/add');
        $back = $this->session->userdata('stored_url') ? $this->session->userdata('stored_url') : base_url('user');
        $section = 'user_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_user') => $back,
            lang('txt_add_user') => base_url('user/add/')));
        
        $act = $this->input->get_post('act');
    
        $user = new User();
        
        if ($act == ACT_SUBMIT) {
            
            $user->first_name = utf8_escape_textarea($this->input->post('first_name'));
            $user->last_name = utf8_escape_textarea($this->input->post('last_name'));
            $user->email = utf8_escape_textarea($this->input->post('email'));
            $user->pass = utf8_escape_textarea($this->input->post('password'));
            $confirm_password = utf8_escape_textarea($this->input->post('confirm_password'));
            $user->home_phone = $this->input->post('home_phone');
            $user->work_phone = $this->input->post('work_phone');
            $user->mobile_phone = $this->input->post('mobile_phone');
            $user->address = utf8_escape_textarea($this->input->post('address'));
            $sel_groups = $this->input->post('id_group');
            
            if ($user->validateInput($confirm_password)) {
                
                $user->pass = do_hash($user->pass);
                
                if ($user->insert()) {
                    
                    if (count($sel_groups) > 0) {
                        foreach ($sel_groups as $id_group) {
                            $user_grp = new UserGroup();
                            $user_grp->id_user = $user->id;
                            $user_grp->id_group = $id_group;
                            $user_grp->insert();
                        }
                    }
                    
                    redirect($back);
                    
                }
                
            }
            
        }
        
        $group = Group::getList();

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['user'] = $user;
        $this->data['group'] = $group;
        $this->data['sel_groups'] = isset($sel_groups) && is_array($sel_groups) ? $sel_groups : array();
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }
    
    function edit($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'user/edit');
        $back = $this->session->userdata('stored_url') ? $this->session->userdata('stored_url') : base_url('user');
        $section = 'user_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_user') => $back,
            lang('txt_edit_user') => base_url('user/edit/'.$id)));
        
        $act = $this->input->get_post('act');
    
        $user = new User();
        
        if (!$id)
            redirect($back);
        
        if (!$user->get($id))
            redirect($back);
        
        $sel_groups = array();
        
        $user_grps = new UserGroup();
        $user_grps->addWhere('user_group.id_user = '.$user->id);
        $user_grps->find();

        while ($user_grps->fetchNext()) {
            $sel_groups[] = $user_grps->id_group;
        }
        
        if ($act == ACT_SUBMIT) {
            
            $user->first_name = utf8_escape_textarea($this->input->post('first_name'));
            $user->last_name = utf8_escape_textarea($this->input->post('last_name'));
            $user->email = utf8_escape_textarea($this->input->post('email'));
            $user->home_phone = $this->input->post('home_phone');
            $user->work_phone = $this->input->post('work_phone');
            $user->mobile_phone = $this->input->post('mobile_phone');
            $user->address = utf8_escape_textarea($this->input->post('address'));
            $sel_groups = $this->input->post('id_group');
            
            if ($user->validateInput()) {
                
                if ($user->update()) {
                    
                    if (count($sel_groups) > 0) {
                        
                        $user_grp = new UserGroup();
                        $user_grp->id_user = $user->id;
                        $user_grp->delete();
                        
                        foreach ($sel_groups as $id_group) {
                            $user_grp->id_user = $user->id;
                            $user_grp->id_group = $id_group;
                            $user_grp->insert();
                        }
                    }
                    
                    redirect($back);
                    
                }
                
            }
            
        }
        
        $group = Group::getList();

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['user'] = $user;
        $this->data['group'] = $group;
        $this->data['sel_groups'] = isset($sel_groups) && is_array($sel_groups) ? $sel_groups : array();
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
    }
}
