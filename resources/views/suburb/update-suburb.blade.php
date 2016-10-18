@extends('layouts.master')

@section('title')
	Update Suburb
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-suburb') }}">Search Suburb</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-suburb', $suburb->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $suburb->id }}</p>
				</div>
			</div>
			
			<div class="form-group">	
				{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('name', $suburb->name, array('class' => 'form-control', 'placeholder' => 'Name')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('box_code', 'Box Code', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('box_code', $suburb->box_code, array('class' => 'form-control', 'placeholder' => 'Box Code')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('street_code', 'Street Code', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('street_code', $suburb->street_code, array('class' => 'form-control', 'placeholder' => 'Street Code')) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('area', 'Area', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('area_id', $areas, $suburb->area_id, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Update Suburb', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection