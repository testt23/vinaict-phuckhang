<?php

	class Parameter extends Parameter_model {

		function __construct() {
			parent::__construct();
		}
                
                public static function getValue($code) {
                    
                    $parameter = new Parameter();
                    $parameter->addWhere("code = '$code'");
                    $parameter->addWhere('disabled = '.IS_NOT_DISABLED);
                    $parameter->addSelect();
                    $parameter->addSelect('value');
                    $parameter->find();
                    $parameter->fetchNext();
                    return $parameter->value;
                    
                }
                
                public static function loadParams($group_code = '', $category = 0) {
                    
                    $param = new Parameter();
                    
                    if ($group_code != '') {
                        $param->addJoin(new ParamGroupParameter());
                        $param->addJoin(new ParamGroup());
                        $param->addWhere("param_group.code = '$group_code'");
                        $param->addWhere('param_group.disabled = '.IS_NOT_DISABLED);
                    }
                    
                    if ($category != 0)
                        $param->addWhere('parameter.category = '.$category);
                    
                    $param->addWhere('parameter.disabled = '.IS_NOT_DISABLED);
                    $param->addSelect();
                    $param->addSelect('parameter.code, parameter.value');
                    $param->find();
                    
                    while ($param->fetchNext()) {
                        
                        if (!defined($param->code)) {
                            define($param->code, $param->value);
                        }
                        
                    }
                    
                }
                
                public static function getParamsNameFromGroupByValue($group_code = '') {
                    
                    $param = new Parameter();
                    
                    if ($group_code != '') {
                        $param->addJoin(new ParamGroupParameter());
                        $param->addJoin(new ParamGroup());
                        $param->addWhere("param_group.code = '$group_code'");
                        $param->addWhere('param_group.disabled = '.IS_NOT_DISABLED);
                    }
                    
                    $param->addWhere('parameter.disabled = '.IS_NOT_DISABLED);
                    $param->addSelect();
                    $param->addSelect('parameter.code, parameter.value, parameter.name');
                    $param->find();
                    
                    $params = array();
                    
                    while ($param->fetchNext()) {
                        $params[$param->value] = $param->name;
                    }
                    
                    return $params;
                    
                }


                public static function getParamArray($group_code = '', $category = 0) {
                    
                    $param = new Parameter();
                    
                    if ($group_code != '') {
                        $param->addJoin(new ParamGroupParameter());
                        $param->addJoin(new ParamGroup());
                        $param->addWhere("param_group.code = '$group_code'");
                        $param->addWhere('param_group.disabled = '.IS_NOT_DISABLED);
                    }
                    
                    if ($category != 0)
                        $param->addWhere('parameter.category = '.$category);
                    
                    $param->addWhere('parameter.disabled = '.IS_NOT_DISABLED);
                    $param->addSelect();
                    $param->addSelect('parameter.code, parameter.value, parameter.name');
                    $param->find();
                    
                    $params = array();
                    
                    while ($param->fetchNext()) {
                        $param[$param->code] = array('value' => $param->value, 'name' => $param->name);
                    }
                    
                    return $params;
                    
                }
	}
