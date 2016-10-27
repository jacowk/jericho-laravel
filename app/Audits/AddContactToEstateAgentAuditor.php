<?php
namespace jericho\Audits;

use Illuminate\Http\Request;
use OwenIt\Auditing\Auditing;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * This class is used to log audits when a contact is added for an Estate Agent. Used in ContactController.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class AddContactToEstateAgentAuditor implements Auditor
{
	public function __construct($request, $user, $estate_agent, $contact)
	{
		$this->request = $request;
		$this->user = $user;
		$this->estate_agent = $estate_agent;
		$this->contact = $contact;
	}
	
	public function log()
	{
		$new_audit = $this->buildNewAudit();
		$auditing = new Auditing();
		$auditing->id = (string) Uuid::uuid4();
		$auditing->type = 'linked';
		$auditing->auditable_id = $this->estate_agent->id;
		$auditing->auditable_type = 'jericho\EstateAgent';
		$auditing->new = $new_audit;
		$auditing->user_id = $this->user->id;
		$auditing->route = $this->request->fullUrl();
		$auditing->ip_address = $this->request->ip();
		$auditing->created_at = new Carbon();
		$auditing->save();
	}
	
	private function buildNewAudit()
	{
		$new_audit = 'Added contact to estate_agent:<br/>' .
				'<b>Estate Agent Name:</b> ' . $this->estate_agent->name . ' (ID: ' . $this->estate_agent->id . '),<br/>' .
				'<b>Contact:</b> ' . $this->contact->firstname . ' ' . $this->contact->surname . ' (ID: ' . $this->contact->id . ')';
		return $new_audit;
	}
}