<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model representing a milestone
 *
 * @author Jaco Koekemoer
 *
 */
class Milestone extends Model
{
	use Auditable;
	
    public function property_flip()
    {
    	return $this->belongsTo('jericho\PropertyFlip');
    }
    
    public function lookup_milestone_type()
    {
    	return $this->belongsTo('jericho\LookupMilestoneType', 'milestone_type_id');
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
    			'milestone_type_id' => array(ModelTypeConstants::LOOKUP_MILESTONE_TYPE, array('description'))
    	];
    	$modelTransformAuditor = new ModelTransformAuditor();
    	$data = $modelTransformAuditor->audit($data, $transformations);
    	return $data;
    }
}
