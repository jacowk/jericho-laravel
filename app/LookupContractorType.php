<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

/**
 * A model used to manage contractor types, such as Builder, Electrician, etc
 * 
 * @author Jaco Koekemoer
 *
 */
class LookupContractorType extends Model
{
	use Auditable;
	
	protected $fillable = ['description'];
	
	public function created_by()
	{
		return $this->belongsTo('jericho\User', 'created_by_id');
	}
	
	public function updated_by()
	{
		return $this->belongsTo('jericho\User', 'updated_by_id');
	}
}
