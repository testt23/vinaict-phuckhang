<?php

	class Social_link_controller extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        
        User::checkAccessable($this->session->userdata('userID'), 'social_link');

        $section = "social_link";
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_social_link') => base_url('social_link'))
        );
        
        $filter = array();
        $arr_social_link = Array();
        $filter['name'] = $this->input->get_post('name');
        $social_link = SocialLink::getList($filter);
//        echo '<pre>';
//        var_dump($social_link);
//        echo '</pre>';
        if($social_link){
            while($social_link->fetchNext()) {
                $arr_social_link[$social_link->id] = array('name' => getI18n($social_link->name),
                                                    'url' => $social_link->url,
                                                    'picture' => $social_link->picture,
                                                    'is_social' => $social_link->is_social
                                                    );
            }
        }
        $this->data['arr_social_link'] = $arr_social_link;
        $this->data['image_group_code'] = 'social';
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
        
        User::checkAccessable($this->session->userdata('userID'), 'social_link/delete');
        $back = base_url('social_link');
        
        $social_link = new SocialLink();

        if ($id && !$social_link->get($id)) {
            redirect($back);
        }
        
        $social_link->delete();
        redirect($back);
    
    }
    
    function add() {
        
        User::checkAccessable($this->session->userdata('userID'), 'social_link/add');
        $back = base_url('social_link');
        $section = 'social_link_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_social_link') => $back,
            lang('txt_add_social_link') => base_url('social_link/add/')));
        
        $act = $this->input->get_post('act');
    
        $social_link = new SocialLink();
        $arr_parent = array();
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
                                    
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $social_link->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
               
            }
            
            $social_link->url = utf8_escape_textarea($this->input->post('url'));
            $social_link->is_social = $this->input->post('is_social');
                        
            if ($social_link->validateInput()) {
                $social_link->insert();
                if (!empty($_FILES['image']['name'])) {
                    $social_link->addPicture();
                }
                
                redirect($back);
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['social_link'] = $social_link;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }
    
    function edit($id) {
        
        User::checkAccessable($this->session->userdata('userID'), 'social_link/edit');
        $back = base_url('social_link');
        $section = 'social_link_form';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_social_link') => $back,
            lang('txt_edit_social_link') => base_url('social_link/edit/'.$id)));
        
        if (!$id)
            redirect($back);
        
        $act = $this->input->get_post('act');
    
        $social_link = new SocialLink();
        
        if (!$social_link->get($id))
            redirect($back);
        
        if (!$social_link->id_image)
            MessageHandler::add(lang('msg_social_link_has_no_picture_uploaded'), MSG_WARNING, MESSAGE_ONLY);
        
        
        
        $image = new Image();
        
        if ($image->get($social_link->id_image)) {
            $img_urls = $image->getImageURLs();
            $this->data['img_urls'] = $img_urls;
            $this->data['image'] = $image;
        }
        
        if ($act == ACT_SUBMIT) {
            
            $lang = Language::getList();
            
            $social_link->url = '';
            $social_link->name ='';
            
            while($lang->fetchNext()) {
                
                if ($this->input->post('name_'.$lang->code)) {
                    $social_link->name .= '<'.$lang->code.'>'.utf8_escape_textarea($this->input->post('name_'.$lang->code)).'</'.$lang->code.'>';
                }
               
                
            }
            
            $social_link->url = utf8_escape_textarea($this->input->post('url'));
            $social_link->is_social = $this->input->post('is_social');
            
                        
            if ($social_link->validateInput()) {
                $social_link->update();
                if (!empty($_FILES['image']['name'])) {
                    $social_link->addPicture();
                }
                
                redirect($back);
            }
            
        }
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $this->data['social_link'] = $social_link;
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
        
    }
    
    function recreateImage($image_id, $id_product_category) {
        
        $back = base_url('social_link');
        User::checkAccessable($this->session->userdata('userID'), 'social_link/recreateImage');
        
        $social_link = new SocialLink();
        
        if (!$id_product_category || !$social_link->get($id_product_category)) {
            redirect($back);
        }
        
        $img = new Image();
        
        if (!$image_id || !$img->get($image_id))
            redirect('social_link/edit/'.$social_link->id);
        
        if (!$img->recreate()) {
            
            if (MessageHandler::countError() > 0) {
                $messages = MessageHandler::getMessages();
                
                foreach ($messages as $msg) {
                    if ($msg['type'] == MSG_ERROR) {
                        $msg = $msg['message'];
                        redirect('social_link/edit/'.$social_link->id, null, null, $msg, MSG_ERROR);
                        break;
                    }
                }
            }
            
        }
        
        redirect('social_link/edit/'.$social_link->id);
        
    }
    
    function deleteImage($image_id, $id_social_link) {
        
        $back = base_url('social_link');
        User::checkAccessable($this->session->userdata('userID'), 'social_link/deleteImage');
        
        $social_link = new SocialLink();
        
        if (!$id_social_link || !$social_link->get($id_social_link)) {
            redirect($back);
        }
        
        $img = new Image();
        
        if (!$image_id || !$img->get($image_id))
            redirect('social_link/edit/'.$social_link->id);
        
        $social_link->deletePicture($image_id);
        
        redirect('social_link/edit/'.$social_link->id);
        
    }
    
}
