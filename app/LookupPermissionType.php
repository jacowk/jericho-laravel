<?php

namespace jericho;

use Illuminate\Database\Eloquent\Model;

/**
 * A model class representing permission types
 * 
 * @author Jaco Koekemoer
 *
 */
class LookupPermissionType extends Model
{
    public function permissions()
    {
    	return $this->hasMany('jericho\Permission');
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
