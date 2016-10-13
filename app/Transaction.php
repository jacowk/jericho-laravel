<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	use Auditable;
	
	public function property_flip()
	{
		return $this->belongsTo('jericho\PropertyFlip');
	}
	
	public function transaction_type()
	{
		return $this->belongsTo("jericho\LookupTransactionType");
	}
	
	public function account()
	{
		return $this->belongsTo("jericho\Account");
	}
}
