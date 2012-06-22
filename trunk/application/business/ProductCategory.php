<?php

class ProductCategory extends Product_category_model {

    function __construct() {
            parent::__construct();
    }

    function getList($filter = array()) {

        $prod_category = new ProductCategory();
        $prod_category->addJoin(new Image(), 'LEFT');
        $prod_category->addSelect();
        $prod_category->addSelect('product_category.*, image.file picture');
        $prod_category->addWhere('product_category.is_deleted = '.IS_NOT_DELETED);

        if (isset($filter['name']) && $filter['name'])
            $prod_category->addWhere("product_category.name LIKE '%".$filter['name']."%'");

        if (isset($filter['keywords']) && $filter['keywords'])
            $prod_category->addWhere("FIND_IN_SET('".$filter['keywords']."', product_category.keywords)");

        $prod_category->find();
        return $prod_category;

    }

    function getTree($filter = array(), $id_prod_category_excluded = null) {

        $arrProdCategory = array();

        $prod_category = new ProductCategory();
        $prod_category->addJoin(new Image(), 'LEFT');
        $prod_category->addSelect();
        $prod_category->addSelect('product_category.*, image.file picture');

        $prod_category->addWhere('is_deleted = '.IS_NOT_DELETED);
        
        if ($id_prod_category_excluded)
            $prod_category->addWhere("product_category.id <> $id_prod_category_excluded");

        if (isset($filter['id_prod_category_parent']) && $filter['id_prod_category_parent'])
            $prod_category->addWhere("FIND_IN_SET('".$filter['id_prod_category_parent']."', id_parent)");
        else
            $prod_category->addWhere("id_parent IS NULL");

        if (!isset($filter['level']))
            $filter['level'] = 0;
        else
            $filter['level'] += 1;

        $prod_category->find();

        while ($prod_category->fetchNext()) {
            $arrProdCategory[] = array(
                        'id' => $prod_category->id,
                        'code' => $prod_category->code,
                        'name' => $prod_category->name,
                        'description' => $prod_category->description,
                        'id_parent' => $prod_category->id_parent,
                        'picture' => $prod_category->picture,
                        'link' => $prod_category->link,
                        'keywords' => $prod_category->keywords,
                        'level' => $filter['level']
                    ); 
            $filter['id_prod_category_parent'] = $prod_category->id;
            $arrProdCategory = array_merge($arrProdCategory, ProductCategory::getTree($filter, $id_prod_category_excluded));
        }

        return $arrProdCategory;

    }

    function validateInput() {

        $this->code = strtoupper(trim($this->code));
        $this->name = trim($this->name);
        $this->description = trim($this->description);
        $this->keywords = trim(trim($this->keywords),',');
        $this->link = trim($this->link);
        
        if (!$this->code || $this->code == "") {
            MessageHandler::add (lang('err_empty_product_category_code'), MSG_ERROR, MESSAGE_ONLY);
        }
        elseif ($this->isExistedByCode()) {
            MessageHandler::add (lang('err_product_category_code_exists'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->name == "") {
            MessageHandler::add (lang('err_empty_product_category_name'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->link == "") {
            MessageHandler::add (lang('err_empty_product_category_link'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        $lang = Language::getList();
        
        while ($lang->fetchNext()) {
                
            if (strlen(getI18n($this->name, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_name_too_long').': '.lang('msg_please_check'). ' "'.getI18n($this->name, $lang->code).'"', MSG_ERROR, MESSAGE_ONLY);
            }
            
            if (strlen(getI18n($this->description, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_desc_too_long').': '.lang('msg_please_check'). ' "'.getI18n($this->description, $lang->code).'"', MSG_ERROR, MESSAGE_ONLY);
            }
                
        }
        
        return MessageHandler::countError() > 0 ? false : true;
    }
    
    function isExistedByCode() {
        $product_category = new ProductCategory();
        
        if ($this->id)
            $product_category->addWhere("id <> $this->id");
        
        $product_category->addWhere("code = '$this->code'");
        $product_category->addSelect();
        $product_category->addSelect("COUNT(*) count");
        $product_category->find();
        $product_category->fetchNext();
        
        return $product_category->count > 0 ? true : false;
    }
    
    function delete() {
        
        $this->is_deleted = 1;
        $this->code = appendIdtoName($this->id, $this->code);
        $this->name = appendIdtoName($this->id, $this->name);
        $this->update();
        
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
        
        if ($image->upload($field, IMG_PRODUCT_CATEGORY_CODE, array('name' => $this->code, 'description' => getI18n($this->name)))) {
            
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
