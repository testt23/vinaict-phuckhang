<?php

	class User_model extends CI_Model {

		protected $__tbname = 'user';
		protected $__dbconf = 'default';

		var $id;	//int(10)	Primary Key	Auto Increment	NOT NULL
		var $email;	//varchar(255)			NOT NULL
		var $pass;	//varchar(255)			NOT NULL
		var $date_last_login;	//datetime			NULL
		var $last_name;	//varchar(255)			NULL
		var $first_name;	//varchar(255)			NULL
		var $disabled = 0;	//tinyint(1)			NULL
		var $login_attempts = 0;	//smallint(3)			NULL
		var $deactived = 0;	//tinyint(1)			NULL
		var $is_controller = 0;	//tinyint(1)			NOT NULL
		var $home_phone;	//varchar(15)			NULL
		var $work_phone;	//varchar(15)			NULL
		var $mobile_phone;	//varchar(15)			NULL
		var $address;	//varchar(255)			NULL
		var $name;	//varchar(255)			NULL
		var $is_business = 0;	//tinyint(1)			NULL
		var $lang = 'vi';	//varchar(5)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'email' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'pass' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'date_last_login' => array('type' => 'datetime', 'null' => TRUE),
			'last_name' => array('type' => 'varchar', 'size' => 255, 'null' => TRUE),
			'first_name' => array('type' => 'varchar', 'size' => 255, 'null' => TRUE),
			'disabled' => array('type' => 'tinyint', 'null' => TRUE),
			'login_attempts' => array('type' => 'smallint', 'null' => TRUE),
			'deactived' => array('type' => 'tinyint', 'null' => TRUE),
			'is_controller' => array('type' => 'tinyint', 'null' => FALSE),
			'home_phone' => array('type' => 'varchar', 'size' => 15, 'null' => TRUE),
			'work_phone' => array('type' => 'varchar', 'size' => 15, 'null' => TRUE),
			'mobile_phone' => array('type' => 'varchar', 'size' => 15, 'null' => TRUE),
			'address' => array('type' => 'varchar', 'size' => 255, 'null' => TRUE),
			'name' => array('type' => 'varchar', 'size' => 255, 'null' => TRUE),
			'is_business' => array('type' => 'tinyint', 'null' => TRUE),
			'lang' => array('type' => 'varchar', 'size' => 5, 'null' => FALSE)
		);
	}
