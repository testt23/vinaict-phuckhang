<?php

class Customer extends Customer_model {
    var $if;
    function __construct() {
        parent::__construct();
        $this->if = new dbinfo();
    }

    public function checkEmail(){
        $Customer = new Customer();
        $email = $this->input->post('email');
        $Customer->addSelect();
        $Customer->addSelect($this->if->_customer_email);
        $Customer->addWhere($this->if->_customer_email . " = '" .$email. "'");
        $Customer->find();
        if ($Customer->countRows() > 0){
            return true;
        }
        return false;
    }
}
