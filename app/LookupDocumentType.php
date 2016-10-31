<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model used to manage document types, such as Lightstone Report, and is used when a Document is captured
 * on a Property Flip.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-18
 *
 */
class LookupDocumentType extends Model
{
	use Auditable;
	
	protected $fillable = ['description', 'created_by_id', 'updated_by_id'];
	
	/* For invoke via reflection in auditing */
	public function getDescription()
	{
		return $this->description;
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
