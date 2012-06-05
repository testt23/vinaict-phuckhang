<?php

	class Permission_model extends CI_Model {

		protected $__tbname = 'permission';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $uri;	//varchar(100)			NOT NULL
		var $id_user = 0;	//int(10) unsigned			NULL
		var $id_group = 0;	//smallint(5) unsigned			NULL
		var $value;	//varchar(8)			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'uri' => array('type' => 'varchar', 'size' => 100, 'null' => FALSE),
			'id_user' => array('type' => 'int', 'null' => TRUE),
			'id_group' => array('type' => 'smallint', 'null' => TRUE),
			'value' => array('type' => 'varchar', 'size' => 8, 'null' => TRUE)
		);

		protected $__relation = array(
			array('table' => 'user', 'foreign_key' => 'id_user'),
			array('table' => 'group', 'foreign_key' => 'id_group')
		);
	}
