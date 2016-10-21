<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Milestones</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">ID</th>
					<th class="col-sm-5 text-center">Milestone Type</th>
					<th class="col-sm-2 text-center">Effective Date</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_MILESTONE))
						<th class="col-sm-1 text-center">Update</th>
					@endif
					<th class="col-sm-1 text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if (!empty($property_flip->milestones) && count($property_flip->milestones) > 0)
					@foreach($property_flip->milestones as $milestone)
					<tr>
						<td>{{ $milestone->id }}</td>
						<td>
							@if ($milestone->lookup_milestone_type)
								{{ $milestone->lookup_milestone_type->description }}
							@else
								No Description
							@endif
						</td>
						<td>{{ $milestone->effective_date }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_MILESTONE))
							<td><a href="{{ route('update-milestone', ['milestone_id' => $milestone->id]) }}">Update</a></td>
						@endif
						<td><a href="{{ route('view-milestone', ['milestone_id' => $milestone->id]) }}">View</a></td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="5">No milestones</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
@if (PermissionValidator::hasPermission(PermissionConstants::ADD_MILESTONE))
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => array('add-milestone', $property_flip->id))) }}
				{{ Form::token() }}
				{{ Form::submit('Add Milestone', array('class' => 'btn btn-default')) }}
			{{ Form::close() }}
		</div>
	</div>
@endif