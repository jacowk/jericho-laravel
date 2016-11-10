<?php
namespace jericho\Audits\Model;

use Illuminate\Support\Arr;
use ReflectionClass;
use Exception;
use jericho\Account;
use jericho\Area;
use jericho\Attorney;
use jericho\Bank;
use jericho\Contact;
use jericho\Contractor;
use jericho\ContractorService;
use jericho\DiaryItem;
use jericho\DiaryItemComment;
use jericho\DiaryItemStatus;
use jericho\Document;
use jericho\EstateAgent;
use jericho\Exceptions;
use jericho\FinanceStatus;
use jericho\FollowupItem;
use jericho\GreaterArea;
use jericho\Issue;
use jericho\IssueComment;
use jericho\IssueStatus;
use jericho\LookupAttorneyType;
use jericho\LookupContractorType;
use jericho\LookupDocumentType;
use jericho\LookupEstateAgentType;
use jericho\LookupIssueCategory;
use jericho\LookupIssueComponent;
use jericho\LookupIssueSeverity;
use jericho\LookupMaritalStatus;
use jericho\LookupMilestoneType;
use jericho\LookupModelType;
use jericho\LookupPropertyType;
use jericho\LookupTitle;
use jericho\LookupTransactionType;
use jericho\LookupUserActivityType;
use jericho\Milestone;
use jericho\Note;
use jericho\Permission;
use jericho\Property;
use jericho\PropertyFlip;
use jericho\Role;
use jericho\SellerStatus;
use jericho\Suburb;
use jericho\Transaction;
use jericho\User;
use jericho\Util\Util;

/**
 * A class for transforming model id properties via reflection into appropriate descriptions that is meaningful
 * to the front end user, and specifically for data that is audited.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-31
 *
 */
class ModelTransformer
{
	/**
	 * A method for performing transformation. The following parameters are used in the method signature:
	 * 
	 * $data is the array that is generated for auditing by the owen-it auditing package. An example of some of the 
	 * entries in this array is as follows. Only "old" and "new" is required for this class:
	 * 
	 *  "old" => array:1 [
	 *    "area_id" => 59
	 *  ]
	 *  "new" => array:1 [
	 *    "area_id" => "46"
	 *  ]
	 *  
	 *  "old" refers to the old value of the property of the model.
	 *  "new" refers to the new value of the property of the model.
	 * 
	 * $key is the key in this array that is to be transformed from id to name or description. An example entry is "old.area_id", or "new.area_id"
	 * $model_class_name refers to the model that is to be used to find the applicable id for. For example, if the $model_class_name is Area, then the Area model is used to find the id with. 
	 * $property_array refers to the names of the properties in the model_class_name, which concatenated values will be used to replace the id with, in the $data array. For Users and Contacts, this can be firstname and surname, but for Area, it is a description or name.
	 * Herewith an example array of $property_array:
	 * 
	 * array:1 [
	 *  0 => "name"
	 * ]
	 * 
	 * @param unknown $data
	 * @param unknown $key
	 * @param unknown $model_class_name
	 * @param unknown $property_array
	 * @return unknown
	 */
	public function transform($data, $key, $model_class_name, $property_array)
	{
		if (Util::isArrayNotNullAndNotEmpty($data))
		{
			if (Util::isArrayNotNullAndNotEmpty($property_array) &&
				Util::isValidRequestVariable($key) &&
				Util::isValidRequestVariable($model_class_name) &&
				Util::isValidModel($model_class_name))
			{
				if (Arr::has($data, $key))
				{
					$model_class_name = 'jericho\\' . str_replace(' ', '', $model_class_name);
					$object = call_user_func($model_class_name . '::find', Arr::get($data, $key));
					if (!is_null($object))
					{
						$value = '';
						foreach ($property_array as $property)
						{
							$reflector = new ReflectionClass($object);
							try
							{
								$value .= $reflector->getMethod(Util::transformToGetterMethod($property))->invoke($object) . ' ';
							}
							catch (Exception $e)
							{
								/* If any of the properties to be called from the model is not present, do not perform any key replacement */
								return $data;
							}
						}
						Arr::set($data, $key, $value);
					}
				}
			}
			return $data;
		}
		return array();
	}
}

