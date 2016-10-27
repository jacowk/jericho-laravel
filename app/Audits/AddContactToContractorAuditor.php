<?php
namespace jericho\Audits;

use Illuminate\Http\Request;
use OwenIt\Auditing\Auditing;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * This class is used to log audits when a contact is added for an contractor. Used in ContactController.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class AddContactToContractorAuditor implements Auditor
{
	public function __construct($request, $user, $contractor, $contact)
	{
		$this->request = $request;
		$this->user = $user;
		$this->contractor = $contractor;
		$this->contact = $contact;
	}
	
	public function log()
	{
		$new_audit = $this->buildNewAudit();
		$auditing = new Auditing();
		$auditing->id = (string) Uuid::uuid4();
		$auditing->type = 'linked';
		$auditing->auditable_id = $this->contractor->id;
		$auditing->auditable_type = 'jericho\Contractor';
		$auditing->new = $new_audit;
		$auditing->user_id = $this->user->id;
		$auditing->route = $this->request->fullUrl();
		$auditing->ip_address = $this->request->ip();
		$auditing->created_at = new Carbon();
		$auditing->save();
	}
	
	private function buildNewAudit()
	{
		$new_audit = 'Added contact to contractor:<br/>' .
				'<b>Contractor Name:</b> ' . $this->contractor->name . ' (ID: ' . $this->contractor->id . '),<br/>' .
				'<b>Contact:</b> ' . $this->contact->firstname . ' ' . $this->contact->surname . ' (ID: ' . $this->contact->id . ')';
		return $new_audit;
	}
}