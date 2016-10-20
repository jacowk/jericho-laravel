<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
	use Auditable;
	
	protected $fillable = ['name'];
	
	public function property_flip()
	{
		return $this->belongsTo('jericho\PropertyFlip');
	}
	
	public function transactions()
	{
		return $this->hasMany('jericho\Transaction');
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
