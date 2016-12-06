<?php

namespace jericho;

use Illuminate\Database\Eloquent\Model;

/**
 * A model representing a property status
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-06
 *
 */
class PropertyStatus extends Model
{
	/* For invocation via reflection in auditing */
	public function getDescription()
	{
		return $this->description;
	}
}
