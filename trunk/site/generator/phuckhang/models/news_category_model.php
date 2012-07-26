<?php

	class News_category_model extends CI_Model {

		protected $__tbname = 'news_category';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $name;	//varchar(250)			NOT NULL
		var $description;	//text			NULL
		var $id_parent;	//varchar(50)			NULL
		var $keyword;	//varchar(200)			NULL
		var $link;	//varchar(400)			NOT NULL
		var $is_deleted = 0;	//tinyint(1)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'name' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'description' => array('type' => 'text', 'null' => TRUE),
			'id_parent' => array('type' => 'varchar', 'size' => 50, 'null' => TRUE),
			'keyword' => array('type' => 'varchar', 'size' => 200, 'null' => TRUE),
			'link' => array('type' => 'varchar', 'size' => 400, 'null' => FALSE),
			'is_deleted' => array('type' => 'tinyint', 'null' => FALSE)
		);
	}
