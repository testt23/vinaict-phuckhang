<?php

	class User_model extends CI_Model {

		protected $__tbname = 'user';
		protected $__dbconf = 'default';

		var $id;	//int(11)	Primary Key	Auto Increment	NOT NULL
		var $first_name;	//varchar(100)			NOT NULL
		var $last_name;	//varchar(100)			NOT NULL
		var $address;	//varchar(500)			NOT NULL
		var $email;	//varchar(100)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'first_name' => array('type' => 'varchar', 'size' => 100, 'null' => FALSE),
			'last_name' => array('type' => 'varchar', 'size' => 100, 'null' => FALSE),
			'address' => array('type' => 'varchar', 'size' => 500, 'null' => FALSE),
			'email' => array('type' => 'varchar', 'size' => 100, 'null' => FALSE)
		);
	}
