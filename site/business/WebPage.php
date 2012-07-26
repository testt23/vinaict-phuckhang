<?php

class WebPage extends Web_page_model {

    var $if;
    var $lang;

    function __construct() {
        parent::__construct();
        $this->if = new DbInfo();
    }

    public function getPage($link = '') {
        $Webpage = new WebPage();
        $Webpage->addSelect();
        $Webpage->addSelect($this->if->_web_page_id . ' as ' . $this->if->_web_page_as_id);
        $Webpage->addSelect($this->if->_web_page_title . ' as ' . $this->if->_web_page_as_title);
        $Webpage->addSelect($this->if->_web_page_meta_description . ' as ' . $this->if->_web_page_as_meta_description);
        $Webpage->addSelect($this->if->_web_page_content . ' as ' . $this->if->_web_page_as_content);
        $Webpage->addSelect($this->if->_web_page_keywords . ' as ' . $this->if->_web_page_as_keywords);
        $Webpage->addWhere($this->if->_web_page_link . " = '" . $link . "'");
        $Webpage->find();
        return $Webpage;
    }

    public function get_web_page_content() {
        return getI18n($this->{$this->if->_web_page_as_content});
    }
    
    public function get_web_page_meta_description() {
        return getI18n($this->{$this->if->_web_page_as_meta_description});
    }

    public function get_web_page_keywords() {
        return getI18n($this->{$this->if->_web_page_as_keywords});
    }
    public function get_web_page_title(){
        return getI18n($this->{$this->if->_web_page_as_title});
    }

}
