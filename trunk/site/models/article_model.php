<?php

	class Article_model extends CI_Model {

		protected $__tbname = 'article';
		protected $__dbconf = 'default';

		var $id;	//int(10)	Primary Key	Auto Increment	NOT NULL
		var $title;	//varchar(250)			NOT NULL
		var $content;	//longtext			NOT NULL
		var $link;	//varchar(250)			NULL
		var $keywords;	//varchar(250)			NULL
		var $is_disabled;	//tinyint(1) unsigned			NULL
		var $id_article_category;	//int(11)			NULL
		var $id_image;	//int(11)			NULL
		var $is_deleted = 0;	//tinyint(1)			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'title' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'content' => array('type' => 'longtext', 'null' => FALSE),
			'link' => array('type' => 'varchar', 'size' => 250, 'null' => TRUE),
			'keywords' => array('type' => 'varchar', 'size' => 250, 'null' => TRUE),
			'is_disabled' => array('type' => 'tinyint', 'null' => TRUE),
			'id_article_category' => array('type' => 'int', 'null' => TRUE),
			'id_image' => array('type' => 'int', 'null' => TRUE),
			'is_deleted' => array('type' => 'tinyint', 'null' => TRUE)
		);

		protected $__relation = array(
			array('table' => 'article_category', 'foreign_key' => 'id_article_category'),
			array('table' => 'image', 'foreign_key' => 'id_image')
		);
	}
