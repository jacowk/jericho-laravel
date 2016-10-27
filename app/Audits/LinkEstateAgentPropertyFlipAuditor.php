<?php
namespace jericho\Audits;

use Illuminate\Http\Request;
use jericho\LookupEstateAgentType;
use OwenIt\Auditing\Auditing;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * This class is used to log audits against the estate_agent_property_flip pivot table.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class LinkEstateAgentPropertyFlipAuditor implements Auditor
{
	public function __construct($request, $property_flip, $estate_agent, $contact, $lookup_estate_agent_type_id, $user)
	{
		$this->request = $request;
		$this->property_flip = $property_flip;
		$this->estate_agent = $estate_agent;
		$this->contact = $contact;
		$this->lookup_estate_agent_type_id = $lookup_estate_agent_type_id;
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
		$lookup_estate_agent_type = LookupEstateAgentType::find($this->lookup_estate_agent_type_id);
		$new_audit = 'Linked estate agent contact to property flip (ID: ' . $this->property_flip->id . '):<br/>' .
				'<b>Estate Agent Name:</b> ' . $this->estate_agent->name . ' (ID: ' . $this->estate_agent->id . '),<br/>' .
				'<b>Contact:</b> ' . $this->contact->firstname . ' ' . $this->contact->surname . ' (ID: ' . $this->contact->id . '),<br/>' .
				'<b>Estate Agent Type:</b> ' . $lookup_estate_agent_type->description . ' (ID: ' . $this->lookup_estate_agent_type_id . ')';
		return $new_audit;
	}
}