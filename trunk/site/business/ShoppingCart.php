<?php

class ShoppingCart {

    var $ci;
    var $shop_name = 'cart';

    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('session');
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
    $id_purchase_order, $id_product, $code_product, $name_product, $price_product, $currency_product, $description_product, $image_product, $number, $is_deleted, $link_product) {

        $cart = new Order_object();
        $Shopping = $this->get_list();
        $this->ci->session->set_userdata(array('test' => 'test'));

        $flag = 'yes';
        if ($Shopping != false) {
            foreach ($Shopping as $item) {
                if ($item->get_id_product() == $id_product) {
                    $item->set_number($item->get_number() + 1);
                    $flag = 'no';
                    break;
                }
            }
        }
        if ($flag == 'yes') {
            $cart->set_id_purchase_order($id_purchase_order);
            $cart->set_id_product($id_product);
            $cart->set_code_product($code_product);
            $cart->set_name_product($name_product);
            $cart->set_price_product($price_product);
            $cart->set_currency_product($currency_product);
            $cart->set_description_product($description_product);
            $cart->set_image_product($image_product);
            $cart->set_number($number);
            $cart->set_link_product($link_product);
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