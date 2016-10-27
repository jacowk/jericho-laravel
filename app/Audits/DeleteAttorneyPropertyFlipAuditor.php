<?php
namespace jericho\Audits;

use Illuminate\Http\Request;
use jericho\LookupAttorneyType;
use OwenIt\Auditing\Auditing;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * This class is used to log audits against the attorney_property_flip pivot table for deletions.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class DeleteAttorneyPropertyFlipAuditor implements Auditor
{
	public function __construct($request, $property_flip, $contact, $lookup_attorney_type_id, $user)
	{
		$this->request = $request;
		$this->property_flip = $property_flip;
		$this->contact = $contact;
		$this->lookup_attorney_type_id = $lookup_attorney_type_id;
		$this->user = $user;
	}
	
	public function log()
	{
		$old_audit = $this->buildNewAudit();
		$auditing = new Auditing();
		$auditing->id = (string) Uuid::uuid4();
		$auditing->type = 'delete';
		$auditing->auditable_id = $this->property_flip->id;
		$auditing->auditable_type = 'jericho\PropertyFlip';
		$auditing->old = $old_audit;
		$auditing->user_id = $this->user->id;
		$auditing->route = $this->request->fullUrl();
		$auditing->ip_address = $this->request->ip();
		$auditing->created_at = new Carbon();
		$auditing->save();
	}
	
	private function buildNewAudit()
	{
		$lookup_attorney_type = LookupAttorneyType::find($this->lookup_attorney_type_id);
		$new_audit = 'Deleted attorney contact link from property flip (ID: ' . $this->property_flip->id . '):<br/>' .
				'<b>Contact:</b> ' . $this->contact->firstname . ' ' . $this->contact->surname . ' (ID: ' . $this->contact->id . '),<br/>' .
				'<b>Attorney Type:</b> ' . $lookup_attorney_type->description . ' (ID: ' . $this->lookup_attorney_type_id . ')';
		return $new_audit;
	}
}