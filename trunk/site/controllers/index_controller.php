<?php

	class Index_controller extends CI_Controller{

		function __construct(){
			parent::__construct();
		}

		function index(){
                    
                    $product = new Product();
                    $info = $product->getNewProduct();
                    
                    // Menu 
                    $array_menus = array();
                    $filter = array();
                    $filter['parent_id'] = 0;
                    Menu::getMenuTree($array_menus, $filter);
                    // end menu
                    $data['selected'] = 'home';
                    $data['product'] = $info['product'];
                    $data['paging'] = $info['paging'];
                    $data['content'] = 'index';
                    $data['array_menus'] = $array_menus;
                    $data['title'] = '';
                    $this->load->view('temp', $data);
                    
		}

	}
