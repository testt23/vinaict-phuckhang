<?php

	class Product_model extends CI_Model {

		protected $__tbname = 'product';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(15)	Unique Key		NOT NULL
		var $name;	//varchar(250)			NOT NULL
		var $short_description;	//tinytext			NULL
		var $description;	//text			NULL
		var $price;	//float unsigned			NULL
		var $currency;	//varchar(3)			NULL
		var $link;	//varchar(50)			NOT NULL
		var $picture;	//varchar(100)			NULL
		var $is_disabled = 0;	//tinyint(4) unsigned			NOT NULL
		var $id_prod_category;	//tinyint(3) unsigned			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('key' => 'UNI', 'type' => 'varchar', 'size' => 15, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'short_description' => array('type' => 'tinytext', 'null' => TRUE),
			'description' => array('type' => 'text', 'null' => TRUE),
			'price' => array('type' => 'float unsigned', 'null' => TRUE),
			'currency' => array('type' => 'varchar', 'size' => 3, 'null' => TRUE),
			'link' => array('type' => 'varchar', 'size' => 50, 'null' => FALSE),
			'picture' => array('type' => 'varchar', 'size' => 100, 'null' => TRUE),
			'is_disabled' => array('type' => 'tinyint', 'null' => FALSE),
			'id_prod_category' => array('type' => 'tinyint', 'null' => FALSE)
		);
	}
