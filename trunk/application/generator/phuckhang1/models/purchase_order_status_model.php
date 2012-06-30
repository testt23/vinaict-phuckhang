<?php

	class Purchase_order_status_model extends CI_Model {

		protected $__tbname = 'purchase_order_status';
		protected $__dbconf = 'default';

		var $id;	//bigint(20) unsigned	Primary Key	Auto Increment	NOT NULL
		var $name;	//varchar(200)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'bigint', 'null' => FALSE, 'auto_increment' => TRUE),
			'name' => array('type' => 'varchar', 'size' => 200, 'null' => FALSE)
		);
	}
