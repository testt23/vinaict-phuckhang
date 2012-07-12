<?php

class News_category_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index() {

        User::checkAccessable($this->session->userdata('userID'), 'news_category');

        $section = "news_category";
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_news_category') => base_url('news_category'))
        );
        
        $filter = array();
        
        $newscategory = NewsCategory::getList($filter);
        
        $filter['name'] = $this->input->get_post('name');
        $filter['keywords'] = $this->input->get_post('keywords');
        $filter['id_parent'] = $this->input->get_post('id_parent');
        
        $news_category = NewsCategory::getList($filter);
        
        //$this->data['NewsCategorySearch'] = $news_category;
        $this->data['news_category'] = $news_category;
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
        
        User::checkAccessable($this->session->userdata('userID'), 'news_category/delete');
        $back = base_url('news_category');
        
        $news_category = new NewsCategory();

        if ($id && !$news_category->get($id)) {
            redirect($back);
        }
        
        if(!$news_category->testExitIdParent($news_category->id)){
            
                if($news_category->delete($news_category->id)){

                    Article::deleteByIdNewsCategory($news_category->id);

                }
               redirect($back); 
        }
        
        redirect($back,null,null,$error_message = lang('err_already_parent'),MSG_ERROR);
    
    }
    
    function add() {
        
        User::checkAccessable($this->session->userdata('userID'), 'news_category/add');
        $back = base_url('news_category');
        $section = 'news_category_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_news_category') => $back,
            lang('txt_add_news_category') => base_url('news_category/add/')));
        
        $act = $this->input->get_post('act');
    
        $news_category = new NewsCategory();
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $news_category->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                //var_dump($news_category->name);
                if ($this->input->post('description_'.$lang->code)) {
                    $news_category->description .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('description_'.$lang->code)).'</'.$lang->code.'>';
                }
                                               
            }
            
            if ($this->input->post('keywords')) {
                $news_category->keyword = utf8_escape_textarea($this->input->post('keywords'));
            }
            
            if ($this->input->post('id_parent')) {
                $news_category->id_parent = $this->input->post('id_parent');               
            }
            
            if ($this->input->post('link')) {
                $news_category->link = utf8_escape_textarea($this->input->post('link'));
            }
                        
            if ($news_category->validateInput()) {
                $news_category->insert();
                redirect($back);
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        
        $newscategory = NewsCategory::getList($filter);
        
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['newscategory'] = $newscategory;
        $this->data['news_category'] = $news_category;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }
    
    function edit($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'news_category/edit');
        $back = base_url('news_category');
        $section = 'news_category_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_news_category') => $back,
            lang('txt_edit_news_category') => base_url('news_category/edit/')));
        
        $act = $this->input->get_post('act');
    
        $news_category = new NewsCategory();
        
        if (!$id)
            redirect($back);
        elseif (!$news_category->get($id)) {
            redirect($back);
        }
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            $news_category->name = '';
            $news_category->description = '';
            $news_category->link = '';
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $news_category->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('description_'.$lang->code)) {
                    $news_category->description .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('description_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                                
            }
            
            if ($this->input->post('keywords')) {
                $news_category->keyword = utf8_escape_textarea($this->input->post('keywords'));
            }
            
            if ($this->input->post('id_parent')) {
                $news_category->id_parent = $this->input->post('id_parent');    
            }
            
            if ($this->input->post('link')) {
                $news_category->link = utf8_escape_textarea($this->input->post('link'));
            }
                            
            if ($news_category->validateInput()) {
                $news_category->update();
                redirect($back);
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        
        $newscategory = NewsCategory::getList($filter);
        
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
       
        $this->data['newscategory'] = $newscategory;
        $this->data['news_category'] = $news_category;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
    }
}