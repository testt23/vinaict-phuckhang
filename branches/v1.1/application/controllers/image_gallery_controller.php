<?php

class Image_gallery_controller extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        
        $this->benchmark->mark('code_start');
        
        User::checkAccessable($this->session->userdata('userID'), 'image_gallery');

        $section = "image_gallery";
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_image_gallery') => base_url('image_gallery'))
        );
        
        $folder_tree = Image::renderFolderTrees();
        
        $filter = array();

        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);

        $this->data['cfer'] = $cfer;
        $this->data['array_menus'] = $array_menus;
        $this->data['section'] = $section;
        $this->data['folder_tree'] = $folder_tree;
        
        $this->load->view('main', $this->data);
        
    }
    
    function viewThumbnailPopup($file = '') {
        echo '<img src="'.direct_url(site_url().'../uploads/images/').str_replace('-slash-', '/', $file).'" alt="" class="thumbnail-popup" />';
    }
    
    function viewportContent($path) {
        echo $path;
    }
    
}