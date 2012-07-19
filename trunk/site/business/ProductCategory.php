<?php

class ProductCategory extends Product_category_model {

    var $if;

    function __construct() {
        parent::__construct();
        $this->if = new DbInfo();
    }

    public function get_category_id_by_link($link = '') {
        $Category = new ProductCategory();
        $Category->addSelect();
        $Category->addSelect($this->if->_product_category_id . ' as ' . $this->if->_product_category_as_id);
        $Category->addSelect($this->if->_product_category_link . ' as ' . $this->if->_product_category_as_link);
        $Category->addWhere($this->if->_product_category_link . " = '" . $link . "'");

        $Category->find();
        
        $Category->fetchNext();
        return $Category;
        
    }

    public function the_prod_cate_id() {
        return $this->{$this->if->_product_category_as_id};
    }

}
