<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class LookupIssueSeverity extends Model
{
	use Auditable;
	
	protected $fillable = ['description'];
}
