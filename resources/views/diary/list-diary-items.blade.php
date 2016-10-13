<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Diary Items</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">ID</th>
					<th class="col-sm-1 text-center">Followup Date</th>
					<th class="col-sm-1 text-center">Followup User</th>
					<th class="col-sm-6 text-center">Comment</th>
					<th class="col-sm-1 text-center">Status</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_DIARY_ITEM))
						<th class="col-sm-1 text-center">Update</th>
					@endif
					<th class="col-sm-1 text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if (!empty($property_flip->diary_items) && count($property_flip->diary_items) > 0)
					@foreach($property_flip->diary_items as $diary_item)
					<tr>
						<td>{{ $diary_item->id }}</td>
						<td>{{ $diary_item->followup_date }}</td>
						<td>{{ $diary_item->followup_user_id }}</td>
						<td>{{ $diary_item->comments }}</td>
						<td>Status</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_DIARY_ITEM))
							<td><a href="{{ route('update-diary-item', ['diary_item_id' => $diary_item->id]) }}">Update</a></td>
						@endif
						<td><a href="{{ route('view-diary-item', ['diary_item_id' => $diary_item->id]) }}">View</a></td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="7">No diary items</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
@if (PermissionValidator::hasPermission(PermissionConstants::ADD_DIARY_ITEM))
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => array('add-diary-item', $property_flip->id), 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<button type="submit" class="btn btn-default">Add Diary Item</button>
			{{ Form::close() }}
		</div>
	</div>
@endif