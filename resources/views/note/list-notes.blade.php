<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Notes</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">ID</th>
					<th class="col-sm-7 text-center">Description</th>
					<th class="col-sm-2 text-center">Date Created</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_NOTE))
						<th class="col-sm-1 text-center">Update</th>
					@endif
					<th class="col-sm-1 text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if (!empty($property_flip->notes) && count($property_flip->notes) > 0)
					@foreach($property_flip->notes as $note)
					<tr>
						<td>{{ $note->id }}</td>
						<td>{{ $note->description }}</td>
						<td>{{ $note->created_at }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_NOTE))
							<td><a href="{{ route('update-note', ['note_id' => $note->id]) }}">Update</a></td>
						@endif
						<td><a id="view-note" href="{{ route('view-note', ['note_id' => $note->id]) }}">View</a></td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="5">No notes</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
@if (PermissionValidator::hasPermission(PermissionConstants::ADD_NOTE))
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => array('add-note', $property_flip->id))) }}
				{{ Form::token() }}
				{{ Form::submit('Add Note', array('class' => 'btn btn-default')) }}
			{{ Form::close() }}
		</div>
	</div>
@endif