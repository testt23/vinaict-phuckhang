<?php

class Contact_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() { 
        
        //menu
        $array_menus = array();
        $filter1 = array();
        $filter1['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter1);
        
        $data['content'] = 'contact';
        $data['array_menus'] = $array_menus;
        $data['selected'] = 'contact';      
        
        $data['content'] = 'contact';    
        $data['title_page'] = lang('title_page_contact');
        $data['description'] = lang('description_page_contact');
        $data['keywords'] = lang('keywords_page_contact');
        $this->load->view('temp', $data);
    }
    
    public function contact(){
        $data['description'] = '';
        $data['keywords'] = '';
        $result = '';
        $is_business = '0';
        $gender = '0';
        $email = '';
        $phone = '';
        $billing_address = '';
        $shipping_address = '';
        $firstname = '';
        $lastname = '';
        $company = '';
        $contact_person = '';
        $website = '';
        $tax_code = '';
        $address = '';
        $yahoo = '';
        $skype = '';
        $career = '';
        $message = '';

        $not_buy = '1';
        $mucdich = '2';

        if ($this->input->post('ok-click') != null && $this->input->post('ok-click') == 'ok-click') {

            $mucdich = $this->input->post('mucdich');
            $not_buy = $this->input->post('not-buy');
            $is_business = $this->input->post('muacho');
            $gender = $this->input->post('gender');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $company = $this->input->post('company');
            $contact_person = $this->input->post('contact_person');
            $website = $this->input->post('website');
            $tax_code = $this->input->post('tax_code');
            $address = $this->input->post('address');
            $yahoo = $this->input->post('yahoo');
            $skype = $this->input->post('skype');
            $career = $this->input->post('career');
            $message = $this->input->post('message');
           

            if ($email != '') {

                $Shopping = new ShoppingCart();
                $list_cart = $Shopping->get_list();

                if ($mucdich == '1') {


                    $total = count($list_cart);
                    $Customer = new Customer();
                    $List_customer = $Customer->findByEmail($email);
                    
                    // neu khach hang da ton tai

                    if ($List_customer->countRows() == 0 && $not_buy == '2') {
                        $result = "<?php echo lang('show_message_info_1');?>";
                    } else {


                        if ($List_customer->countRows() > 0) {
                            // kiem tra danh sach thong so
                            $List_customer->fetchFirst();
                            if ($phone == '') {
                                $phone = $List_customer->work_phone;
                            }
                           
                            if ($firstname == '') {
                                $firstname = $List_customer->firstname;
                            }

                            if ($lastname == '') {
                                $lastname = $List_customer->lastname;
                            }

                            if ($company == '') {
                                $company = $List_customer->company;
                            }

                            if ($contact_person == '') {
                                $contact_person = $List_customer->contact_person;
                            }

                            if ($website == '') {
                                $website = $List_customer->website;
                            }

                            if ($tax_code == '') {
                                $tax_code = $List_customer->tax_code;
                            }

                            if ($address == '') {
                                $address = $List_customer->contact_address;
                            }

                            if ($yahoo == '') {
                                $yahoo = $List_customer->yahoo_id;
                            }

                            if ($skype == '') {
                                $skype = $List_customer->skype_id;
                            }

                            if ($career == '') {
                                $career = $List_customer->career;
                            }
                        }
                        $Cus_update = new Customer();

                        $Cus_update->gender = $gender;
                        $Cus_update->email = $email;
                        $Cus_update->work_phone = $phone;
                        $Cus_update->firstname = $firstname;
                        $Cus_update->is_business = $is_business;
                        $Cus_update->lastname = $lastname;
                        $Cus_update->company = $company;
                        $Cus_update->contact_person = $contact_person;
                        $Cus_update->website = $website;
                        $Cus_update->tax_code = $tax_code;
                        $Cus_update->contact_address = $address;
                        $Cus_update->yahoo_id = $yahoo;
                        $Cus_update->skype_id = $skype;
                        $Cus_update->career = $career;
                        $Cus_update->description = $message;
                        $Cus_update->billing_address = $billing_address;
                        $Cus_update->shipping_address = $shipping_address;
                                                
                        if ($List_customer->countRows() > 0) {
                            $Cus_update->id = $List_customer->id;
                            $Cus_update->update();
                        } else {
                            $Cus_update->insert();
                            
                        }
                        
                        $filter = Array();
                        
                        $filter['your_name'] = $firstname . ' ' . $lastname;
                        $filter['website'] = $website;
                        $filter['company'] = $company;
                        $filter['contact_person'] = $contact_person;
                        $filter['tax_code'] = $tax_code;
                        $filter['your_email'] = $email;
                        $filter['ym'] = $yahoo;
                        $filter['skype'] = $skype;
                        $filter['message'] = $message;
                        $filter['is_business'] = $is_business; 
                        $filter['phone'] = $phone;
                        
                        $mail = new Mailer();
                        if($mail->sendContact($filter)){
                            $result = lang('show_message_info_2');
                        } else{
                            $result = lang('show_message_contact_fail');
                        }
                        

                    }
                } else {
                    $result = "<span style='color: red;'><?php echo lang('show_message_info_4');?><span>";
                }
            } else {
                $result = "<?php echo lang('show_message_info_5');?>";
            }
        }
        
        if($is_business == 1){
            $firstname = '';
            $lastname  = '';
        }else {
            $company    = '';
            $website    = '';
            $contact_person = '';
            $tax_code   = '';
        }
        
        $filter = array();
        $filter['mucdich'] = $mucdich;
        $filter['not_buy'] = $not_buy;
        $filter['is_business'] = $is_business;
        $filter['gender'] = $gender;
        $filter['email'] = $email;
        $filter['phone'] = $phone;
        $filter['billing_address'] = $billing_address;
        $filter['shipping_address'] = $shipping_address;
        $filter['firstname'] = $firstname;
        $filter['lastname'] = $lastname;
        $filter['company'] = $company;
        $filter['contact_person'] = $contact_person;
        $filter['website'] = $website;
        $filter['tax_code'] = $tax_code;
        $filter['address'] = $address;
        $filter['yahoo'] = $yahoo;
        $filter['skype'] = $skype;
        $filter['career'] = $career;
        $filter['message'] = $message;
        
        // menu
        $array_menus = array();
        $filter1 = array();
        $filter1['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter1);
        
        $data['title_page'] = lang('title_page_contact');
        $data['description'] = lang('description_page_contact');
        $data['keywords'] = lang('keywords_page_contact');
        
        $data['mess'] = $result;
        $data['filter'] = $filter;
        $data['content'] = 'contact';
        $data['array_menus'] = $array_menus;
        $data['selected'] = 'contact';       
        $this->load->view('temp', $data);
    }

    
    
    

}