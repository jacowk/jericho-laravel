<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Arr;
use jericho\Audits\Model\ModelTransformAuditor;
use jericho\Util\ModelTypeConstants;

/**
 * A model representing a user
 *
 * @author Jaco Koekemoer
 *
 */
class User extends Authenticatable
{
    use Notifiable;
    use Auditable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'surname', 'email', 'password', 'pagination_size', 'created_by_id', 'updated_by_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * Exclude the following properties from being audited by Auditable
     * 
     * @var array
     */
    protected $dontKeepAuditOf = ['remember_token', 'password'];
    
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
    
    public function roles()
    {
    	return $this->belongsToMany('jericho\Role');
    }
    
    public function followup_diary_items()
    {
    	return $this->hasMany('jericho\DiaryItem', 'followup_user_id');
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
    			'updated_by_id' => array(ModelTypeConstants::USER, array('firstname', 'surname'))
    	];
    	$modelTransformAuditor = new ModelTransformAuditor();
    	$data = $modelTransformAuditor->audit($data, $transformations);
    	return $data;
    }
}
