<?php

	class Category_controller extends CI_Controller{

		function __construct(){
			parent::__construct();
			// Your own construction code here
		}

		function index(){
			// Your own code here
                    echo 'max dinh';
		}
                public function cat_list_all($message = ''){
                    $Category = new Category();
                    $List = $Category->cat_list_all();
                    $Data['list'] = $List;
                    $this->load->view('cat_list_all', $Data);
                }
                public function cat_delete(){
                    $Category = new Category();
                    $kq = $Category->cat_delete();
                    $this->cat_list_all();
                }
                public function cat_insert(){
                    $Category = new Category();
                    $Category->cat_insert();
                    $this->cat_list_all();
                }
                public function cat_update(){
                    $Category = new Category();
                    $Category->cat_update();
                    $this->cat_list_all();
                }

	}
