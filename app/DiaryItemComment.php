<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model used for managing the comments added to a diary item
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class DiaryItemComment extends Model
{
	use Auditable;
	
	public function diary_item()
	{
		return $this->belongsTo('jericho\DiaryItem');
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
