<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
	use Auditable;
	
	public function suburb()
	{
		return $this->belongsTo('jericho\Suburb');
	}
	
	public function area()
	{
		return $this->belongsTo('jericho\Area');
	}
	
	public function greater_area()
	{
		return $this->belongsTo('jericho\GreaterArea');
	}
	
	public function property_flips()
	{
		return $this->hasMany('jericho\PropertyFlip');
	}
	
	public function lookup_property_type()
	{
		return $this->belongsTo('jericho\LookupPropertyType');
	}
}
