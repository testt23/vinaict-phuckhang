<?php

	class User_controller extends CI_Controller{

		function __construct(){
			parent::__construct();
			// Your own construction code here
		}

		function index(){
			// Your own code here
		}

		// You can place some more methods code here
                
                public function load_user(){
                    $user_load = new User();
                    $data = $user_load->loaduser();
                    
                    $this->data['data'] = $data; 
                    $this->load->view('user',$this->data);
                } 
                
                public function insert_user(){
                    $user_add = new User();
                    $user_add->Adduser();
                    $this->load_user();
                } 
                public function detele_user(){
                    $user_del = new User();
                    $user_del->Deteleuser();
                   
                    $this->load_user();
                }
                
                public function updateuser(){
                   $user_up = new User();
                   $user_up->Updateuser();
                   
                   $this->
                }
	}
