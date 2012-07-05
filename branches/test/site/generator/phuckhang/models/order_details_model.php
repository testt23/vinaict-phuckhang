<?php

	class Order_details_model extends CI_Model {

		protected $__tbname = 'order_details';
		protected $__dbconf = 'default';

		var $id;	//int(11)	Primary Key	Auto Increment	NOT NULL
		var $id_order;	//int(11)			NOT NULL
		var $id_product;	//int(11)			NOT NULL
		var $number;	//int(11)			NULL
		var $name_product;	//varchar(255)			NULL
		var $price;	//varchar(100)			NULL
		var $image;	//varchar(255)			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'id_order' => array('type' => 'int', 'null' => FALSE),
			'id_product' => array('type' => 'int', 'null' => FALSE),
			'number' => array('type' => 'int', 'null' => TRUE),
			'name_product' => array('type' => 'varchar', 'size' => 255, 'null' => TRUE),
			'price' => array('type' => 'varchar', 'size' => 100, 'null' => TRUE),
			'image' => array('type' => 'varchar', 'size' => 255, 'null' => TRUE)
		);

		protected $__relation = array(
			array('table' => 'order', 'foreign_key' => 'id_order'),
			array('table' => 'product', 'foreign_key' => 'id_product')
		);
	}
