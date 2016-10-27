<?php
namespace jericho\Audits;

use Illuminate\Http\Request;
use jericho\LookupAttorneyType;
use OwenIt\Auditing\Auditing;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * This class is used to log audits against the attorney_property_flip pivot table.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-26
 *
 */
class LinkAttorneyPropertyFlipAuditor implements Auditor
{
	public function __construct($request, $property_flip, $attorney, $contact, $lookup_attorney_type_id, $user)
	{
		$this->request = $request;
		$this->property_flip = $property_flip;
		$this->attorney = $attorney;
		$this->contact = $contact;
		$this->lookup_attorney_type_id = $lookup_attorney_type_id;
		$this->user = $user;
	}
	
	public function log()
	{
		$new_audit = $this->buildNewAudit();
		$auditing = new Auditing();
		$auditing->id = (string) Uuid::uuid4();
		$auditing->type = 'linked';
		$auditing->auditable_id = $this->property_flip->id;
		$auditing->auditable_type = 'jericho\PropertyFlip';
		$auditing->new = $new_audit;
		$auditing->user_id = $this->user->id;
		$auditing->route = $this->request->fullUrl();
		$auditing->ip_address = $this->request->ip();
		$auditing->created_at = new Carbon();
		$auditing->save();
	}
	
	private function buildNewAudit()
	{
		$lookup_attorney_type = LookupAttorneyType::find($this->lookup_attorney_type_id);
		$new_audit = 'Linked attorney contact to property flip (ID: ' . $this->property_flip->id . '):<br/>' .
				'<b>Attorney Name:</b> ' . $this->attorney->name . ' (ID: ' . $this->attorney->id . '),<br/>' .
				'<b>Contact:</b> ' . $this->contact->firstname . ' ' . $this->contact->surname . ' (ID: ' . $this->contact->id . '),<br/>' .
				'<b>Attorney Type:</b> ' . $lookup_attorney_type->description . ' (ID: ' . $this->lookup_attorney_type_id . ')';
		return $new_audit;
	}
}