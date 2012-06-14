<?php

	class Customer_model extends CI_Model {

		protected $__tbname = 'customer';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $email;	//varchar(100)	Unique Key		NOT NULL
		var $firstname;	//varchar(100)			NULL
		var $lastname;	//varchar(100)			NULL
		var $company;	//varchar(200)			NULL
		var $gender;	//char(1)			NULL
		var $birthdate;	//date			NULL
		var $billing_address;	//varchar(255)			NOT NULL
		var $shipping_address;	//varchar(255)			NOT NULL
		var $contact_address;	//varchar(255)			NOT NULL
		var $home_phone;	//varchar(20)			NULL
		var $work_phone;	//varchar(20)			NULL
		var $mobile_phone;	//varchar(20)			NULL
		var $website;	//varchar(255)			NULL
		var $yahoo_id;	//varchar(50)			NULL
		var $skype_id;	//varchar(50)			NULL
		var $is_deleted = 0;	//tinyint(1) unsigned			NOT NULL
		var $id_user;	//int(10) unsigned			NULL
		var $is_business = 0;	//tinyint(1) unsigned			NOT NULL
		var $tax_code;	//varchar(20)			NULL
		var $fax;	//varchar(20)			NULL
		var $career;	//varchar(50)			NULL
		var $contact_person;	//varchar(200)			NULL
		var $position;	//varchar(50)			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'email' => array('key' => 'UNI', 'type' => 'varchar', 'size' => 100, 'null' => FALSE),
			'firstname' => array('type' => 'varchar', 'size' => 100, 'null' => TRUE),
			'lastname' => array('type' => 'varchar', 'size' => 100, 'null' => TRUE),
			'company' => array('type' => 'varchar', 'size' => 200, 'null' => TRUE),
			'gender' => array('type' => 'char', 'size' => 1, 'null' => TRUE),
			'birthdate' => array('type' => 'date', 'null' => TRUE),
			'billing_address' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'shipping_address' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'contact_address' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'home_phone' => array('type' => 'varchar', 'size' => 20, 'null' => TRUE),
			'work_phone' => array('type' => 'varchar', 'size' => 20, 'null' => TRUE),
			'mobile_phone' => array('type' => 'varchar', 'size' => 20, 'null' => TRUE),
			'website' => array('type' => 'varchar', 'size' => 255, 'null' => TRUE),
			'yahoo_id' => array('type' => 'varchar', 'size' => 50, 'null' => TRUE),
			'skype_id' => array('type' => 'varchar', 'size' => 50, 'null' => TRUE),
			'is_deleted' => array('type' => 'tinyint', 'null' => FALSE),
			'id_user' => array('type' => 'int', 'null' => TRUE),
			'is_business' => array('type' => 'tinyint', 'null' => FALSE),
			'tax_code' => array('type' => 'varchar', 'size' => 20, 'null' => TRUE),
			'fax' => array('type' => 'varchar', 'size' => 20, 'null' => TRUE),
			'career' => array('type' => 'varchar', 'size' => 50, 'null' => TRUE),
			'contact_person' => array('type' => 'varchar', 'size' => 200, 'null' => TRUE),
			'position' => array('type' => 'varchar', 'size' => 50, 'null' => TRUE)
		);

		protected $__relation = array(
			array('table' => 'user', 'foreign_key' => 'id_user')
		);
	}
