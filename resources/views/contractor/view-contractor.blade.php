@extends('layouts.master')

@section('title')
	View Contractor
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-contractor') }}">Search Contractor</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $contractor->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Name</th>
					<td>{{ $contractor->name }}</td>
				</tr>
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
					<tr>
						<th class="col-sm-3 text-right">Created By</th>
						<td>
							@if ($contractor->created_by)
								{{ $contractor->created_by->firstname }} {{ $contractor->created_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Created At</th>
						<td>{{ $contractor->created_at }}</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated By</th>
						<td>
							@if ($contractor->updated_by)
								{{ $contractor->updated_by->firstname }} {{ $contractor->updated_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated At</th>
						<td>{{ $contractor->updated_at }}</td>
					</tr>
				@endif
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{ Form::open(array('route' => 'search-contractor', 'class' => 'form-horizontal')) }}
					{{ Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							{{ Form::submit('Back to Search Contractor', array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{ Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTRACTOR))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-contractor', $contractor->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								{{ Form::submit('Update Contractor', array('class' => 'btn btn-default')) }}
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
	
	@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTRACTOR_SERVICE))
		@include('contractor-service.list-contractor-services')
	@endif
	
	@section('contact-list-title')
		Contractor Contacts
	@endsection
	
	@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT))
		@include('contact.list-contacts')
	@endif
	
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_CONTACT))
		<div class="container">
			<div class="row">
				{{  Form::open(array('route' => 'add-contact')) }}
					{{ Form::token() }}
					{{ Form::hidden('model_name', $model_name) }}
					{{ Form::hidden('model_id', $model_id) }}
					{{ Form::submit('Add Contact', array('class' => 'btn btn-default')) }}
				{{  Form::close() }}
			</div>
		</div>
	@endif
@endsection