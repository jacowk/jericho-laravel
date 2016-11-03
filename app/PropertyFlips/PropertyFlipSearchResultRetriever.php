<?php
namespace jericho\PropertyFlips;

use jericho\Component\Component;
use DB;

/**
 * This component is used to retrieve search results for a property flip joined with the properties table
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-03
 *
 */
class PropertyFlipSearchResultRetriever implements Component
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
		$properties = DB::table('properties')
						->join('property_flips', 'properties.id', '=', 'property_flips.property_id')
						->join('suburbs', 'properties.suburb_id', '=', 'suburbs.id')
						->join('areas', 'properties.area_id', '=', 'areas.id')
						->join('greater_areas', 'properties.greater_area_id', '=', 'greater_areas.id')
						->where($this->query_parameters)
						->where(function ($query) use ($address_query_parameter) {
							$query->where('address_line_1', 'like', $address_query_parameter)
							->orWhere('address_line_2', 'like', $address_query_parameter)
							->orWhere('address_line_3', 'like', $address_query_parameter)
							->orWhere('address_line_4', 'like', $address_query_parameter)
							->orWhere('address_line_5', 'like', $address_query_parameter);
						})
						->select('properties.*',
								'property_flips.id as property_flip_id',
								'property_flips.reference_number',
								'suburbs.name as suburb_name',
								'areas.name as area_name',
								'greater_areas.name as greater_area_name')
						->paginate($this->user->pagination_size);
		
		return $properties;
	}
}