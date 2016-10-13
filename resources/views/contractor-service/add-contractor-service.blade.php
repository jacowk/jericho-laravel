@extends('layouts.master')

@section('title')
	Add Contractor Service
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-contractor', $contractor_id) }}">View Contractor</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{  Form::open(array('route' => 'do-add-contractor-service', 'class' => 'form-horizontal')) }}
			{{  Form::token() }}
			{{  Form::hidden('contractor_id', $contractor_id) }}
			
			<div class="form-group">
				{{  Form::label('contractor_type_id', 'Contractor Service Type', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{ Form::select('contractor_type_id', $contractor_types, null, ['class' => 'form-control']) }}
				</div>
			</div>
			
			<div class="form-group">
				{{  Form::label('service_description', 'Service Description', array('class' => 'col-sm-2 control-label')) }}
				<div class="col-sm-10">
					{{  Form::textarea('service_description', '', array('class' => 'form-control', 'placeholder' => 'Service Description')) }}
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Add Contractor Service</button>
				</div>
			</div>
		{{  Form::close() }}
	</div>
@endsection