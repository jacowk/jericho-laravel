<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	use Auditable;
	
    public function suburbs()
    {
    	return $this->hasMany('jericho\Suburb');
    }
    
    public function properties()
    {
    	return $this->hasMany('jericho\Property');
    }
}
