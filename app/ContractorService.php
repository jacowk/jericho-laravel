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
	
	public function created_by()
	{
		return $this->belongsTo('jericho\User', 'created_by_id');
	}
	
	public function updated_by()
	{
		return $this->belongsTo('jericho\User', 'updated_by_id');
	}
}
