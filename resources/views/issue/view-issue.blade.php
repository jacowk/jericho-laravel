@extends('layouts.master')

@section('title')
	View Issue
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-issue') }}">Search Issue</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">Issue ID</th>
					<td>{{ $issue->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Assigned To</th>
					<td>
						@if ($issue->assigned_to)
							{{ $issue->assigned_to->firstname }} {{ $issue->assigned_to->surname }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Component</th>
					<td>
						@if ($issue->issue_component)
							{{ $issue->issue_component->description }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Category</th>
					<td>
						@if ($issue->issue_category)
							{{ $issue->issue_category->description }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Severity</th>
					<td>
						@if ($issue->issue_severity)
							{{ $issue->issue_severity->description }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Status</th>
					<td>
						@if ($issue->issue_status)
							{{ $issue->issue_status->description }}
						@endif
					</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Description</th>
					<td>{{ $issue->description }}</td>						
				</tr>
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
					<tr>
						<th class="col-sm-3 text-right">Created By</th>
						<td>
							@if ($issue->created_by)
								{{ $issue->created_by->firstname }} {{ $issue->created_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Created At</th>
						<td>{{ $issue->created_at }}</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated By</th>
						<td>
							@if ($issue->updated_by)
								{{ $issue->updated_by->firstname }} {{ $issue->updated_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated At</th>
						<td>{{ $issue->updated_at }}</td>						
					</tr>
				@endif
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => 'search-issue', 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							{{ Form::submit('Back to Search Issue', array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ISSUE))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-issue', $issue->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								{{ Form::submit('Update Issue', array('class' => 'btn btn-default')) }}
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
	
	@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_ISSUE_COMMENT))
		@include('issue-comment.list-issue-comments')
	@endif
@endsection