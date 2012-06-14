<?php

class WebPage extends Web_page_model {

    function __construct() {
        parent::__construct();
    }
    
    public function getList($filter = array()) {
        
        $page = new WebPage();
        
        if (isset($filter['title']) && $filter['title'])
            $page->addWhere("title LIKE '%".$filter['title']."%'");
        
        if (isset($filter['content']) && $filter['content'])
            $page->addWhere("content LIKE '%".$filter['content']."%'");
        
        if (isset($filter['tag']) && $filter['tag'])
            $page->addWhere("FIND_IN_SET(keywords, '".$filter['tag']."')");
        
        $page->orderBy(getI18nRealStringSql("title"));
        
        $page->find();
        
        return $page;
        
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
    
    function toggleStatus() {
       $this->is_disabled =  $this->is_disabled == IS_DISABLED ? "'".IS_NOT_DISABLED."'" : IS_DISABLED;
       $this->update();
    }
    
}
