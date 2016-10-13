<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class FollowupItem extends Model
{
	use Auditable;
	
    public function diary_item()
    {
    	return $this->belongsTo('jericho\DiaryItem');
    }
}
