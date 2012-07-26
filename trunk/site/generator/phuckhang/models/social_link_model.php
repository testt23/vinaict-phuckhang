<?php

	class Social_link_model extends CI_Model {

		protected $__tbname = 'social_link';
		protected $__dbconf = 'default';

		var $id;	//int(11)	Primary Key	Auto Increment	NOT NULL
		var $name;	//varchar(255)			NOT NULL
		var $url;	//varchar(255)			NOT NULL
		var $id_image;	//int(11)			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'name' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'url' => array('type' => 'varchar', 'size' => 255, 'null' => FALSE),
			'id_image' => array('type' => 'int', 'null' => TRUE)
		);

		protected $__relation = array(
			array('table' => 'image', 'foreign_key' => 'id_image')
		);
	}
