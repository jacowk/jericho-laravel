<?php

namespace jericho;

use Illuminate\Database\Eloquent\Model;

/**
 * A model representing the finance status for a seller
 * 
 * @author Jaco Koekemoer
 *
 */
class FinanceStatus extends Model
{
	/* For invoke via reflection in auditing */
	public function getDescription()
	{
		return $this->description;
	}  
}
