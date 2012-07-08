<?php

class Order_object {

    var $id_purchase_order;
    var $id_product;
    var $code_product;
    var $name_product;
    var $price_product;
    var $currency_product;
    var $desciption_product;
    var $image_product;
    var $number;
    
    var $link_product;
    var $lang;
    function __construct() {
        $this->lang = get_system_language();
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
        return getI18n($this->name_product, $this->lang);
    }

    public function get_price_product() {
        return $this->price_product;
    }

    public function get_currency_product() {
        return getI18n($this->currency_product, $this->lang);
    }

    public function get_description_product() {
        return getI18n($this->desciption_product, $this->lang);
    }

    public function get_image_product() {
        return $this->image_product;
    }

    public function get_number() {
        return $this->number;
    }

    public function get_link_product() {
        return $this->link_product;
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

    public function set_link_product($value) {
        $this->link_product = $value;
    }

}
