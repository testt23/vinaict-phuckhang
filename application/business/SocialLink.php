<?php

class SocialLink extends Social_link_model {

    function __construct() {
            parent::__construct();
    }

    function getList($filter = array()) {

        $social_link = new SocialLink();
        $social_link->addJoin(new Image(), 'LEFT');
        $social_link->addSelect();
        $social_link->addSelect('social_link.*, image.file picture');

        if (isset($filter['name']) && $filter['name'])
            $social_link->addWhere("social_link.name LIKE '%".$filter['name']."%'");

        if (isset($filter['is_social']) && $filter['is_social'])
            $social_link->addWhere("social_link.is_social = ".$filter['is_social']);
        
        $social_link->find();
        return $social_link;

    }

    function validateInput() {

        $this->name = trim($this->name);
        $this->url = trim($this->url);     
        if ($this->name == "") {
            MessageHandler::add (lang('err_empty_social_link_name'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->url == "") {
            MessageHandler::add (lang('err_empty_social_link_url'), MSG_ERROR, MESSAGE_ONLY);
        }
//        elseif (!validate_uri($this->link, URI_PATTERN, PROD_CATEGORY_URI_PREFIX, PROD_CATEGORY_URI_SUFFIX)) {
//            MessageHandler::add (lang('err_invalid_link'), MSG_ERROR, MESSAGE_ONLY);
//        }
        
        $lang = Language::getList();
        
        while ($lang->fetchNext()) {
                
            if (strlen(getI18n($this->name, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_name_too_long').': '.lang('msg_please_check'). ' "'.getI18n($this->name, $lang->code).'"', MSG_ERROR, MESSAGE_ONLY);
            }
                            
        }
        
        return MessageHandler::countError() > 0 ? false : true;
    }
    
    function isExistedByCode() {
        $social_link = new SocialLink();
        
        if ($this->id)
            $social_link->addWhere("id <> $this->id");
        
        $social_link->addWhere("code = '$this->code'");
        $social_link->addSelect();
        $social_link->addSelect("COUNT(*) count");
        $social_link->find();
        $social_link->fetchNext();
        
        return $social_link->count > 0 ? true : false;
    }
    
        
    function addPictureById ($id_picture = null) {
        
        if ($id_picture) {
            
            $image = new Image();
            
            if ($image->get($id_picture)) {
                
                if ($this->id_image) {
                    $img = new Image();
                    if ($img->get($this->id_image)) {
                        $img->delete();
                    }
                }
                
                $this->id_image = $image->id;
                $this->update();
                
                if ($image->name != $this->code || $image->description != getI18n($this->name)) {
                    $image->name = $this->code;
                    $image->description = getI18n($this->name);
                    $image->update();
                }
                
            }
            
        }
        
    }
    
    function addPicture($field = 'image') {
        
        $image = new Image(); 
        if ($image->upload($field, IMG_SOCIAL_LINK_CODE, array('name' => $this->name, 'description' => getI18n($this->name)))) {
            if ($this->id_image) {
                $img = new Image();
                if ($img->get($this->id_image)) {
                    $img->delete();
                }
            }
            
            $this->id_image = $image->id;
            
            if ($this->id)
                $this->update();
            
            return true;
            
        }
        else {
            return false;
        }
        
    }
    
    function deletePicture($id) {
        
        $image = new Image();
        $image->get($id);
        $image->delete();
        $this->id_image = '0';
        $this->update();
        
    }
                
}