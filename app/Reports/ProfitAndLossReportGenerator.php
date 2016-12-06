<?php
namespace jericho\Reports;

use jericho\PropertyFlips\PropertyFlipSearchResultRetriever;
use jericho\Http\Controllers\Auth\AuthUserRetriever;
use jericho\Util\Util;
use jericho\Accounts\AccountBalanceCalculator;
use jericho\PropertyFlip;

/**
 * This class is used for generating the data required for the profit and loss report, including for the 
 * PDF to be downloaded.
 * 
 * @author Jaco Koekemoer
 * Date: 2016-12-06
 *
 */
class ProfitAndLossReportGenerator
{
	public function generate($query_parameters)
	{
		$address_query_parameter = Util::convertToLikeQueryParameter('');
		$user = (new AuthUserRetriever())->retrieveUser();
		
		$properties = (new PropertyFlipSearchResultRetriever($query_parameters, $address_query_parameter, $user))->execute();
		
		$report_data = array();
		for ($i = 0; $i < count($properties); $i++)
		{
			$property_flip = PropertyFlip::find($properties[$i]->property_flip_id);
			$accountBalanceCalculator = new AccountBalanceCalculator();
			$profit_loss_balance = $accountBalanceCalculator->calculate(AccountConstants::PROFIT_AND_LOSS_ACCOUNT,
				$property_flip->transactions);
			$item_data = [
				'property_flip' => $property_flip,
				'profit_loss_balance' => $profit_loss_balance
			];
		}
	}
}