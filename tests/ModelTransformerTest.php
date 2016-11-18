<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Audits\Model\ModelTransformer;
use Carbon\Carbon;
use jericho\Area;
use jericho\Contact;
use jericho\Util\Util;

/**
 * A unit test for ModelTransformer
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-09
 *
 */
class ModelTransformerTest extends TestCase
{
    public function testTransformWithOldArea()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'area_id';
    	$old_attribute_value = 58;
    	$new_attribute_value = 46;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'old.area_id';
    	$model_class_name = 'Area';
    	$property_array = ['name'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the old area id */
    	$old_array = $data['old'];
    	$new_value = $old_array[$attribute_name];
		$area = Area::find($old_attribute_value);
		$this->assertEquals(trim($area->name), trim($new_value));
    }
    
    public function testTransformWithNewArea()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'area_id';
    	$old_attribute_value = 58;
    	$new_attribute_value = 46;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'new.area_id';
    	$model_class_name = 'Area';
    	$property_array = ['name'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the new area id */
    	$new_array = $data['new'];
    	$new_value = $new_array[$attribute_name];
		$area = Area::find($new_attribute_value);
		$this->assertEquals(trim($area->name), trim($new_value));
    }
    
    public function testTransformWithOldContact()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'old.contact_id';
    	$model_class_name = 'Contact';
    	$property_array = ['firstname', 'surname'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the old area id */
    	$old_array = $data['old'];
    	$new_value = $old_array[$attribute_name];
		$contact = Contact::find($old_attribute_value);
		$this->assertEquals(trim($contact->firstname . ' ' . $contact->surname), trim($new_value));
    }
     
    public function testTransformWithNewContact()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'new.contact_id';
    	$model_class_name = 'Contact';
    	$property_array = ['firstname', 'surname'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the old area id */
    	$new_array = $data['new'];
    	$new_value = $new_array[$attribute_name];
		$contact = Contact::find($new_attribute_value);
		$this->assertEquals(trim($contact->firstname . ' ' . $contact->surname), trim($new_value));
    }
    
    public function testTransformWithInvalidPropertyToCall()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'area_id';
    	$old_attribute_value = 58;
    	$new_attribute_value = 46;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'old.area_id';
    	$model_class_name = 'Area';
    	$property_array = ['invalid'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate not null and not empty */
    	$this->assertNotNull($data);
    	$this->assertNotEmpty($data);
    }
    
    public function testTransformWithInvalidKey()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'new.invalid_id';
    	$model_class_name = 'Contact';
    	$property_array = ['firstname', 'surname'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$return_data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate $data and $return_data is equal */    	
    	$this->assertTrue(Util::areArraysEqual($data, $return_data));
    }
    
    public function testTransformWithInvalidModelClassName()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'new.area_id';
    	$model_class_name = 'Invalid';
    	$property_array = ['firstname', 'surname'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$return_data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate $data and $return_data is equal */    	
    	$this->assertNotNull($data);
    	$this->assertNotEmpty($data);
    }

    public function testTransformWithNullDataArray()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = null;
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'old.contact_id';
    	$model_class_name = 'Contact';
    	$property_array = ['firstname', 'surname'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertEmpty($data);
    }

    public function testTransformWithEmptyDataArray()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = array();
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'old.contact_id';
    	$model_class_name = 'Contact';
    	$property_array = ['firstname', 'surname'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertEmpty($data);
    }

    public function testTransformWithNullKey()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = null;
    	$model_class_name = 'Contact';
    	$property_array = ['firstname', 'surname'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	$this->assertNotEmpty($data);
    }

    public function testTransformWithEmptyKey()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = '';
    	$model_class_name = 'Contact';
    	$property_array = ['firstname', 'surname'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	$this->assertNotEmpty($data);
    }

    public function testTransformWithNullModelClassName()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'new.contact_id';
    	$model_class_name = null;
    	$property_array = ['firstname', 'surname'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	$this->assertNotEmpty($data);
    }

    public function testTransformWithEmptyModelClassName()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'new.contact_id';
    	$model_class_name = '';
    	$property_array = ['firstname', 'surname'];
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	$this->assertNotEmpty($data);
    }

    public function testTransformWithNullPropertyArray()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'new.contact_id';
    	$model_class_name = 'Contact';
    	$property_array = null;
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	$this->assertNotEmpty($data);
    }

    public function testTransformWithEmptyPropertyArray()
    {
    	/* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value);
    	/* Prepare the rest of the parameters for the ModelTransformer */
    	$key = 'new.contact_id';
    	$model_class_name = 'Contact';
    	$property_array = array();
    	/* Instantiate the ModelTransformer */
    	$model_transformer = new ModelTransformer();
    	/* Call the ModelTransformer */
    	$data = $model_transformer->transform($data, $key, $model_class_name, $property_array);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	$this->assertNotEmpty($data);
    }
    
    /**
     * Get an associative array
     * 
     * @param unknown $attribute_name
     * @param unknown $old_attribute_value
     * @param unknown $new_attribute_value
     * @return string[]|number[]|unknown[][]|\Carbon\Carbon[]
     */
    private function getData($attribute_name, $old_attribute_value, $new_attribute_value)
    {
    	$data = array();
    	$data['id'] = "1fa4da59-b6f0-4f54-9562-81c6c340d1d6";
    	$data['old'] = [
    		$attribute_name => $old_attribute_value
    	];
    	$data['new'] = [
    		$attribute_name => $new_attribute_value
    	];
    	$data['type'] = "updated";
    	$data['auditable_id'] = 4382;
    	$data['auditable_type'] = "jericho\Suburb";
    	$data['user_id'] = 1;
    	$data['route'] = "http://localhost:8000/do-update-suburb/4382";
    	$data['ip_address'] = "127.0.0.1";
    	$data['created_at'] = Carbon::now();
    	return $data;
    }
    
    /*
     * An example array of $data
     * 
array:10 [
  "id" => "1fa4da59-b6f0-4f54-9562-81c6c340d1d6"
  "old" => array:1 [
    "area_id" => 59
  ]
  "new" => array:1 [
    "area_id" => "46"
  ]
  "type" => "updated"
  "auditable_id" => 4382
  "auditable_type" => "jericho\Suburb"
  "user_id" => 1
  "route" => "http://localhost:8000/do-update-suburb/4382"
  "ip_address" => "127.0.0.1"
  "created_at" => Carbon {#1075 
    +"date": "2016-11-09 13:59:27.000000"
    +"timezone_type": 3
    +"timezone": "Africa/Johannesburg"
  }
]
    */
}
