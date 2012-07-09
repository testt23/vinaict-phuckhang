<?php

    class Login_controller extends CI_Controller {
        
        function __construct(){
            parent::__construct();
        }

        function index(){
            
            $redirect = base_url('dashboard');
            
            if ($this->session->userdata('userID')) {
                
                $user = new User();
                
                if ($user->get($this->session->userdata('userID'))) {
                    
                    if (User::getPermission($user->id)) {
                        if ($this->session->userdata('last_login_id') != $this->session->userdata('userID')) {
                            $redirect = base_url('dashboard');
                        }
                        $this->session->set_userdata('logged_email', $user->email);
                        redirect($redirect);
                    }
                    
                }
                
            }
            
            $section = "login";

            $user = new User();
            
            $act = $this->input->get_post('act');
            
            $this->session->unset_userdata('userID');
            $this->session->unset_userdata('logged_email');

            if ($act == ACT_SUBMIT) {
                
                $email = $this->input->post('email') ? $this->input->post('email') : "";
                $password = $this->input->post('password') ? $this->input->post('password') : "";
                
                if ($email != "" && $password != "") {
                    
                    if (!User::emailExistByUserID($email)) {
                        
                        User::increaseLoginAttempts($email);
                        MessageHandler::add(lang('err_email_not_exist'), MSG_ERROR, MESSAGE_ONLY);
                        
                    }
                    elseif (User::isDeactivated($email)) {
                        
                        User::increaseLoginAttempts($email);
                        MessageHandler::add(lang('err_email_deactivated'), MSG_ERROR, MESSAGE_ONLY);
                        MessageHandler::add(lang('msg_contact_admin'), MSG_INFO, MESSAGE_ONLY);
                        
                    }
                    else {
                        
                        $acces = User::connect($email, $password);
                        
                        if ($acces) {
                            
                            // Update login time
                            $acces->updateLogin();
                            
                            // Check user permission
                            $perm = User::getPermission($acces->id);
                            
                            if ($perm && $perm != '') {
                                //  Set login user into the session
                                $this->session->set_userdata("userID", $acces->id);
                                $this->session->set_userdata("logged_email", $acces->email);
                                // Reset login attempts
                                User::resetLoginAttempts($acces->email);
                                
                                if ($this->session->userdata('last_login_id') != $this->session->userdata('userID')) {
                                    $redirect = base_url('dashboard');
                                }
                                $this->session->set_userdata('lang',utf8_escape_html($acces->lang));
                                // Redirect user to use the system
                                redirect($redirect);
                            }
                            else {
                                
                                User::increaseLoginAttempts($email);
                                MessageHandler::add(lang('msg_not_granted'), MSG_WARNING, MESSAGE_ONLY);
                                MessageHandler::add(lang('msg_contact_admin'), MSG_INFO, MESSAGE_ONLY);
                            }
                            
                        }
                        else {
                            
                            User::increaseLoginAttempts($email);
                            MessageHandler::add(lang('err_wrong_email_or_password'), MSG_ERROR, MESSAGE_ONLY);
                            
                        }
                        
                    }
                    
                }
                else {
                    
                    MessageHandler::add(lang('err_empty_email_or_password'), MSG_ERROR, MESSAGE_ONLY);
                    
                }
                   
            }
            
            $this->data['login_email'] = isset($email) ? $email : '';
            $this->data['section'] = $section;
            $this->load->view('main', $this->data);
            
        }

        function logout(){
            
            //$this->load->library('session');
            
            $this->session->set_userdata('last_login_id', $this->session->userdata('userID'));
            $this->session->unset_userdata('userID');
            $this->session->unset_userdata('logged_email');
            redirect('login');
            
        }
        
        function lang(){
            
            $lang = $this->input->get_post('lang') ? $this->input->get_post('lang'):'en';
            $logged_user = new User();
            
            if ($logged_user->get($this->session->userdata("userID"))) {
                $logged_user->lang = $lang;
                $logged_user->update();
                $this->session->set_userdata('lang',$logged_user->lang);
            }
            redirect($this->session->userdata('url_lang'));            
        }
    
    }
