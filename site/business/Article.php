<?php

class Article extends Article_model {

    function __construct() {
        parent::__construct();
    }

    public function getList($filter = array()) {

        $article = new Article();
        $article->addJoin(new NewsCategory());
        $article->addJoin(new Image(),'LEFT');
        
        $article->addSelect();
        $article->addSelect('article.*, news_category.name name_category, image.file picture');

        if (isset($filter['title']) && $filter['title'])
            $article->addWhere("title LIKE '%" . $filter['title'] . "%'");

        if (isset($filter['keywords']) && $filter['keywords'])
            $article->addWhere("keywords LIKE '%" . $filter['keywords'] . "%'");

        if (isset($filter['id_news_category']) && $filter['id_news_category'])
            $article->addWhere("id_news_category = " . $filter['id_news_category']);
        
        if (isset($filter['limit']) && $filter['limit'])
            $article->limit($filter['limit']);

        $article->orderBy("date DESC");

        $article->find();

        return $article;
    }
    
    
    
    public function get_id(){
        return $this->id;
    }
    
    public function get_title(){
        return getI18n($this->title);
    }
    
    public function get_date(){
        return date_sql_to_local_date($this->date);
    }
    
    public function get_content(){
        
        $utf8_string = preg_replace("/\r?\n/", "", getI18n($this->content));
	return htmlspecialchars_decode($utf8_string);
        //return getI18n($this->content);
    }
    
    public function get_meta_description(){
        return getI18n($this->meta_description);
    }
    
     public function get_keywords(){
        return getI18n($this->keywords);
    }
    
    public function get_image_group_code(){
        return 'article';
    }
     
    public function get_image_default(){
        return base_url(config_item('upload_path').'images/'.self::get_image_group_code().'/default.png');
    }
    
    public function get_image_link_tiny($image) {
        if(trim($image) == ''){
            return self::image_exists(self::get_image_default());
        }
        $url = self::get_image_group_code(). '/' . str_replace(array('.jpg', '.png', '.gif'), array('_tiny.jpg', '_tiny.png', '_tiny.gif'), $image);
        return self::image_exists($url);
    }
    
    public function get_image_link_small($image) {
        if(trim($image) == ''){
            return self::image_exists(self::get_image_default());
        }
        $url = self::get_image_group_code() . '/' . str_replace(array('.jpg', '.png', '.gif'), array('_small.jpg', '_small.png', '_small.gif'), $image);
        return self::image_exists($url);
    }
    
   public function image_exists($url){
        $url = trim($url, '/');
        if (empty($url)){
            return $this->image_default;
        }
        return file_exists(direct_url(config_item('source_image').$url)) ? base_url(config_item('source_image').$url) : base_url(config_item('upload_path').'images/'.self::get_image_group_code().'/default.png');
    }
    
    public function get_content_html($string){
        
        $utf8_string = preg_replace("/\r?\n/", "", getI18n($string));
	return htmlspecialchars_decode($utf8_string);
    }
    
}
