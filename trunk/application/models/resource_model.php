<?php

	class Resource_model extends CI_Model {

		protected $__tbname = 'resource';
		protected $__dbconf = 'default';

		var $id_project;	//int(10) unsigned	Primary Key		NOT NULL
		var $id_user;	//int(10) unsigned	Primary Key		NOT NULL

		protected $__validation_rule = array(
			'id_project' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE),
			'id_user' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE)
		);

		protected $__relation = array(
			array('table' => 'project', 'foreign_key' => 'id_project'),
			array('table' => 'user', 'foreign_key' => 'id_user')
		);
	}
