<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

/**
 * This model forms part of the issue tracker, for creating issue comments
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class IssueComment extends Model
{
	use Auditable;
	
	public function issue()
	{
		return $this->belongsTo('jericho\Issue');
	}
	
	public function created_by()
	{
		return $this->belongsTo('jericho\User', 'created_by_id');
	}
	
	public function updated_by()
	{
		return $this->belongsTo('jericho\User', 'updated_by_id');
	}
}
