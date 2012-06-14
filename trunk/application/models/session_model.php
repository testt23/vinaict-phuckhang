<?php

	class Session_model extends CI_Model {

		protected $__tbname = 'session';
		protected $__dbconf = 'default';

		var $session_id = '0';	//varchar(40)	Primary Key		NOT NULL
		var $ip_address = '0';	//varchar(16)			NOT NULL
		var $user_agent;	//varchar(120)			NOT NULL
		var $last_activity = 0;	//int(10) unsigned			NOT NULL
		var $user_data;	//text			NOT NULL

		protected $__validation_rule = array(
			'session_id' => array('key' => 'PRI', 'type' => 'varchar', 'size' => 40, 'null' => FALSE),
			'ip_address' => array('type' => 'varchar', 'size' => 16, 'null' => FALSE),
			'user_agent' => array('type' => 'varchar', 'size' => 120, 'null' => FALSE),
			'last_activity' => array('key' => 'MUL', 'type' => 'int', 'null' => FALSE),
			'user_data' => array('type' => 'text', 'null' => FALSE)
		);
	}
