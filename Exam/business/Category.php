<?php

	class Category extends Category_model {

		function __construct() {
			parent::__construct();
		}
                public function cat_list_all(){
                    $Category = new Category();
                    $Category->addSelect();
                    $Category->addSelect('category.*');
                    $Category->find();
                    return $Category;
                }
                public function cat_delete(){
                    $kq = false;
                    if (isset($_POST['sb_delete']) && isset($_POST['id'])){
                        $id =  $_POST['id'];
                        $id = $id * 1;
                        $Category = new Category();
                        $Category->id = $id;
                        $kq = $Category->delete();
                    }
                    return $kq;
                }
                public function cat_insert(){
                    if (isset($_POST['sub_insert'])){
                        $name = $this->input->post('name');
                        $Category = new Category();
                        $Category->name = $name;
                        $Category->insert();
                    }
                }
                public function cat_update(){
                    
                    if (isset($_POST['sub_update'])){
                        $id = $this->input->post('id');
                        $name = $this->input->post('name');
                        $Category = new Category();
                        $Category->id = $id;
                        $Category->name = $name;
                        $Category->update();
                    }
                }
	}
