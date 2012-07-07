<?php

class Product_controller extends CI_Controller {
    
    function __construct() {

        parent::__construct();
        
    }

    public function index() {
        redirect('index');
    }

    // function display a list products by page
    public function prod_list_by_category($url_cate = '', $url_page = 1) {
        if (!empty($url_cate)) {
            $Product = new Product();
            $info = $Product->getProductByCategory($url_cate, $url_page);
            $data['content'] = 'index';
            $data['product'] = $info['product'];
            $data['paging'] = $info['paging'];
            $this->load->view('temp', $data);
        } else {
            redirec('index');
        }
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
                $data['image'] = $Image->getListImageByListId($Product_tmp->the_product_id_prod_image());
            } else {
                $data['image'] = '';
            }


            $data['content'] = 'prod_details';

            $this->load->view('temp', $data);
        } else {
            redirect('index');
        }
    }

    public function prod_list_cart() { // 
        $Shopping = new ShoppingCart();

        if ($this->input->post('click_access') != null && $this->input->post('click_access') == 'click_access') {
            $id_purchase_order = '';
            $id_product = $this->input->post('h_id');
            $code_product = $this->input->post('h_code');
            $name_product = $this->input->post('h_name');
            $price_product = $this->input->post('h_price');
            $currency_product = $this->input->post('h_curency');
            $description_product = $this->input->post('h_description');
            $image_product = $this->input->post('h_image');
            $number = 1;
            $is_deleted = 0;
            $link_product = $this->input->post('h_link');

            $Shopping->insert($id_purchase_order, $id_product, $code_product, $name_product, $price_product, $currency_product, $description_product, $image_product, $number, $is_deleted, $link_product);
        }


        $data['shopping'] = $Shopping->get_list();
        $data['content'] = 'order_list';
        $this->load->view('temp', $data);
    }

    public function prod_order_contact() {
        $mess = '';
        
        $description = '';
        $firstname = $this->input->post('firstname');
        $lastname = $this->input->post('lastname');
        $company = $this->input->post('company');
        $gender = $this->input->post('gender');
        $birthday = '';
        $billing_address = $this->input->post('billing_addres');
        $shipping_address = $this->input->post('shipping_address');
        $contact_address = '';
        $home_phone = $this->input->post('home_phone');
        $work_phone = $this->input->post('work_phone');
        $mobile_phone = $this->input->post('mobile_phone');
        $website = $this->input->post('website');
        echo '<pre>' .  $website  . 'CHUNG TOI LA AI' . '</pre>';
        $yahoo_id = $this->input->post('yahoo');
        $skype_id = $this->input->post('Skype');
        $is_deleted = 0;
        $id_user = '';
        $is_business = 0;
        if ($this->input->post('option_contact') == '1') {
            $is_business = 1;
        }
        $tax_code = $this->input->post('tax_code');
        $fax = $this->input->post('fax');
        $career = $this->input->post('career');
        $contact_person = '';
        $position = '';
        $email = $this->input->post('email');

        $ShoppingCart = new ShoppingCart();
        $List = $ShoppingCart->get_list();
        $data['shopping'] = $List;

        // neu form duoc submit
        if ($this->input->post('check') != null && $this->input->post('check') == 'order-ok') {
            if ($List) {
                if (trim($email) != '') {
                    $CM = new Customer();
                    $Customer = $CM->findByEmail($email);
                    $cus_id = '';
                    
                    // khach hang da ton tai
                    if ($Customer->countRows() > 0) {
                        
                        $Customer->fetchFirst();
                        
                        if (empty ($firstname)) {
                            $firstname = $Customer->firstname;
                        }
                        if (empty ($lastname)) {
                            $lastname = $Customer->lastname;
                        }
                        if (empty ($company )) {
                            $company = $Customer->company;
                        }
                        if (empty ($billing_address )) {
                            $billing_address = $Customer->billing_address;
                        }
                        if (empty ($shipping_address)) {
                            $shipping_address = $Customer->shipping_address;
                        }
                        if (empty ($home_phone)){
                            $home_phone = $Customer->home_phone;
                        }
                        if (empty ($work_phone)) {
                            $work_phone = $Customer->work_phone;
                        }
                        if (empty ($mobile_phone)) {
                            $mobile_phone = $Customer->mobile_phone;
                        }
                        if (empty ($website)){
                            echo 'VAO WEBSITE';
                            $website = $Customer->website;
                        }
                        if (empty ($yahoo_id)){
                            $yahoo_id = $Customer->yahoo_id;
                        }

                        if (empty ($skype_id)){
                            $skype_id = $Customer->skype_id;
                        }
                        if (empty ($tax_code)) {
                            $tax_code = $Customer->tax_code;
                        }
                        if (empty ($fax)) {
                            $fax = $Customer->fax;
                        }
                        if (empty ($career)){
                            $fax = $Customer->fax;
                        }
                        
                        $Cus = new Customer();
                        $Cus->id = $Customer->id;
                        $Cus->email = $email;
                        $Cus->firstname = $firstname;
                        $Cus->lastname = $lastname;
                        $Cus->company = $company;
                        $Cus->gender = $gender;
                        $Cus->birthdate = $birthday;
                        $Cus->billing_address = $billing_address;
                        $Cus->shipping_address = $shipping_address;
                        $Cus->contact_address = $contact_address;
                        $Cus->home_phone = $home_phone;
                        $Cus->work_phone = $work_phone;
                        $Cus->mobile_phone = $mobile_phone;
                        $Cus->website = $website;
                        
                        $Cus->yahoo_id = $yahoo_id;
                        $Cus->skype_id = $skype_id;
                        $Cus->tax_code = $tax_code;
                        $Cus->fax = $fax;
                        $Cus->career = $career;
                        $Cus->update();
                        $cus_id = $Cus->id;
                    } else {
                        $Shopping = new ShoppingCart();

                        // them khach hang moi
                        if (empty($billing_address)) {
                            $mess = 'Vui lòng nhập địa chỉ nhận tiền';
                        } else if (empty($shipping_address)) {
                            $mess = 'Vui lòng nhập địa chỉ giao hàng';
                        } else if (empty($firstname) || !empty($lastname)) {
                            $mess = 'Vui lòng nhập tên của bạn';
                        } else if ($is_business == '1') {
                            if (empty($company)) {
                                $mess = 'Vui lòng nhập tên công ty';
                            }if (empty($work_phone)) {
                                $mess = 'Vui lòng nhập điện thoại công ty';
                            }if (empty($tax_code)) {
                                $mess = 'Vui lòng nhập mã số thuế';
                            }
                        } else {
                            $Cus = new Customer();
                            $Cus->email = $email;
                            $Cus->firstname = $firstname;
                            $Cus->lastname = $lastname;
                            $Cus->company = $company;
                            $Cus->gender = $gender;
                            $Cus->birthdate = $birthday;
                            $Cus->billing_address = $billing_address;
                            $Cus->shipping_address = $shipping_address;
                            $Cus->contact_address = $contact_address;
                            $Cus->home_phone = $home_phone;
                            $Cus->work_phone = $work_phone;
                            $Cus->mobile_phone = $mobile_phone;
                            $Cus->website = $website;
                            $Cus->yahoo_id = $yahoo_id;
                            $Cus->skype_id = $skype_id;
                            $Cus->tax_code = $tax_code;
                            $Cus->fax = $fax;
                            $Cus->career = $career;
                            $Cus->insert();
                            $cus_id = $Cus->id;
                        }
                    }
                    if (!empty($cus_id)) {
                        // insert order
                        $description = $this->input->post('description');
                        $PurchaseOrder = new PurchaseOrder();
                        $PurchaseOrder->id_customer = $cus_id;
                        $PurchaseOrder->order_date = date('Y/d/m');
                        $PurchaseOrder->amount = 0;
                        $PurchaseOrder->is_deleted = 0;
                        $PurchaseOrder->status = '';
                        $PurchaseOrder->description = $description;
                        $PurchaseOrder->billing_address = $billing_address;
                        $PurchaseOrder->shipping_address = $shipping_address;
                        $PurchaseOrder->shipping_date = '';
                        $PurchaseOrder->payment_date = '';
                        $PurchaseOrder->creation_date = '';
                        $PurchaseOrder->modification_date = '';
                        $PurchaseOrder->insert();

                        // insert into Order details
                        $total = count($List);
                        $list_product = '';
                        for ($i = 0; $i < $total; $i++) {
                            $list_product .= '<tr class="tt-info">
                                    <td width="218"><a href="'.$List[$i]->get_link_product().'">' . $List[$i]->get_name_product() . '</a></td>
                                    <td width="218">' . $List[$i]->get_id_product() . '</td>
                                    <td width="218">' . $List[$i]->get_price_product() . ' ' . $List[$i]->get_currency_product() . '</td>
                                    <td width="218">' . $List[$i]->get_number() . '</td>
                                    </tr>';
                            $Details = new PurchaseOrderDetail();
                            $Details->id_purchase_order = $PurchaseOrder->id;
                            $Details->id_product = $List[$i]->get_id_product();
                            $Details->code_product = $List[$i]->get_code_product();
                            $Details->name_product = $List[$i]->get_name_product();
                            $Details->price_product = $List[$i]->get_price_product();
                            $Details->currency_product = $List[$i]->get_currency_product();
                            $Details->desciption_product = $List[$i]->get_description_product();
                            $Details->image_product = $List[$i]->get_image_product();
                            $Details->number = $List[$i]->get_number();
                            $Details->is_deleted = '0';
                            $Details->link_product = $List[$i]->get_link_product();
                            $Details->insert();
                            unset($Details);
                        }
                        // send mail
                       
                        $filter = array();
                        $filter['company'] = $company;
                        $filter['your_name'] = $firstname . ' ' . $lastname;
                        $filter['tax_code'] = $tax_code;
                        $filter['website'] = $website;
                        $filter['fax'] = $fax;
                        $filter['your_email'] = $email;
                        $filter['shipping_address'] = $shipping_address;
                        $filter['billing_address'] = $billing_address;
                        $filter['ym'] = $yahoo_id;
                        $filter['skype'] = $skype_id;
                        $filter['message'] = $description;
                        $filter['info_product'] = $list_product;
                        $filter['url_confirm'] = '#confirm';
                        $Mailer = new Mailer();
                        $Mailer->sendmail($filter);
                        
                        $mess = 'Cám ơn bạn đã đặt hàng. vui lòng vào email xác nhận mua hàng, chúng tôi sẽ liên hệ với bạn sớm nhất. xin cám ơn.';
                    }else{
                        $mess = 'Bạn chưa mua sản phẩm nào. vui lòng chọn khách hàng bình thường và điền đầy đủ thông tin';
                    }
                }  else {
                    $mess = 'Vui lòng nhập email';
                }
            }else{ //  neu chua co mon hang nao
                $mess = 'Bạn chưa có món hàng nào';
            }
        }
        
        
       
        // load data into view and select view
        
        $new_customer = '1';
        if ($this->input->post('new-customer') != null) {
            $new_customer = $this->input->post('new-customer');
        }
        
        $filter = array();
        $filter['yahoo'] = $yahoo_id;
        $filter['skype'] = $skype_id;
        $filter['option_contact'] = $this->input->post('option-contact');
        $filter['website'] = $website;
        $filter['email'] = $email;
        $filter['gender'] = $gender;
        $filter['new_customer'] = $new_customer;
        $filter['tax_code'] = $tax_code;
        $filter['fax'] = $fax;
        $filter['mobile_phone'] = $mobile_phone;
        $filter['work_phone'] = $work_phone;
        $filter['home_phone'] = $home_phone;
        $filter['description'] = $description;
        $filter['firstname'] = $firstname;
        $filter['lastname'] = $lastname;
        $filter['company'] = $company;
        $filter['career'] = $career;
        $filter['gender'] = $gender;
        $filter['billing_address'] = $billing_address;
        $filter['shipping_address'] = $shipping_address;
        $data['filter'] = $filter;
        $data['content'] = 'order_form';
        $data['mess'] = $mess;
        $this->load->view('temp', $data);
    }

}