<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model used to manage documents added to property flips.
 * 
 * @author Jaco Koekemoer
 *
 */
class Document extends Model
{
	use Auditable;
	
	/**
	 * Exclude the following properties from being audited by Auditable
	 *
	 * @var array
	 */
	protected $dontKeepAuditOf = ['file'];
	
    public function property_flip()
    {
    	return $this->belongsTo('jericho\PropertyFlip');
    }
    
    public function document_type()
    {
    	return $this->belongsTo('jericho\LookupDocumentType');
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
    			'document_type_id' => array(ModelTypeConstants::LOOKUP_DOCUMENT_TYPE, array('description'))
    	];
    	$modelTransformAuditor = new ModelTransformAuditor();
    	$data = $modelTransformAuditor->audit($data, $transformations);
    	return $data;
    }
}
