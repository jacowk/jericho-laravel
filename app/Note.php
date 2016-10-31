<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model representing a note
 *
 * @author Jaco Koekemoer
 *
 */
class Note extends Model
{
	use Auditable;
	
    public function property_flip()
    {
    	return $this->belongsTo('jericho\PropertyFlip');
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
    			'updated_by_id' => array(ModelTypeConstants::USER, array('firstname', 'surname'))
    	];
    	$modelTransformAuditor = new ModelTransformAuditor();
    	$data = $modelTransformAuditor->audit($data, $transformations);
    	return $data;
    }
}
