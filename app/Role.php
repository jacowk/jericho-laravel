<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	use Auditable;
	
	public function permissions()
	{
		return $this->belongsToMany('jericho\Permission');
	}
	
	public function users()
	{
		return $this->belongsToMany('jericho\User');
	}
}
