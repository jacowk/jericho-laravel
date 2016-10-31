<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

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
	
	public function transformAudit(array $data)
	{
		if (Arr::has($data, 'new.created_by_id'))
		{
			Arr::set($data, 'new.created_by_id',  $this->created_by->firstname . ' ' . $this->created_by->surname);
		}
		if (Arr::has($data, 'new.updated_by_id'))
		{
			Arr::set($data, 'new.updated_by_id',  $this->updated_by->firstname . ' ' . $this->updated_by->surname);
		}
		
		if (Arr::has($data, 'old.created_by_id'))
		{
			Arr::set($data, 'old.created_by_id',  $this->created_by->firstname . ' ' . $this->created_by->surname);
		}
		if (Arr::has($data, 'old.updated_by_id'))
		{
			Arr::set($data, 'old.updated_by_id',  $this->updated_by->firstname . ' ' . $this->updated_by->surname);
		}
		return $data;
	}
}
