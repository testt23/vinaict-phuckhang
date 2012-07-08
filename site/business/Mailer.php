<?php

class Mailer {
    
    var $ci;
    
    function __construct() {
        
        $this->ci = & get_instance();
    }
    public function sendmail($filter = array()) {
        
        // info product and confirm
        // email confirm
        $fil['self_company_name'] = 'Công ty TNHH Dát Vàng Phúc Khang';
        $fil['self_address'] = '207 Huỳnh Văn Nghệ, P.12, Q. Gò Vấp';
        $fil['self_phone'] = '(08)66806108';
        $fil['self_hotline'] = '0973513579';
        $fil['self_fax'] = '(08)66806108';
        $fil['self_url_name'] = 'www.DatVangNgheThuat.com';
        $fil['self_url'] = 'www.DatVangNgheThuat.com';
        $fil['self_email'] = 'phuckhanggold@gmail.com';
        $fil['title'] = 'Xác nhận thông tin đặt hàng';
        
        $content = '';
        
        @$content = file_get_contents(base_url(). 'email/'.  get_system_language().'/order_confirmation.html');
         
        $content = str_replace('{date_time}', date('d-m-Y'), $content);
        $content = str_replace('{title}',    $fil['title']   , $content);
        
        // info customer
        $content = str_replace('{customer_name}',       $filter['your_name'], $content);
        $content = str_replace('{website_url}',       $fil['self_url_name'], $content);
        $content = str_replace('{website_name}',       $fil['self_url_name'], $content);
        $content = str_replace('{company}',       $filter['company'], $content);
        $content = str_replace('{your_name}',       $filter['your_name'], $content);
        $content = str_replace('{tax_code}',       $filter['tax_code'], $content);
        $content = str_replace('{your_email}',       $filter['your_email'], $content);
        $content = str_replace('{shipping_address}',       $filter['shipping_address'], $content);
        $content = str_replace('{billing_address}',       $filter['billing_address'], $content);
        $content = str_replace('{ym}',       $filter['ym'], $content);
        $content = str_replace('{skype}',       $filter['skype'], $content);
        $content = str_replace('{message}',       $filter['message'], $content);
        $content = str_replace('{info_product}', $filter['info_product']     , $content);
        $content = str_replace('{url_confirm}',  $filter['url_confirm']     , $content);
        
        
        
        
        
       
        $content = str_replace('{self_company_name}',    $fil['self_company_name']   , $content);
        $content = str_replace('{self_address}',   $fil['self_address']   , $content);
        $content = str_replace('{self_phone}',   $fil['self_phone']    , $content);
        $content = str_replace('{self_hotline}',  $fil['self_hotline']     , $content);
        $content = str_replace('{self_fax}',     $fil['self_fax']  , $content);
        $content = str_replace('{self_url_name}', $fil['self_url_name']      , $content);
        $content = str_replace('{self_url}',   $fil['self_url']    , $content);
        $content = str_replace('{self_email}',   $fil['self_email']     , $content);
     
        
        
        $this->ci->load->library('email');
        $this->ci->email->from('TheHalfHeart@gmail.com', 'Nguyen Van Cuong');
        $this->ci->email->to('truong@vinaict.com');
        $this->ci->email->subject('Công ty TNHH Dát Vàng Phúc Khang');
        $this->ci->email->message($content);

        return @$this->ci->email->send();
    }
    

}