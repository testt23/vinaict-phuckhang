<?php

	class Usr_group_user_model extends CI_Model {

		protected $__tbname = 'usr_group_user';
		protected $__dbconf = 'default';

		var $id_user;	//int(10) unsigned	Primary Key		NOT NULL
		var $id_usr_group;	//smallint(5) unsigned	Primary Key		NOT NULL

		protected $__validation_rule = array(
			'id_user' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE),
			'id_usr_group' => array('key' => 'PRI', 'type' => 'smallint', 'null' => FALSE)
		);

		protected $__relation = array(
			array('table' => 'user', 'foreign_key' => 'id_user'),
			array('table' => 'usr_group', 'foreign_key' => 'id_usr_group')
		);
	}
