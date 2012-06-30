<?php

class PurchaseOrder extends Purchase_order_model {
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function getList($filter = array()) {
        
        $purchase_order = new PurchaseOrder();
        $purchase_order->addJoin(new Customer);
        $purchase_order->addWhere('purchase_order.is_deleted = '.IS_NOT_DELETED);
        $purchase_order->addSelect();
        $purchase_order->addSelect('purchase_order.*, purchase_order.id id_order, customer.*');
      
        $purchase_order->find();
        
        return $purchase_order;
        
    }
    
    
    function delete() {
        
        $this->is_deleted = 1; 
        
        //$this->code = appendIdtoName($this->id, $this->code);
        //$this->name = appendIdtoName($this->id, $this->name);
        
        $this->update();
        
        
    }
    
    function setStatus($id_status = NULL) {
        
        $pos = new PurchaseOrderStatus();
        
        if (!$id_status || !$pos->get($id_status))
            return FALSE;
        
        $this->status = $id_status;
        $this->update();
        
        return TRUE;
        
    }
    
    function status_prev() {
        
        //$this->code = appendIdtoName($this->id, $this->code);
        //$this->name = appendIdtoName($this->id, $this->name);
        
        $this->update();
    
    }
    
    //////////////////////////////////////////////////////////////////
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
            MessageHandler::add (lang('err_empty_purchase_order_code'), MSG_ERROR, MESSAGE_ONLY);
        }
        elseif ($this->isExistedByCode()) {
            MessageHandler::add (lang('err_purchase_order_code_exists'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->name == "") {
            MessageHandler::add (lang('err_empty_purchase_order_name'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if ($this->link == "") {
            MessageHandler::add (lang('err_empty_purchase_order_link'), MSG_ERROR, MESSAGE_ONLY);
        }
        elseif (!validate_uri($this->link, URI_PATTERN, PRODUCT_URI_PREFIX, PRODUCT_URI_SUFFIX)) {
            MessageHandler::add (lang('err_invalid_link'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if (!$this->id_prod_category) {
            MessageHandler::add (lang('err_empty_purchase_order_category'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        if (!$this->id_primary_prod_category) {
            MessageHandler::add (lang('err_empty_primary_purchase_order_category'), MSG_ERROR, MESSAGE_ONLY);
        }
        
        while ($lang->fetchNext()) {
                
            if (strlen(getI18n($this->name, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_purchase_order_name_too_long').': '.lang('msg_please_check'). ' "'.getI18n($this->name, $lang->code).'"', MSG_ERROR, MESSAGE_ONLY);
            }
            
            if (strlen(getI18n($this->short_description, $lang->code)) > MAX_LENGTH_NAME) {
                MessageHandler::add (lang('err_short_desc_too_long').': '.lang('msg_please_check'). ' "'.getI18n($this->short_description, $lang->code).'"', MSG_ERROR, MESSAGE_ONLY);
            }
                
        }
        
        return MessageHandler::countError() > 0 ? false : true;
    }
    
    function isExistedByCode() {
        $purchase_order = new PurchaseOrder();
        
        if ($this->id)
            $purchase_order->addWhere("id <> $this->id");
        
        $purchase_order->addWhere("code = '$this->code'");
        $purchase_order->addSelect();
        $purchase_order->addSelect("COUNT(*) count");
        $purchase_order->find();
        $purchase_order->fetchNext();
        
        return $purchase_order->count > 0 ? true : false;
    }
    
    function generateCode() {
        
        if ($this->id_primary_prod_category) {
            $prod_category = new PurchaseOrderCategory();
            $prod_category->get($this->id_primary_prod_category);
            
            $prod = new PurchaseOrder();
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
    
    function addPictureById ($id_picture = null) {
        
        if ($id_picture) {
            
            $image = new Image();
            
            if ($image->get($id_picture)) {
                
                if (!$this->id_prod_image || $this->id_prod_image == '')
                    $this->id_prod_image = $image->id;
                else {
                    $pictures = explode(',', $this->id_prod_image);
                    
                    if (!in_array($id_picture, $pictures))
                        $this->id_prod_image .= ",$image->id";
                }
                
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
