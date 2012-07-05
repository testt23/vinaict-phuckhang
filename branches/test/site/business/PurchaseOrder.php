<?php

class PurchaseOrder extends Purchase_order_model {

    function __construct() {
        parent::__construct();
    }
    
    public function insert_into_database(){
        $O = new PurchaseOrder();
        $Order = $O->l_insert(
                $code, 
                $id_customer, 
                $order_date, 
                $amount, 
                $is_deleted, 
                $status, 
                $description, 
                $shipping_address, 
                $billing_address, 
                $shipping_date, 
                $payment_date, 
                $creation_date, 
                $modification_date);
        
        
    }
    
    
    
    public function l_insert($code,$id_customer, 
            $order_date, $amount, $is_deleted, $status, $description,
            $shipping_address, $billing_address, $shipping_date,$payment_date,
            $creation_date, $modification_date){
        
        $Order = new PurchaseOrder();
        $Order->code = $code;
        $Order->id_customer = $id_customer;
        $Order->order_date = $order_date;
        $Order->amount = $amount;
        $Order->is_deleted = $is_deleted;
        $Order->status = $status;
        $Order->description = $description;
        $Order->shipping_address = $shipping_address;
        $Order->billing_address = $billing_address;
        $Order->shipping_date =$shipping_date;
        $Order->payment_date = $payment_date;
        $Order->creation_date = $creation_date;
        $Order->modification_date = $modification_date;
        $Order->insert();
        return $Order;
        
    }
    
}
