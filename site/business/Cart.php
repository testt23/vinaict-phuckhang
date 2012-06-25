<?php

class Cart {

    var $_id;
    var $_name;
    var $_image;
    var $_price;
    var $_currentcy;
    var $_number;
    function __construct() {
        
    }
    public function set_id($id){
        $this->_id = $id;
    }
    public function get_id(){
        return $this->_id;
    }
    public function set_currency($currency){
        $this->_currentcy = $currency;
    }
    public function get_currency(){
        return $this->_currentcy;
    }
    public function set_name($name){
        $this->_name = $name;
    }
    public function get_name(){
        return $this->_name;
    }
    public function get_image(){
        return $this->_image;
    }
    
    public function get_price(){
        return number_format($this->_price, 3);
    }
    public function get_number(){
        return $this->_number;
    }
    public function set_image($image){
        $this->_image = $image;
    }
    public function set_price($price){
        $this->_price = $price;
    }
    public function set_number($number){
        $this->_number = $number;
    }
}