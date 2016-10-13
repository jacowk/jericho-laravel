<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class ContractorService extends Model
{
	use Auditable;
	
	public function contractor()
	{
		return $this->belongsTo('jericho\Contractor');
	}
	
	public function contractor_type()
	{
		return $this->belongsTo('jericho\LookupContractorType');
	}
}
