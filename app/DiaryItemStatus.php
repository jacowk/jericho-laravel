<?php

namespace jericho;

use Illuminate\Database\Eloquent\Model;

/**
 * A model representing the status of a diary item.
 * 
 * @author Jaco Koekemoer
 *
 */
class DiaryItemStatus extends Model
{
	/* For invoke via reflection in auditing */
	public function getDescription()
	{
		return $this->description;
	}
}
