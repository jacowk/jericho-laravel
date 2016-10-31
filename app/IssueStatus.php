<?php

namespace jericho;

use Illuminate\Database\Eloquent\Model;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model representing the status of an issue
 *
 * @author Jaco Koekemoer
 *
 */
class IssueStatus extends Model
{
	/* For invoke via reflection in auditing */
	public function getDescription()
	{
		return $this->description;
	}
}
