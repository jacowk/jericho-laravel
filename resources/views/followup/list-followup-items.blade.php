<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Followup Items</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">ID</th>
					<th class="col-sm-7 text-center">Comments</th>
					<th class="col-sm-2 text-center">Date Created</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_FOLLOWUP_ITEM))
						<th class="col-sm-1 text-center">Update</th>
					@endif
					<th class="col-sm-1 text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if (!empty($diary_item->followup_items) && count($diary_item->followup_items) > 0)
					@foreach($diary_item->followup_items as $followup_item)
					<tr>
						<td>{{ $followup_item->id }}</td>
						<td>{{ $followup_item->comments }}</td>
						<td>{{ $followup_item->created_at }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_FOLLOWUP_ITEM))
							<td><a id="update-followup-item" href="{{ route('update-followup-item', ['followup_item_id' => $followup_item->id]) }}">Update</a></td>
						@endif
						<td><a id="view-followup-item" href="{{ route('view-followup-item', ['followup_item_id' => $followup_item->id]) }}">View</a></td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="5">No followups</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
@if (PermissionValidator::hasPermission(PermissionConstants::ADD_FOLLOWUP_ITEM))
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => array('add-followup-item', $diary_item->id))) }}
				{{ Form::token() }}
				{{ Form::submit('Add Followup Item', array('class' => 'btn btn-default')) }}
			{{ Form::close() }}
		</div>
	</div>
@endif