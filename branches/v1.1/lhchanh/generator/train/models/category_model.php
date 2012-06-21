<?php

	class Category_model extends CI_Model {

		protected $__tbname = 'category';
		protected $__dbconf = 'default';

		var $id;	//int(10)	Primary Key	Auto Increment	NOT NULL
		var $name;	//varchar(50)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'name' => array('type' => 'varchar', 'size' => 50, 'null' => FALSE)
		);
	}
