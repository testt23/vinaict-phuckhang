<?php

	class Menu_model extends CI_Model {

		protected $__tbname = 'menu';
		protected $__dbconf = 'default';

		var $id;	//int(11) unsigned	Primary Key	Auto Increment	NOT NULL
		var $name;	//varchar(255)			NOT NULL
		var $position = 0;	//int(2)			NOT NULL
		var $link;	//varchar(255)			NOT NULL
		var $section;	//varchar(255)			NOT NULL
		var $id_parent = 0;	//int(11)			NOT NULL
		var $disabled = 0;	//tinyint(1)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'name' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'position' => array('type' => 'int', 'null' => FALSE),
			'link' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'section' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'id_parent' => array('type' => 'int', 'null' => FALSE),
			'disabled' => array('type' => 'tinyint', 'null' => FALSE)
		);
	}
