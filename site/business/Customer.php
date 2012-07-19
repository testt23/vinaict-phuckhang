<?php

class Customer extends Customer_model {

    var $if;

    function __construct() {
        parent::__construct();
        $this->if = new DbInfo();
    }
    
    public function findByEmail($email){
        $Customer = new Customer();
        $Customer->addSelect();
        $Customer->addSelect($this->if->_table_customer . '.*');
        $Customer->addWhere($this->if->_customer_email ." = '" .$email. "'");
        $Customer->find();
        return $Customer;

    }


    public function insert_with_company() {
        // neu nguoi dung submit
        $Customer->email = $this->input->post('email');
        $Customer->firstname = $this->input->post('firstname');
        $Customer->lastname = $this->input->post('lastname');
        $Customer->company = $this->input->post('company');
        $Customer->gender = $this->input->post('gender');
        $Customer->billing_address = $this->input->post('billing_addres');
        $Customer->shipping_address = $this->input->post('shipping_address');
        $Customer->home_phone = $this->input->post('home_phone');
        $Customer->work_phone = $this->input->post('work_phone');
        $Customer->mobile_phone = $this->input->post('mobile_phone');
        $Customer->website = $this->input->post('website');
        $Customer->yahoo_id = $this->input->post('yahoo');
        $Customer->skype_id = $this->input->post('skype');
        $Customer->tax_code = $this->input->post('tax_code');
        $Customer->fax = $this->input->post('fax');
        $Customer->career = $this->input->post('career');
        $Customer->insert();
    }

    public function insert_with_individuals() {
        $Customer->email = $this->input->post('email');
        $Customer->firstname = $this->input->post('firstname');
        $Customer->lastname = $this->input->post('lastname');
        $Customer->gender = $this->input->post('gender');
        $Customer->billing_address = $this->input->post('billing_addres');
        $Customer->shipping_address = $this->input->post('shipping_address');
        $Customer->home_phone = $this->input->post('home_phone');
        $Customer->work_phone = $this->input->post('work_phone');
        $Customer->mobile_phone = $this->input->post('mobile_phone');
        $Customer->yahoo_id = $this->input->post('yahoo');
        $Customer->skype_id = $this->input->post('skype');
        $Customer->fax = $this->input->post('fax');
        $Customer->insert();
    }
    public function insert_with_contact(){
        $Customer->email = $this->input->post('email');
        $Customer->firstname = $this->input->post('firstname');
        $Customer->lastname = $this->input->post('lastname');
        $Customer->contact_address = '';
        $Customer->contact_person = '';
        $Customer->home_phone = '';
        $Customer->work_phone = '';
        $Customer->mobile_phone = '';
        $Customer->yahoo_id = '';
        $Customer->skype_id = '';
    }

}
