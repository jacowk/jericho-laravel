<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
    
    public function roles()
    {
    	return $this->belongsToMany('jericho\Role');
    }
    
    public function allocated_diary_items()
    {
    	return $this->hasMany('jericho\DiaryItem', 'allocated_user_id');
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
}
