<?php

class JqueryValidator
{
	var $availableFunctions = array(
                'Campaign::changeStatus',
		'Country::isExistsByName',
		'Country::isExistsByCode',
        'Country::getCodeCountry',
        'Country::getCurrencyInfo',
        'City::getLatLonById',
		'City::isExistsByName',
		'Category::isExistsByName',
		'Client_Segment::isExistsByName',
		'Client_Segment::isExistsByCode',
		'Client_Segment::isUsed',
		'Client_Segment_Value::isExistsByName',
		'Deal_View_Log::heatmap',
		'Deal_Provider::isExistsByName',
		'Provider_Category::isExistsByName',
		'Provider_Country::isExists',
		'Device_Model::isExistsByCode',
        'Country_Mno::isExists',
		'Emplacement::isExistsByCode',
        'Emplacement::isExistsByPosition',
        'Category::isExistsByPosition',
		'Emplacement::isExistsByName',
		'Emplacement_Deal_Provider::isExists',
		'Emplacement_Country_Period::isExists',
        'Front_Db::isExistsByName',
        'Front::isExistsByName',
		'Login::emailExistByLoginID',
		'Emplacement_Country_Period::getCpcminForDemand',
        'Emplacement_Country_Period::isAbleInsert',
        'Emplacement_Country_Period::isDeleteAble',
        'Parameter::saveValue',
        'Campaign::isExistByName',
        'Demand::changeBid',
        'City::isExistById',
		'Login::codeExistByLoginID',
        'Provider_Connector::isExistsByName',
        'Mobile_Operator::isExistsByName',
        'Mobile_Operator_Provider::isExists',
        'Mobile_Operator_Network::isExists',
        'Mobile_Operator_Romversion::isExists',
        'Provider_Connector::isExistsByName',
        'Deal::markFeatured',
        'Deal::isExistsByCampaign',
        'Connector::isExistsByName',
        'Connector::getType',
        'Front_Db::isConnectwithServer',
        'Deal::listAssociatedDealByProvider',
        'Deal::searchList',
        'Provider_Mo_Reference::isExists',
        'Provider_Connector::checkUrlvalid',
        'Provider_Mo_Reference::isExistsGeneric',
        'Financial_Reporting_Provider::isExists',
		'Front_Language::isExists',
		'Front_Label_Code::saveValue',
        'Shared_Network::isExistsByName',
		'Sorting_Methods::isExistsByLabel',
		'Sorting_Methods::isExistsByCode',
        'Front_Language::isExistsByName',
        'Share_Package::isExists',
        'Deal::changeValidateStatus',
        'Device_Model_Ids::isExists',
        'Deal_Business_Rule::isDisabled',
        'Deal_Business_Rule::changeValue',
        'Deal_Business_Rule::validateRules',
        'Deal::markExclusive',
        'Device_Model::isExistsByName',
        'Mobile_Operator::getListBelongCountry',
        'Deal_Provider::getListBelongCountry',
        'Device_Model_Ids::isExistsUnmapList',
        'Login::markActive'

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

	function callFunction($objectfunction, $agrs)
	{
		$result = $this->checkValidate($objectfunction);
		if( !$result )
			return false;

		list($classname, $funcName) = explode('::', $objectfunction);
		return call_user_func_array( array( $result['object'], $result['functionname']), $agrs);
	}
}
