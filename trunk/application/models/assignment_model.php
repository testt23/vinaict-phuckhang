<?php

	class Assignment_model extends CI_Model {

		protected $__tbname = 'assignment';
		protected $__dbconf = 'default';

		var $id_task;	//int(10) unsigned	Primary Key		NOT NULL
		var $id_user;	//int(10) unsigned	Primary Key		NOT NULL
		var $id_operation;	//tinyint(2) unsigned	Primary Key		NOT NULL
		var $start_date;	//datetime	Primary Key		NOT NULL
		var $estimation = 0;	//int(11)			NULL
		var $duration = 0;	//int(11)			NULL
		var $status = 0;	//tinyint(2)			NULL
		var $id_user_create;	//int(11)			NULL
		var $creation_date = 'CURRENT_TIMESTAMP';	//timestamp			NOT NULL
		var $id_user_modify;	//int(11)			NULL
		var $modification_date;	//datetime			NULL
		var $deleted = 0;	//tinyint(1)			NULL

		protected $__validation_rule = array(
			'id_task' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE),
			'id_user' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE),
			'id_operation' => array('key' => 'PRI', 'type' => 'tinyint', 'null' => FALSE),
			'start_date' => array('key' => 'PRI', 'type' => 'datetime', 'null' => FALSE),
			'estimation' => array('type' => 'int', 'null' => TRUE),
			'duration' => array('type' => 'int', 'null' => TRUE),
			'status' => array('type' => 'tinyint', 'null' => TRUE),
			'id_user_create' => array('type' => 'int', 'null' => TRUE),
			'creation_date' => array('type' => 'timestamp', 'null' => FALSE),
			'id_user_modify' => array('type' => 'int', 'null' => TRUE),
			'modification_date' => array('type' => 'datetime', 'null' => TRUE),
			'deleted' => array('type' => 'tinyint', 'null' => TRUE)
		);

		protected $__relation = array(
			array('table' => 'task', 'foreign_key' => 'id_task'),
			array('table' => 'user', 'foreign_key' => 'id_user')
		);
	}
