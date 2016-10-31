<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model representing a permission
 *
 * @author Jaco Koekemoer
 *
 */
class Permission extends Model
{
	use Auditable;
	
	protected $fillable = ['name', 'created_by_id', 'updated_by_id'];
	
	public function roles()
	{
		return $this->belongsToMany('jericho\Role');
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
