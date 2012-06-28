<?php

class Order extends Order_model {

    function __construct() {
        parent::__construct();
    }
    public function insert($id_customer, $description){
        $Order = new Order();
        $Order->id_customer = $id_customer;
        $Order->description = $description;
        return $Order->insert();
    }
    
    

}
