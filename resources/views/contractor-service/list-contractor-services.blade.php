<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Contractor Services</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">ID</th>
					<th class="col-sm-7 text-center">Service Description</th>
					<th class="col-sm-2 text-center">Contractor Service Type</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTRACTOR_SERVICE))
						<th class="col-sm-1 text-center">Update</th>
					@endif
					<th class="col-sm-1 text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if (!empty($contractor->contractor_services) && count($contractor->contractor_services) > 0)
					@foreach($contractor->contractor_services as $contractor_service)
					<tr>
						<td>{{ $contractor_service->id }}</td>
						<td>{{ $contractor_service->service_description }}</td>
						<td>{{ $contractor_service->contractor_type->description }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTRACTOR_SERVICE))
							<td><a href="{{ route('update-contractor-service', ['contractor_service_id' => $contractor_service->id]) }}">Update</a></td>
						@endif
						<td><a href="{{ route('view-contractor-service', ['contractor_service_id' => $contractor_service->id]) }}">View</a></td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="4">No contractor services</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>

@if (PermissionValidator::hasPermission(PermissionConstants::ADD_CONTRACTOR_SERVICE))
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => array('add-contractor-service', $contractor->id))) }}
				{{ Form::token() }}
				{{ Form::submit('Add Contractor Service', array('class' => 'btn btn-default')) }}
			{{ Form::close() }}
		</div>
	</div>
@endif