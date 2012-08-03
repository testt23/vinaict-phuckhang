<?php

class News_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $S = new ShoppingCart();
    }

    public function index() {
        
        $filter = Array();
        $article_arr = Array();
        
        $news_category = NewsCategory::getList($filter);
        $article = Article::getList($filter);
        
        
        while($article->fetchNext()){
            $article_arr[$article->id_news_category]['id'][] = $article->id;
            $article_arr[$article->id_news_category]['title'][] = $article->title;
            $article_arr[$article->id_news_category]['content'][] = $article->content;
            $article_arr[$article->id_news_category]['link'][] = $article->link;
            $article_arr[$article->id_news_category]['keywords'][] = $article->keywords;
            $article_arr[$article->id_news_category]['id_news_category'][] = $article->id_news_category;
            $article_arr[$article->id_news_category]['date'][] = $article->date;  
            $article_arr[$article->id_news_category]['picture'][] = $article->picture;  
        }
        
//        echo '<pre>';
//        var_dump($article_arr); 
//        echo '<pre>';
        
        
        $data['article_array'] = $article_arr;
        $data['news_category'] = $news_category;
        
        $data['content'] = 'news';
        $data['selected'] = 'news';
        
        $data['title_page'] = lang('title_news_page');
        $data['description'] = lang('description_news_page');
        $data['keywords'] = lang('keywords_news_page');
        
        $array_menus = array();
        $filter = array();

        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);

        $data['array_menus'] = $array_menus;
       
        $this->load->view('temp', $data);
    }
    
    public function detail($id = NULL){
        
        $article = new Article();
        $back = 'news';
        if($id){
            $article->addJoin(new Image(), 'LEFT');
            $article->addwhere('article.id = '.$id);
            $article->addSelect();
            $article->addSelect('article.*, image.file picture');
            
            if(!$article->find()){
                redirect($back);
            }
        }else{
            redirect($back);
        }
        
        
        
        $data['article'] = $article;
        $data['content'] = 'news_detail';
        $data['selected'] = 'news';

        $array_menus = array();
        $filter = array();

        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);
        
        $article->fetchNext();
        $data['title_page'] = $article->get_title();
        $data['description'] = $article->get_meta_description();
        $data['keywords'] = $article->get_keywords();
        
        $data['array_menus'] = $array_menus;
        $data['title'] = '';

        $this->load->view('temp', $data);
    }
    
    public function list_article($id_news_category = NULL){
        $articles = new Article();
        $news_category = new NewsCategory();
        
        $back = 'news';
        if($id_news_category){
            if($news_category->get($id_news_category)){
                $articles->addJoin(new Image(),'LEFT');
                $articles->addWhere('id_news_category ='. $id_news_category);
                $articles->addSelect();
                $articles->addSelect('article.*, image.file picture');
                $articles->orderBy('date DESC');
                $articles->find();
            }
        }else{
            redirect($back);
        }
        
        $data['news_category'] = $news_category;
        $data['article'] = $articles;
        $data['content'] = 'news_list';
        $data['selected'] = 'news';

        $array_menus = array();
        $filter = array();
        
        $news_category->fetchNext();
        $data['title_page'] = $news_category->get_name();
        $data['description'] = $news_category->get_description();
        $data['keywords'] = $news_category->get_keyword();
        
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);

        $data['array_menus'] = $array_menus;
        $data['title'] = '';

        $this->load->view('temp', $data);
    }
}

?>