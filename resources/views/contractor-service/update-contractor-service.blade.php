@extends('layouts.master')

@section('title')
	Update Contractor Service
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-contractor', $contractor_service->contractor->id) }}">View Contractor</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		{{ Form::open(array('route' => array('do-update-contractor-service', $contractor_service->id), 'class' => 'form-horizontal')) }}
			{{ Form::token() }}
			<div class="form-group">
			
				<div class="form-group">
					{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						<p>{{ $contractor_service->id }}</p>
					</div>
				</div>
				
				<div class="form-group">
					{{  Form::label('contractor_type_id', 'Contractor Service Type', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::select('contractor_type_id', $contractor_types, $contractor_service->contractor_type_id, ['class' => 'form-control']) }}
					</div>
				</div>
				
				<div class="form-group">
					{{  Form::label('service_description', 'Service Description', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{  Form::textarea('service_description', $contractor_service->service_description, array('class' => 'form-control', 'placeholder' => 'Service Description')) }}
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Update Contractor Service</button>
				</div>
			</div>
		{{ Form::close() }}
	</div>
@endsection