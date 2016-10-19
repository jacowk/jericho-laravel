<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

/**
 * A model used for managing the comments added to a diary item
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class DiaryItemComment extends Model
{
	use Auditable;
	
	public function diary_item()
	{
		return $this->belongsTo('jericho\DiaryItem');
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
