<?php
namespace jericho\Audits;

use Illuminate\Http\Request;
use jericho\LookupContractorType;
use OwenIt\Auditing\Auditing;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * This class is used to log audits against the contractor_property_flip pivot table.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class LinkContractorPropertyFlipAuditor implements Auditor
{
	public function __construct($request, $property_flip, $contractor, $contact, $lookup_contractor_type_id, $user)
	{
		$this->request = $request;
		$this->property_flip = $property_flip;
		$this->contractor = $contractor;
		$this->contact = $contact;
		$this->lookup_contractor_type_id = $lookup_contractor_type_id;
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
		$lookup_contractor_type = LookupContractorType::find($this->lookup_contractor_type_id);
		$new_audit = 'Linked contractor contact to property flip (ID: ' . $this->property_flip->id . '):<br/>' .
				'<b>Contractor Name:</b> ' . $this->contractor->name . ' (ID: ' . $this->contractor->id . '),<br/>' .
				'<b>Contact:</b> ' . $this->contact->firstname . ' ' . $this->contact->surname . ' (ID: ' . $this->contact->id . '),<br/>' .
				'<b>Contractor Type:</b> ' . $lookup_contractor_type->description . ' (ID: ' . $this->lookup_contractor_type_id . ')';
		return $new_audit;
	}
}