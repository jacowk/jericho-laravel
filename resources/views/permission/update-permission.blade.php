@extends('layouts.master')

@section('title')
	Update Permission
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-permission') }}">Search Permission</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-permission', $permission->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $permission->id }}</p>
				</div>
			</div>
			
			<div class="form-group">	
				{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('name', $permission->name, array('class' => 'form-control', 'placeholder' => 'Name')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('roles', 'Roles', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					@if ($roles)
						@foreach($roles as $id => $role)
							{{ Form::checkbox($role['html_name'], $id, $role['role_selected'], ['class' => 'field']) }} {{ $role['name'] }}<br>
						@endforeach
					@endif
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Update Permission', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection