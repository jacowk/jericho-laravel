@extends('layouts.master')

@section('title')
	Add Estate Agent
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-estate-agent') }}">Search Estate Agent</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => 'do-add-estate-agent', 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('name', '', array('class' => 'form-control', 'placeholder' => 'Name')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Add Estate Agent</button>
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection