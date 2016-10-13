<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	use Auditable;
	
	public function property_flip()
	{
		return $this->belongsTo('jericho\PropertyFlip');
	}
	
	public function transactions()
	{
		return $this->hasMany('jericho\Transaction');
	}
}
