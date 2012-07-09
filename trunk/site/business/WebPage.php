<?php

class WebPage extends Web_page_model {

    var $if;
    var $lang;

    function __construct() {
        parent::__construct();
        $this->if = new dbinfo();
        $this->lang = get_system_language();
    }

    public function getPage($link = '') {
        $Webpage = new WebPage();

        $Webpage->addSelect();
        $Webpage->addSelect($this->if->_web_page_id . ' as ' . $this->if->_web_page_as_id);
        $Webpage->addSelect($this->if->_web_page_content . ' as ' . $this->if->_web_page_as_content);

        $Webpage->addWhere($this->if->_web_page_link . " = '" . $link . "'");

        $Webpage->find();

        return $Webpage;
    }

    public function the_web_page_content() {
        return getI18n($this->{$this->if->_web_page_as_content}, $this->lang);
    }

}
