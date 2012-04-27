<?php

	class Task_model extends CI_Model {

		protected $__tbname = 'task';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $id_project;	//int(10) unsigned			NOT NULL
		var $code;	//varchar(15)			NOT NULL
		var $name;	//varchar(255)			NOT NULL
		var $description;	//text			NOT NULL
		var $start_date;	//datetime			NOT NULL
		var $estimation = 0;	//int(11)			NULL
		var $duration = 0;	//int(11)			NOT NULL
		var $status;	//tinyint(2) unsigned			NOT NULL
		var $assignee;	//int(11) unsigned			NOT NULL
		var $id_user_create;	//int(11) unsigned			NOT NULL
		var $creation_date = 'CURRENT_TIMESTAMP';	//timestamp			NOT NULL
		var $id_user_modify;	//int(11) unsigned			NULL
		var $modification_date;	//datetime			NULL
		var $deleted = 0;	//tinyint(1)			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'id_project' => array('key' => 'MUL', 'type' => 'int', 'null' => FALSE),
			'code' => array('type' => 'varchar', 'size' => 15, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'description' => array('type' => 'text', 'null' => FALSE),
			'start_date' => array('type' => 'datetime', 'null' => FALSE),
			'estimation' => array('type' => 'int', 'null' => TRUE),
			'duration' => array('type' => 'int', 'null' => FALSE),
			'status' => array('type' => 'tinyint', 'null' => FALSE),
			'assignee' => array('type' => 'int', 'null' => FALSE),
			'id_user_create' => array('type' => 'int', 'null' => FALSE),
			'creation_date' => array('type' => 'timestamp', 'null' => FALSE),
			'id_user_modify' => array('type' => 'int', 'null' => TRUE),
			'modification_date' => array('type' => 'datetime', 'null' => TRUE),
			'deleted' => array('type' => 'tinyint', 'null' => TRUE)
		);

		protected $__relation = array(
			array('table' => 'project', 'foreign_key' => 'id_project')
		);
	}
