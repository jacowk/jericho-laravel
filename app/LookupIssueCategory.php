<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class LookupIssueCategory extends Model
{
	use Auditable;
	
	protected $fillable = ['description'];
}
