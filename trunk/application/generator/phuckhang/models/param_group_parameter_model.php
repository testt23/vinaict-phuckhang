<?php

	class Param_group_parameter_model extends CI_Model {

		protected $__tbname = 'param_group_parameter';
		protected $__dbconf = 'default';

		var $id_parameter;	//int(10) unsigned	Primary Key		NOT NULL
		var $id_param_group;	//int(10) unsigned	Primary Key		NOT NULL

		protected $__validation_rule = array(
			'id_parameter' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE),
			'id_param_group' => array('key' => 'PRI', 'type' => 'int', 'null' => FALSE)
		);

		protected $__relation = array(
			array('table' => 'parameter', 'foreign_key' => 'id_parameter'),
			array('table' => 'param_group', 'foreign_key' => 'id_param_group')
		);
	}
