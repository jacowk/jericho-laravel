@extends('layouts.master')

@section('title')
	View Contractor Service
@endsection

@section('breadcrumb')
<ol class="breadcrumb">
	<li class="breadcrumb-item active"><a href="{{ route('view-contractor', $contractor_service->contractor->id) }}">View Contractor</a></li>
</ol>
@endsection

@section('content')
	<div class="container">
		<div class="form-group">
			<table class="table table-bordered table-striped table-condensed">
				<tr>
					<th class="col-sm-3 text-right">ID</th>
					<td>{{ $contractor_service->id }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Contractor Service Type</th>
					<td>{{ $contractor_service->contractor_type->description }}</td>						
				</tr>
				<tr>
					<th class="col-sm-3 text-right">Service Description</th>
					<td>{{ $contractor_service->service_description }}</td>						
				</tr>
			</table>
		</div>
		<div class="form-inline">
			<div class="form-group">
				{{  Form::open(array('route' => array('view-contractor', $contractor_service->contractor->id), 'class' => 'form-horizontal')) }}
					{{  Form::token() }}
					<div class="form-group">
						<div class="col-sm-10">
							<button type="submit" class="btn btn-default">Back to View Contractor</button>
						</div>
					</div>
				{{  Form::close() }}
			</div>
			@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTRACTOR_SERVICE))
				<div class="form-group">
					{{  Form::open(array('route' => array('update-contractor-service', $contractor_service->id), 'class' => 'form-horizontal')) }}
						{{  Form::token() }}
						<div class="form-group">
							<div class="col-sm-10">
								<button type="submit" class="btn btn-default">Update Contractor Service</button>
							</div>
						</div>
					{{  Form::close() }}
				</div>
			@endif
		</div>
	</div>
@endsection