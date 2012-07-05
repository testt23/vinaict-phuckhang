<?php

	class Article_category_model extends CI_Model {

		protected $__tbname = 'article_category';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $name;	//varchar(250)			NOT NULL
		var $is_deleted;	//tinyint(1) unsigned			NULL
		var $id_parent;	//varchar(50)			NULL
		var $description;	//text			NULL
		var $keywords;	//varchar(200)			NULL
		var $link;	//varchar(400)			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'name' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'is_deleted' => array('type' => 'tinyint', 'null' => TRUE),
			'id_parent' => array('type' => 'varchar', 'size' => 50, 'null' => TRUE),
			'description' => array('type' => 'text', 'null' => TRUE),
			'keywords' => array('type' => 'varchar', 'size' => 200, 'null' => TRUE),
			'link' => array('type' => 'varchar', 'size' => 400, 'null' => FALSE)
		);
	}
