<?php

	class Product_model extends CI_Model {

		protected $__tbname = 'product';
		protected $__dbconf = 'default';

		var $id;	//int(11)	Primary Key	Auto Increment	NOT NULL
		var $name;	//text			NOT NULL
		var $id_category;	//int(11)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'name' => array('type' => 'text', 'null' => FALSE),
			'id_category' => array('type' => 'int', 'null' => FALSE)
		);

		protected $__relation = array(
			array('table' => 'category', 'foreign_key' => 'id_category')
		);
	}
