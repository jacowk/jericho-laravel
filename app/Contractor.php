<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
	use Auditable;
	
	public function contacts()
    {
    	return $this->belongsToMany('jericho\Contact');
    }
    
    public function contractor_services()
    {
    	return $this->hasMany('jericho\ContractorService');
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
