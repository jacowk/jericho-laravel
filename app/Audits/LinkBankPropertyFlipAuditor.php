<?php
namespace jericho\Audits;

use Illuminate\Http\Request;
use OwenIt\Auditing\Auditing;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

/**
 * This class is used to log audits against the bank_property_flip pivot table.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-27
 *
 */
class LinkBankPropertyFlipAuditor implements Auditor
{
	public function __construct($request, $property_flip, $bank, $contact, $user)
	{
		$this->request = $request;
		$this->property_flip = $property_flip;
		$this->bank = $bank;
		$this->contact = $contact;
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
		$new_audit = 'Linked bank contact to property flip (ID: ' . $this->property_flip->id . '):<br/>' .
				'<b>Bank Name:</b> ' . $this->bank->name . ' (ID: ' . $this->bank->id . '),<br/>' .
				'<b>Contact:</b> ' . $this->contact->firstname . ' ' . $this->contact->surname . ' (ID: ' . $this->contact->id . '),<br/>';
		return $new_audit;
	}
}