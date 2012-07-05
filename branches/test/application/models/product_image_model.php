<?php

	class Product_image_model extends CI_Model {

		protected $__tbname = 'product_image';
		protected $__dbconf = 'default';

		var $id_product;	//bigint(20) unsigned	Primary Key		NOT NULL
		var $id_image;	//bigint(20) unsigned	Primary Key		NOT NULL

		protected $__validation_rule = array(
			'id_product' => array('key' => 'PRI', 'type' => 'bigint', 'null' => FALSE),
			'id_image' => array('key' => 'PRI', 'type' => 'bigint', 'null' => FALSE)
		);

		protected $__relation = array(
			array('table' => 'product', 'foreign_key' => 'id_product'),
			array('table' => 'image', 'foreign_key' => 'id_image')
		);
	}
