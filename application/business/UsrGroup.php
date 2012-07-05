<?php

	class UsrGroup extends Usr_group_model {

		function __construct() {
			parent::__construct();
		}
                
                public static function getList($id = NULL) {
                    
                    $group = new UsrGroup();
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
                    else if (strlen($this->name) > MAX_LENGTH_NAME_GROUP) {
                            MessageHandler::add (lang('err_name_too_long'), MSG_ERROR, MESSAGE_ONLY);
                    }
                    
                    return MessageHandler::countError() > 0 ? false : true;
                }
                
                function delete() {
                    $this->disabled = 1;
                    $this->code = appendIdtoName($this->id, $this->code);
                    $this->name = appendIdtoName($this->id, $this->name);
                    $this->update();
                    return TRUE;
                }
                
                function isExitUserByUsrGroup($id = NULL){
                    
                    if($id){
                        $this->addJoin(new UsrGroupUser());
                        $this->addWhere('id = '. $id);
                        $this->find();
                        
                        if( $this->countRows() > 0 ){
                            MessageHandler::add (lang('err_exit_user'), MSG_ERROR, MESSAGE_ONLY);
                            return TRUE;
                        }else {
                            return FALSE;
                        } 
                    }
                    
                    return FALSE;
                }
	}
