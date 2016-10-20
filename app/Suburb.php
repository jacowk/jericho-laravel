<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Suburb extends Model
{
	use Auditable;
	
	protected $fillable = ['name', 'box_code', 'street_code'];
	
    public function area()
    {
    	return $this->belongsTo('jericho\Area');
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
