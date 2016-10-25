<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

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
}
