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
            $data['page'] = $info;
            $data['content'] = 'webpage';

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
