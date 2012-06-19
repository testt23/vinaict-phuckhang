<?php

	class Category extends Category_model {

		function __construct() {
			parent::__construct();
		}
                
                function hello(){
                    
                    $hello = '<br> Hello';
                    
                    return $hello;
                }

                public function listItem(){
                    //echo 'test';
                    $category = new Category();
                    $category->addSelect();
                    $category->addSelect('category.*');
                    $category->find();
                    
                    return $category;
                   
                }
                
                public function getItem($id){
                    //echo 'test';
                    $category = new Category();
                    $category->addSelect();
                    $category->addSelect('category.*');
                    $category->addWhere('id = $id');
                    $category->find();
                    
                    return $category;
                   
                }
                
                public function insertItem($_arrParam){
                    
                    $category = new Category();
                   // $category->addSelect();
                  if(isset($_arrParam) and $_arrParam != null){
                      
                    $category->name = $_arrParam['name'];
                    $category->insert();
                    
                  }
                }
                
                public function deleteItem($_arrParam){
                    
                   
                    $category = new Category();
                   // $category->addSelect();
                    if(isset($_arrParam) and $_arrParam != null){
                  // echo $_arrParam['id'];
                        $category->get($_arrParam['id']); 
                    
                        $category->delete();
                    }
                }
                
                public function updateItem($id){
                   // $category->addSelect();
                   echo '<br>' ;
                    if(isset($_arrParam) and $_arrParam != null){
                  // echo $_arrParam['id'];
                         $category = new Category();
                        $category->updateItem($_arrParam['id']);
                    
                        $category->update();
                    }
                    
              
                }
                
	}
