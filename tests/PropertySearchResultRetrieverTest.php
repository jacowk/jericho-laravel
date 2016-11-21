<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\User;
use jericho\Properties\PropertySearchResultRetriever;
use jericho\Property;

/**
 * Unit test for testing PropertySearchResultRetriever functionality
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-18
 *
 */
class PropertySearchResultRetrieverTest extends AbstractUnitTest
{
    public function testExecuteWithSpaces()
    {
    	$address_line_1 = 'Test address line 1000';
    	$this->createProperty($address_line_1);
    	$query_parameters = array();
    	$address_query_parameter = '%' . $address_line_1 . '%';
    	$user = User::find(1);
    	
    	$property_search_result_retriever = new PropertySearchResultRetriever($query_parameters, 
    		$address_query_parameter, $user);
    	$properties = $property_search_result_retriever->execute();
    	$this->assertNotNull($properties);
    	$this->assertTrue(count($properties) > 0);
    	$this->assertNotEmpty($properties);
    }
    
    private function createProperty($address_line_1)
    {
    	$area_id = 1;
    	$greater_area_id = 1;
    	$portion_number = 1;
    	$erf_number = 10;
    	$size = 50;
    	$lookup_property_type_id = 1;
    	$created_by_id = 1;
    	
    	$property = new Property();
    	$property->address_line_1 = $address_line_1;
    	$property->area_id = $area_id;
    	$property->greater_area_id = $greater_area_id;
    	$property->portion_number = $portion_number;
    	$property->erf_number = $erf_number;
    	$property->size = $size;
    	$property->lookup_property_type_id = $lookup_property_type_id;
    	$property->created_by_id = $created_by_id;
    	$property->save();
    }
}
