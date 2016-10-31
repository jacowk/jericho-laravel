<?php

namespace jericho;

use Illuminate\Database\Eloquent\Model;

/**
 * A model representing a seller status
 * 
 * @author Jaco Koekemoer
 *
 */
class SellerStatus extends Model
{
	/* For invoke via reflection in auditing */
	public function getDescription()
	{
		return $this->description;
	}
}
