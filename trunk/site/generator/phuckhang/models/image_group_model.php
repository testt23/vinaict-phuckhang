<?php

	class Image_group_model extends CI_Model {

		protected $__tbname = 'image_group';
		protected $__dbconf = 'default';

		var $id;	//smallint(3) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(20)			NOT NULL
		var $name;	//varchar(400)			NOT NULL
		var $id_image_size;	//varchar(100)			NULL
		var $use_wm = 0;	//tinyint(1) unsigned			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'smallint', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('type' => 'varchar', 'size' => 20, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 400, 'null' => FALSE),
			'id_image_size' => array('type' => 'varchar', 'size' => 100, 'null' => TRUE),
			'use_wm' => array('type' => 'tinyint', 'null' => FALSE)
		);

		protected $__relation = array(
			array('table' => 'image_size', 'foreign_key' => 'id_image_size')
		);
	}
