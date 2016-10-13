<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class GreaterArea extends Model
{
	use Auditable;
	
	public function properties()
	{
		return $this->hasMany('jericho\Property');
	}
}
