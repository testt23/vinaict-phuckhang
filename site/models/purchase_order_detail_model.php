<?php

	class Purchase_order_detail_model extends CI_Model {

		protected $__tbname = 'purchase_order_detail';
		protected $__dbconf = 'default';

		var $id;	//bigint(20) unsigned	Primary Key	Auto Increment	NOT NULL
		var $id_purchase_order;	//bigint(20) unsigned			NOT NULL
		var $id_product;	//bigint(20) unsigned			NOT NULL
		var $code_product;	//varchar(15)			NOT NULL
		var $name_product;	//varchar(250)			NOT NULL
		var $price_product;	//float			NOT NULL
		var $currency_product;	//varchar(3)			NOT NULL
		var $desciption_product;	//text			NULL
		var $image_product;	//varchar(300)			NULL
		var $number;	//bigint(20) unsigned			NOT NULL
		var $is_deleted = 0;	//tinyint(1) unsigned			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'bigint', 'null' => FALSE, 'auto_increment' => TRUE),
			'id_purchase_order' => array('type' => 'bigint', 'null' => FALSE),
			'id_product' => array('type' => 'bigint', 'null' => FALSE),
			'code_product' => array('type' => 'varchar', 'size' => 15, 'null' => FALSE),
			'name_product' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'price_product' => array('type' => 'float', 'null' => FALSE),
			'currency_product' => array('type' => 'varchar', 'size' => 3, 'null' => FALSE),
			'desciption_product' => array('type' => 'text', 'null' => TRUE),
			'image_product' => array('type' => 'varchar', 'size' => 300, 'null' => TRUE),
			'number' => array('type' => 'bigint', 'null' => FALSE),
			'is_deleted' => array('type' => 'tinyint', 'null' => TRUE)
		);

		protected $__relation = array(
			array('table' => 'purchase_order', 'foreign_key' => 'id_purchase_order'),
			array('table' => 'product', 'foreign_key' => 'id_product')
		);
	}
