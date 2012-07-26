<?php

class Product_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $S = new ShoppingCart();
    }

    public function index() {
        redirect('index');
    }

    
    
    // function display a list products by page
    public function prod_list_by_category($url_cate = '') {
        if (!empty($url_cate)) {
            $Product = new Product();
            $info = $Product->getProductByCategory($url_cate);
            $data['content'] = 'index';            
            $data['product'] = $info['product'];
            $data['paging'] = $info['paging'];
            $data['selected'] = $url_cate;
            
            //seo
            
            $Category = new ProductCategory();
            $list_cate = $Category->getCategoryByLink($url_cate);
            if ($list_cate->countRows() > 0){
                $list_cate->fetchNext();
                $data['title_page'] = $list_cate->get_prod_cate_name();
                $data['description'] = $list_cate->get_prod_cate_meta_description();
                $data['keywords'] = $list_cate->get_prod_cate_keywords();
            }else{
                $data['title_page'] = '';
                $data['description'] = '';
                $data['keywords'] = '';
            }
            
            $array_menus = array();
            $filter = array();
            $filter['parent_id'] = 0;
            Menu::getMenuTree($array_menus, $filter);
            $data['array_menus'] = $array_menus;
            
            $this->load->view('temp', $data);
        } else {
            redirect(Variable::getDefaultPageString());
        }
    }

    
    public function prod_search() {

        $name = '';
        $pric_from = '';
        $pric_to = '';
        $currency = '';
        if ($this->session->userdata('search_name')) {
            $name = $this->session->userdata('search_name');
        }

        if ($this->session->userdata('search_pric_from')) {
            $pric_from = $this->session->userdata('search_pric_from');
        }

        if ($this->session->userdata('search_pric_to')) {
            $pric_to = $this->session->userdata('search_pric_to');
        }

        if ($this->session->userdata('search_currency')) {
            $currency = $this->session->userdata('search_currency');
        }

        if ($this->input->post('button-search') != null) {
            $name = $this->input->post('search-name');
            $pric_from = $this->input->post('price-from-search');
            $pric_to = $this->input->post('price-to-search');
            $currency = $this->input->post('currency-search');
            $this->session->set_userdata('search_currency', $currency);
            $this->session->set_userdata('search_pric_to', $pric_to);
            $this->session->set_userdata('search_pric_from', $pric_from);
            $this->session->set_userdata('search_name', $name);
        }

        $Product = new Product();
        $info = $Product->getProductByname($name, $pric_from, $pric_to, $currency);
        
        // menu tree
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);
        
        // 
        $data['title_page'] = 'search page';
        $data['description'] = $name . ' ' . $pric_from . ' ' . $pric_to . ' ' . $currency;
        $data['keywords'] = $name;
        $data['selected'] = '';
        $data['content'] = 'index';
        $data['product'] = $info['product'];
        $data['paging'] = $info['paging'];
        $data['array_menus'] = $array_menus;
        $data['title'] = '';
        $this->load->view('temp', $data);
    }

    
    
    // function display detail a product
    public function prod_detail($url_link = null) {
        if (!empty($url_link)) { // neu link khong ton tai hay bi trong

            $Product = new Product();
            $Image = new Image();
            $Product_tmp = $Product->getProductByLink($url_link);
            $Product_tmp->fetchFirst();
            $data['product'] = $Product_tmp;

            if ($Product_tmp->countRows() > 0) {
                $data['image'] = $Image->getListImageByListId($Product_tmp->get_product_id_prod_image());
            } else {
                $data['image'] = '';
            }

            // menu tree            
            $array_menus = array();
            $filter = array();
            $filter['parent_id'] = 0;
            Menu::getMenuTree($array_menus, $filter);
            
            
            $data['description'] = $Product_tmp->get_product_short_description();
            $data['keywords'] = $Product_tmp->get_product_keywords();
            $data['title_page'] = $Product_tmp->get_product_keywords();
            
            $data['selected'] = '';
            $data['array_menus'] = $array_menus;
            $data['content'] = 'prod_details';
            $this->load->view('temp', $data);
            
        } else {
            redirect(Variable::getDefaultPageString());
        }
    }

    
    
    // function get list cart and order cart
    public function prod_list_cart() {
        $Shopping = new ShoppingCart();

        if ($this->input->post('click_access') != null && $this->input->post('click_access') == 'click_access') {
            $id_product = $this->input->post('h_id');
            $code_product = $this->input->post('h_code');
            $name_product = $this->input->post('h_name');
            $price_product = $this->input->post('h_price');
            $currency_product = $this->input->post('h_curency');
            $number = 1;
            $Shopping->insert($id_product, $code_product, $name_product, $price_product, $currency_product, $number);
        }
        
        // menu
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);
        
        
        $data['title_page'] = '';
        $data['description'] = '';
        $data['keywords'] = '';
        $data['selected'] = '';
        $data['array_menus'] = $array_menus;
        $data['shopping'] = $Shopping->get_list();
        $data['content'] = 'order_list';
        $this->load->view('temp', $data);
    }
    
    
    // contact
    
    public function prod_contact(){
        $this->prod_order_contact('yes');
    }

    // function contact and buy product
    public function prod_order_contact($fil = '') {
        
        $result = '';
        $is_business = '';
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
        if ($fil != ''){
            $mucdich = '1';
        }
        

        if ($this->input->post('ok-click') != null && $this->input->post('ok-click') == 'ok-click') {

            $mucdich = $this->input->post('mucdich');
            $not_buy = $this->input->post('not-buy');
            $is_business = $this->input->post('muacho');
            $gender = $this->input->post('gender');
            $email = $this->input->post('email');
            $phone = $this->input->post('phone');
            $billing_address = $this->input->post('billing_address');
            $shipping_address = $this->input->post('shipping_address');
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


                if (!empty($list_cart) || $mucdich == '1') {


                    $total = count($list_cart);
                    $Customer = new Customer();
                    $List_customer = $Customer->findByEmail($email);
                    $total_price = '';
                    for ($i = 0; $i < $total; $i++) {
                        $total_price += $list_cart[$i]->get_price_product() * 1;
                    }
                    // neu khach hang da ton tai

                    if ($List_customer->countRows() == 0 && $not_buy == '2') {
                        $result = '<span style="color: red;">'.lang('show_message_info_1') .'</span>';
                    } else {


                        if ($List_customer->countRows() > 0) {
                            // kiem tra danh sach thong so
                            $List_customer->fetchFirst();
                            if ($phone == '') {
                                $phone = $List_customer->work_phone;
                            }

                            if ($billing_address == '') {
                                $billing_address = $List_customer->billing_address;
                            }

                            if ($shipping_address == '') {
                                $shipping_address = $List_customer->shipping_address;
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
                        $Cus_update->billing_address = $billing_address;
                        $Cus_update->shipping_address = $shipping_address;
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

                        if ($List_customer->countRows() > 0) {
                            $Cus_update->id = $List_customer->id;
                            $Cus_update->update();
                        } else {
                            $Cus_update->insert();
                        }

                        if ($Cus_update->id) {
                            // insert purchase order
                            $purchase = new PurchaseOrder();
                            $string_active = substr(md5(date("Y/m/d h:i:s") . $Cus_update->id . $email . rand(0, 1000000)), 0, 12);
                           
                            $purchase->code = $string_active;
                            $purchase->id_customer = $Cus_update->id;
                            $purchase->order_date = date('d/m/Y');
                            $purchase->creation_date = date('d/m/Y');
                            $purchase->amount = '';
                            $purchase->currency = '';
                            $purchase->status = '1';
                            $purchase->amount = '';
                            $purchase->description = $message;
                            $purchase->billing_address = $billing_address;
                            $purchase->shipping_address = $shipping_address;
                            $purchase->insert();
                            $result = lang('show_message_info_2');

                            $text = '';
                            if (isset($purchase->id) && $Cus_update->id && $mucdich == '2') {
                                for ($i = 0; $i < $total; $i++) {

                                    $text .= '<tr> <td width="218" style="border-right:solid 1px #f5f5f5;">' . $list_cart[$i]->get_name_product() . '</td>
                                    <td width="218" style="border-right:solid 1px #f5f5f5;">' . $list_cart[$i]->get_code_product() . '</td>
                                    <td width="218" style="border-right:solid 1px #f5f5f5;">' . $list_cart[$i]->get_price_product() . ' ' . $list_cart[$i]->get_currency_product() . ' </td>
                                    <td width="218" style="border-right:none;">' . $list_cart[$i]->get_number() . '</td>
                                    </tr>';


                                    $details = new PurchaseOrderDetail();
                                    $details->id_purchase_order = $purchase->id;
                                    $details->id_product = $list_cart[$i]->get_id_product();
                                    $details->code_product = $list_cart[$i]->get_code_product();
                                    $details->name_product = $list_cart[$i]->get_name_product();
                                    $details->price_product = $list_cart[$i]->get_price_product();
                                    $details->currency_product = $list_cart[$i]->get_currency_product();
                                    $details->description_product = '';
                                    $details->image_product = '';
                                    $details->number = $list_cart[$i]->get_number();
                                    $details->is_deleted = 0;
                                    $details->insert();
                                }
                                $filter = array();
                                
                                
                                $filter['your_name'] = $firstname . ' ' . $lastname;
                                $filter['website'] = $website;
                                $filter['company'] = $company;
                                $filter['tax_code'] = $tax_code;
                                $filter['your_email'] = $email;
                                $filter['ym'] = $yahoo;
                                $filter['skype'] = $skype;
                                $filter['message'] = $message;
                                $filter['info_product'] = $text;
                                $filter['url_confirm'] = Variable::getLinkActive($string_active, $Cus_update->id);
                                $filter['shipping_address'] = $shipping_address;
                                $filter['billing_address'] = $billing_address;
                                $mail = new Mailer();
                                if ($mail->sendmail($filter)){
                                    $result = lang('show_message_info_3');
                                }else{
                                    $result = lang('show_message_info_8');
                                }                                
                                $Shopping->clear_all();
                            }
                        }
                    }
                } else {
                    $result = '<span style="color: red;">' .lang('show_message_info_4') . '<span>';
                }
            } else {
                $result = '<span style="color: red;">' .lang('show_message_info_5') . '<span>';
            }
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
        
        
        $data['mess'] = $result;
        //echo $result;
        $data['filter'] = $filter;
        $data['content'] = 'order_form';
        $data['array_menus'] = $array_menus;
        $data['selected'] = '';
        
        $data['title_page'] = lang('title_page_contact_us');
        $data['description'] = '';
        $data['keywords'] = '';
        
        $this->load->view('temp', $data);
    }

    public function update_shopping($id, $number) {
        if ($number*1 > 0){
            $Shopping = new ShoppingCart();
            $Shopping->update_number($id, $number);
        }
    }

    public function delete_shopping($id) {
        $Shopping = new ShoppingCart();
        $Shopping->delete($id);
    }
    public function active_cat(){
        $Product = new Product();
        if ($Product->activeCartShop()){
            $mess = lang('show_message_info_6');
        }else{
            $mess = lang('show_message_info_7');
        }
        // menu
        $array_menus = array();
        $filter1 = array();
        $filter1['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter1);
        $data['array_menus'] = $array_menus;
        $data['selected'] = '';
        $data['content'] = 'active';
        $data['mess'] = $mess;
        $this->load->view('temp', $data);
        
    }
    
    

}

