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
        $prod_category = ProductCategory::getList($filter);
        
        while($prod_category->fetchNext()) {
            $arr_prod_category[$prod_category->id] = array('code' => $prod_category->code,
                                                'name' => getI18n($prod_category->name),
                                                'description' => truncateString(clean_html(getI18n($prod_category->description)), 100),
                                                'link' => getI18n($prod_category->link),
                                                'picture' => $prod_category->picture,
                                                'keywords' => $prod_category->keywords,
                                                'id_parent' => $prod_category->id_parent
                                                );
        }
        
        $this->data['arr_prod_category'] = $arr_prod_category;
        $this->data['image_group_code'] = 'prod_category';
        $this->data['filter'] = $filter;

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
        $arr_parent = array();
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $prod_category->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('description_'.$lang->code)) {
                    $prod_category->description .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('description_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('link_'.$lang->code)) {
                    $prod_category->link .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('link_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            $prod_category->code = $this->input->post('code');
            $prod_category->keywords = $this->input->post('keywords');
            $prod_category->id_parent = $this->input->post('id_parent');
            
            if ($prod_category->id_parent) {
                if (is_array($prod_category->id_parent)) {
                    $arr_parent = $prod_category->id_parent;
                    $prod_category->id_parent = implode(',', $arr_parent);
                }
                else {
                    $arr_parent[] = $prod_category->id_parent;
                }
            }
            
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
        $this->data['arr_parent'] = $arr_parent;
        $this->data['categories'] = $categories;
        $this->data['arr_parent'] = $arr_parent;
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
        $arr_parent = array();
        
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
            $prod_category->link = '';
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $prod_category->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('description_'.$lang->code)) {
                    $prod_category->description .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('description_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('link_'.$lang->code)) {
                    $prod_category->link .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('link_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            $prod_category->code = $this->input->post('code');
            $prod_category->keywords = $this->input->post('keywords');
            $prod_category->id_parent = $this->input->post('id_parent');
            
            if ($prod_category->id_parent) {
                if (is_array($prod_category->id_parent)) {
                    $arr_parent = $prod_category->id_parent;
                    $prod_category->id_parent = implode(',', $arr_parent);
                }
                else {
                    $arr_parent[] = $prod_category->id_parent;
                }
            }
            
            if ($prod_category->validateInput()) {
                $prod_category->update();
                
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
        $this->data['arr_parent'] = $arr_parent;
        $this->data['categories'] = $categories;
        $this->data['arr_parent'] = $arr_parent;
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
