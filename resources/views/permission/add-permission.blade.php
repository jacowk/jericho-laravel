@extends('layouts.master')

@section('title')
	Add Permission
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-permission') }}">Search Permission</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-permission', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			<div class="form-group">
				{{  Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Name')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('roles', 'Roles', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					@if ($roles)
						@foreach($roles as $id => $name)
							{{ Form::checkbox($name['html_name'], $id, null, ['class' => 'field']) }} {{ $name['name'] }}<br>
						@endforeach
					@endif
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Add Permission</button>
				</div>
			</div>
		{{  Form::close() }}
	</div>
@endsection