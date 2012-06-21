<?php

class Product extends Product_model {
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function getList($filter = array()) {
        
        $product = new Product();
        $product->addJoin(new Image(), 'LEFT', 'image img', 'img.id = product.id_def_image');
        $product->addSelect();
        $product->addSelect('product.*, img.file picture');
        
        if (isset($filter['code']) && $filter['code'])
            $product->addWhere("code LIKE '%".$filter['code']."%'");
        
        if (isset($filter['name']) && $filter['name'])
            $product->addWhere("name LIKE '%".$filter['name']."%'");
        
        if (isset($filter['description']) && $filter['description']) {
            $product->addWhere("(short_description LIKE '%".$filter['description']."%'");
            $product->addWhere("description LIKE '%".$filter['description']."%')", "OR");
        }
        
        if (isset($filter['keywords']) && $filter['keywords'])
            $product->addWhere("FIND_IN_SET(keywords, '".$filter['keywords']."')");
        
        if (isset($filter['id_prod_category']) && $filter['id_prod_category'])
            $product->addWhere('id_prod_category = '.$filter['id_prod_category']);
        
        $product->orderBy("product.id");
        $product->orderBy(getI18nRealStringSql("product.name"));
        
        $product->find();
        
        return $product;
        
    }
    
    function validateInput() {

        $this->code = strtoupper(trim($this->code));
        $this->name = trim($this->name);
        $this->short_description = trim($this->short_description);
        $this->description = trim($this->description);
        $this->price = trim($this->price);
        $this->currency = trim($this->currency);
        $this->keywords = trim(trim($this->keywords),',');
        $this->link = trim($this->link);
        
        $lang = Language::getList();
        
        if (!$this->code || $this->code == "") {
            MessageHandler::add (lang('err_empty_product_code'), MSG_ERROR, MESSAGE_ONLY);
        }
        elseif ($this->isExistedByCode()) {
            MessageHandler::add (lang('err_product_code_exists'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->name == "") {
            MessageHandler::add (lang('err_empty_product_name'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->link == "") {
            MessageHandler::add (lang('err_empty_product_link'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if (!$this->id_prod_category) {
            MessageHandler::add (lang('err_empty_product_category'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if (!$this->id_primary_prod_category) {
            MessageHandler::add (lang('err_empty_primary_product_category'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        while ($lang->fetchNext()) {
                
            if (strlen(getI18n($this->name, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_product_name_too_long').': '.lang('msg_please_check'). ' "'.getI18n($this->name, $lang->code).'"', MSG_ERROR, MESSAGE_ONLY);
            }
            
            if (strlen(getI18n($this->short_description, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_short_desc_too_long').': '.lang('msg_please_check'). ' "'.getI18n($this->short_description, $lang->code).'"', MSG_ERROR, MESSAGE_ONLY);
            }
            
            if (strlen(getI18n($this->link, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_url_too_long').': '.lang('msg_please_check'). ' "'.getI18n($this->link, $lang->code).'"', MSG_ERROR, MESSAGE_ONLY);
            }
                
        }
        
        return MessageHandler::countError() > 0 ? false : true;
    }
    
    function isExistedByCode() {
        $product = new Product();
        
        if ($this->id)
            $product->addWhere("id <> $this->id");
        
        $product->addWhere("code = '$this->code'");
        $product->addSelect();
        $product->addSelect("COUNT(*) count");
        $product->find();
        $product->fetchNext();
        
        return $product->count > 0 ? true : false;
    }
    
    function generateCode() {
        
        if ($this->id_primary_prod_category) {
            $prod_category = new ProductCategory();
            $prod_category->get($this->id_primary_prod_category);
            
            $prod = new Product();
            $prod->addSelect();
            $prod->addSelect('COUNT(*) count');
            $prod->find();
            $prod->fetchNext();
            
            $this->code = $prod_category->code.sprintf('%05d', ($prod->count + 1));
        }
        
    }
    
    function toggleStatus() {
       $this->is_disabled =  $this->is_disabled == IS_DISABLED ? "'".IS_NOT_DISABLED."'" : IS_DISABLED;
       $this->update();
    }
    
    function delete() {
        
        $this->is_deleted = 1;
        $this->code = appendIdtoName($this->id, $this->code);
        $this->name = appendIdtoName($this->id, $this->name);
        $this->update();
        
    }
    
    function getPictures() {
        
        if (!$this->id || !$this->id_prod_image || trim($this->id_prod_image) == '')
            return false;
        
        $img = new Image();
        $img->addJoin(new ImageGroup());
        $img->addWhere("image.id IN ($this->id_prod_image)");
        $img->addSelect();
        $img->addSelect('image.*, CONCAT(image_group.code, \'/\', image.file) image_path');
        $img->find();
        return $img;
        
    }
    
    function deletePicture($id) {
        
        $image = new Image();
        $image->get($id);
        $image->delete();
        $arr_img_id = explode(",", $this->id_prod_image);
        
        $found = array_search($id, $arr_img_id);
        
        if ($this->id_def_image == $arr_img_id[$found]) {
            $this->id_def_image = '0';
        }
        
        unset($arr_img_id[$found]);
        
        if (count($arr_img_id) > 0)
            $this->id_prod_image = implode(',', $arr_img_id);
        else
            $this->id_prod_image = '';
        
        $this->update();
        
    }
    
    function deleteAllPictures() {
        
        $image = new Image();
        $image->addWhere("id IN ($this->id_prod_image)");
        $image->addSelect();
        $image->addSelect('id');
        $image->find();
        
        while ($image->fetchNext()) {
            
            $img = new Image();
            $img->get($image->id);
            $img->delete();
            
        }
        
        $this->id_prod_image = '';
        $this->id_def_image = 0;
        $this->update();
        
    }
    
    function addPicture($field = 'image') {
        
        $image = new Image();
        
        if ($image->upload($field, IMG_PRODUCT_CODE, array('name' => $this->code, 'description' => getI18n($this->name)))) {
            
            if (!$this->id_prod_image || $this->id_prod_image == '')
                $this->id_prod_image = $image->id;
            else
                $this->id_prod_image .= ",$image->id";
            
            $this->update();
            
            return true;
            
        }
        else {
            return false;
        }
        
    }
    
}
