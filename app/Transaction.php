<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model representing a transaction
 *
 * @author Jaco Koekemoer
 *
 */
class Transaction extends Model
{
	use Auditable;
	
	/* For invoke via reflection in auditing */
	public function getDescription()
	{
		return $this->description;
	}
	
	public function property_flip()
	{
		return $this->belongsTo('jericho\PropertyFlip');
	}
	
	public function transaction_type()
	{
		return $this->belongsTo("jericho\LookupTransactionType");
	}
	
	public function account()
	{
		return $this->belongsTo("jericho\Account");
	}
	
	public function created_by()
	{
		return $this->belongsTo('jericho\User', 'created_by_id');
	}
	
	public function updated_by()
	{
		return $this->belongsTo('jericho\User', 'updated_by_id');
	}
	
	public function transformAudit(array $data)
	{
		$transformations = [
				'created_by_id' => array(ModelTypeConstants::USER, array('firstname', 'surname')),
				'updated_by_id' => array(ModelTypeConstants::USER, array('firstname', 'surname')),
				'account_id' => array(ModelTypeConstants::ACCOUNT, array('name')),
				'transaction_type_id' => array(ModelTypeConstants::LOOKUP_TRANSACTION_TYPE, array('description')),
		];
		$modelTransformAuditor = new ModelTransformAuditor();
		$data = $modelTransformAuditor->audit($data, $transformations);
		return $data;
		return $data;
	}
}
