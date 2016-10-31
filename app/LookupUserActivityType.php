<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * A model represting a user activity type
 * 
 * @author Jaco Koekemoer
 *
 */
class LookupUserActivityType extends Model
{
	use Auditable;
	
	/* For invoke via reflection in auditing */
	public function getDescription()
	{
		return $this->description;
	}
}
