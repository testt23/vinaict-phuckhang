<?php

class ShoppingCart {

    var $ci;
    var $shop_name;
    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('session');
        $this->shop_name = Variable::getSessionShopping();
    }

    public function get_shop_name() {
        return $this->shop_name;
    }

    public function update_number($id, $num) {
        $Shopping = $this->get_list();
        if (!empty($Shopping)) {
            $total = count($Shopping);
            for ($i = 0; $i < $total; $i++) {

                if ($Shopping[$i]->get_id_product() == $id) {
                    echo 'success';
                    $Shopping[$i]->set_number($num);
                    break;
                }
            }
        }
        $this->ci->session->set_userdata(array($this->shop_name => $Shopping));
    }

    public function insert(
    $id_product, $code_product, $name_product, $price_product, $currency_product, $number) {
        
        $Shopping = $this->get_list();
        
        $flag = 'yes';
        if ($Shopping) {
                for ($i = 0; $i < count($Shopping); $i++){
                    if ($Shopping[$i]->get_id_product() == $id_product) {
                        $Shopping[$i]->set_number($Shopping[$i]->get_number() + 1);
                        $flag = 'no';
                        break;
                    }
                }
        }else{
            $Shopping = array();
        }
        
        if ($flag == 'yes') {
                $cart = new Order_object();
                $cart->set_id_product($id_product);
                $cart->set_code_product($code_product);
                $cart->set_name_product($name_product);
                $cart->set_price_product($price_product);
                $cart->set_currency_product($currency_product);
                $cart->set_number($number);
                $Shopping[] = $cart;
                
        }
        $this->ci->session->set_userdata(array($this->shop_name => $Shopping));
    }

    public function delete($id) {
        $Shopping = $this->ci->session->userdata($this->shop_name);
        $TMP = array();
        if ($Shopping):
            $total = count($Shopping);
            for ($i = 0; $i < $total; $i++) {
                if ($Shopping[$i]->get_id_product() != $id) {
                    $TMP[] = $Shopping[$i];
                }
            }
            $this->ci->session->set_userdata(array($this->shop_name => $TMP));
        endif;
    }

    public function get_list() {
        return $this->ci->session->userdata($this->shop_name);
    }

    public function clear_all() {
        $this->ci->session->set_userdata(array($this->shop_name => ''));
    }

}