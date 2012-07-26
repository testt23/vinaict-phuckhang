<?php

class Article extends Article_model {

    public static $lang;
    function __construct() {
        parent::__construct();
        self::$lang = get_system_language();
    }

    public function getList($filter = array()) {

        $article = new Article();

        $article->addJoin(new NewsCategory);

        $article->addSelect();
        $article->addSelect('article.*, news_category.name name_category');

        if (isset($filter['title']) && $filter['title'])
            $article->addWhere("title LIKE '%" . $filter['title'] . "%'");

        if (isset($filter['keywords']) && $filter['keywords'])
            $article->addWhere("keywords LIKE '%" . $filter['keywords'] . "%'");

        if (isset($filter['id_news_category']) && $filter['id_news_category'])
            $article->addWhere("id_news_category = " . $filter['id_news_category']);

        $article->orderBy(getI18nRealStringSql("title"));

        $article->find();

        return $article;
    }
    
    
    
    public function get_id(){
        return $this->id;
    }
    
    public function get_title(){
        return getI18n($this->title, self::$lang);
    }
    
    public function get_date(){
        return date_sql_to_local_date($this->date);
    }
    
    public function get_content(){
        return getI18n($this->id, self::$lang);
    }

}
