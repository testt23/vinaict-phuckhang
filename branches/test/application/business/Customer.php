<?php

	class Customer extends Customer_model {

		function __construct() {
			parent::__construct();
		}
                
                function getList(&$filter = array(), $pager = true) {
        
                    $customer = new Customer();

                    if(isset($filter['name']) && $filter['name']) {
                        $customer->addWhere("(customer.last_name LIKE '%".utf8_escape_textarea($filter['name'])."%'");
                        $customer->addWhere("customer.first_name LIKE '%".utf8_escape_textarea($filter['name'])."%')", 'OR');
                    }

                    $customer->addWhere('customer.is_deleted = '.IS_NOT_DELETED);

                    // Get total rows
                    $customer->groupBy('customer.id');
                    $customer->orderBy("customer.lastname, customer.firstname");
                    $customer->find();

                    if ($pager) {

                        $filter[PAGINATION_QUERY_STRING_SEGMENT] = isset($filter[PAGINATION_QUERY_STRING_SEGMENT]) && $filter[PAGINATION_QUERY_STRING_SEGMENT] ? $filter[PAGINATION_QUERY_STRING_SEGMENT] : 1;
                        // Initialize pagination
                        $ci =& get_instance();
                        $ci->load->library('pagination');
                        $ci->pagination->setModel($customer);
                        $ci->pagination->url = curPageURL();
                        $ci->pagination->cur_page = $filter[PAGINATION_QUERY_STRING_SEGMENT];

                    }

                    return $customer;
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
