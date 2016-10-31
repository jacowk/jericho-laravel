<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * The model representing an account, for example ''Profit and Loss' account.
 * 
 * @author Jaco Koekemoer
 *
 */
class Account extends Model
{
	use Auditable;
	
	protected $fillable = ['name', 'created_by_id', 'updated_by_id'];
	
	/* For invoke via reflection in auditing */
	public function getName()
	{
		return $this->name;
	}
	
	public function property_flip()
	{
		return $this->belongsTo('jericho\PropertyFlip');
	}
	
	public function transactions()
	{
		return $this->hasMany('jericho\Transaction');
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
				'updated_by_id' => array(ModelTypeConstants::USER, array('firstname', 'surname'))
		];
		$modelTransformAuditor = new ModelTransformAuditor();
		$data = $modelTransformAuditor->audit($data, $transformations);
		return $data;
	}
}
