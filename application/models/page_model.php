<?php

	class Page_model extends CI_Model {

		protected $__tbname = 'page';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $title;	//varchar(250)			NOT NULL
		var $content;	//longtext			NOT NULL
		var $link;	//varchar(250)	Unique Key		NULL
		var $keywords;	//varchar(250)			NULL
		var $is_disabled = 0;	//tinyint(1) unsigned			NOT NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'title' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'content' => array('type' => 'longtext', 'null' => FALSE),
			'link' => array('key' => 'UNI', 'type' => 'varchar', 'size' => 250, 'null' => TRUE),
			'keywords' => array('type' => 'varchar', 'size' => 250, 'null' => TRUE),
			'is_disabled' => array('type' => 'tinyint', 'null' => FALSE)
		);
	}
