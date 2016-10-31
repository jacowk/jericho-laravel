<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model representing a suburb
 *
 * @author Jaco Koekemoer
 *
 */
class Suburb extends Model
{
	use Auditable;
	
	protected $fillable = ['name', 'box_code', 'street_code', 'created_by_id', 'updated_by_id'];
	
	/* For invoke via reflection in auditing */
	public function getName()
	{
		return $this->name;
	}
	
    public function area()
    {
    	return $this->belongsTo('jericho\Area');
    }
    
    public function properties()
    {
    	return $this->hasMany('jericho\Property');
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
    			'area_id' => array(ModelTypeConstants::AREA, array('name')),
    	];
    	$modelTransformAuditor = new ModelTransformAuditor();
    	$data = $modelTransformAuditor->audit($data, $transformations);
    	return $data;
    }
}
