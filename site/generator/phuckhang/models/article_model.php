<?php

	class Article_model extends CI_Model {

		protected $__tbname = 'article';
		protected $__dbconf = 'default';

		var $id;	//int(10) unsigned	Primary Key	Auto Increment	NOT NULL
		var $title;	//varchar(250)			NOT NULL
		var $content;	//longtext			NOT NULL
		var $link;	//varchar(250)	Unique Key		NULL
		var $keywords;	//varchar(250)			NULL
		var $id_news_category;	//int(11)			NULL

		protected $__validation_rule = array(
			'id' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE, 'auto_increment' => TRUE),
			'title' => array('type' => 'varchar', 'size' => 250, 'null' => FALSE),
			'content' => array('type' => 'longtext', 'null' => FALSE),
			'link' => array('key' => 'UNI', 'type' => 'varchar', 'size' => 250, 'null' => TRUE),
			'keywords' => array('type' => 'varchar', 'size' => 250, 'null' => TRUE),
			'id_news_category' => array('type' => 'int', 'null' => TRUE)
		);

		protected $__relation = array(
			array('table' => 'news_category', 'foreign_key' => 'id_news_category')
		);
	}
