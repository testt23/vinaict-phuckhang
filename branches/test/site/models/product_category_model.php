<?php

	class Product_category_model extends CI_Model {

		protected $__tbname = 'product_category';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(10)	Unique Key		NOT NULL
		var $name;	//varchar(250)			NOT NULL
		var $is_deleted = 0;	//tinyint(1) unsigned			NOT NULL
		var $id_parent;	//varchar(50)			NULL
		var $description;	//text			NULL
		var $keywords;	//varchar(200)			NULL
		var $id_image;	//int(11)			NULL
		var $link;	//varchar(400)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('key' => 'UNI', 'type' => 'varchar', 'size' => 10, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'is_deleted' => array('type' => 'tinyint', 'null' => FALSE),
			'id_parent' => array('type' => 'varchar', 'size' => 50, 'null' => TRUE),
			'description' => array('type' => 'text', 'null' => TRUE),
			'keywords' => array('type' => 'varchar', 'size' => 200, 'null' => TRUE),
			'id_image' => array('type' => 'int', 'null' => TRUE),
			'link' => array('type' => 'varchar', 'size' => 400, 'null' => FALSE)
		);

		protected $__relation = array(
			array('table' => 'image', 'foreign_key' => 'id_image')
		);
	}
