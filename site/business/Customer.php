<?php

class Customer extends Customer_model {
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function countAll(){
        $Customer = new Customer();
        $Customer->addSelect();
        $Customer->addSelect('count(id) as total_record');
        $Customer->addWhere("customer.image <> ''");
        $Customer->addWhere("customer.image IS NOT NULL");
        $Customer->find();
        $Customer->fetchFirst();
        return $Customer->total_record;
        
    }
    public function selectAll($filter = array()) {
        $Customer = new Customer();
        $Customer->addSelect();
        $Customer->addSelect('customer.*');
        $Customer->addWhere("customer.image <> ''");
        $Customer->addWhere("customer.image IS NOT NULL");
        if (isset($filter['limit']) && isset($filter['start']))
            $Customer->limit ($filter['start'] . ',' . $filter['limit']);
        
        $Customer->find();
        return $Customer;
        
    }
    public function findByEmail($email) {
        $Customer = new Customer();
        $Customer->addSelect();
        $Customer->addSelect('customer.*');
        $Customer->addWhere("customer.email = '" . $email . "'");
        $Customer->addWhere("customer.email <> '' and customer.email is not null");
        $Customer->find();
        return $Customer;
    }

    public function findByPhone($phone) {
        $Customer = new Customer();
        $Customer->addSelect();
        $Customer->addSelect('customer.*');
        $Customer->addWhere("mobile_phone = '" . $phone . "'");
        $Customer->find();
        return $Customer;
    }

    public function findByUsername($username) {
        $Customer = new Customer();
        $Customer->addSelect();
        $Customer->addSelect('customer.*');
        $Customer->addWhere("username = '" . $username . "'");
        $Customer->addWhere("type_connect = '1'");
        $Customer->find();
        return $Customer;
    }

    public function insertCustomer($filter) {
        $customer = new Customer();
        $customer->firstname = $filter['firstname'];
        $customer->lastname = $filter['lastname'];
        $customer->email = $filter['email'];
        $customer->gender = $filter['gender'];
        $customer->birthday = $filter['birthday'];
        $customer->mobile = $filter['mobile'];
        $customer->image = $filter['image'];
        $customer->username = $filter['username'];
        $customer->link_profile = $filter['link_profile'];
        $customer->type_connect = $filter['type_connect'];
        // tweet 1, yahoo 2, google 3, facebook 4
        $customer->insert();
    }

    public function updateCustomerExist($customer, $filter) {
        $customer->firstname = $filter['firstname'];
        $customer->lastname = $filter['lastname'];
        $customer->email = $filter['email'];
        $customer->gender = $filter['gender'];
        $customer->birthday = $filter['birthday'];
        $customer->mobile = $filter['mobile'];
        $customer->image = $filter['image'];
        $customer->username = $filter['username'];
        $customer->link_profile = $filter['link_profile'];
        $customer->update();
    }
    
    public function getByUsernameOrEmail($filter = array()){
        $customer = null;
        if ($filter['type'] == 3){
            $customer = new Customer();
            $customer->addSelect();
            $customer->addSelect('customer.*');
            $customer->addWhere("customer.email = '" .$filter['email']. "'");
        }
    }
    
    public function getSessionLogin(){
        $CI = &get_instance();
        $CI->load->library('session');
        return $CI->session->userdata('logined');
    }

}
