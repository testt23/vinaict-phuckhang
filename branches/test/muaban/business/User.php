<?php

	class User extends User_model {

		function __construct() {
			parent::__construct();
		}
                
                public function loaduser(){
                    $user_load = new User();
                    $user_load->addSelect();
                    $user_load->addSelect('user.*');
                    $user_load->find();
                    
                    return $user_load; 
                }




                public function Adduser(){
                    $firstname = $this->input->post('firstname');
                    $lastname = $this->input->post('lastname');
                    $address = $this->input->post('address');
                    $email = $this->input->post('email');
                    
                    $this->last_name = $lastname;
                    $this->first_name = $firstname;
                    $this->address = $address;
                    $this->email = $email;
                    
                    $this->insert();
                }
                
                
                public function Deteleuser(){
                    $id = $this->input->post('id');
                    $user = new User();
                    $user->id = $id;
                    $user->delete();
                }
                
                public function Showupdate(){
                    $user_show = new User();
                    $id = $this->input->post('id');
                    
                    $user_show->get($id);
                    return $user_show;
                }


                public function Updateuser(){
                    $user_up = new User();
                    
                    $user_up->id = $this->input->post('id');
                    $user_up->first_name = $this->input->post('firstname');
                    $user_up->last_name = $this->input->post('lastname');
                    $user_up->address = $this->input->post('address');
                    $user_up->email = $this->input->post('email');
                    
                    $user_up->insert();
                    
                }
	}
