<?php

	class Prod_category_model extends CI_Model {

		protected $__tbname = 'prod_category';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(10)	Unique Key		NOT NULL
		var $name;	//varchar(250)			NOT NULL
		var $is_deleted = 0;	//tinyint(1) unsigned			NOT NULL
		var $id_parent;	//int(11)			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('key' => 'UNI', 'type' => 'varchar', 'size' => 10, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'is_deleted' => array('type' => 'tinyint', 'null' => FALSE),
			'id_parent' => array('type' => 'int', 'null' => TRUE)
		);
	}
