<?php

	class Order_model extends CI_Model {

		protected $__tbname = 'order';
		protected $__dbconf = 'default';

		var $id;	//int(11)	Primary Key	Auto Increment	NOT NULL
		var $id_customer;	//int(11)			NOT NULL
		var $description;	//text			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'id_customer' => array('type' => 'int', 'null' => FALSE),
			'description' => array('type' => 'text', 'null' => TRUE)
		);

		protected $__relation = array(
			array('table' => 'customer', 'foreign_key' => 'id_customer')
		);
	}
