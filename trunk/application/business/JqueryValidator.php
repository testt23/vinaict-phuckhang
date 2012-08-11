<?php

class JqueryValidator
{
	var $availableFunctions = array(
            'Image::getImageGalleryTree',
            'Image::renderFolderTrees',
            'Parameter::getParamByID',
            'Parameter::renderInput',
            'Parameter::saveValue',
            'Image::deleteImage'
	);

	var $classInvalid = false;
	var $objIncorrect = false;
	var $classDoesNotExist = false;
	var $methodDoseNotExist = false;

	function checkValidate( $objectfunction )
	{
		//check if the function allowed calling
		if( !in_array($objectfunction, $this->availableFunctions) )
		{
			$this->classInvalid = true;
			return false;
		}

		//check does the object and function posted by client is in correct form
		if( !preg_match('/^[0-9A-Za-z_]+::[0-9A-Za-z_]+$/', $objectfunction))
		{
				$this->objIncorrect = true;
			return false;
		}

		list($classname, $functionname) = explode('::', $objectfunction);

		if( !class_exists($classname) )
		{
				$this->classDoesNotExist = true;
				return false;
		}

		$object = new $classname();

		if( !method_exists($object, $functionname))
		{
				$this->methodDoseNotExist = true;
				return false;
		}

		return array("object"  => $object, "functionname" => $functionname);
	}

	function ajaxCallFunction($objectfunction, $agrs)
	{
            
		$result = $this->checkValidate($objectfunction);
		if( !$result )
			return false;

		list($classname, $funcName) = explode('::', $objectfunction);
                
		return call_user_func_array( array( $result['object'], $result['functionname']), $agrs);
	}
}
