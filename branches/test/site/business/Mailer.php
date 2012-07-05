<?php

class Mailer {
    
    var $ci;
    function __construct() {
        $this->ci = & get_instance();
    }
    public function sendmail($filter = array()) {
        $content = '';
        if (!empty($filter)):
        $content = file_get_contents(base_url(). 'email/vi/order_confirmation.html');
        $content = str_replace('{title}',       $filter['title'], $content);
        $content = str_replace('{txt_welcome}', $filter['txt_welcome'], $content);
        $content = str_replace('{customer_name}', $filter['customer_name'], $content);
        $content = str_replace('{your_name}',   $filter['your_name'], $content);
        $content = str_replace('{company}',     $filter['company'], $content);
        $content = str_replace('{tax_code}',    $filter['tax_code'], $content);
        $content = str_replace('{fax}',         $filter['fax'], $content);
        $content = str_replace('{email}',       $filter['email'], $content);
        $content = str_replace('{shopping_address}', $filter['shopping_address'], $content);
        $content = str_replace('{billing_address}', $filter['billing_address'], $content);
        $content = str_replace('{yahoo}',       $filter['yahoo'], $content);
        $content = str_replace('{skype}',       $filter['skype'], $content);
        $content = str_replace('{message}',     $filter['message'], $content);
        $content = str_replace('{list_product}', $filter['list_product'], $content);
        $content = str_replace('{contact_email}', $filter['contact_email'], $content);
        $content = str_replace('{contact_name}', $filter['contact_name'], $content);
        $content = str_replace('{url_confirm}', $filter['url_confirm'], $content);
        
        endif;
        
        $this->ci->load->library('email');
        $this->ci->email->from('TheHalfHeart@gmail.com', 'Your Name');
        $this->ci->email->to('thehalfheart@gmail.com');
        $this->ci->email->subject('Test Mail');
        $this->ci->email->message('<div style="background: red; width: 200px; height: 200px;">fsad</div>');

        if($this->ci->email->send()){
            echo 'Send thanh cong';
        }else{
            echo 'Send that bai';
        }
        
    }
    

}