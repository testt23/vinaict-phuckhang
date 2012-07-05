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
        $filter['name'] = $this->input->get_post('name');
        $filter['keyword'] = $this->input->get_post('keyword');
        $news_category = NewsCategory::getList($filter);

        while ($news_category->fetchNext()) {
            $arr_news_category[$news_category->id] = array(
                'id' => getI18n($news_category->id),
                'name' => getI18n($news_category->name),
                'description' => truncateString(clean_html(getI18n($news_category->description)), 100),
                'link' => $news_category->link,
                
                'keyword' => $news_category->keyword,
                'id_parent' => $news_category->id_parent
            );
        }

        $this->data['arr_news_category'] = $arr_news_category;        
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
        
        $news_category->delete();
        redirect($back);
    
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
        $categories = NewsCategory::getTree();
        $arr_parent = array();
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->id)) {
                    $news_category->name .= '<'.$lang->id.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->id)).'</'.$lang->id.'>';
                }
                
                if ($this->input->post('description_'.$lang->id)) {
                    $news_category->description .= '<'.$lang->id.'>'.utf8_escape_textarea($this->input->post('description_'.$lang->id)).'</'.$lang->id.'>';
                }
                
            }
            
            $news_category->link = utf8_escape_textarea($this->input->post('link'));
            $news_category->keywords = utf8_escape_textarea($this->input->post('keyword'));
            $news_category->id_parent = $this->input->post('id_parent');
            
            if ($news_category->id_parent) {
                if (is_array($news_category->id_parent)) {
                    $arr_parent = $news_category->id_parent;
                    $news_category->id_parent = implode(',', $arr_parent);
                }
                else {
                    $arr_parent[] = $news_category->id_parent;
                }
            }
            
            if ($news_category->validateInput()) {
                $news_category->insert();           
                
                redirect($back);
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['news_category'] = $news_category;
        $this->data['categories'] = $categories;
        $this->data['arr_parent'] = $arr_parent;
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
        
        if (!$id)
            redirect($back);
        
        $act = $this->input->get_post('act');
    
        $news_category = new NewsCategory();
        
        if (!$news_category->get($id))
            redirect($back);
        
        
        $categories = NewsCategory::getTree(null, $id);
        $arr_parent = explode(',', $news_category->id_parent);
        
        
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            $news_category->name = '';
            $news_category->description = '';
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->id)) {
                    $news_category->name .= '<'.$lang->id.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->id)).'</'.$lang->id.'>';
                }
                
                if ($this->input->post('description_'.$lang->id)) {
                    $news_category->description .= '<'.$lang->id.'>'.utf8_escape_textarea($this->input->post('description_'.$lang->id)).'</'.$lang->id.'>';
                }
                
            }
            
            
            $news_category->keywords = utf8_escape_textarea($this->input->post('keyword'));
            $news_category->link = utf8_escape_textarea($this->input->post('link'));
            
            if ($this->input->post('id_parent')) {
                if (is_array($this->input->post('id_parent'))) {
                    $arr_parent = $this->input->post('id_parent');
                    $news_category->id_parent = implode(',', $arr_parent);
                }
                else {
                    $arr_parent[] = $news_category->id_parent;
                    $news_category->id_parent = $this->input->post('id_parent');
                }
            }
            
            if ($news_category->validateInput()) {
                $news_category->update();
                                
                redirect($back);
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['news_category'] = $news_category;
        $this->data['categories'] = $categories;
        $this->data['arr_parent'] = $arr_parent;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }

}
