<?php
namespace jericho\Reports;

use jericho\PropertyFlips\PropertyFlipSearchResultRetriever;
use jericho\Http\Controllers\Auth\AuthUserRetriever;
use jericho\Util\Util;
use jericho\Accounts\AccountBalanceCalculator;
use jericho\PropertyFlip;
use jericho\Accounts\AccountConstants;

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
	public function __construct($query_parameters, $user = null)
	{
		$this->query_parameters = $query_parameters;
		if ($user == null)
		{
			$this->user = (new AuthUserRetriever())->retrieveUser();
		}
		else
		{
			$this->user = $user;
		}
	}
	
	public function generate()
	{
		$address_query_parameter = Util::convertToLikeQueryParameter('');
		
		/* Search for properties */
		$properties = (new PropertyFlipSearchResultRetriever($this->query_parameters, $address_query_parameter, 
			$this->user))->execute();
		
		/* Calculate the account balance for each property, and create the final array for return */
		$report_data = array();
		for ($i = 0; $i < count($properties); $i++)
		{
			$property_flip = PropertyFlip::find($properties[$i]->property_flip_id);
			$accountBalanceCalculator = new AccountBalanceCalculator();
			$profit_loss_balance = $accountBalanceCalculator->calculate(AccountConstants::PROFIT_AND_LOSS_ACCOUNT,
				$property_flip->transactions);
			$item_data = [
				'property' => $properties[$i],
				'profit_loss_balance' => $profit_loss_balance
			];
			array_push($report_data, $item_data);
		}
		return $report_data;
	}
}