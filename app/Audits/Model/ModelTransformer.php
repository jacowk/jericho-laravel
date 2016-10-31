<?php
namespace jericho\Audits\Model;

use Illuminate\Support\Arr;
use ReflectionClass;
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
 * A class for transforming model id properties via reflection
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-31
 *
 */
class ModelTransformer
{
	public function transform($data, $key, $model_class_name, $property_array)
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
					$value .= $reflector->getMethod(Util::transformToGetterMethod($property))->invoke($object) . ' ';
				}
				Arr::set($data, $key, $value);
			}
		}
		return $data;
	}
}

