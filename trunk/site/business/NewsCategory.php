<?php

class NewsCategory extends News_category_model {

    function __construct() {
        parent::__construct();
    }

    function getList($filter = array()) {

        $news_category = new NewsCategory();
        
        $sql = "SELECT news_category.*, parent_news_category.name name_parent
                    FROM news_category
                    LEFT JOIN (SELECT * FROM news_category) parent_news_category
                    ON (news_category.id_parent = parent_news_category.id)
                    WHERE news_category.is_deleted = ".IS_NOT_DISABLED;
        
       if (isset($filter['name']) && $filter['name'])
            $sql .= " AND news_category.name LIKE '%".$filter['name']."%'";
        
       if (isset($filter['keyworks']) && $filter['keyworks'])
            $sql .= " AND news_category.keywork LIKE '%".$filter['keyworks']."%'";
        
       if (isset($filter['id_parent']) && $filter['id_parent'])
            $sql .= " AND news_category.id_parent = ".$filter['id_parent'];
       
       $news_category->query($sql);
        
       return $news_category;
    }

    function validateInput() {

        $this->name = trim($this->name);
        $this->link = trim($this->link);
        $this->keyword = trim(trim($this->keyword),',');
        
        $lang = Language::getList();
        
        if ($this->name == "") {
            MessageHandler::add (lang('err_empty_name_news_category'), MSG_ERROR, MESSAGE_ONLY);
        }     
        
        if ($this->keyword == "") {
            MessageHandler::add (lang('err_empty_keywords'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->link == "") {
            MessageHandler::add (lang('err_empty_link'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        while ($lang->fetchNext()) {
                
            if (strlen(getI18n($this->name, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_name_too_long').': '.lang('msg_please_check'). '', MSG_ERROR, MESSAGE_ONLY);
            }
            
            if (strlen(getI18n($this->link, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_url_too_long').': '.lang('msg_please_check'). '', MSG_ERROR, MESSAGE_ONLY);
            }
            
            if (strlen(getI18n($this->keyword, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_keywords_too_long').': '.lang('msg_please_check'). '', MSG_ERROR, MESSAGE_ONLY);
            }
        }
        
        return MessageHandler::countError() > 0 ? false : true;
    }
    
    function delete($id = null){
        $newcate = new NewsCategory();
        
        $newcate->get($id);
        $newcate->is_deleted = IS_DISABLED;
        $newcate->update();
        return TRUE;
    }
    
    function testExitIdParent($id_parent = null){
        
        $newcate = new NewsCategory();
        
        $newcate->addWhere('id_parent ='. $id_parent);
        $newcate->addWhere('is_deleted = '.IS_NOT_DISABLED);
        
        $newcate->find();
        
        $lang = Language::getList();
        if($newcate->countRows() > 0){
            //MessageHandler::add (lang('err_already_parent').': '.lang('msg_please_check'). '', MSG_ERROR, MESSAGE_ONLY);
            //MessageHandler::add (lang('err_already_parent'), MSG_ERROR, MESSAGE_ONLY);
            MessageHandler::add (lang('err_already_parent').': '.lang('msg_please_check'). '', MSG_ERROR, MESSAGE_ONLY);
            return TRUE;
        }else {
            return FALSE;
        }
        
        
    }
}
