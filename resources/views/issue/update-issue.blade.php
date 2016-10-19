@extends('layouts.master')

@section('title')
	Update Issue
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-issue') }}">Search Issue</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-issue', $issue->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			
			<div class="form-group">
				{{  Form::label('assigned_to_id', 'Assign To', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('assigned_to_id', $users, $issue->assigned_to_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('lookup_issue_component_id', 'Component', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('lookup_issue_component_id', $issue_components, $issue->lookup_issue_component_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('lookup_issue_category_id', 'Category', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('lookup_issue_category_id', $issue_categories, $issue->lookup_issue_category_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('lookup_issue_severity_id', 'Severity', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('lookup_issue_severity_id', $issue_severity_list, $issue->lookup_issue_severity_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('issue_status_id', 'Status', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('issue_status_id', $issue_statuses, $issue->issue_status_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::textarea('description', $issue->description, array('class' => 'form-control', 'placeholder' => 'Description')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Update Issue', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection