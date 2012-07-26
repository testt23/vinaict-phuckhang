<?php

	class Counter_model extends CI_Model {

		protected $__tbname = 'counter';
		protected $__dbconf = 'default';

		var $id;	//int(11)	Primary Key	Auto Increment	NOT NULL
		var $count;	//int(11)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'count' => array('type' => 'int', 'null' => FALSE)
		);
	}
