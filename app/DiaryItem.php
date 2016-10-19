<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class DiaryItem extends Model
{
	use Auditable;
	
	public function property_flip()
    {
    	return $this->belongsTo('jericho\PropertyFlip');
    }
    
    public function followup_items()
    {
    	return $this->hasMany('jericho\FollowupItem');
    }
    
    public function diary_item_comments()
    {
    	return $this->hasMany('jericho\DiaryItemComment');
    }
    
    public function allocated_user()
    {
    	return $this->belongsTo('jericho\User');
    }
    
    public function followup_user()
    {
    	return $this->belongsTo('jericho\User');
    }
    
    public function status()
    {
    	return $this->belongsTo('jericho\DiaryItemStatus');
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
