<?php

	class Image_size_model extends CI_Model {

		protected $__tbname = 'image_size';
		protected $__dbconf = 'default';

		var $id;	//smallint(5) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(10)			NOT NULL
		var $name;	//varchar(200)			NOT NULL
		var $value;	//varchar(20)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'smallint', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('type' => 'varchar', 'size' => 10, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 200, 'null' => FALSE),
			'value' => array('type' => 'varchar', 'size' => 20, 'null' => FALSE)
		);
	}
