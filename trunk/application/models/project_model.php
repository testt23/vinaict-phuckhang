<?php

	class Project_model extends CI_Model {

		protected $__tbname = 'project';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(15)	Unique Key		NOT NULL
		var $name;	//varchar(255)			NOT NULL
		var $id_customer;	//int(11)			NOT NULL
		var $reg_date;	//datetime			NOT NULL
		var $estimation;	//int(11)			NULL
		var $duration;	//int(11)			NOT NULL
		var $description;	//text			NULL
		var $deleted = 0;	//tinyint(1)			NOT NULL
		var $cost = 0;	//decimal(10,0)			NOT NULL
		var $id_user_create;	//int(11)			NULL
		var $creation_date = 'CURRENT_TIMESTAMP';	//timestamp			NULL
		var $id_user_modify;	//int(11)			NULL
		var $modification_date;	//datetime			NULL
		var $status = 0;	//tinyint(2)			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('key' => 'UNI', 'type' => 'varchar', 'size' => 15, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'id_customer' => array('type' => 'int', 'null' => FALSE),
			'reg_date' => array('type' => 'datetime', 'null' => FALSE),
			'estimation' => array('type' => 'int', 'null' => TRUE),
			'duration' => array('type' => 'int', 'null' => FALSE),
			'description' => array('type' => 'text', 'null' => TRUE),
			'deleted' => array('type' => 'tinyint', 'null' => FALSE),
			'cost' => array('type' => 'decimal', 'null' => FALSE),
			'id_user_create' => array('type' => 'int', 'null' => TRUE),
			'creation_date' => array('type' => 'timestamp', 'null' => TRUE),
			'id_user_modify' => array('type' => 'int', 'null' => TRUE),
			'modification_date' => array('type' => 'datetime', 'null' => TRUE),
			'status' => array('type' => 'tinyint', 'null' => TRUE)
		);
	}
