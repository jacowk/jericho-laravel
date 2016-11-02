<?php
namespace jericho\Properties;
use jericho\Component\Component;
use jericho\Property;

/**
 * This component is used to retrieve the total number of properties in the system
 * 
 * @author Jaco Koekemoer
 * Date: 2016-11-02
 *
 */
class TotalPropertiesRetriever implements Component
{
	public function __construct($from_date, $to_date)
	{
		$this->from_date = $from_date;
		$this->to_date = $to_date;
	}
	
	public function execute()
	{
		$total_properties = Property::whereBetween('created_at', [$this->from_date, $this->to_date])
								->count();
		return $total_properties;
	}
}