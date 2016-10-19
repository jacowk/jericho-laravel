@extends('layouts.master')

@section('title')
	View Issue Comment
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-issue', $issue_comment->issue->id) }}">View Issue</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $issue_comment->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Comment</th>
					<td>{{ $issue_comment->comment }}</td>						
				</tr>
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
					<tr>
						<th class="col-sm-3 text-right">Created By</th>
						<td>
							@if ($issue_comment->created_by)
								{{ $issue_comment->created_by->firstname }} {{ $issue_comment->created_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Created At</th>
						<td>{{ $issue_comment->created_at }}</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated By</th>
						<td>
							@if ($issue_comment->updated_by)
								{{ $issue_comment->updated_by->firstname }} {{ $issue_comment->updated_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated At</th>
						<td>{{ $issue_comment->updated_at }}</td>						
					</tr>
				@endif
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => array('view-issue', $issue_comment->issue->id), 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							{{ Form::submit('Back to View Issue', array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ISSUE_COMMENT))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-issue-comment', $issue_comment->id), 'class' => 'form-horizontal')) }}
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
@endsection