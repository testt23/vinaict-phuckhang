<?php

	class Language_model extends CI_Model {

		protected $__tbname = 'language';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(5)			NOT NULL
		var $name;	//varchar(100)			NOT NULL
		var $is_disabled = 0;	//tinyint(1) unsigned			NOT NULL
		var $is_deleted = 0;	//tinyint(1) unsigned			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('type' => 'varchar', 'size' => 5, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 100, 'null' => FALSE),
			'is_disabled' => array('type' => 'tinyint', 'null' => FALSE),
			'is_deleted' => array('type' => 'tinyint', 'null' => FALSE)
		);
	}
