<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
	use Auditable;
	
	public function contacts()
    {
    	return $this->belongsToMany('jericho\Contact');
    }
}
