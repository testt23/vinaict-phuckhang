<?php

	class Currency extends Currency_model {

                var $if;
		function __construct() {
			parent::__construct();
                        $this->if = new DbInfo();
		}
                public function get_list(){
                    $Currency = new Currency();
                    $Currency->addSelect($this->if->_table_currency . '.*');
                    $Currency->find();
                    return $Currency;
                }
	}
