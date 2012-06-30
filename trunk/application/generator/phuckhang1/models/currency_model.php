<?php

	class Currency_model extends CI_Model {

		protected $__tbname = 'currency';
		protected $__dbconf = 'default';

		var $id;	//tinyint(2) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(3)			NOT NULL
		var $name;	//varchar(100)			NOT NULL
		var $sign;	//varchar(2)			NOT NULL
		var $rate = 1;	//float unsigned			NOT NULL
		var $is_default = 0;	//tinyint(1) unsigned			NOT NULL
		var $is_deleted = 0;	//tinyint(1) unsigned			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'tinyint', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('type' => 'varchar', 'size' => 3, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 100, 'null' => FALSE),
			'sign' => array('type' => 'varchar', 'size' => 2, 'null' => FALSE),
			'rate' => array('type' => 'float unsigned', 'null' => FALSE),
			'is_default' => array('type' => 'tinyint', 'null' => FALSE),
			'is_deleted' => array('type' => 'tinyint', 'null' => FALSE)
		);
	}
