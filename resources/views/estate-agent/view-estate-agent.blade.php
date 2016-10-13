@extends('layouts.master')

@section('title')
	View Estate Agent
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-estate-agent') }}">Search Estate Agent</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $estate_agent->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Name</th>
					<td>{{ $estate_agent->name }}</td>						
				</tr>
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{ Form::open(array('route' => 'search-estate-agent', 'class' => 'form-horizontal')) }}
					{{ Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Back to Search Estate Agent</button>
						</div>
					</div>
				{{ Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ESTATE_AGENT))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-estate-agent', $estate_agent->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-default">Update Estate Agent</button>
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
	
	@section('contact-list-title')
		Estate Agent Contacts
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