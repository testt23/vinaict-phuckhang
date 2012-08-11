<?php

	class Customer extends Customer_model {

		function __construct() {
			parent::__construct();
		}
                
                function getList(&$filter = array(), $pager = true) {
                    $customer = new Customer();
                    $customer->addWhereSearch($filter);
                    if (isset($filter['limit']) && $filter['limit'] && isset($filter['start']) && is_numeric($filter['start'])){
                        $customer->limit($filter['start']. ',' . $filter['limit']);
                    }
                    $customer->groupBy('customer.id');
                    $customer->orderBy("customer.lastname, customer.firstname");
                    $customer->find();
                    return $customer;
                }
                
                public function getTotalRecord($filter = array()){
                    $customer = new Customer();
                    $customer->addSelect();
                    $customer->addSelect("count(customer.id) as total_record");
                    $customer->addWhereSearch($filter);
                    $customer->find();
                    $customer->fetchFirst();
                    return $customer->total_record;
                }
                
                function addWhereSearch($filter = array()){
                    if(isset($filter['name']) && $filter['name']) {
                        $this->addWhere("(customer.lastname LIKE '%".utf8_escape_textarea($filter['name'])."%'");
                        $this->addWhere("customer.firstname LIKE '%".utf8_escape_textarea($filter['name'])."%')", 'OR');
                    }
                    
                    if(isset($filter['address']) && $filter['address']) {
                        $this->addWhere("(customer.billing_address LIKE '%".utf8_escape_textarea($filter['address'])."%'");
                        $this->addWhere("customer.shipping_address LIKE '%".utf8_escape_textarea($filter['address'])."%'", 'OR');
                        $this->addWhere("customer.contact_address LIKE '%".utf8_escape_textarea($filter['address'])."%')");
                    }
                    
                    if(isset($filter['gender']) && $filter['gender'])
                        $this->addWhere("customer.gender ='".$filter['gender']."'");
                    
                    if(isset($filter['code']) && $filter['code'])
                        $this->addWhere("customer.code LIKE '%".utf8_escape_textarea($filter['code'])."%'");
                    
                    if(isset($filter['phone']) && $filter['phone']){
                        $this->addWhere("(customer.home_phone LIKE '%".utf8_escape_textarea($filter['phone'])."%'");
                        $this->addWhere("customer.work_phone LIKE '%".utf8_escape_textarea($filter['phone'])."%'", 'OR');
                        $this->addWhere("customer.mobile_phone LIKE '%".utf8_escape_textarea($filter['phone'])."%')");
                    }
                        
                    
                    if(isset($filter['email']) && $filter['email'])
                        $this->addWhere("customer.email LIKE '%".utf8_escape_textarea($filter['email'])."%'");
                    
                    if(isset($filter['yahoo']) && $filter['yahoo'])
                        $this->addWhere("customer.yahoo_id LIKE '%".utf8_escape_textarea($filter['yahoo'])."%'");
                    
                    if(isset($filter['skype']) && $filter['skype'])
                        $this->addWhere("customer.skype_id LIKE '%".utf8_escape_textarea($filter['skype'])."%'");
                    
                    $this->addWhere('customer.is_deleted = '.IS_NOT_DELETED);
                    
                }
                
                
                function validateInput() {
                    
                    if ($this->is_business) {
                        
                        if (trim($this->company) == "") {
                            MessageHandler::add (lang('err_empty_company_name'), MSG_ERROR, MESSAGE_ONLY);
                        }
                        
                        if (trim($this->tax_code) == "") {
                            MessageHandler::add (lang('err_empty_tax_code'), MSG_ERROR, MESSAGE_ONLY);
                        }
                        
                        if (trim($this->contact_person) == "") {
                            MessageHandler::add (lang('err_empty_contact_person'), MSG_ERROR, MESSAGE_ONLY);
                        }
                        
                    }
                    else {
                        
                        if (trim($this->firstname) == "") {
                            MessageHandler::add (lang('err_empty_first_name'), MSG_ERROR, MESSAGE_ONLY);
                        }
                        
                        if (trim($this->lastname) == "") {
                                MessageHandler::add (lang('err_empty_last_name'), MSG_ERROR, MESSAGE_ONLY);
                        }
                        
                        if (trim($this->gender) == "") {
                                MessageHandler::add (lang('err_empty_gender'), MSG_ERROR, MESSAGE_ONLY);
                        }
                        
                        if (trim($this->birthdate) == "") {
                                MessageHandler::add (lang('err_empty_birthdate'), MSG_ERROR, MESSAGE_ONLY);
                        }
                        
                    }
                    
                    if ($this->firstname && strlen($this->firstname) > MAX_LENGTH_NAME) {
                            MessageHandler::add (lang('err_first_name_too_long'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    
                    if ($this->lastname && strlen($this->lastname) > MAX_LENGTH_NAME) {
                            MessageHandler::add (lang('err_last_name_too_long'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    
                    if (trim($this->contact_address) == "") {
                        MessageHandler::add (lang('err_empty_contact_address'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    
                    if (trim($this->billing_address) == "") {
                        MessageHandler::add (lang('err_empty_billing_address'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    
                    if (trim($this->shipping_address) == "") {
                        MessageHandler::add (lang('err_empty_shipping_address'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    
                    if ($this->home_phone && !isValidPhoneNumber($this->home_phone)) {
                        MessageHandler::add (lang('err_invalid_home_phone'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    
                    if ($this->work_phone && !isValidPhoneNumber($this->work_phone)) {
                        MessageHandler::add (lang('err_invalid_work_phone'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    
                    if ($this->mobile_phone && !isValidPhoneNumber($this->mobile_phone)) {
                        MessageHandler::add (lang('err_invalid_mobile_phone'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    
                    if ($this->fax && !isValidPhoneNumber($this->fax)) {
                        MessageHandler::add (lang('err_invalid_fax'), MSG_ERROR, MESSAGE_ONLY);
                    }

                    if (!isset($this->email) || trim($this->email) == "") {
                            MessageHandler::add (lang('err_empty_email'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    elseif (!isValidEmail($this->email))
                    {
                            MessageHandler::add (lang('err_invalid_email'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    else if (Customer::emailExistByCustomerID($this->email, $this->id))
                    {
                            MessageHandler::add (lang('err_email_exists'), MSG_ERROR, MESSAGE_ONLY);
                    }

                    return MessageHandler::countError() > 0 ? false : true;
                    
                }
                
                public static function emailExistByCustomerID($email, $userID = null) {
		
                    $user = new Customer();
                    $user->addWhere("email = '$email'");
                    if ($userID)
                            $user->addWhere("id <> " . $userID);
                    $user->find();

                    if($user->fetchFirst()) {
                        return $user->id;
                    }
                    
                    return false;

                }
            
	}
