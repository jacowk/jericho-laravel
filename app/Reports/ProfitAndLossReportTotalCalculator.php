<?php
namespace jericho\Reports;

/**
 * This class is used for calculating the total for the profit and loss report.
 *
 * @author Jaco Koekemoer
 * Date: 2016-12-07
 *
 */
class ProfitAndLossReportTotalCalculator
{
	public function __construct($report_data)
	{
		$this->report_data = $report_data;
	}

	public function calculate()
	{
		$total = 0;
		for ($i = 0; $i < count($this->report_data); $i++)
		{
			$profit_loss_balance = $this->report_data[$i]['profit_loss_balance'];
			$total += $profit_loss_balance;
		}
		return $total;
	}
}