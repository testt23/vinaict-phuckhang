<?php

class PurchaseOrderDetail extends Purchase_order_detail_model {

    function __construct() {
        parent::__construct();
    }

    public function getList($id_order) {

        $order_detail = new PurchaseOrderDetail();
        $po = new PurchaseOrder();
        
        if (!$id_order || !$po->get($id_order))
            return FALSE;
        
        
        $order_detail->addWhere('id_purchase_order = "'.$id_order.'"');
        $order_detail->addWhere('purchase_order_detail.is_deleted = '.IS_NOT_DELETED);
        $order_detail->addSelect();
        $order_detail->addSelect('purchase_order_detail.*');

        $order_detail->find();

        return $order_detail;
    }

    public function deleteOrderDetail($order_status = null){
        
        $this->addJoin( new PurchaseOrder);
        $this->addWhere('purchase_order.status = '.$order_status.'');
        $this->is_deleted = 1;
        $this->update();    
        return TRUE;
    }
}
