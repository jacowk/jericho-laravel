<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
	use Auditable;
	
	public function roles()
	{
		return $this->belongsToMany('jericho\Role');
	}
}
