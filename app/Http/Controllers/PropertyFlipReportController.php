<?php

namespace jericho\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use jericho\PropertyFlip;
use jericho\Property;
use jericho\Accounts\AccountBalanceCalculator;
use jericho\Accounts\AccountConstants;
use jericho\Accounts\AccountViewDataGenerator;
use jericho\Contacts\AttorneyContactRetriever;
use jericho\Contacts\EstateAgentContactRetriever;
use jericho\Contacts\BankContactRetriever;
use jericho\Contacts\ContractorContactRetriever;
use jericho\Contacts\InvestorContactRetriever;
use jericho\Validation\ViewObjectValidator;
use PDF;

/**
 * This controller is used to download all information related to a property flip as a pdf report
 * 
 * Remember to add audit entries for all reports!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-07
 *
 */
class PropertyFlipReportController extends Controller
{
	/**
	 * Download the pdf for this report
	 *
	 * @param Request $request
	 */
	public function downloadPDF(Request $request, $property_flip_id)
	{
// 		$validator = Validator::make($request->all(), [
// 			'property_flip_id' => 'required',
// 		]);
		
// 		if ($validator->fails()) {
// 			return redirect('view-property-flip', ['property_flip_id' => $property_flip_id])
// 			->withErrors($validator)
// 			->withInput();
// 		}
		
		$property_flip = PropertyFlip::find($property_flip_id);
		(new ViewObjectValidator())->validate($property_flip, 'property flip', $property_flip_id);
		$property = Property::find($property_flip->property_id);
		$attorney_contacts = (new AttorneyContactRetriever($property_flip))->execute();
		$contact_estate_agents = (new EstateAgentContactRetriever($property_flip))->execute();
		$contact_contractors = (new ContractorContactRetriever($property_flip))->execute();
		$bank_contacts = (new BankContactRetriever($property_flip))->execute();
		$contact_investors = (new InvestorContactRetriever($property_flip))->execute();
		
		$accountBalanceCalculator = new AccountBalanceCalculator();
		$profit_loss_balance = $accountBalanceCalculator->calculate(AccountConstants::PROFIT_AND_LOSS_ACCOUNT,
			$property_flip->transactions);
		
		/* Generate account transactions data for the view */
		$account_view_data_generator = new AccountViewDataGenerator();
		$account_transactions = $account_view_data_generator->generateData($property_flip_id);
		
		/* Download PDF */
		$pdf = PDF::loadView('pdf.property-flip', [
				'property_flip' => $property_flip,
				'attorney_contacts' => $attorney_contacts,
				'contact_estate_agents' => $contact_estate_agents,
				'contact_contractors' => $contact_contractors,
				'bank_contacts' => $bank_contacts,
				'contact_investors' => $contact_investors,
				'property' => $property,
				'profit_loss_balance' => $profit_loss_balance,
				'account_transactions' => $account_transactions
		]);
		return $pdf->download('property-flip-' . $property_flip_id . '.pdf');
	}
}
