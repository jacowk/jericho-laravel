<?php
namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model representing a property
 * 
 * @author Jaco Koekemoer
 *
 */
class Property extends Model
{
	use Auditable;
	
	protected $fillable = [
		'address_line_1',
		'address_line_2',
		'address_line_3',
		'address_line_4',
		'address_line_5',
		'suburb_id',
		'area_id',
		'greater_area_id',
		'portion_number',
		'erf_number',
		'size',
		'lookup_property_type_id',
		'created_by_id',
		'updated_by_id'
	];
	
	/* For invoke via reflection in auditing */
	public function getName()
	{
		return $this->name;
	}
	
	public function suburb()
	{
		return $this->belongsTo('jericho\Suburb');
	}
	
	public function area()
	{
		return $this->belongsTo('jericho\Area');
	}
	
	public function greater_area()
	{
		return $this->belongsTo('jericho\GreaterArea');
	}
	
	public function property_flips()
	{
		return $this->hasMany('jericho\PropertyFlip');
	}
	
	public function lookup_property_type()
	{
		return $this->belongsTo('jericho\LookupPropertyType');
	}
	
	public function created_by()
	{
		return $this->belongsTo('jericho\User', 'created_by_id');
	}
	
	public function updated_by()
	{
		return $this->belongsTo('jericho\User', 'updated_by_id');
	}
	
	public function transformAudit(array $data)
	{
		$transformations = [
				'created_by_id' => array(ModelTypeConstants::USER, array('firstname', 'surname')),
				'updated_by_id' => array(ModelTypeConstants::USER, array('firstname', 'surname')),
				'suburb_id' => array(ModelTypeConstants::SUBURB, array('name')),
				'area_id' => array(ModelTypeConstants::AREA, array('name')),
				'greater_area_id' => array(ModelTypeConstants::GREATER_AREA, array('name')),
				'lookup_property_type_id' => array(ModelTypeConstants::LOOKUP_PROPERTY_TYPE, array('description')),
		];
		$modelTransformAuditor = new ModelTransformAuditor();
		$data = $modelTransformAuditor->audit($data, $transformations);
		return $data;
	}
}
