@extends('layouts.master')

@section('title')
	View Bank
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-bank') }}">Search Bank</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $bank->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Name</th>
					<td>{{ $bank->name }}</td>
				</tr>
				@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_AUDIT_FIELDS))
					<tr>
						<th class="col-sm-3 text-right">Created By</th>
						<td>
							@if ($bank->created_by)
								{{ $bank->created_by->firstname }} {{ $bank->created_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Created At</th>
						<td>{{ $bank->created_at }}</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated By</th>
						<td>
							@if ($bank->updated_by)
								{{ $bank->updated_by->firstname }} {{ $bank->updated_by->surname }}
							@endif
						</td>						
					</tr>
					<tr>
						<th class="col-sm-3 text-right">Updated At</th>
						<td>{{ $bank->updated_at }}</td>						
					</tr>
				@endif
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => 'search-bank', 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							{{ Form::submit('Back to Search Bank', array('class' => 'btn btn-default')) }}
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_BANK))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-bank', $bank->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								{{ Form::submit('Update Bank', array('class' => 'btn btn-default')) }}
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
	
	@section('contact-list-title')
		Bank Contacts
	@endsection
	
	@if (PermissionValidator::hasPermission(PermissionConstants::VIEW_CONTACT))
		@include('contact.list-contacts')
	@endif
	
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_CONTACT))
		<div class="container">
			<div class="row">
				{{  Form::open(array('route' => 'add-contact')) }}
					{{  Form::token() }}
					{{  Form::hidden('model_name', $model_name) }}
					{{  Form::hidden('model_id', $model_id) }}
					{{ Form::submit('Add Contact', array('class' => 'btn btn-default')) }}
				{{  Form::close() }}
			</div>
		</div>
	@endif
@endsection