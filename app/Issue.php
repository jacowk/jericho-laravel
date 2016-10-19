<?php

namespace jericho;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;

/**
 * This model forms part of the issue tracker, for creating issues
 * 
 * @author Jaco Koekemoer
 * Date: 2016-10-19
 *
 */
class Issue extends Model
{
	use Auditable;
	
	public function assigned_to()
	{
		return $this->belongsTo('jericho\User', 'assigned_to_id');
	}
	
	public function issue_component()
	{
		return $this->belongsTo('jericho\LookupIssueComponent', 'lookup_issue_component_id');
	}
	
	public function issue_category()
	{
		return $this->belongsTo('jericho\LookupIssueCategory', 'lookup_issue_category_id');
	}
	
	public function issue_severity()
	{
		return $this->belongsTo('jericho\LookupIssueSeverity', 'lookup_issue_severity_id');
	}
	
	public function issue_status()
	{
		return $this->belongsTo('jericho\IssueStatus', 'issue_status_id');
	}
	
	public function issue_comments()
	{
		return $this->hasMany('jericho\IssueComment');
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
