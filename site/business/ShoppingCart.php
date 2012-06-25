<?php

class ShoppingCart {

    var $ci;
    var $shop_name = 'giohang';

    function __construct() {
        $this->ci = & get_instance();
    }

    public function get_shop_name() {
        return $this->shop_name;
    }

    public function page($number = 1) {
        $Product = new Product();

        $info = $Product->getNewProduct($number);
        $data['product'] = $info['product'];
        $data['paging'] = $info['paging'];
        $data['content'] = 'index';
        $this->load->view('temp', $data);
    }

    public function insert($id, $name, $image, $price, $number, $currency) {
        $cart = new Cart();
        $Shopping = $this->ci->session->userdata($this->shop_name);

        $flag = 'yes';
        if ($Shopping != false) {
            $total = count($Shopping);
            if ($total > 0) {
                for ($i = 0; $i < $total; $i++) {
                    if ($Shopping[$i]->get_id() == $id) {
                        $Shopping[$i]->set_number($Shopping[$i]->get_number() + 1);
                        if (($Shopping[$i]->get_price() * 1) != 0) {
                            $Shopping[$i]->set_price($Shopping[$i]->get_price() + $price);
                        }
                        $flag = 'no';
                    }
                }
            }
        }

        if ($flag == 'yes') {
            $cart->set_id($id);
            $cart->set_name($name);
            $cart->set_image($image);
            $cart->set_price($price);
            $cart->set_number($number);
            $cart->set_currency($currency);
            $Shopping[] = $cart;
        }
        $this->ci->session->set_userdata(array($this->shop_name => $Shopping));
    }

    public function delete($id) {
        $Shopping = $this->ci->session->userdata($this->shop_name);
        $total = count($Shopping);
        $Shop_return = array();
        for ($i = 0; $i < $total; $i++) {
            if ($Shopping[$i]->get_id() != $id) {
                $Shop_return[] = $Shopping[$i];
            }
        }
        $this->ci->session->set_userdata(array($this->shop_name => $Shop_return));
    }

    public function get_list() {
        return $this->ci->session->userdata($this->shop_name);
    }

    public function clear_all() {
        $this->ci->session->set_userdata(array($this->shop_name => ''));
    }

}