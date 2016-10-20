<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class LookupIssueComponent extends Model
{
	use Auditable;
	
	protected $fillable = ['name'];
}
