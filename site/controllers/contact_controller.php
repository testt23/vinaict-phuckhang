<?php

class Contact_controller extends CI_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {     
        $data['content'] = 'contact ';
        $this->load->view('temp', $data);
    }
    
    public function contact(){
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
        $message = 'message';

        $not_buy = '1';
        $mucdich = '2';

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
            if ($message == 'message') {
                $message = '';
            }

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
                        $result = "<?php echo lang('show_message_info_1');?>";
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
                        $Cus_update->id_yahoo = $yahoo;
                        $Cus_update->id_skype = $skype;
                        $Cus_update->$career = $career;
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
                            $purchase->code = '';
                            $purchase->id_customer = $Cus_update->id;
                            $purchase->order_date = date('d/m/Y');
                            $purchase->creation_date = date('d/m/Y');
                            $purchase->amount = '';
                            $purchase->currency = '';
                            $purchase->status = '';
                            $purchase->amount = '';
                            $purchase->description = $message;
                            $purchase->billing_address = $billing_address;
                            $purchase->shipping_address = $shipping_address;
                            $purchase->insert();
                            $result = "<?php echo lang('show_message_info_2');?>";

                            $text = '';
                            if (isset($purchase->id) && $Cus_update->id && $mucdich == '2') {
                                for ($i = 0; $i < $total; $i++) {

                                    $text = ' <td width="218" style="border-right:solid 1px #f5f5f5;">' . $list_cart[$i]->get_name_product() . '</td>
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
                                    $details->description_product = $list_cart[$i]->get_description_product();
                                    $details->image_product = $list_cart[$i]->get_image_product();
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
                                $filter['url_confirm'] = '';
                                $filter['shipping_address'] = $shipping_address;
                                $filter['billing_address'] = $billing_address;
                                $mail = new Mailer();
                                $mail->sendmail($filter);
                                $result = "<?php echo lang('show_message_info_3');?>";
                                $Shopping->clear_all();
                            }
                        }
                    }
                } else {
                    $result = "<span style='color: red;'><?php echo lang('show_message_info_4');?><span>";
                }
            } else {
                $result = "<?php echo lang('show_message_info_5');?>";
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
        if ($message == '') {
            $filter['message'] = 'message';
        } else {
            $filter['message'] = $message;
        }

        // menu
        $array_menus = array();
        $filter1 = array();
        $filter1['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter1);
        
        
        $data['mess'] = $result;
        $data['filter'] = $filter;
        $data['content'] = 'order_form';
        $data['array_menus'] = $array_menus;
        $data['selected'] = '';
        $this->load->view('temp', $data);
    }

    
    
    

}