<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Suburb extends Model
{
	use Auditable;
	
    public function area()
    {
    	return $this->belongsTo('jericho\Area');
    }
    
    public function properties()
    {
    	return $this->hasMany('jericho\Property');
    }
}
