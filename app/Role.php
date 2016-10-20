<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	use Auditable;
	
	protected $fillable = ['name'];
	
	public function permissions()
	{
		return $this->belongsToMany('jericho\Permission');
	}
	
	public function users()
	{
		return $this->belongsToMany('jericho\User');
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
