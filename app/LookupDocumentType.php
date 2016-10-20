<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

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
	
	protected $fillable = ['description'];
	
	public function created_by()
	{
		return $this->belongsTo('jericho\User', 'created_by_id');
	}
	
	public function updated_by()
	{
		return $this->belongsTo('jericho\User', 'updated_by_id');
	}
}
