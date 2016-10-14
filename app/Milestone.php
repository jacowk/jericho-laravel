<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
	use Auditable;
	
    public function property_flip()
    {
    	return $this->belongsTo('jericho\PropertyFlip');
    }
    
    public function lookup_milestone_type()
    {
    	return $this->belongsTo('jericho\LookupMilestoneType', 'milestone_type_id');
    }
}
