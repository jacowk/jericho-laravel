@extends('layouts.master')

@section('title')
	Update Greater Area
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-greater-area') }}">Search Greater Area</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => array('do-update-greater-area', $greater_area->id), 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			<div class="form-group">
				{{  Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $greater_area->id }}</p>
				</div>
				{{  Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('name', $greater_area->name, array('class' => 'form-control', 'placeholder' => 'Name')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Update Greater Area</button>
				</div>
			</div>
		{{  Form::close() }}
	</div>
@endsection