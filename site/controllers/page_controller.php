<?php

class Page_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function the_page($link = '') {
        if ($link != '') {
            $Webpage = new WebPage();
            $info = $Webpage->getPage($link);
            if (empty($info) || $info->countRows() == 0) {
                redirect('index');
            }
            
            
            $info->fetchNext();
            $data['page'] = $info->the_web_page_content();
            
            $data['title_page'] = getI18n($info->title);
            $data['description'] = getI18n($info->meta_description);
            $data['keywords'] = $info->keywords;

            $data['selected'] = $link;
            $filter = array();
            $array_menus = array();

            $filter['parent_id'] = 0;
            Menu::getMenuTree($array_menus, $filter);
            $data['array_menus'] = $array_menus;

            $this->load->view('temp', $data);
        } else {
            redirect(Variable::getDefaultPageString());
        }
    }

}
