<?php

class Article extends Article_model {

    function __construct() {
        parent::__construct();
    }
    
    public function getList($filter = array()) {
        
        $article = new Article();
        
        $article->addJoin(new NewsCategory);
        
        $article->addSelect();
        $article->addSelect('article.*, news_category.name name_category');
        
        if (isset($filter['title']) && $filter['title'])
            $article->addWhere("title LIKE '%".$filter['title']."%'");
        
        if (isset($filter['keywords']) && $filter['keywords'])
            $article->addWhere("keywords LIKE '%".$filter['keywords']."%'");
         
        if (isset($filter['id_news_category']) && $filter['id_news_category'])
            $article->addWhere("id_news_category = ".$filter['id_news_category']);
        
        $article->orderBy(getI18nRealStringSql("title"));
        
        $article->find();
        
        return $article;
        
    }
    
    function validateInput() {

        $this->title = trim($this->title);
        $this->link = trim($this->link);
        $this->content = trim($this->content);
        $this->keywords = trim(trim($this->keywords),',');
        
        $lang = Language::getList();
        
        if ($this->title == "") {
            MessageHandler::add (lang('err_empty_title'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->content == "") {
            MessageHandler::add (lang('err_empty_content'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->link == "") {
            MessageHandler::add (lang('err_empty_link'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        while ($lang->fetchNext()) {
                
            if (strlen(getI18n($this->title, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_title_too_long').': '.lang('msg_please_check'). '', MSG_ERROR, MESSAGE_ONLY);
            }
            
            if (strlen(getI18n($this->link, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_url_too_long').': '.lang('msg_please_check'). '', MSG_ERROR, MESSAGE_ONLY);
            }
                
        }
        
        return MessageHandler::countError() > 0 ? false : true;
    }
    
    function deleteByIdNewsCategory($idNewsCategory = NULL){
        $article = new Article();
        
        $article->id_news_category = $idNewsCategory;
        $article->delete();
        return TRUE;
    }
        
}
