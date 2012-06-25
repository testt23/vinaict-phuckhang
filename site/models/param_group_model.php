<?php

	class Param_group_model extends CI_Model {

		protected $__tbname = 'param_group';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(50)	Unique Key		NOT NULL
		var $name;	//varchar(255)			NOT NULL
		var $disabled;	//tinyint(1) unsigned			NOT NULL
		var $creation_date = 'CURRENT_TIMESTAMP';	//timestamp			NOT NULL
		var $id_user_created;	//int(10) unsigned			NOT NULL
		var $modification_date;	//datetime			NULL
		var $id_user_modified;	//int(10) unsigned			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('key' => 'UNI', 'type' => 'varchar', 'size' => 50, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'disabled' => array('type' => 'tinyint', 'null' => FALSE),
			'creation_date' => array('type' => 'timestamp', 'null' => FALSE),
			'id_user_created' => array('type' => 'int', 'null' => FALSE),
			'modification_date' => array('type' => 'datetime', 'null' => TRUE),
			'id_user_modified' => array('type' => 'int', 'null' => TRUE)
		);
	}
