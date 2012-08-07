<?php

class Image_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $data['title_page'] = '';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['content'] = 'image';
        $data['description'] = 'image';
        $data['keywords'] = 'image';
        // Menu 
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);
        $data['selected'] = '';
        $data['array_menus'] = $array_menus;
        // end menu
        
        $Image = new Image();
        $images = $Image->getListImageFrontEnd();

        $data['images'] = $images;

        $this->load->view('temp', $data);
    }

}