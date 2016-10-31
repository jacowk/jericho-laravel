<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model representing a diary item
 *
 * @author Jaco Koekemoer
 *
 */
class DiaryItem extends Model
{
	use Auditable;
	
	public function property_flip()
    {
    	return $this->belongsTo('jericho\PropertyFlip');
    }
    
    public function followup_items()
    {
    	return $this->hasMany('jericho\FollowupItem');
    }
    
    public function diary_item_comments()
    {
    	return $this->hasMany('jericho\DiaryItemComment');
    }
    
    public function followup_user()
    {
    	return $this->belongsTo('jericho\User');
    }
    
    public function status()
    {
    	return $this->belongsTo('jericho\DiaryItemStatus');
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
    			'followup_user_id' => array(ModelTypeConstants::USER, array('firstname', 'surname')),
    			'status_id' => array(ModelTypeConstants::DIARY_ITEM_STATUS, array('description'))
    	];
    	$modelTransformAuditor = new ModelTransformAuditor();
    	$data = $modelTransformAuditor->audit($data, $transformations);
    	return $data;
    }
}
