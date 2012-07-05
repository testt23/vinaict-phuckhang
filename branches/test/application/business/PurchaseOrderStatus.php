<?php

	class PurchaseOrderStatus extends Purchase_order_status_model {

		function __construct() {
			parent::__construct();
		}
                
                
                public function getList() {

                    $order_detail = new PurchaseOrderStatus();
                    
                    $order_detail->addSelect();
                    $order_detail->addSelect('purchase_order_status.*');
                    $order_detail->find();

                    return $order_detail;
                    
                }
                
                
	}
