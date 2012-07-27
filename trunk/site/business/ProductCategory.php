<?php

class ProductCategory extends Product_category_model {

    var $if;
    public static $lang;
    function __construct() {
        parent::__construct();
        $this->if = new DbInfo();
        self::$lang = get_system_language();
    }

    public function getCategoryByLink($link = '') {
        
        $Category = new ProductCategory();
        $Category->addSelect();
        $Category->addSelect($this->if->_product_category_id . ' as ' . $this->if->_product_category_as_id);
        $Category->addSelect($this->if->_product_category_link . ' as ' . $this->if->_product_category_as_link);
        $Category->addSelect($this->if->_product_category_name . ' as ' . $this->if->_product_category_as_name);
        $Category->addSelect($this->if->_product_category_description . ' as ' . $this->if->_product_category_as_description);
        $Category->addSelect($this->if->_product_category_meta_description . ' as ' . $this->if->_product_category_as_meta_description);
        $Category->addSelect($this->if->_product_category_keywords . ' as ' . $this->if->_product_category_as_keywords);
        $Category->addWhere($this->if->_product_category_link . " = '" . $link . "'");
        $Category->find();
        return $Category;
        
    }
    
    /*don't use*/
    public function getCategoryChildByParentId($id){
        $Category = new ProductCategory();
        $Category->addSelect();
        $Category->addSelect($this->if->_product_category_id . 'as' . $this->if->_product_category_as_id);
        $Category->addWhere($this->if->_product_category_id_parent . '=' . $id);
        $Category->find();
        return $Category;
    }
    
    public function get_prod_cate_name(){
        return getI18n($this->{$this->if->_product_category_as_name}, self::$lang);
    }
    public function get_prod_cate_id() {
        return $this->{$this->if->_product_category_as_id};
    }
    
    public function get_prod_cate_link(){
        return $this->{$this->if->_product_category_as_link};
    }
    public function get_prod_cate_meta_description(){
        return getI18n($this->{$this->if->_product_category_as_description}, self::$lang);
    }
    public function get_prod_cate_description() {
        return getI18n($this->{$this->if->_product_category_as_description}, self::$lang);
    }

    public function get_prod_cate_keywords() {
        return getI18n($this->{$this->if->_product_category_as_keywords}, self::$lang);
    }

}
