<?php

	class Customer_controller extends CI_Controller {

		function __construct(){
			parent::__construct();
                        $this->load->helper('string');
                        $this->load->library('email');
                        $this->data['logged_email'] = $this->session->userdata('logged_email');
		}

		function index(){
			
                    User::checkAccessable($this->session->userdata('userID'), 'customer');
                    $this->session->set_userdata('stored_url', selfURL());

                    $section = "customer";

                    // Use for breadcrumb
                    $cfer = new Cfer(array(
                        lang('txt_dashboard') => base_url('dashboard'),
                        lang('txt_customer_list') => base_url('customer'))
                    );

                    $filter = array();
                    $filter['name'] = $this->input->get_post('name');
                    $filter['address'] = $this->input->get_post('address');
                    $filter['gender'] = $this->input->get_post('gender');
                    $filter['email'] = $this->input->get_post('email');
                    $filter[PAGINATION_QUERY_STRING_SEGMENT] = $this->input->get(PAGINATION_QUERY_STRING_SEGMENT);
                    $customer = Customer::getList($filter, true);

                    $this->data['customer'] = $customer;
                    $this->data['filter'] = $filter;

                    $array_menus = array();
                    $filter = array();
                    $filter['parent_id'] = 0;
                    Menu::getMenuTree($array_menus, $filter);

                    $this->data['cfer'] = $cfer;
                    $this->data['array_menus'] = $array_menus;
                    $this->data['section'] = $section;
                    $this->data['pagination'] = $customer->pagination;

                    $this->load->view('main', $this->data);
                    
		}

		function add() {
        
                    User::checkAccessable($this->session->userdata('userID'), 'customer/add');
                    $back = $this->session->userdata('stored_url') ? $this->session->userdata('stored_url') : base_url('customer');
                    $section = 'customer_form';

                    $cfer = new Cfer(array(
                        lang('txt_dashboard') => base_url('dashboard'),
                        lang('txt_customer_list') => $back,
                        lang('txt_add_customer') => base_url('customer/add/')));

                    $act = $this->input->get_post('act');

                    $customer = new Customer();
                    $same = $this->input->post('same_address');

                    if ($act == ACT_SUBMIT) {

                        $customer->firstname = utf8_escape_textarea($this->input->post('first_name'));
                        $customer->lastname = utf8_escape_textarea($this->input->post('last_name'));
                        $customer->company = utf8_escape_textarea($this->input->post('company'));
                        $customer->gender = $this->input->post('gender');
                        $customer->birthdate = utf8_escape_textarea($this->input->post('birthdate'));
                        $customer->email = utf8_escape_textarea($this->input->post('email'));
                        $customer->home_phone = utf8_escape_textarea($this->input->post('home_phone'));
                        $customer->work_phone = utf8_escape_textarea($this->input->post('work_phone'));
                        $customer->mobile_phone = utf8_escape_textarea($this->input->post('mobile_phone'));
                        $customer->contact_address = utf8_escape_textarea($this->input->post('address'));
                        $customer->billing_address = utf8_escape_textarea($this->input->post('billing_address'));
                        $customer->shipping_address = $same == 1 ? $customer->billing_address : utf8_escape_textarea($this->input->post('shipping_address'));
                        $customer->website = utf8_escape_textarea($this->input->post('website'));
                        $customer->yahoo_id = utf8_escape_textarea($this->input->post('yahoo_id'));
                        $customer->skype_id = utf8_escape_textarea($this->input->post('skype_id'));
                        $customer->is_business = $this->input->post('is_business');
                        $customer->tax_code = utf8_escape_textarea($this->input->post('tax_code'));
                        $customer->career = utf8_escape_textarea($this->input->post('career'));
                        $customer->contact_person = utf8_escape_textarea($this->input->post('contact_person'));

                        if ($customer->validateInput()) {

                            if ($customer->insert()) {
                                /*
                                $password = random_string();

                                $user = new User();
                                $user->email = $customer->email;
                                $user->first_name = $customer->firstname;
                                $user->last_name = $customer->lastname;
                                $user->address = $customer->contact_address;
                                $user->home_phone = $customer->home_phone;
                                $user->work_phone = $customer->work_phone;
                                $user->mobile_phone = $customer->mobile_phone;
                                $user->is_business = $customer->is_business;
                                $user->name = $customer->is_business ? $customer->company : '';
                                $user->pass = sha1($password);
                                
                                if ($user->insert()) {
                                    
                                    $customer->id_user = $user->id;
                                    $customer->update();
                                    
                                    $this->email->from(ADMIN_EMAIL, SITE_NAME);
                                    $this->email->to($user->email);

                                    $this->email->subject('Account Information');
                                    $this->email->message("Account name: ".($customer->is_business ? $customer->company : "$customer->lastname $customer->firstname")."\nLogin email: $user->email\nPassword: $password");

                                    $this->email->send();
                                }
                                 * 
                                 */
                                
                                redirect($back);

                            }

                        }

                    }

                    $array_menus = array();
                    $filter = array();
                    $filter['parent_id'] = 0;
                    $filter['type'] = 1;
                    Menu::getMenuTree($array_menus, $filter);

                    $this->data['customer'] = $customer;
                    $this->data['same'] = $same;
                    $this->data['array_menus'] = $array_menus;
                    $this->data['cfer'] = $cfer;
                    $this->data['backlink'] = $back;
                    $this->data['section'] = $section;

                    $this->load->view('main', $this->data);

                }
                
                function edit($id) {
        
                    User::checkAccessable($this->session->userdata('userID'), 'customer/edit');
                    $back = $this->session->userdata('stored_url') ? $this->session->userdata('stored_url') : base_url('customer');
                    $section = 'customer_form';
                    
                    if (!$id)
                        redirect($back);

                    $cfer = new Cfer(array(
                        lang('txt_dashboard') => base_url('dashboard'),
                        lang('txt_customer_list') => $back,
                        lang('txt_edit_customer') => base_url('customer/edit/')));

                    $act = $this->input->get_post('act');

                    $customer = new Customer();
                    
                    if (!$customer->get($id))
                        redirect($back);
                    
                    $same = $this->input->post('same_address');

                    if ($act == ACT_SUBMIT) {

                        $customer->firstname = utf8_escape_textarea($this->input->post('first_name'));
                        $customer->lastname = utf8_escape_textarea($this->input->post('last_name'));
                        $customer->company = utf8_escape_textarea($this->input->post('company'));
                        $customer->gender = $this->input->post('gender');
                        $customer->birthdate = utf8_escape_textarea($this->input->post('birthdate'));
                        $customer->email = utf8_escape_textarea($this->input->post('email'));
                        $customer->home_phone = utf8_escape_textarea($this->input->post('home_phone'));
                        $customer->work_phone = utf8_escape_textarea($this->input->post('work_phone'));
                        $customer->mobile_phone = utf8_escape_textarea($this->input->post('mobile_phone'));
                        $customer->contact_address = utf8_escape_textarea($this->input->post('address'));
                        $customer->billing_address = utf8_escape_textarea($this->input->post('billing_address'));
                        $customer->shipping_address = $same == 1 ? $customer->billing_address : utf8_escape_textarea($this->input->post('shipping_address'));
                        $customer->website = utf8_escape_textarea($this->input->post('website'));
                        $customer->yahoo_id = utf8_escape_textarea($this->input->post('yahoo_id'));
                        $customer->skype_id = utf8_escape_textarea($this->input->post('skype_id'));
                        $customer->is_business = $this->input->post('is_business');
                        $customer->tax_code = utf8_escape_textarea($this->input->post('tax_code'));
                        $customer->career = utf8_escape_textarea($this->input->post('career'));
                        $customer->contact_person = utf8_escape_textarea($this->input->post('contact_person'));

                        if ($customer->validateInput()) {

                            if ($customer->update()) {
                                /*
                                $user = new User();
                                $user->get($customer->id_user);
                                $send_email = false;
                                
                                if ($user->email != $customer->email) {
                                    $user->email = $customer->email;
                                    $user->pass = sha1(random_string());
                                    $send_email = true;
                                }
                                
                                $user->first_name = $customer->firstname;
                                $user->last_name = $customer->lastname;
                                $user->address = $customer->contact_address;
                                $user->home_phone = $customer->home_phone;
                                $user->work_phone = $customer->work_phone;
                                $user->mobile_phone = $customer->mobile_phone;
                                $user->is_business = $customer->is_business;
                                $user->name = $customer->is_business ? $customer->company : '';
                                
                                if ($user->update() && $send_email) {
                                    
                                    $this->email->from(ADMIN_EMAIL, SITE_NAME);
                                    $this->email->to($user->email);

                                    $this->email->subject('Account Information');
                                    $this->email->message("Account name: ".($customer->is_business ? $customer->company : "$customer->lastname $customer->firstname")."\nLogin email: $user->email\nPassword: $password");

                                    $this->email->send();
                                    
                                }
                                */
                                
                                redirect($back);

                            }

                        }

                    }

                    $array_menus = array();
                    $filter = array();
                    $filter['parent_id'] = 0;
                    $filter['type'] = 1;
                    Menu::getMenuTree($array_menus, $filter);

                    $this->data['customer'] = $customer;
                    $this->data['same'] = $same;
                    $this->data['array_menus'] = $array_menus;
                    $this->data['cfer'] = $cfer;
                    $this->data['backlink'] = $back;
                    $this->data['section'] = $section;

                    $this->load->view('main', $this->data);

                }
                
                function delete($id = null) {
        
                    User::checkAccessable($this->session->userdata('userID'), 'customer/delete');
                    $back = $this->session->userdata('stored_url') ? $this->session->userdata('stored_url') : base_url('customer');

                    $customer = new Customer();

                    if ($id && !$customer->get($id)) {
                        redirect($back);
                    }

                    $customer->is_deleted = IS_DELETED;
                    
                    if ($customer->lastname)
                        $customer->lastname = appendIdtoName ($customer->id, $customer->lastname);
                    
                    if ($customer->firstname)
                        $customer->firstname = appendIdtoName ($customer->id, $customer->firstname);
                    
                    if ($customer->company)
                        $customer->company = appendIdtoName ($customer->id, $customer->company);
                    
                    $customer->update();
                    
                    $user = new User();
                    
                    if ($user->get($customer->id_user)) {
                        $user->disabled = IS_DISABLED;

                        if ($user->last_name)
                            $user->last_name = appendIdtoName ($user->id, $user->last_name);

                        if ($user->first_name)
                            $user->first_name = appendIdtoName ($user->id, $user->first_name);

                        if ($user->name)
                            $user->name = appendIdtoName ($user->id, $user->name);

                        $user->update();
                    }
                    
                    redirect($back);

                }

	}
