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
	
	public function created_by()
	{
		return $this->belongsTo('jericho\User', 'created_by_id');
	}
	
	public function updated_by()
	{
		return $this->belongsTo('jericho\User', 'updated_by_id');
	}
}
