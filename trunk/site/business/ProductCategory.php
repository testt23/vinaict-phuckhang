<?php

class ProductCategory extends Product_category_model {

    var $if;

    function __construct() {
        parent::__construct();
        $this->if = new DbInfo();
    }

    public function getProdCategoryByLink($link = '') {
        
        $Category = new ProductCategory();
        $Category->addSelect();
        $Category->addSelect($this->if->_product_category_id . ' as ' . $this->if->_product_category_as_id);
        $Category->addSelect($this->if->_product_category_link . ' as ' . $this->if->_product_category_as_link);
        $Category->addWhere($this->if->_product_category_link . " = '" . $link . "'");
        $Category->addSelect($this->if->_product_category_description . ' as ' . $this->if->_product_category_as_description);
        $Category->addSelect($this->if->_product_category_keywords . ' as ' . $this->if->_product_category_as_keywords);

        $Category->find();
        
        $Category->fetchNext();
        return $Category;
        
    }

    public function the_prod_cate_id() {
        return $this->{$this->if->_product_category_as_id};
    }
    
    public function the_prod_cate_link(){
        return $this->{$this->if->_product_category_link};
    }
    
    public function the_prod_cate_description() {
        return getI18n($this->{$this->if->_product_category_as_description});
    }

    public function the_prod_cate_keywords() {
        return getI18n($this->{$this->if->_product_category_as_keywords});
    }

}
