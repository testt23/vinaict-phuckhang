<?php

class Order_object {

    var $id_product;
    var $code_product;
    var $name_product;
    var $price_product;
    var $currency_product;
    var $number;
    
    var $lang;
    function __construct() {
        $this->lang = get_system_language();
    }
    

    public function get_id_product() {
        return $this->id_product;
    }

    public function get_code_product() {
        return $this->code_product;
    }

    public function get_name_product($option = false) {
            return getI18n($this->name_product, $this->lang);
    }

    public function get_price_product() {
        return number_format(floatval($this->price_product),0,',',',') ; 
    }

    public function get_currency_product() {
        return $this->currency_product;
    }

    public function get_number() {
        return $this->number;
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


    public function set_number($value) {
        $this->number = $value;
    }

}
