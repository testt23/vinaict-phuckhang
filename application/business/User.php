<?php

class User extends User_model {
    
    function __construct() {
        parent::__construct();
    }
    
    function validateChangePassword($new_password, $confirm_password) {
        if (trim($new_password) == "")
        {
            MessageHandler::add (lang('err_empty_new_password'), MSG_ERROR, MESSAGE_ONLY);
        }
        elseif(strlen($new_password) > MAX_LENGTH_PASSWORD)
        {
            MessageHandler::add (lang('err_password_too_long'), MSG_ERROR, MESSAGE_ONLY);
        }
        elseif(strlen($new_password) < MIN_LENGTH_PASSWORD)
        {
            MessageHandler::add (lang('err_password_too_short'), MSG_ERROR, MESSAGE_ONLY);
        }
        elseif (trim($confirm_password) == "") {
            MessageHandler::add (lang('err_empty_confirm_password'), MSG_ERROR, MESSAGE_ONLY);
        } elseif ($new_password != $confirm_password)
        {
            MessageHandler::add (lang('err_password_confirm_not_match'), MSG_ERROR, MESSAGE_ONLY);
        }
        return MessageHandler::countError() > 0 ? false : true;
    }
    
	/**
	 * Check if email of the user exist
	 *
	 * @param string $email
	 * @return int $id is the User ID
	 */
	function userExistByEmail($email) {

		$user = new User();
		$user->addWhere("email = '$email'");
		$user->addWhere("disabled = ".IS_NOT_DISABLED);
		$user->find();
                
                if($user->fetchFirst()) {
                    return $user->id;
                }
                
                return false;
	}
    
    /**
	 * Check if email of the user exist
	 *
	 * @param string $email
	 * @param string $userID
	 * @return int $id is the User ID
	 */
	public static function emailExistByUserID($email, $userID = null) {
		
            $user = new User();
            $user->addWhere("email = '$email'");
            if ($userID)
                    $user->addWhere("id <> " . $userID);
            $user->addWhere("disabled = ".IS_NOT_DISABLED);
            $user->find();

            if($user->fetchFirst()) {
                return $user->id;
            }
            return false;
            
	}
    /**
	 * Insert/Update the User
	 *
	 * @return data_object updated
	 */
	function store() {
		if ($this->id==0)
			return $this->insert();
		else return $this->update();
	}
    
    function updateLogin() {
		$this->date_last_login = date("Y-m-d G:i:s");
		$this->update();
	}
    
    function isExistUserID()
    {
        
        $user = new User();
        $user->addWhere('id = ' . $this->session->userdata('userID'));
        $user->addWhere('disabled = '.IS_NOT_DISABLED);
        $user->find();
        
        if ($user->countRows() > 0)
            return true;
        else
            return false;
        
    }
    
    public static function increaseLoginAttempts($email)

    {
            if ($email)

            {
                    $obj_user = new User();
                    $obj_user->addWhere("email = '$email'");
                    $obj_user->find();

                    if ($obj_user->fetchNext())
                    {
                            $obj_user->login_attempts += 1;

                            if ($obj_user->login_attempts >= ALLOWED_LOGIN_ATTEMPTS)
                            {
                                    $obj_user->deactived = 1;
                            }
                            $obj_user->update();
                    }
            }
    }
    
     public static function resetLoginAttempts($email)

    {
            if ($email)

            {
                    $obj_user = new User();
                    $obj_user->addWhere("email = '$email'");
                    $obj_user->find();
                    if ($obj_user->fetchNext())
                    {
                            if (!$obj_user->deactived || $obj_user->deactived == 0)

                            {
                                    $obj_user->login_attempts = "0";

                                    $obj_user->update();
                            }
                    }
            }
    }
	
	public static function isPassTransformRule($new_user)
	{/*
		$bln_pass = true;

		// if transform-to account is SUPPORT or REGIE
		if ($new_user->is_controller)
		{
			if (($_SESSION["is_controller"] == ADMIN_SUPPORT && $new_user->is_controller == ADMIN_SUPPORT))
			{
				$bln_pass = false;
			}
		}
		return $bln_pass;*/
	}
    
    function getList(&$filter = array(), $pager = true) {
        
        $user = new User();
        $user->addJoin(new UsrGroupUser(), 'LEFT');
        $user->addJoin(new Usrgroup(), 'LEFT');
        
        if(isset($filter['name']) && $filter['name']) {
            $user->addWhere("(user.last_name LIKE '%".utf8_escape_textarea($filter['name'])."%'");
            $user->addWhere("user.first_name LIKE '%".utf8_escape_textarea($filter['name'])."%')", 'OR');
        }
        if(isset($filter['id_usr_group']) && $filter['id_usr_group']) {
            $user->addWhere("usr_group_user.id_usr_group = ".$filter['id_usr_group']);
        }
        
        $user->addWhere('user.disabled = '.IS_NOT_DISABLED);        
        
        // Get total rows
        $user->addSelect();
        $user->addSelect("user.*, GROUP_CONCAT(usr_group.name) group_name");
        $user->groupBy('user.id');
        $user->orderBy("user.last_name, user.first_name");
        $user->find();
        
        if ($pager) {
            
            $filter[PAGINATION_QUERY_STRING_SEGMENT] = isset($filter[PAGINATION_QUERY_STRING_SEGMENT]) && $filter[PAGINATION_QUERY_STRING_SEGMENT] ? $filter[PAGINATION_QUERY_STRING_SEGMENT] : 1;
            // Initialize pagination
            $ci =& get_instance();
            $ci->load->library('pagination');
            $ci->pagination->setModel($user);
            $ci->pagination->url = curPageURL();
            $ci->pagination->cur_page = $filter[PAGINATION_QUERY_STRING_SEGMENT];
            
        }
        
        return $user;
    }

    // Leave $confirm_password blank if you edit a user
    
	function validateInput($confirm_password = '') {
		
            if (trim($this->first_name) == "") {
                    MessageHandler::add (lang('err_empty_first_name'), MSG_ERROR, MESSAGE_ONLY);
            }
            else if (strlen($this->first_name) > MAX_LENGTH_NAME) {
                    MessageHandler::add (lang('err_first_name_too_long'), MSG_ERROR, MESSAGE_ONLY);
            }
            if (trim($this->last_name) == "") {
                    MessageHandler::add (lang('err_empty_last_name'), MSG_ERROR, MESSAGE_ONLY);
            }
            if (!strlen($this->last_name) > MAX_LENGTH_NAME) {
                    MessageHandler::add (lang('err_last_name_too_long'), MSG_ERROR, MESSAGE_ONLY);
            }

            if (!isset($this->email) || trim($this->email) == "") {
                    MessageHandler::add (lang('err_empty_email'), MSG_ERROR, MESSAGE_ONLY);
            }
            elseif (!isValidEmail($this->email))
            {
                    MessageHandler::add (lang('err_invalid_email'), MSG_ERROR, MESSAGE_ONLY);
            }
            else if (User::emailExistByUserID($this->email, $this->id))
            {
                    MessageHandler::add (lang('err_email_exists'), MSG_ERROR, MESSAGE_ONLY);
            }

            // When add new
            if (!$this->id)
            {
                    $this->validateChangePassword(utf8_escape_textarea($this->pass), utf8_escape_textarea($confirm_password));
            }

            return MessageHandler::countError() > 0 ? false : true;
	}
    
    public static function isDeactivated($email)
	{
			$bln_ok = false;

			if ($email)

			{
					$obj_user = new User();
					$obj_user->addWhere("email = '$email'");
					$obj_user->find();

					if ($obj_user->fetchNext())
					{
						if ($obj_user->deactived)
						{
							$bln_ok = true;
						}
					}
			}

			return $bln_ok;
	}
        
        function delete() {
            
            if ($this->id == 1)
                return false;
            
            $user = new User();
            $user->get($this->id);
            $user->disabled = IS_DISABLED;
            $user->update();
            return TRUE;
        }
        
      
        public static function getPermission($id_user, $uri = '') {
            
            if (!$id_user || $id_user == '')
                return false;
            
            $user = new User();
            
            if (!$user->get($id_user))
                return false;

            
            $perm = new Permission();
            $perm->addSelect();


            $perm->addWhere("permission.id_user = ".$id_user);
            
            if ($uri && $uri != '') {

                $perm->addWhere("permission.uri = '$uri'");
                $perm->addSelect("permission.value");
            }
            else
                $perm->addSelect("GROUP_CONCAT(permission.value) value");
            
            $perm->find();
            $perm->fetchNext();
            
            if (!$perm->value) {
                
                $perm = new Permission();
                $perm->addSelect();
                $perm->addJoin(new UsrGroupUser(), 'LEFT', 'usr_group_user', 'permission.id_usr_group = usr_group_user.id_usr_group');
                $perm->addWhere("usr_group_user.id_user = ".$id_user);
                
                if ($uri && $uri != '') {
                    $perm->addWhere("permission.uri = '$uri'");
                    $perm->addSelect("permission.value");
                }
                else
                    $perm->addSelect("GROUP_CONCAT(permission.value) value");
                
                $perm->find();
                $perm->fetchNext();
                
            }
            
            return $perm->value;
            
        }
        
		public static function connect($login, $pwd) 
		{
			$acces = new User();
			$acces->addWhere("email = '" . utf8_escape_textarea($login) . "'");
			$acces->addWhere("pass = '" . sha1(utf8_escape_textarea($pwd)) . "'");
			$acces->addWhere("disabled = ".IS_NOT_DISABLED);
			$acces->find();

			if ($acces->fetchNext())
                            return $acces;
                        
			return false;
		}
                
		public static function checkAccessable($id_user, $uri) {
        
			if (!$id_user)
				redirect('login/logout');
			
			$user = new User();
			
			if (!$user->get($id_user))
				redirect('login/logout');
			
			if (!$uri || $uri == '') {
				redirect('login/logout');
			}
			
			$perm = User::getPermission($user->id, $uri);
			
			if (!$perm || $perm == '') {
                            
                            $perm = User::getPermission($user->id, 'dashboard');

                            if ($perm && $perm != '') {
                                redirect(base_url('dashboard'), null, null, lang('msg_not_granted_this_page'), MSG_ERROR);
                            }
                            
                            redirect('login/logout');
                        }
			
		}
                
                function isAccessAble($id_user, $uri) {
                    
                    if (!$id_user)
                        return false;
			
                    $user = new User();

                    if (!$user->get($id_user))
                            return false;

                    if (!$uri || $uri == '') {
                            return false;
                    }

                    $perm = User::getPermission($user->id, $uri);

                    if (!$perm || $perm == '')
                        return false;

                    return true;
                    
                }
                
                
}
