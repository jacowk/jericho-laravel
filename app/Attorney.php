<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Attorney extends Model
{
	use Auditable;
	
	protected $fillable = ['name'];
	
    public function contacts()
    {
    	return $this->belongsToMany('jericho\Contact');
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
