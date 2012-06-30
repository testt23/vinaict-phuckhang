<?php

class ShoppingCart {

    var $ci;
    var $shop_name = 'shopping_cart';

    function __construct() {
        $this->ci = & get_instance();
    }

    public function get_shop_name() {
        return $this->shop_name;
    }

    public function t_insert(
            $id_purchase_order, 
            $id_product, 
            $code_product, 
            $name_product, 
            $price_product, 
            $currency_product, 
            $description_product, 
            $image_product, 
            $number, 
            $is_deleted, 
            $link_product) 
    {
        
        $cart = new PurchaseOrderDetail();
        $Shopping = $this->ci->session->userdata($this->shop_name);
        var_dump($Shopping . 'SHOPPING'); 
        if ($Shopping != false) {
            foreach ($Shopping as $item){
                if ($item->get_id_product() == $id_product) {
                    $item->set_number($item->get_number() + 1);
                    if (($item->get_price() * 1) != 0) {
                        $item->set_price($item->get_price() + $price);
                    }
                    return;
                }
            }
        }
        $cart->set_id_purchase_order($id_purchase_order);
        $cart->set_id_product($id_product);
        $cart->set_code_product($code_product);
        $cart->set_name_product($name_product);
        $cart->set_price_product($price_product);
        $cart->set_currency_product($currency_product);
        $cart->set_description_product($description_product);
        $cart->set_image_product($image_product);
        $cart->set_number($number);
        $cart->set_is_deleted($is_deleted);
        $cart->set_link_product($link_product);
        
        $Shopping[] = $cart;
        $this->ci->session->set_userdata(array($this->shop_name => $Shopping));
    }

    public function delete($id) {
        $Shopping = $this->ci->session->userdata($this->shop_name);
        $total = count($Shopping);
        for ($i = 0; $i < $total; $i++) {
            if ($Shopping[$i]->get_id() != $id) {
                unset($Shopping[$i]);
            }
        }
        $this->ci->session->set_userdata(array($this->shop_name => $Shopping));
    }

    public function get_list() {
        return $this->ci->session->userdata($this->shop_name);
    }

    public function clear_all() {
        $this->ci->session->set_userdata(array($this->shop_name => ''));
    }

}