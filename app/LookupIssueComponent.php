<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

/**
 * A model representing the component to which an issue applies
 * 
 * @author Jaco Koekemoer
 *
 */
class LookupIssueComponent extends Model
{
	use Auditable;
	
	protected $fillable = ['name', 'created_by_id', 'updated_by_id'];
	
	/* For invoke via reflection in auditing */
	public function getName()
	{
		return $this->name;
	}
}
