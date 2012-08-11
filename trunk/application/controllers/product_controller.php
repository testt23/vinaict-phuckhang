<?php

    class Product_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        $section = "product";
        
        User::checkAccessable($this->session->userdata('userID'), "product");
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_product') => base_url('product'))
        );
        
        $filter = array();
        $filter['code'] = $this->input->get_post('code');
        $filter['name'] = $this->input->get_post('name');
        $filter['keywords'] = $this->input->get_post('keywords');
        $filter['id_prod_category'] = $this->input->get_post('category');
        $filter['is_featured'] = $this->input->get_post('is_featured');
        $filter['disable_yes'] = $this->input->get_post('disable_yes');
        $filter['disable_no'] = $this->input->get_post('disable_no');
        $filter['option_price'] = $this->input->get_post('option_price');
        $filter['price'] = $this->input->get_post('price');
        $filter['currency'] = $this->input->get_post('currency');
        $filter['sort_by'] = $this->input->get_post('sort_by');
        $total_record = Product::getTotalRecord($filter);
        $filter['limit'] = $this->input->get_post('limit');
        if (!$filter['limit'] || !is_numeric($filter['limit']))
            $filter['limit'] = 10;
        $pagination = new Pagination($this, $total_record, $filter['limit']);
        
        $filter['start'] = $pagination->start;
        $product = Product::getList($filter);
        
        $this->data['categories'] = ProductCategory::getTree();
        $this->data['product'] = $product;
        $this->data['filter'] = $filter;
        $this->data['pagination'] = $pagination->get_html(2);
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);

        $this->data['cfer'] = $cfer;
        $this->data['array_menus'] = $array_menus;
        $this->data['section'] = $section;
        $this->data['image_group_code'] = IMG_PRODUCT_CODE;
        
        $this->load->view('main', $this->data); 
    }
    
    function toggleStatus($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'product/toggleStatus');
        $back = base_url('product');
        
        $product = new Product();
        
        if ($id && $product->get($id)) {
            $product->toggleStatus();
        }
        
        redirect($back);
        
    }

    function delete($id = null) {
        
        User::checkAccessable($this->session->userdata('userID'), 'product/delete');
        $back = base_url('product');
        
        $product = new Product();

        if ($id && !$product->get($id)) {
            redirect($back);
        }
        
        $product->delete();
        redirect($back);
    
    }
    
    function add() {
        
        User::checkAccessable($this->session->userdata('userID'), 'product/add');
        $back = base_url('product');
        $section = 'product_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_product') => $back,
            lang('txt_add_product') => base_url('product/add/')));
        
        $act = $this->input->get_post('act');
    
        $product = new Product();
        $currency = Currency::getList();
        $categories = ProductCategory::getTree();
        $arr_prod_category = array();
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $product->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('short_description_'.$lang->code)) {
                    $product->short_description .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('short_description_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('description_'.$lang->code)) {
                    $product->description .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('description_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            $product->code = utf8_escape_textarea($this->input->post('code'));
            $product->link = utf8_escape_textarea($this->input->post('link'));
            $product->price = $this->input->post('price');
            $product->currency = $this->input->post('currency');
            $product->keywords = utf8_escape_textarea($this->input->post('keywords'));
            $product->is_disabled = $this->input->post('is_disabled');
            $product->id_prod_category = $this->input->post('id_prod_category');
            $product->id_primary_prod_category = $this->input->post('id_primary_product_category');
            $product->is_featured = $this->input->post('is_featured');
            
            if ($product->id_prod_category) {
                if (is_array($product->id_prod_category)) {
                    $arr_prod_category = $product->id_prod_category;
                    $product->id_prod_category = implode(',', $arr_prod_category);
                }
                else {
                    $arr_prod_category[] = $product->id_prod_category;
                }
            }
            
            if (!$product->code || $product->code == '')
                $product->generateCode();
            
            if ($product->validateInput()) {
                $product->insert();
                $product->link = $product->link . '-' . $product->id;
                $product->update();
                redirect('product/detail/'.$product->id);
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['product'] = $product;
        $this->data['currency'] = $currency;
        $this->data['categories'] = $categories;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        $this->data['arr_prod_category'] = $arr_prod_category;
        
        $this->load->view('main', $this->data);
        
    }
    
    function edit($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'product/edit');
        $back = base_url('product');
        $section = 'product_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_product') => $back,
            lang('txt_edit_product') => base_url('product/edit/'.$id)));
        
        $act = $this->input->get_post('act');
    
        $product = new Product();
        
        if (!$id || !$product->get($id))
            redirect($back);
        
        $currency = Currency::getList();
        $categories = ProductCategory::getTree();
        
        $arr_prod_category = $product->id_prod_category ? explode(',', $product->id_prod_category) : array();
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            $product->name = '';
            $product->short_description = '';
            $product->description = '';
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $product->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('short_description_'.$lang->code)) {
                    $product->short_description .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('short_description_'.$lang->code)).'</'.$lang->code.'>';
                }
                
                if ($this->input->post('description_'.$lang->code)) {
                    $product->description .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('description_'.$lang->code)).'</'.$lang->code.'>';
                }
                
            }
            
            $product->code = utf8_escape_textarea($this->input->post('code'));
            $product->link = utf8_escape_textarea($this->input->post('link')) . '-' . $product->id;
            $product->price = $this->input->post('price');
            $product->currency = $this->input->post('currency');
            $product->keywords = utf8_escape_textarea($this->input->post('keywords'));
            $product->is_disabled = $this->input->post('is_disabled');
            $product->id_prod_category = $this->input->post('id_prod_category');
            $product->id_primary_prod_category = $this->input->post('id_primary_product_category');
            $product->is_featured = $this->input->post('is_featured');
            
            if ($product->id_prod_category) {
                if (is_array($product->id_prod_category)) {
                    $arr_prod_category = $product->id_prod_category;
                    $product->id_prod_category = implode(',', $arr_prod_category);
                }
                else {
                    $arr_prod_category[] = $product->id_prod_category;
                }
            }
            
            if (!$product->code || $product->code == '')
                $product->generateCode();
            
            if ($product->validateInput()) {
                $product->update();
                
                if ($product->id_prod_image && $product->id_def_image)
                    redirect($back);
                else
                    redirect('product/detail/'.$product->id);
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['product'] = $product;
        $this->data['currency'] = $currency;
        $this->data['categories'] = $categories;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        $this->data['arr_prod_category'] = $arr_prod_category;
        
        $this->load->view('main', $this->data);
    }
    
    
    function detail($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'product/detail');
        $back = base_url('product');
        $section = 'product_detail';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_product') => $back,
            lang('txt_product_detail') => base_url('product/detail/'.$id)));
        
        $act = $this->input->get_post('act');
    
        $product = new Product();
        
        if (!$id || !$product->get($id))
            redirect($back);
        
        if ($act == ACT_SUBMIT) {
            
            $product->addPicture();
            
        }
        
        if (!$product->id_prod_image || $product->id_prod_image == '')
            MessageHandler::add(lang('msg_product_has_no_picture_uploaded'), MSG_WARNING, MESSAGE_ONLY);
        elseif (!$product->id_def_image || $product->id_def_image == '')
            MessageHandler::add(lang('msg_product_no_presentative_picture'), MSG_WARNING, MESSAGE_ONLY);
        
        $picture = $product->getPictures();
        $pro_det = $product->getProductByID($id);
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['product'] = $product;
        $this->data['pro_det'] = $pro_det;
        $this->data['picture'] = $picture;
        $this->data['image_path'] = 'images/';
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }
    
    function uploadImage($field, $image_name = null, $image_description = '') {
        
        if (!$image_name)
            $data = null;
        else
            $data = array('name' => $image_name, 'description' => $image_description);
        
        $img = new Image();
        $img = $img->upload($field, IMG_PRODUCT_CODE, $data);
        
        return $img;
        
    }
    
    function deleteImage($image_id, $id_product) {
        
        $back = base_url('product');
        User::checkAccessable($this->session->userdata('userID'), 'product/deleteImage');
        
        $product = new Product();
        
        if (!$id_product || !$product->get($id_product)) {
            redirect($back);
        }
        
        $img = new Image();
        
        if (!$image_id || !$img->get($image_id))
            redirect('product/detail/'.$product->id);
        
        $product->deletePicture($image_id);
        
        redirect('product/detail/'.$product->id);
        
    }
    
    function setDefaultImage($image_id, $id_product) {
        
        $back = base_url('product');
        User::checkAccessable($this->session->userdata('userID'), 'product/setDefaultImage');
        
        $product = new Product();
        
        if (!$id_product || !$product->get($id_product)) {
            redirect($back);
        }
        
        $img = new Image();
        
        if (!$image_id || !$img->get($image_id))
            redirect('product/detail/'.$product->id);
        
        $product->id_def_image = $image_id;
        $product->update();
        
        redirect('product/detail/'.$product->id);
        
    }
    
    function recreateImage($image_id, $id_product) {
        
        $back = base_url('product');
        User::checkAccessable($this->session->userdata('userID'), 'product/recreateImage');
        
        $product = new Product();
        
        if (!$id_product || !$product->get($id_product)) {
            redirect($back);
        }
        
        $img = new Image();
        
        if (!$image_id || !$img->get($image_id))
            redirect('product/detail/'.$product->id);
        
        if (!$img->recreate()) {
            
            if (MessageHandler::countError() > 0) {
                $messages = MessageHandler::getMessages();
                
                foreach ($messages as $msg) {
                    if ($msg['type'] == MSG_ERROR) {
                        $msg = $msg['message'];
                        redirect('product/detail/'.$product->id, null, null, $msg, MSG_ERROR);
                        break;
                    }
                }
            }
            
        }
        
        redirect('product/detail/'.$product->id);
        
    }
    
    
}
