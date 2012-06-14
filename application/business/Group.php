<?php

	class Group extends Group_model {

		function __construct() {
			parent::__construct();
		}
                
                public static function getList() {
                    
                    $group = new Group();
                    $group->addWhere('group.disabled = '.IS_NOT_DISABLED);
                    $group->orderBy(getI18nRealStringSql('group.name'));
                    $group->find();
                    return $group;
                    
                }
	}
