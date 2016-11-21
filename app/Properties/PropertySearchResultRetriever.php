<?php
namespace jericho\Properties;

use jericho\Component\Component;
use DB;

/**
 * This component is used to retrieve search results for a property
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class PropertySearchResultRetriever implements Component
{
	public function __construct($query_parameters, $address_query_parameter, $user)
	{
		$this->query_parameters = $query_parameters;
		$this->address_query_parameter = $address_query_parameter;
		$this->user = $user;
	}

	public function execute()
	{
		$address_query_parameter = $this->address_query_parameter;
		$query_parameters = $this->query_parameters;
		$user = $this->user;
						
		$properties = DB::table('properties')
						->leftJoin('suburbs', 'properties.suburb_id', '=', 'suburbs.id')
						->leftJoin('areas', 'properties.area_id', '=', 'areas.id')
						->leftJoin('greater_areas', 'properties.greater_area_id', '=', 'greater_areas.id')
						->where($query_parameters)
						->where(function ($query) use ($address_query_parameter) {
							$query->where('properties.address_line_1', 'like', $address_query_parameter)
								->orWhere('properties.address_line_2', 'like', $address_query_parameter)
								->orWhere('properties.address_line_3', 'like', $address_query_parameter)
								->orWhere('properties.address_line_4', 'like', $address_query_parameter)
								->orWhere('properties.address_line_5', 'like', $address_query_parameter);
						})
						->select('properties.*',
								'suburbs.name as suburb_name',
								'areas.name as area_name',
								'greater_areas.name as greater_area_name')
						->paginate($user->pagination_size);
		return $properties;
	}
}