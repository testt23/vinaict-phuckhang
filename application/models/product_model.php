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
		var $id_def_image;	//int(11)			NULL
		var $is_disabled = 0;	//tinyint(1) unsigned			NOT NULL
		var $id_prod_category;	//varchar(100)			NULL
		var $is_deleted = 0;	//tinyint(1) unsigned			NOT NULL
		var $keywords;	//varchar(100)			NULL
		var $is_featured = 0;	//tinyint(1) unsigned			NOT NULL
		var $id_prod_image;	//varchar(100)			NULL
		var $id_primary_prod_category = 0;	//int(10) unsigned			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('key' => 'UNI', 'type' => 'varchar', 'size' => 15, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'short_description' => array('type' => 'tinytext', 'null' => TRUE),
			'description' => array('type' => 'text', 'null' => TRUE),
			'price' => array('type' => 'float unsigned', 'null' => TRUE),
			'currency' => array('type' => 'varchar', 'size' => 3, 'null' => TRUE),
			'link' => array('type' => 'varchar', 'size' => 50, 'null' => FALSE),
			'id_def_image' => array('type' => 'int', 'null' => TRUE),
			'is_disabled' => array('type' => 'tinyint', 'null' => FALSE),
			'id_prod_category' => array('type' => 'varchar', 'size' => 100, 'null' => TRUE),
			'is_deleted' => array('type' => 'tinyint', 'null' => FALSE),
			'keywords' => array('type' => 'varchar', 'size' => 100, 'null' => TRUE),
			'is_featured' => array('type' => 'tinyint', 'null' => FALSE),
			'id_prod_image' => array('type' => 'varchar', 'size' => 100, 'null' => TRUE),
			'id_primary_prod_category' => array('type' => 'int', 'null' => FALSE)
		);
	}
