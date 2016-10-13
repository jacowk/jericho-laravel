@extends('layouts.master')

@section('title')
	Search Contacts
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-contact', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('firstname', 'Firstname', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('firstname', '', array('class' => 'form-control', 'placeholder' => 'Firstname')) }}
					</div>
				</div>
				<div class="form-group">
					{{ Form::label('surname', 'Surname', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::text('surname', '', array('class' => 'form-control', 'placeholder' => 'Surname')) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10"> 
						<button type="submit" class="btn btn-default">Search</button>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div><br/>
	
	@section('contact-list-title')
		Contacts Search Result
	@endsection
	
	@include('contact.list-contacts')
	
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_CONTACT))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-contact')) }}
					{{ Form::token() }}
					{{  Form::hidden('model_name', 'none') }}
					{{  Form::hidden('model_id', '0') }}
					<button type="submit" class="btn btn-default">Add Contact</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
