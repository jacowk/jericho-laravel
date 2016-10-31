<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model representing a contact 
 * 
 * @author Jaco Koekemoer
 *
 */
class Contact extends Model
{
	use Auditable;
	
	protected $fillable = [
			'firstname', 
			'surname', 
			'home_tel_no', 
			'work_tel_no', 
			'cell_no', 
			'fax_no', 
			'personal_email', 
			'work_email', 
			'work_email', 
			'sa_citizen', 
			'created_by_id', 
			'updated_by_id'
	];
	
	/* For invoke via reflection in auditing */
	public function getFirstname()
	{
		return $this->firstname;
	}
	
	/* For invoke via reflection in auditing */
	public function getSurname()
	{
		return $this->surname;
	}
	
	public function title()
	{
		return $this->belongsTo('jericho\LookupTitle');
	}
	
	public function marital_status()
	{
		return $this->belongsTo('jericho\LookupMaritalStatus');
	}
	
	public function attorneys()
    {
    	return $this->belongsToMany('jericho\Attorney');
    }
    
    public function banks()
    {
    	return $this->belongsToMany('jericho\Bank');
    }
    
    public function contractors()
    {
    	return $this->belongsToMany('jericho\Contractor');
    }
    
    public function estateAgents()
    {
    	return $this->belongsToMany('jericho\EstateAgent');
    }
    
    public function attorney_property_flips()
    {
    	return $this->belongsToMany('jericho\PropertyFlip', 'attorney_property_flip');
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
    			'title_id' => array(ModelTypeConstants::LOOKUP_TITLE, array('description')),
    			'marital_status_id' => array(ModelTypeConstants::LOOKUP_MARITAL_STATUS, array('description'))
    	];
    	$modelTransformAuditor = new ModelTransformAuditor();
    	$data = $modelTransformAuditor->audit($data, $transformations);
    	return $data;
    }
}
