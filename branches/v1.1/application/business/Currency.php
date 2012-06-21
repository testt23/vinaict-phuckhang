<?php

	class Currency extends Currency_model {

		function __construct() {
			parent::__construct();
		}
                
                function getList() {
                    $currency = new Currency();
                    $currency->addWhere('is_deleted = '.IS_NOT_DELETED);
                    $currency->find();
                    return $currency;
                }
	}
