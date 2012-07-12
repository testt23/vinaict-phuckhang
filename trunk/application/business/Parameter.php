<?php

	class Parameter extends Parameter_model {

		function __construct() {
			parent::__construct();
		}
                
                function getList($filter = array()) {
                    $parameter = new Parameter();
                    $parameter->addJoin(new ParamGroupParameter(), 'LEFT');
                    $parameter->addJoin(new ParamGroup(), 'LEFT');
                    $parameter->addSelect();
                    $parameter->addSelect('parameter.*, param_group.name param_group_name');
                    $parameter->addWhere('parameter.disabled = '.IS_NOT_DISABLED);

                    if (isset($filter['id_param_group']) && $filter['id_param_group'])
                        $parameter->addWhere('id_param_group = '.$filter['id_param_group']);
                    
                    if (isset($filter['always_load']) && $filter['always_load'] == '1')
                        $parameter->addWhere('always_load = '.$filter['always_load']);

                    $parameter->orderBy(getI18nRealStringSql("param_group.name").", parameter.name");
                    $parameter->find();

                    return $parameter;
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
                
                public static function loadParams($group_code = '', $always_load = TRUE) {
                    
                    $param = new Parameter();
                    
                    if ($group_code != '') {
                        $param->addJoin(new ParamGroupParameter());
                        $param->addJoin(new ParamGroup());
                        $param->addWhere("param_group.code = '$group_code'");
                        $param->addWhere('param_group.disabled = '.IS_NOT_DISABLED);
                    }
                    
                    if ($always_load == TRUE)
                        $param->addWhere('parameter.always_load = 1');
                    
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
                
                function validateInput() {
                    return TRUE;
                }


                public static function saveValue($id, $value) {
                    
                    $param = new Parameter();
                    
                    if (!$id || !$param->get($id))
                        return FALSE;
                    
                    if ($param->data_type == TEXT_MULTILANG || $param->data_type == TEXTAREA_MULTILANG || $param->data_type == EDITOR_MULTILANG) {
                        $lang = Language::getArrayLangIso();
                        $param->value = '';
                        $value = json_decode($value);
                        foreach ($lang as $l) {
                            $param->value .= '<'.$l.'>'.utf8_escape_textarea($value->$l).'</'.$l.'>';
                        }
                    }
                    else
                        $param->value = utf8_escape_textarea($value);
                    
                    if ($param->validateInput()) {
                        $param->update();
                        $param->value = getI18n($param->value);
                        return json_encode($param);
                    }
                    
                }
                
                public static function getParamByID($id) {
                    $param = new Parameter();
                    
                    if (!$id || !$param->get($id))
                        return FALSE;
                    
                    return json_encode($param);
                }
                
                public static function renderInput($id) {
                    
                    $param = new Parameter();
                    
                    if (!$id || !$param->get($id))
                        return FALSE;
                    
                    switch ($param->data_type) {
                        case TEXT:
                            return '<input type="text" id="param_data_'.$param->id.'" name="param_data_'.$param->id.'" value="'.$param->value.'" />';
                            break;
                        case TEXTAREA:
                            return '<textarea id="param_data_'.$param->id.'" name="param_data_'.$param->id.'">'.$param->value.'</textarea>';
                            break;
                        case NUMBER:
                            return '<input type="text" id="param_data_'.$param->id.'" name="param_data_'.$param->id.'" value="'.$param->value.'" />';
                            break;
                        case DATE:
                            return '<div class="datepicker" id="param_data_'.$param->id.'" name="param_data_'.$param->id.'" value="'.$param->value.'" />';
                            break;
                        case DATETIME:
                            return '<div class="datepicker" id="param_data_'.$param->id.'" name="param_data_'.$param->id.'" value="'.$param->value.'" />';
                            break;
                        case BOOLEAN:
                            return '<input type="checkbox" id="param_data_'.$param->id.'" name="param_data_'.$param->id.'" value="1" '.($param->value == '1' ? 'checked' : '').' />';
                            break;
                        case TEXT_MULTILANG:
                            $lang = Language::getArrayLangIso();
                            $lang = implode(',', $lang);
                            return '<div type="text-multilang" lang="'.$lang.'" tabindex="1" maxlength="255" class="field text medium" id="param_data_'.$param->id.'" name="param_data_'.$param->id.'" value="'.$param->value.'" ></div>';
                            break;
                        case TEXTAREA_MULTILANG:
                            $lang = Language::getArrayLangIso();
                            $lang = implode(',', $lang);
                            return '<div type="textarea-multilang" lang="'.$lang.'" tabindex="1" maxlength="255" class="field text medium" id="param_data_'.$param->id.'" name="param_data_'.$param->id.'" value="'.$param->value.'" ></div>';
                            break;
                    }
                    
                }
	}
