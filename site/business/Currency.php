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
                
                function getList() {
                    $currency = new Currency();
                    $currency->addSelect();
                    $currency->addSelect('*');
                    $currency->find();
                    return $currency;
                }
                
                function getArrayCurrencyIso() {
                    $currency = self::getList();
                    $arr_currency = array();
                    while($currency->fetchNext()) {
                        $arr_currency[$currency->name] = $currency->code;
                    }
                    return $arr_currency;
                }
                
                function getCurrencyByCode($code = NULL){
                    $currency = new Currency();
                    $currency->code = $code;
                    $currency->find();
                    
                    return $currency;
                }
	}
