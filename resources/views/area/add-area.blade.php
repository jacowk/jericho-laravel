@extends('layouts.master')

@section('title')
	Add Area
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-area') }}">Search Area</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-area', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			<div class="form-group">
				{{  Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::text('name', '', array('class' => 'form-control captialize', 'placeholder' => 'Name')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					{{ Form::submit('Add Area', array('class' => 'btn btn-default')) }}
				</div>
			</div>
		{{  Form::close() }}
	</div>
@endsection