<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

/**
 * A model represting model types in the system. A model refers to the Laravel definition of a model.
 * 
 * @author Jaco Koekemoer
 *
 */
class LookupModelType extends Model
{
	use Auditable;
	
}
