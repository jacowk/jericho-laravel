<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

/**
 * A model representing milestone types
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-13
 *
 */
class LookupMilestoneType extends Model
{
	use Auditable;
	
	public function created_by()
	{
		return $this->belongsTo('jericho\User', 'created_by_id');
	}
	
	public function updated_by()
	{
		return $this->belongsTo('jericho\User', 'updated_by_id');
	}
}
