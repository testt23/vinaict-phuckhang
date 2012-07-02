<?php

class PurchaseOrder extends Purchase_order_model {
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function getList($filter = array()) {
        
        $purchase_order = new PurchaseOrder();
        $purchase_order->addJoin(new Customer);
        $purchase_order->addWhere('purchase_order.is_deleted = '.IS_NOT_DELETED);
        $purchase_order->addSelect();
        $purchase_order->addSelect('purchase_order.*, purchase_order.id id_order, customer.*');
      
        $purchase_order->find();
        
        return $purchase_order;
        
    }
    
    
    function delete() {
        
        $this->is_deleted = 1; 
        
        $this->update();
        
        
    }
    
    function setStatus($id_status = NULL) {
        
        $pos = new PurchaseOrderStatus();
        
        if (!$id_status || !$pos->get($id_status))
            return FALSE;
        
        $this->status = $id_status;
        $this->update();
        
        return TRUE;
        
    }
   
}
