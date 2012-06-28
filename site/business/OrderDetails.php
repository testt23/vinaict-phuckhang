<?php

	class OrderDetails extends Order_details_model {

		function __construct() {
			parent::__construct();
		}
                public function insert($id, $id_order, $id_product, $number, $name_product, $price, $image){
                    $OrderDetails = new OrderDetails();
                    $OrderDetails->id_order = $id_order;
                    $OrderDetails->id_product = $id_product;
                    $OrderDetails->number = $number;
                    $OrderDetails->name_product = $name_product;
                    $OrderDetails->price = $price;
                    $OrderDetails->image = $image;
                     $OrderDetails->insert();
                     return $OrderDetails;
                }
	}
