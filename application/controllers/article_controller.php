<?php

    class Article_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        
        User::checkAccessable($this->session->userdata('userID'), 'article');

        $section = "article";
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_article') => base_url('article'))
        );
        
        $filter = array();
        
        $newscategory = NewsCategory::getList($filter);
        
        $filter['title'] = $this->input->get_post('title');
        $filter['keywords'] = $this->input->get_post('keywords');
        $filter['id_news_category'] = $this->input->get_post('id_news_category');
        
        $article = Article::getList($filter);
        $this->data['newscategory'] = $newscategory;
        $this->data['article'] = $article;
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
        
        User::checkAccessable($this->session->userdata('userID'), 'article/delete');
        $back = base_url('article');
        
        $article = new Article();

        if ($id && !$article->get($id)) {
            redirect($back);
        }
        
        $article->delete();
        redirect($back);
    
    }
    
    function add() {
        
        User::checkAccessable($this->session->userdata('userID'), 'article/add');
        $back = base_url('article');
        $section = 'article_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_article') => $back,
            lang('txt_add_article') => base_url('article/add/')));
        
        $act = $this->input->get_post('act');
    
        $article = new Article();
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('title_'.$lang->code)) {
                    $article->title .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('title_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('content_'.$lang->code)) {
                    $article->content .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('content_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('link_'.$lang->code)) {
                    $article->link .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('link_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            if ($this->input->post('keywords')) {
                $article->keywords = $this->input->post('keywords');
            }
            
            if ($this->input->post('id_news_category')) {
                $article->id_news_category = $this->input->post('id_news_category');               
            }
                  
            if ($article->validateInput()) {
                $article->insert();
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
        $this->data['article'] = $article;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }
    
    function edit($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'article/edit');
        $back = base_url('article');
        $section = 'article_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_article') => $back,
            lang('txt_edit_article') => base_url('article/edit/')));
        
        $act = $this->input->get_post('act');
    
        $article = new Article();
        
        if (!$id)
            redirect($back);
        elseif (!$article->get($id)) {
            redirect($back);
        }
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            $article->title = '';
            $article->content = '';
            $article->link = '';
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('title_'.$lang->code)) {
                    $article->title .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('title_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('content_'.$lang->code)) {
                    $article->content .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('content_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('link_'.$lang->code)) {
                    $article->link .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('link_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            if ($this->input->post('keywords')) {
                $article->keywords = $this->input->post('keywords');
            }
            
            if ($this->input->post('id_news_category')) {
                $article->id_news_category = $this->input->post('id_news_category');                 
                //$article->id_news_category = $this->input->post('id_news_category');
            }
            //echo "<pre>";  var_dump($article->id_article_category); echo "<pre>";
            if ($article->validateInput()) {
                $article->update();
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
        $this->data['article'] = $article;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
    }
}
