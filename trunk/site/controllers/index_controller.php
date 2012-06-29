<?php

	class Index_controller extends CI_Controller{

		function __construct(){
			parent::__construct();
			// Your own construction code here
		}

		function index($page = 1){
                    
                    $Product = new Product();
                    $info = $Product->getNewProduct($page);
                    $data['product'] = $info['product'];
                    $data['paging'] = $info['paging'];
                    $data['content'] = 'index';
                    $this->load->view('temp', $data);
		}
                public function page($page){
                    $this->index($page);
                }
                
                
                
		// You can place some more methods code here

	}
