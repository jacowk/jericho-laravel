<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

/**
 * A model represting the severity of an issue.
 * 
 * @author Jaco Koekemoer
 *
 */
class LookupIssueSeverity extends Model
{
	use Auditable;
	
	protected $fillable = ['description', 'created_by_id', 'updated_by_id'];
	
	/* For invoke via reflection in auditing */
	public function getDescription()
	{
		return $this->description;
	}
}
