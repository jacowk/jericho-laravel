@extends('layouts.master')

@section('title')
	View Attorney
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-attorney') }}">Search Attorney</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $attorney->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Name</th>
					<td>{{ $attorney->name }}</td>						
				</tr>
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
					<tr>
						<th class="col-sm-3 text-right">Created By</th>
						<td>
							@if ($attorney->created_by)
								{{ $attorney->created_by->firstname }} {{ $attorney->created_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Created At</th>
						<td>{{ $attorney->created_at }}</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated By</th>
						<td>
							@if ($attorney->updated_by)
								{{ $attorney->updated_by->firstname }} {{ $attorney->updated_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated At</th>
						<td>{{ $attorney->updated_at }}</td>						
					</tr>
				@endif
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => 'search-attorney', 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Back to Search Attorney</button>
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ATTORNEY))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-attorney', $attorney->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-default">Update Attorney</button>
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
	
	
	@section('contact-list-title')
		Attorney Contacts
	@endsection
	
	@include('contact.list-contacts')
	
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_CONTACT))
		<div class="container">
			<div class="row">
				{{  Form::open(array('route' => 'add-contact')) }}
					{{  Form::token() }}
					{{  Form::hidden('model_name', $model_name) }}
					{{  Form::hidden('model_id', $model_id) }}
					<button type="submit" class="btn btn-default">Add Contact</button>
				{{  Form::close() }}
			</div>
		</div>
	@endif
@endsection