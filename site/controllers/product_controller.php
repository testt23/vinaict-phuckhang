<?php

class Product_controller extends CI_Controller{

    function __construct() {
        
        parent::__construct();
        
    }
    
    public function index(){
        redirect('index');
    }
     
    // function display a list products by page
    public function prod_list_by_category($url_cate = '', $url_page = 1){
        if (!empty($url_cate)){
            $Product = new Product();
            $info = $Product->getProductByCategory($url_cate, $url_page);
            $data['content'] = 'index';
            $data['product'] = $info['product'];
            $data['paging'] = $info['paging'];
            $this->load->view('temp', $data);
        }
        else{
            redirec('index');
        }
    }
    
    // function display detail a product
    public function prod_detail($url_link = null){
        if (!empty ($url_link)){ // neu link khong ton tai hay bi trong
            $Product = new Product();
            $Image = new Image();
            
            $Product_tmp = $Product->getProductByLink($url_link);
            $Product_tmp->fetchFirst();
            $data['product'] = $Product_tmp;
            if ($Product_tmp->countRows() > 0){
                $data['image'] = $Image->getListImageByListId($Product_tmp->the_product_id_prod_image());
            }else{
                $data['image'] = '';
            }
            
            
            $data['content'] = 'prod_details';

            $this->load->view('temp', $data);
            
        }else{
            redirect('index');
        }
    }
   
    
    
    public function prod_list_cart(){ // 
        $Shopping = new ShoppingCart();
        
        if ($this->input->post('click_access') != null && $this->input->post('click_access') == 'click_access'){
            $id_purchase_order = '';
            $id_product = $this->input->post('h_id');
            $code_product = $this->input->post('h_code');
            $name_product = $this->input->post('h_name');
            $price_product = $this->input->post('h_price');
            $currency_product = $this->input->post('h_curency');
            $description_product = $this->input->post('h_description');
            $image_product = $this->input->post('h_image');
            $number  = 1;
            $is_deleted = 0 ;
            $link_product = $this->input->post('h_link');
            
            $Shopping->t_insert( $id_purchase_order, 
                    $id_product, $code_product, $name_product,
                    $price_product, $currency_product, $description_product, 
                    $image_product, $number, $is_deleted, $link_product);
        }
        
        
        $data['shopping'] = $Shopping->get_list();
        $data['content'] = 'order_list';
        $this->load->view('temp', $data);
        
    }
    
    
    public function prod_order_contact(){
        $data['content'] = 'order_form';
        $this->load->view('temp', $data);
        if ($this->input->post('check') != null && $this->input->post('check') == 'order-ok'){
            $email = $this->input->post('email');
            $Customer = new Customer();
            $Cus = $Customer->getByEmail($email);
            
            $cus_id = '';
            $ord_id = '';
            if ($Cus->countRows() > 0){
                // khoong them khach hang moi
                // insert order before
                $Cus->fetchFirst();
                $cus_id = $Cus->{$this->if->_customer_as_id};
                $Order = new Order();
                $ord_id = $Order->insert($cus_id, $this->input->post('description'));
                
                
            }else{
                // them khach hang moi
                $cus = $Customer->insert();
                $cus_id = $Customer->id;
                // insert into order
                $Order = new Order();
                $ord_id = $Order->insert($cus_id, $this->input->post('description'));
            }
        }
    }
    

}