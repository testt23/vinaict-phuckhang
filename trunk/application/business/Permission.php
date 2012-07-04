<?php

	class Permission extends Permission_model {

		function __construct() {
			parent::__construct();
		}
                
                public static function updatePermission($uri, $perm, $id_user = null) {
                    
                    if (!$uri || $uri == '')
                        return false;
                    
                    if (!$perm || !is_array($perm))
                        return false;
                    
                    if (count($perm) == 0)
                        return false;
                    
                    $arr_id_user = array();
                    
                    if (!$id_user) {
                        $group = new UsrGroup();
                        $group->addWhere("disabled = ".IS_NOT_DISABLED);
                        $group->addSelect();
                        $group->addSelect("id");
                        $group->find();
                        
                        while($group->fetchNext()) {
                            $permission = new Permission();
                            $permission->id_usr_group = $group->id;
                            $permission->uri = $uri;
                            $permission->delete();
                            
                            $permission->id_usr_group = $group->id;
                            $permission->uri = $uri;
                            $permission->value = implode(',', $perm);
                            $permission->insert();
                        }
                        
                    }
                    else {
                        $user = new User();
                        
                        if (!$user->get($id_user))
                            return false;
                        
                        $permission = new Permission();
                        $permission->id_user = $id_user;
                        $permission->uri = $uri;
                        $permission->delete();
                        
                        $permission->id_user = $id_user;
                        $permission->uri = $uri;
                        $permission->value = explode(',', $perm);
                        $permission->insert();
                    }
                    
                    return true;
                    
                }
                
                public static function deletePermission($uri) {
                    
                    $permission = new Permission();
                    $permission->uri = $uri;
                    $permission->delete();
                    
                }
                
                public static function deletePermissionByUser($uri, $id_user) {
                    
                    $permission = new Permission();
                    $permission->uri = $uri;
                    $permission->id_user = $id_user;
                    $permission->delete();
                    
                }
                
                public static function deletePermissionByUsrGroup($uri, $id_usr_group) {
                    
                    $permission = new Permission();
                    $permission->uri = $uri;
                    $permission->id_usr_group = $id_usr_group;
                    $permission->delete();
                    
                }
                
	}
