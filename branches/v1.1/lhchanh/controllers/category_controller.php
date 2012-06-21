<?php

	class Category_controller extends CI_Controller{

                protected $_arrParrams;
            
		function __construct(){
			parent::__construct();
                        
                        $this->_arrParrams = $_POST;
			// Your own construction code here
		}

		function index(){
			// Your own code here
                    
                   $category = new Category();
                   $t = $category->listItem();
                   $this->data['category'] = $t;
                   $this->load->view('category/index',  $this->data);
                  
		}
                
                function insert(){
                   $category = new Category();
                    
                   if(isset($_POST)){
                     $category->insertItem($this->_arrParrams);
                   }
                    $this->load->view('category/insert');
                }
                
                 function delete(){
                    $category = new Category();
                    $Items = $category->listItem();
                  //  $category->deleteItem(3);
                    
                    $this->data['Items'] = $Items;
                    $this->load->view('category/delete',  $this->data);
                    
                    if(isset($_POST)){
                        
                        $category->deleteItem($this->_arrParrams);
                   }
                }
                
                function update(){
                   
                    // $category = new Category();
                     
                    if($this->_arrParrams != null){
                       // $Items = $category->getItem($this->_arrParrams['id']);
                        //$this->data['Items'] = $Items;
                        $category = new Category();
                         $Item =  $category->getItem($this->_arrParrams['id']);
                        
                        $this->data['Item'] = $Item;
                        
                        
                        
                        if(isset($_POST)){
                        
                            $category->updateItem($this->_arrParrams);
                        }
                   }
                    
                  //  $category->deleteItem(3);
                    
                    $this->load->view('category/update',  $this->data);
                   // $this->load->view('category/update',  $this->data);
                    
                 
                }
		// You can place some more methods code here

	}
