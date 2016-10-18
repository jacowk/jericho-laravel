<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
	use Auditable;
	
	public function created_by()
	{
		return $this->belongsTo('jericho\User', 'created_by_id');
	}
	
	public function updated_by()
	{
		return $this->belongsTo('jericho\User', 'updated_by_id');
	}
}
