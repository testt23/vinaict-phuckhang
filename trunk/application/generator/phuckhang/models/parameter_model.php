<?php

	class Parameter_model extends CI_Model {

		protected $__tbname = 'parameter';
		protected $__dbconf = 'default';

		var $id;	//int(11)	Primary Key	Auto Increment	NOT NULL
		var $name;	//varchar(255)			NOT NULL
		var $code;	//varchar(255)			NOT NULL
		var $value;	//text			NOT NULL
		var $always_load = 0;	//tinyint(1)			NOT NULL
		var $status = 0;	//tinyint(1)			NOT NULL
		var $creation_date = 'CURRENT_TIMESTAMP';	//timestamp			NOT NULL
		var $modification_date;	//datetime			NULL
		var $id_user_created;	//int(11)			NOT NULL
		var $id_user_modified;	//int(11)			NULL
		var $disabled = 0;	//tinyint(1)			NOT NULL
		var $data_type = 1;	//tinyint(1)			NOT NULL
		var $data;	//text			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'name' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'code' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'value' => array('type' => 'text', 'null' => FALSE),
			'always_load' => array('type' => 'tinyint', 'null' => FALSE),
			'status' => array('type' => 'tinyint', 'null' => FALSE),
			'creation_date' => array('type' => 'timestamp', 'null' => FALSE),
			'modification_date' => array('type' => 'datetime', 'null' => TRUE),
			'id_user_created' => array('type' => 'int', 'null' => FALSE),
			'id_user_modified' => array('type' => 'int', 'null' => TRUE),
			'disabled' => array('type' => 'tinyint', 'null' => FALSE),
			'data_type' => array('type' => 'tinyint', 'null' => FALSE),
			'data' => array('type' => 'text', 'null' => TRUE)
		);
	}
