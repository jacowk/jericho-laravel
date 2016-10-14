<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class PropertyFlip extends Model
{
	use Auditable;
	
	public function property()
    {
    	return $this->belongsTo('jericho\Property');
    }
    
    public function finance_status()
    {
    	return $this->belongsTo('jericho\FinanceStatus');
    }
    
    public function seller()
    {
    	return $this->belongsTo('jericho\Contact', 'seller_id');
    }
    
    public function purchaser()
    {
    	return $this->belongsTo('jericho\Contact', 'purchaser_id');
    }
    
    public function attorneys()
    {
    	return $this->belongsToMany('jericho\Contact', 'attorney_property_flip')
    				->withPivot('lookup_attorney_type_id', 
    							'created_by_id', 
    							'updated_by_id',
    							'deleted_by_id',
    							'created_at',
    							'updated_at',
    							'deleted_at');
    }
    
    public function estate_agents()
    {
    	return $this->belongsToMany('jericho\Contact', 'estate_agent_property_flip')
    	->withPivot('lookup_estate_agent_type_id',
    			'created_by_id',
    			'updated_by_id',
    			'deleted_by_id',
    			'created_at',
    			'updated_at',
    			'deleted_at');
    }
    
    public function contractors()
    {
    	return $this->belongsToMany('jericho\Contact', 'contractor_property_flip')
    	->withPivot('lookup_contractor_type_id',
    			'created_by_id',
    			'updated_by_id',
    			'deleted_by_id',
    			'created_at',
    			'updated_at',
    			'deleted_at');
    }
    
    public function banks()
    {
    	return $this->belongsToMany('jericho\Contact', 'bank_property_flip')
    	->withPivot('created_by_id',
    			'updated_by_id',
    			'deleted_by_id',
    			'created_at',
    			'updated_at',
    			'deleted_at');
    }
    
    public function milestones()
    {
    	return $this->hasMany('jericho\Milestone');
    }
    
    public function notes()
    {
    	return $this->hasMany('jericho\Note');
    }
    
    public function documents()
    {
    	return $this->hasMany('jericho\Document');
    }
    
    public function diary_items()
    {
    	return $this->hasMany('jericho\DiaryItem');
    }
    
    public function transactions()
    {
    	return $this->hasMany('jericho\Transaction');
    }
}
