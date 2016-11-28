<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use jericho\Audits\Model\ModelTransformAuditor;
use Carbon\Carbon;
use jericho\Area;
use jericho\Suburb;
use jericho\Contact;
use jericho\Util\ModelTypeConstants;

/**
 * A unit test for ModelTransformer
 *
 * @author Jaco Koekemoer
 * Date: 2016-11-16
 *
 */
class ModelTransformAuditorTest extends TestCase
{
    public function testAuditWithOldArea()
    {
        /* Prepare to create a $data array */
    	$helderkruin_suburb = Suburb::where('name', 'like', 'Helderkruin')->first();
    	$old_area = Area::find($helderkruin_suburb->area_id);
    	$new_area = Area::find($helderkruin_suburb->area_id + 1);;
    	$attribute_name = 'area_id';
    	$old_attribute_value = $old_area->id;
    	$new_attribute_value = $new_area->id;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value, $helderkruin_suburb);
    	/* Prepare transformations */
    	$transformations = [
    			'area_id' => array(ModelTypeConstants::AREA, array('name')),
    	];
    	/* Call method tested */
    	$model_transform_auditor = new ModelTransformAuditor();
    	$data = $model_transform_auditor->audit($data, $transformations);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the old area id */
    	$new_array = $data['old'];
    	$new_value = $new_array[$attribute_name];
    	$area = Area::find($old_attribute_value);
    	$this->assertEquals(trim($area->name), trim($new_value));
    }
    
    public function testAuditWithNewArea()
    {
        /* Prepare to create a $data array */
    	$helderkruin_suburb = Suburb::where('name', 'like', 'Helderkruin')->first();
    	$old_area = Area::find($helderkruin_suburb->area_id);
    	$new_area = Area::find($helderkruin_suburb->area_id + 1);
    	$attribute_name = 'area_id';
    	$old_attribute_value = $old_area->id;
    	$new_attribute_value = $new_area->id;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_area->id, $new_area->id, $helderkruin_suburb);
    	/* Prepare transformations */
    	$transformations = [
    			'area_id' => array(ModelTypeConstants::AREA, array('name')),
    	];
    	/* Call method tested */
    	$model_transform_auditor = new ModelTransformAuditor();
    	$data = $model_transform_auditor->audit($data, $transformations);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the old area id */
    	$new_array = $data['new'];
    	$new_value = $new_array[$attribute_name];
    	$area = Area::find($new_attribute_value);
    	$this->assertEquals(trim($area->name), trim($new_value));
    }
    
    public function testAuditWithNullTransformations()
    {
        /* Prepare to create a $data array */
    	$helderkruin_suburb = Suburb::where('name', 'like', 'Helderkruin')->first();
    	$old_area = Area::find($helderkruin_suburb->area_id);
    	$new_area = Area::find($helderkruin_suburb->area_id + 1);
    	$attribute_name = 'area_id';
    	$old_attribute_value = $old_area->id;
    	$new_attribute_value = $new_area->id;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value, $helderkruin_suburb);
    	/* Prepare transformations */
    	$transformations = null;
    	/* Call method tested */
    	$model_transform_auditor = new ModelTransformAuditor();
    	$data = $model_transform_auditor->audit($data, $transformations);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the old area id */
    	$new_array = $data['new'];
    	$new_value = $new_array[$attribute_name];
    	$this->assertEquals($new_attribute_value, trim($new_value));
    }
    
    public function testAuditWithInvalidProperty()
    {
        /* Prepare to create a $data array */
    	$helderkruin_suburb = Suburb::where('name', 'like', 'Helderkruin')->first();
    	$old_area = Area::find($helderkruin_suburb->area_id);
    	$new_area = Area::find($helderkruin_suburb->area_id + 1);
    	$attribute_name = 'area_id';
    	$old_attribute_value = $old_area->id;
    	$new_attribute_value = $new_area->id;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value, $helderkruin_suburb);
    	/* Prepare transformations */
    	$transformations = [
    			'area_id' => array(ModelTypeConstants::AREA, array('invalid')), //The invalid property
    	];
    	/* Call method tested */
    	$model_transform_auditor = new ModelTransformAuditor();
    	$data = $model_transform_auditor->audit($data, $transformations);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the old area id */
    	$new_array = $data['new'];
    	$new_value = $new_array[$attribute_name];
    	$this->assertEquals($new_attribute_value, trim($new_value));
    }
    
    public function testAuditWithInvalidKey()
    {
        /* Prepare to create a $data array */
    	$helderkruin_suburb = Suburb::where('name', 'like', 'Helderkruin')->first();
    	$old_area = Area::find($helderkruin_suburb->area_id);
    	$new_area = Area::find($helderkruin_suburb->area_id + 1);
    	$attribute_name = 'area_id';
    	$old_attribute_value = $old_area->id;
    	$new_attribute_value = $new_area->id;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value, $helderkruin_suburb);
    	/* Prepare transformations */
    	$transformations = [
    			'invalid' => array(ModelTypeConstants::AREA, array('name')), //The invalid key
    	];
    	/* Call method tested */
    	$model_transform_auditor = new ModelTransformAuditor();
    	$data = $model_transform_auditor->audit($data, $transformations);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the old area id */
    	$new_array = $data['new'];
    	$new_value = $new_array[$attribute_name];
    	$this->assertEquals($new_attribute_value, trim($new_value));
    }
    
    public function testAuditWithEmptyKey()
    {
        /* Prepare to create a $data array */
    	$helderkruin_suburb = Suburb::where('name', 'like', 'Helderkruin')->first();
    	$old_area = Area::find($helderkruin_suburb->area_id);
    	$new_area = Area::find($helderkruin_suburb->area_id + 1);
    	$attribute_name = 'area_id';
    	$old_attribute_value = $old_area->id;
    	$new_attribute_value = $new_area->id;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value, $helderkruin_suburb);
    	/* Prepare transformations */
    	$transformations = [
    			'' => array(ModelTypeConstants::AREA, array('name')), //The invalid key
    	];
    	/* Call method tested */
    	$model_transform_auditor = new ModelTransformAuditor();
    	$data = $model_transform_auditor->audit($data, $transformations);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	$this->assertNotEmpty($data);
    }
    
    public function testAuditWithInvalidModelClassName()
    {
        /* Prepare to create a $data array */
    	$helderkruin_suburb = Suburb::where('name', 'like', 'Helderkruin')->first();
    	$old_area = Area::find($helderkruin_suburb->area_id);
    	$new_area = Area::find($helderkruin_suburb->area_id + 1);
    	$attribute_name = 'area_id';
    	$old_attribute_value = $old_area->id;
    	$new_attribute_value = $new_area->id;
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value, $helderkruin_suburb);
    	/* Prepare transformations */
    	$transformations = [
    			'area_id' => array('InvalidClassName', array('name')), //The invalid class name
    	];
    	/* Call method tested */
    	$model_transform_auditor = new ModelTransformAuditor();
    	$data = $model_transform_auditor->audit($data, $transformations);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the old area id */
    	$new_array = $data['new'];
    	$new_value = $new_array[$attribute_name];
    	$this->assertEquals($new_attribute_value, trim($new_value));
    }
    
    public function testAuditWithNullDataArray()
    {
        /* Prepare to create a $data array */
    	$helderkruin_suburb = Suburb::where('name', 'like', 'Helderkruin')->first();
    	$old_area = Area::find($helderkruin_suburb->area_id);
    	$new_area = Area::find($helderkruin_suburb->area_id + 1);
    	$attribute_name = 'area_id';
    	$old_attribute_value = $old_area->id;
    	$new_attribute_value = $new_area->id;
    	/* Create the $data array */
    	$data = null;
    	/* Prepare transformations */
    	$transformations = [
    			'area_id' => array(ModelTypeConstants::AREA, array('name')), //The invalid class name
    	];
    	/* Call method tested */
    	$model_transform_auditor = new ModelTransformAuditor();
    	$data = $model_transform_auditor->audit($data, $transformations);
    	/* Validate not null */
    	$this->assertEmpty($data);
    }
    
    public function testAuditWithEmptyDataArray()
    {
        /* Prepare to create a $data array */
    	$helderkruin_suburb = Suburb::where('name', 'like', 'Helderkruin')->first();
    	$old_area = Area::find($helderkruin_suburb->area_id);
    	$new_area = Area::find($helderkruin_suburb->area_id + 1);
    	$attribute_name = 'area_id';
    	$old_attribute_value = $old_area->id;
    	$new_attribute_value = $new_area->id;
    	/* Create the $data array */
    	$data = array();
    	/* Prepare transformations */
    	$transformations = [
    			'area_id' => array(ModelTypeConstants::AREA, array('name')), //The invalid class name
    	];
    	/* Call method tested */
    	$model_transform_auditor = new ModelTransformAuditor();
    	$data = $model_transform_auditor->audit($data, $transformations);
    	/* Validate not null */
    	$this->assertEmpty($data);
    }
    
    public function testAuditWithOldContact()
    {
        /* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	$contact = Contact::find(1);
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value, $contact);
    	/* Prepare transformations */
    	$transformations = [
    			'contact_id' => array(ModelTypeConstants::CONTACT, array('firstname', 'surname')),
    	];
    	/* Call method tested */
    	$model_transform_auditor = new ModelTransformAuditor();
    	$data = $model_transform_auditor->audit($data, $transformations);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the old contact id */
    	$new_array = $data['old'];
    	$new_value = $new_array[$attribute_name];
    	$contact = Contact::find($old_attribute_value);
    	$this->assertEquals(trim($contact->firstname . ' ' . $contact->surname), trim($new_value));
    }
    
    public function testAuditWithNewContact()
    {
        /* Prepare to create a $data array */
    	$attribute_name = 'contact_id';
    	$old_attribute_value = 1;
    	$new_attribute_value = 2;
    	$contact = Contact::find(1);
    	/* Create the $data array */
    	$data = $this->getData($attribute_name, $old_attribute_value, $new_attribute_value, $contact);
    	/* Prepare transformations */
    	$transformations = [
    			'contact_id' => array(ModelTypeConstants::CONTACT, array('firstname', 'surname')),
    	];
    	/* Call method tested */
    	$model_transform_auditor = new ModelTransformAuditor();
    	$data = $model_transform_auditor->audit($data, $transformations);
    	/* Validate not null */
    	$this->assertNotNull($data);
    	/* Validate the transformation of the old contact id */
    	$new_array = $data['new'];
    	$new_value = $new_array[$attribute_name];
    	$contact = Contact::find($new_attribute_value);
    	$this->assertEquals(trim($contact->firstname . ' ' . $contact->surname), trim($new_value));
    }
    
    private function getData($attribute_name, $old_attribute_value, $new_attribute_value, $auditable)
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
    	$data['auditable_id'] = $auditable->id;
    	$data['auditable_type'] = "jericho\Suburb";
    	$data['user_id'] = 1;
    	$data['route'] = "http://localhost:8000/do-update-suburb/4382";
    	$data['ip_address'] = "127.0.0.1";
    	$data['created_at'] = Carbon::now();
    	return $data;
    }
}
