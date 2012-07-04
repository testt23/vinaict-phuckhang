<?php

	class Usrgroup extends Usr_group_model {

		function __construct() {
			parent::__construct();
		}
                
                public static function getList($id = NULL) {
                    
                    $group = new Usrgroup();
                    $group->addWhere('usr_group.disabled = '.IS_NOT_DISABLED);
                    if($id){
                        $group->addWhere('id = '. $id);
                    }
                    $group->orderBy(getI18nRealStringSql('usr_group.name'));
                    $group->find();
                    return $group;
                    
                }
                
                function validateInput() {
		
                    if (trim($this->code) == "") {
                            MessageHandler::add (lang('err_empty_code'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    else if (strlen($this->code) > MAX_LENGTH_CODE) {
                            MessageHandler::add (lang('err_code_too_long'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    
                    if (trim($this->name) == "") {
                            MessageHandler::add (lang('err_empty_name'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    else if (strlen($this->name) > MAX_LENGTH_NAME) {
                            MessageHandler::add (lang('err_name_too_long'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    
                    return MessageHandler::countError() > 0 ? false : true;
                }
                
                function delete($id = null){
                    $this->disabled = 1;
                    //$this->addWhere('id = '.$id);
                    $this->db->where('id = ' . $id);
                    $this->db->update('usr_group',$this);
                    
                    return TRUE;
                }
                
                function update($id = null){
                    
                    $this->db->where('id = ' . $id);
                    $this->db->update('usr_group',$this);
                    
                    return TRUE;
                }
	}
