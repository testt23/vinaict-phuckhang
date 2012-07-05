<?php

	class Usr_group_model extends CI_Model {

		protected $__tbname = 'group';
		protected $__dbconf = 'default';

		var $id;	//smallint(5) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(10)	Unique Key		NOT NULL
		var $name;	//varchar(255)			NOT NULL
		var $disabled = 0;	//tinyint(1) unsigned			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'smallint', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('key' => 'UNI', 'type' => 'varchar', 'size' => 10, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'disabled' => array('type' => 'tinyint', 'null' => FALSE)
		);
	}
