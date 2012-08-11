<?php

	class Image_model extends CI_Model {

		protected $__tbname = 'image';
		protected $__dbconf = 'default';

		var $id;	//bigint(20) unsigned	Primary Key	Auto Increment	NOT NULL
		var $code;	//varchar(50)			NOT NULL
		var $name;	//varchar(400)			NOT NULL
		var $description;	//text			NULL
		var $id_image_group;	//tinyint(2)			NULL
		var $file;	//varchar(50)			NOT NULL
		var $creation_date = 'CURRENT_TIMESTAMP';	//timestamp			NOT NULL
		var $is_display_front_end = 1;	//int(1)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'bigint', 'null' => FALSE, 'auto_increment' => TRUE),
			'code' => array('type' => 'varchar', 'size' => 50, 'null' => FALSE),
			'name' => array('type' => 'varchar', 'size' => 400, 'null' => FALSE),
			'description' => array('type' => 'text', 'null' => TRUE),
			'id_image_group' => array('type' => 'tinyint', 'null' => TRUE),
			'file' => array('type' => 'varchar', 'size' => 50, 'null' => FALSE),
			'creation_date' => array('type' => 'timestamp', 'null' => FALSE),
			'is_display_front_end' => array('type' => 'int', 'null' => FALSE)
		);

		protected $__relation = array(
			array('table' => 'image_group', 'foreign_key' => 'id_image_group')
		);
	}
