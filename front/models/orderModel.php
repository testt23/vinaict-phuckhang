<?php

class OrderModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function addCart() {
        $List = '';
        $shopping = new ShoppingCart();
        if (isset($_POST['orderSubmit'])) {
            $id = $_POST['h_id'];
            $name = $_POST['h_name'];
            $price = $_POST['h_price'];
            $iamge = $_POST['h_image'];
            $shopping->addCart($id, $name, $price, $iamge);
        }
        if ($shopping->isHave()) {
            $List = $shopping->listCart();
        }
        return $List;
    }

    function delete($id) {
        $shopping = new ShoppingCart();
        $shopping->deleteCart($id);
    }

    function clear() {
        $shopping = new ShoppingCart();
        $shopping->clearAll();
    }

}