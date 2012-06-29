<?php

class PurchaseOrderDetail extends Purchase_order_detail_model {

    function __construct() {
        parent::__construct();
    }

    
    
    public function insert_with_session(){
        $O = new ShoppingCart();
        $Shopping = $O->get_list();
        foreach ($Shopping as $item){
            $item->insert();
        }
    }
    
    
    
    
    
    
    
    
    //get
    public function get_id() {
        return $this->id;
    }

    public function get_id_purchase_order() {
        return $this->id_purchase_order;
    }

    public function get_id_product() {
        return $this->id_product;
    }

    public function get_code_product() {
        return $this->code_product;
    }

    public function get_name_product() {
        return $this->name_product;
    }

    public function get_price_product() {
        return $this->price_product;
    }

    public function get_currency_product() {
        return $this->currency_product;
    }

    public function get_description_product() {
        return $this->desciption_product;
    }

    public function get_image_product() {
        return $this->image_product;
    }

    public function get_number() {
        return $this->number;
    }

    public function get_is_deleted() {
        return $this->is_deleted;
    }

    public function get_link_product() {
        return $this->link_product;
    }

    // set
    public function set_id($value) {
        $this->id = $value;
    }

    public function set_id_purchase_order($value) {
        $this->id_purchase_order = $value;
    }

    public function set_id_product($value) {
        $this->id_product = $value;
    }

    public function set_code_product($value) {
        $this->code_product = $value;
    }

    public function set_name_product($value) {
        $this->name_product = $value;
    }

    public function set_price_product($value) {
        $this->price_product = $value;
    }

    public function set_currency_product($value) {
        $this->currency_product = $value;
    }

    public function set_description_product($value) {
        $this->desciption_product = $value;
    }

    public function set_image_product($value) {
        $this->image_product = $value;
    }

    public function set_number($value) {
        $this->number = $value;
    }

    public function set_is_deleted($value) {
        $this->is_deleted = $value;
    }

    public function set_link_product($value) {
        $this->link_product = $value;
    }

}
