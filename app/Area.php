<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	use Auditable;
	
	protected $fillable = ['name'];
	
    public function suburbs()
    {
    	return $this->hasMany('jericho\Suburb');
    }
    
    public function properties()
    {
    	return $this->hasMany('jericho\Property');
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
