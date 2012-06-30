<?php

    class Order_controller extends CI_Controller {

    function __construct(){
        parent::__construct();
        $this->data['logged_email'] = $this->session->userdata('logged_email');
    }

    function index(){
        
        $section = "order";
        
        User::checkAccessable($this->session->userdata('userID'), "order");
        
        // Use for breadcrumb
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_order') => base_url('order'))
        );
        
        $filter = array();
        $filter['code'] = $this->input->get_post('code');
        $filter['name'] = $this->input->get_post('name');
        $filter['description'] = $this->input->get_post('description');
        
        $order        = PurchaseOrder::getList($filter);
        $order_status = PurchaseOrderStatus::getlist();
        
        $this->data['order']        = $order;
        $this->data['filter']       = $filter;
        $this->data['order_status'] = $order_status;

        $array_menus         = array();
        $filter              = array();
        $filter['parent_id'] = 0;
        Menu::getMenuTree($array_menus, $filter);

        $this->data['cfer'] = $cfer;
        $this->data['array_menus'] = $array_menus;
        $this->data['section'] = $section;
        $this->data['image_group_code'] = IMG_PRODUCT_CODE;
        
        $this->load->view('main', $this->data); 
    }
    
     function delete($id = null) {
        
        User::checkAccessable($this->session->userdata('userID'), 'order/delete');
        $back = base_url('order');
        
        $order = new PurchaseOrder();

        if ($id && !$order->get($id)) {
            redirect($back);
        }
        
        $order->delete();
        redirect($back);
    
    }
    
    function status($status = null, $id = null) {
        
        User::checkAccessable($this->session->userdata('userID'), 'order/status');
        $back = base_url('order');
        
        $order = new PurchaseOrder();

        if ($id && !$order->get($id) && $status){
            redirect($back);
        }

        $order->setStatus($status);
        redirect($back);
    
    }
    
    
    
    function detail($id_order = null, $order_status = null) {
        
        User::checkAccessable($this->session->userdata('userID'), 'order/detail');
        $back = base_url('order');
        $section = 'order_detail';
        
        $cfer = new Cfer(array(
            lang('txt_dashboard') => base_url('dashboard'),
            lang('txt_order') => $back,
            lang('txt_order_detail') => base_url('order/detail/'.$id_order)));
        
        
        $order = new PurchaseOrderDetail();
        
        if (!$id_order){
           redirect($back);
        }
        
        $array_menus = array();
        $filter = array();
        $filter['parent_id'] = 0;
        $filter['type'] = 1;
        Menu::getMenuTree($array_menus, $filter);
        
        $order_detail = $order->getList($id_order);
        
        $this->data['order_status'] = $order_status;
        $this->data['order_detail'] = $order_detail;
        $this->data['image_path'] = 'images/';
        $this->data['array_menus'] = $array_menus;
        $this->data['cfer'] = $cfer;
        $this->data['backlink'] = $back;
        $this->data['section'] = $section;
        
        $this->load->view('main', $this->data);
             
    }
    
    function deleteOrderDetail($id_order = null, $order_status = null, $id = null){
        
        User::checkAccessable($this->session->userdata('userID'), 'order/deleteOrderDetail');
        $back = base_url('order/detail/'.$id_order.'/'.$order_status);
        
        $order_detail = new PurchaseOrderDetail();

        if ($id && !$order_detail->get($id) && $id_order && $order_status){
            redirect($back);
        }
        
        $order_detail->deleteOrderDetail($order_status);
        redirect($back);
        
    }
    
    
    
    
}
