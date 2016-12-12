<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model representing a property flip
 * 
 * @author Jaco Koekemoer
 *
 */
class PropertyFlip extends Model
{
	use Auditable;
	
	protected $fillable = [
			'reference_number',
			'title_deed_number',
			'case_number',
			'seller_id',
			'selling_price',
			'seller_status_id',
			'purchaser_id',
			'purchase_price',
			'finance_status_id',
			'property_id',
			'created_by_id',
			'updated_by_id'
	];
	
	public function property()
    {
    	return $this->belongsTo('jericho\Property');
    }
    
    public function finance_status()
    {
    	return $this->belongsTo('jericho\FinanceStatus');
    }
    
    public function seller_status()
    {
    	return $this->belongsTo('jericho\SellerStatus');
    }

    public function property_status()
    {
    	return $this->belongsTo('jericho\PropertyStatus');
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
    
    public function investors()
    {
    	return $this->belongsToMany('jericho\Contact', 'investor_property_flip')
    	->withPivot('investment_amount',
    			'created_by_id',
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
    
    public function lead_type()
    {
    	return $this->belongsTo('jericho\LookupLeadType');
    }
    
    public function created_by()
    {
    	return $this->belongsTo('jericho\User', 'created_by_id');
    }
    
    public function updated_by()
    {
    	return $this->belongsTo('jericho\User', 'updated_by_id');
    }
    
    public function transformAudit(array $data)
    {
    	$transformations = [
    			'created_by_id' => array(ModelTypeConstants::USER, array('firstname', 'surname')),
    			'updated_by_id' => array(ModelTypeConstants::USER, array('firstname', 'surname')),
    			'finance_status_id' => array(ModelTypeConstants::FINANCE_STATUS, array('description')),
    			'seller_status_id' => array(ModelTypeConstants::SELLER_STATUS, array('description')),
    			'seller_id' => array(ModelTypeConstants::CONTACT, array('firstname', 'surname')),
    			'purchaser_id' => array(ModelTypeConstants::CONTACT, array('firstname', 'surname'))
    	];
    	$modelTransformAuditor = new ModelTransformAuditor();
    	$data = $modelTransformAuditor->audit($data, $transformations);
    	return $data;
    }
}
