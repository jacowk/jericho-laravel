@extends('layouts.master')

@section('title')
	Update Milestone Type
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('search-milestone-type') }}">Search Milestone Type</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-milestone-type', $milestone_type->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
				{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					<p>{{ $milestone_type->id }}</p>
				</div>
				{{ Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::text('description', $milestone_type->description, array('class' => 'form-control', 'placeholder' => 'Description')) }}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Update Milestone Type</button>
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection