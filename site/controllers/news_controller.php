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
        }
        
//        echo '<pre>';
//        var_dump($article_arr); 
//        echo '<pre>';
        
        
        $data['article_array'] = $article_arr;
        $data['news_category'] = $news_category;
        
        $data['content'] = 'news';
        $data['selected'] = 'news';

        $array_menus = array();
        $filter = array();

        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);

        $data['array_menus'] = $array_menus;
        $data['title'] = '';

        $this->load->view('temp', $data);
    }
    
    public function detail($id = NULL){
        
        $article = new Article();
        $back = 'news';
        if($id){
            if(!$article->get($id)){
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
                $articles->addWhere('id_news_category ='. $id_news_category);
                $articles->addSelect();
                $articles->addSelect('article.*');
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

        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);

        $data['array_menus'] = $array_menus;
        $data['title'] = '';

        $this->load->view('temp', $data);
    }
}

?>