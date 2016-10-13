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
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{ Form::open(array('route' => 'search-contractor', 'class' => 'form-horizontal')) }}
					{{ Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Back to Search Contractor</button>
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
								<button type="submit" class="btn btn-default">Update Contractor</button>
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
	
	@include('contractor-service.list-contractor-services')
	
	@section('contact-list-title')
		Contractor Contacts
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