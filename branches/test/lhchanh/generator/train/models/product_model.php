<?php

	class Product_model extends CI_Model {

		protected $__tbname = 'product';
		protected $__dbconf = 'default';

		var $id;	//int(10)	Primary Key	Auto Increment	NOT NULL
		var $name;	//varchar(50)			NOT NULL
		var $description;	//text			NOT NULL
		var $price;	//float			NOT NULL
		var $id_category;	//int(10)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'name' => array('type' => 'varchar', 'size' => 50, 'null' => FALSE),
			'description' => array('type' => 'text', 'null' => FALSE),
			'price' => array('type' => 'float', 'null' => FALSE),
			'id_category' => array('type' => 'int', 'null' => FALSE)
		);

		protected $__relation = array(
			array('table' => 'category', 'foreign_key' => 'id_category')
		);
	}
