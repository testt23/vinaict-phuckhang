<?php

    class Prod_category_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        
        User::checkAccessable($this->session->userdata('userID'), 'prod_category');

        $section = "prod_category";
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_product_category') => base_url('prod_category'))
        );
        
        $filter = array();
        $filter['name'] = $this->input->get_post('name');
        $filter['keywords'] = $this->input->get_post('keywords');
        $filter['code'] = $this->input->get_post('code');
        $filter['sort_by'] = $this->input->get_post('sort_by');
        $filter['category'] = $this->input->get_post('category');
        $filter['limit'] = $this->input->get_post('limit');
        if (!$filter['limit'] && !is_numeric($filter['limit']))
            $filter['limit'] = 10;
        
        
        $total_record = ProductCategory::getTotalRecord($filter);
        

        
        $pagination = new Pagination($this, $total_record, $filter['limit']);
        
        $filter['start'] = $pagination->start;
        $this->data['pagination'] = $pagination->get_html(2);
        
        $prod_category = ProductCategory::getList($filter);
        $arr_prod_category = array();
        while($prod_category->fetchNext()) {
            $arr_prod_category[$prod_category->id] = array('code' => $prod_category->code,
                                                'name' => getI18n($prod_category->name),
                                                'description' => truncateString(clean_html(getI18n($prod_category->description)), 100),
                                                'link' => $prod_category->link,
                                                'picture' => $prod_category->picture,
                                                'keywords' => $prod_category->keywords,
                                                'id_parent' => $prod_category->id_parent
                                                );
        }
        
        $this->data['arr_prod_category'] = $arr_prod_category;
        $this->data['image_group_code'] = 'prod_category';
        $this->data['filter'] = $filter;
        $this->data['categories'] = ProductCategory::getTree();
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);

        $this->data['cfer'] = $cfer;
        $this->data['array_menus'] = $array_menus;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
    }

    function delete($id = null) {
        
        User::checkAccessable($this->session->userdata('userID'), 'prod_category/delete');
        $back = base_url('prod_category');
        
        $prod_category = new ProductCategory();

        if ($id && !$prod_category->get($id)) {
            redirect($back);
        }
        
        $prod_category->delete();
        redirect($back);
    
    }
    
    function add() {
        User::checkAccessable($this->session->userdata('userID'), 'prod_category/add');
        $back = base_url('prod_category');
        $section = 'prod_category_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_product_category') => $back,
            lang('txt_add_product_category') => base_url('prod_category/add/')));
        
        $act = $this->input->get_post('act');
    
        $prod_category = new ProductCategory();
        $categories = ProductCategory::getTree();
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $prod_category->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('description_'.$lang->code)) {
                    $prod_category->description .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('description_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            $prod_category->code = utf8_escape_textarea($this->input->post('code'));
            $prod_category->link = utf8_escape_textarea($this->input->post('link'));
            $prod_category->keywords = utf8_escape_textarea($this->input->post('keywords'));
            $prod_category->id_parent = $this->input->post('id_parent');
            
            
            $prod_cate_parent = new ProductCategory();
            $link_parent = $prod_cate_parent->getLinkById($prod_category->id_parent);
            if ($link_parent == ''){
                $link_parent = defined('SITE_PAGE_PRODUCT_STRING') ? SITE_PAGE_PRODUCT_STRING : 'san-pham';
            }
            $prod_category->link = trim($link_parent . '/' .$prod_category->link, '/');
            if ($prod_category->validateInput()) {
                $prod_category->insert();
                
                if (!empty($_FILES['image']['name'])) {
                    $prod_category->addPicture();
                }
                
                redirect($back);
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['prod_category'] = $prod_category;
        $this->data['categories'] = $categories;
        $this->data['id_parent'] = $prod_category->id_parent;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }
    
    function edit($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'prod_category/edit');
        $back = base_url('prod_category');
        $section = 'prod_category_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_product_category') => $back,
            lang('txt_edit_product_category') => base_url('prod_category/edit/')));
        
        if (!$id)
            redirect($back);
        
        $act = $this->input->get_post('act');
    
        $prod_category = new ProductCategory();
        
        if (!$prod_category->get($id))
            redirect($back);
        
        if (!$prod_category->id_image)
            MessageHandler::add(lang('msg_prod_category_has_no_picture_uploaded'), MSG_WARNING, MESSAGE_ONLY);
        $categories = ProductCategory::getTree(null, $id);
        
        $id_parent = $prod_category->id_parent;
        
        
        $image = new Image();
        
        if ($image->get($prod_category->id_image)) {
            $img_urls = $image->getImageURLs();
            $this->data['img_urls'] = $img_urls;
            $this->data['image'] = $image;
        }
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            $prod_category->name = '';
            $prod_category->description = '';
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $prod_category->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('description_'.$lang->code)) {
                    $prod_category->description .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('description_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            $prod_category->code = utf8_escape_textarea($this->input->post('code'));
            $prod_category->keywords = utf8_escape_textarea($this->input->post('keywords'));
            $prod_category->link = utf8_escape_textarea($this->input->post('link'));
            $prod_category->id_parent = $this->input->post('id_parent');
            
            
            $prod_cate_parent = new ProductCategory();
            $link_parent = $prod_cate_parent->getLinkById($prod_category->id_parent);
            if ($link_parent == ''){
                $link_parent = SITE_PAGE_PRODUCT_STRING;
            }
            $prod_category->link = trim($link_parent . '/' .$prod_category->link, '/');
            if ($prod_category->validateInput()) {
                $prod_category->update();
                if ($_FILES['image']['size'] > 0 && !empty($_FILES['image']['tmp_name'])){
                    if ($prod_category->addPicture()) redirect($back);
                }
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['prod_category'] = $prod_category;
        $this->data['categories'] = $categories;
        $this->data['id_parent'] = $id_parent;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }
    
    function recreateImage($image_id, $id_product_category) {
        
        $back = base_url('prod_category');
        User::checkAccessable($this->session->userdata('userID'), 'prod_category/recreateImage');
        
        $prod_category = new ProductCategory();
        
        if (!$id_product_category || !$prod_category->get($id_product_category)) {
            redirect($back);
        }
        
        $img = new Image();
        
        if (!$image_id || !$img->get($image_id))
            redirect('prod_category/edit/'.$prod_category->id);
        
        if (!$img->recreate()) {
            
            if (MessageHandler::countError() > 0) {
                $messages = MessageHandler::getMessages();
                
                foreach ($messages as $msg) {
                    if ($msg['type'] == MSG_ERROR) {
                        $msg = $msg['message'];
                        redirect('prod_category/edit/'.$prod_category->id, null, null, $msg, MSG_ERROR);
                        break;
                    }
                }
            }
            
        }
        
        redirect('prod_category/edit/'.$prod_category->id);
        
    }
    
    function deleteImage($image_id, $id_prod_category) {
        
        $back = base_url('prod_category');
        User::checkAccessable($this->session->userdata('userID'), 'prod_category/deleteImage');
        
        $prod_category = new ProductCategory();
        
        if (!$id_prod_category || !$prod_category->get($id_prod_category)) {
            redirect($back);
        }
        
        $img = new Image();
        
        if (!$image_id || !$img->get($image_id))
            redirect('prod_category/edit/'.$prod_category->id);
        
        $prod_category->deletePicture($image_id);
        
        redirect('prod_category/edit/'.$prod_category->id);
        
    }
    
}
