<?php

class Mailer {
    
    var $ci;
    
    function __construct() {
        
        $this->ci = & get_instance();
    }
    public function sendmail($filter = array()) {
        
        // info product and confirm
        // email confirm
        $fil['self_company_name'] = getI18n(Variable::getCompanyName(), get_system_language());
        $fil['self_address'] = getI18n(Variable::getCompanyAddress(), get_system_language());;
        $fil['self_phone'] = Variable::getCompanyPhone();
        $fil['self_hotline'] = Variable::getCompanyHotline();
        $fil['self_fax'] = Variable::getCompanyFax();
        $fil['self_url_name'] = Variable::getDomainName();
        $fil['self_url'] = Variable::getDomainName();
        $fil['self_email'] = Variable::getCompanyMail();
        $fil['title'] = getI18n(Variable::getTitelMail(), get_system_language());
        
        $content = '';
        
        @$content = file_get_contents(base_url(). 'email/'.  get_system_language().'/order_confirmation.html');
         
        $content = str_replace('{date_time}', date('d-m-Y'), $content);
        $content = str_replace('{title}',    $fil['title']   , $content);
        //echo $fil['title'];
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
        $this->ci->email->from(Variable::getCompanyMail(), Variable::getCompanyName());
        $this->ci->email->to($filter['your_email']);
        $this->ci->email->subject(getI18n(Variable::getObjectNameEmail(), get_system_language()));
        $this->ci->email->message($content);
        return @$this->ci->email->send();
    }
    

}