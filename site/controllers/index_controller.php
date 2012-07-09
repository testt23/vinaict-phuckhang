<?php

	class Index_controller extends CI_Controller{

		function __construct(){
			parent::__construct();
		}

		function index($page = 1){
                    
                    $product = new Product();
                    $info = $product->getNewProduct($page);
                    $data['product'] = $info['product'];
                    $data['paging'] = $info['paging'];
                    $data['content'] = 'index';
                    
                    $array_menus = array();
                    $filter = array();
                    $filter['parent_id'] = 0;
                    Menu::getMenuTree($array_menus, $filter);
   
                    $data['array_menus'] = $array_menus;
                    
                    $this->load->view('temp', $data);
		}
                public function page($page){
                    $this->index($page);
                }
                
                
                
		// You can place some more methods code here

	}
