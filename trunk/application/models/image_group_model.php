<?php

	class Image_group_model extends CI_Model {

		protected $__tbname = 'image_group';
		protected $__dbconf = 'default';

		var $id;	//smallint(3) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(10)			NOT NULL
		var $name;	//varchar(400)			NOT NULL
		var $id_image_size;	//varchar(5)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'smallint', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('type' => 'varchar', 'size' => 10, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 400, 'null' => FALSE),
			'id_image_size' => array('type' => 'varchar', 'size' => 5, 'null' => FALSE)
		);

		protected $__relation = array(
			array('table' => 'image_size', 'foreign_key' => 'id_image_size')
		);
	}
