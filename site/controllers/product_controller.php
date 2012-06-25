<?php

class Product_controller extends CI_Controller{

    function __construct() {
        
        parent::__construct();
        
    }
    
    public function index(){
        echo 'We are in index page';
    }
    
    public function details($link = false){
        
        if (!empty ($link)){
            
            $Product = new Product();
            $Image = new Image();
            
            $Product_tmp = $Product->getProductByLink($link);
            
            $Product_tmp->fetchFirst();
            $data['product'] = $Product_tmp;
            
            $data['image'] = $Image->getListImageByListId($Product_tmp->the_product_id_prod_image());
            
            $data['content'] = 'prod_details';

            $this->load->view('temp', $data);
            
        }else{
            
            redirect('index');
            
        }
    }
    
    public function order(){
        $Shopping = new ShoppingCart();
        if ($this->input->post('click_access') != null && $this->input->post('click_access') == 'click_access'){
            $id = $this->input->post('h_id');
            $name = $this->input->post('h_name');
            $price = $this->input->post('h_price');
            $image = $this->input->post('h_image');
            $currency = $this->input->post('h_currency');
            $number = 1;
            $Shopping->insert($id, $name, $image, $price, $number, $currency);
        }
        $data['shopping'] = $Shopping->get_list();
        $data['content'] = 'prod_order';
        $this->load->view('temp', $data);
        
    }
    public function prod_cate($cate = '', $page = 1){
        
        $Product = new Product();
        $info = $Product->getProductByCategory($cate, $page);
        $data['content'] = 'index';
        $data['product'] = $info['product'];
        $data['paging'] = $info['paging'];
        $this->load->view('temp', $data);
        
    }

}