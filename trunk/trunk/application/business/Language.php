<?php

	class Language extends Language_model {

		function __construct() {
			parent::__construct();
		}
                
                function getList() {
                    $lang = new Language();
                    $lang->addSelect();
                    $lang->addSelect('*');
                    $lang->find();
                    return $lang;
                }
	}
