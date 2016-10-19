<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Diary Item Comments</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">ID</th>
					<th class="col-sm-7 text-center">Comment</th>
					<th class="col-sm-2 text-center">Date Created</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_DIARY_ITEM_COMMENT))
						<th class="col-sm-1 text-center">Update</th>
					@endif
					<th class="col-sm-1 text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if (!empty($diary_item->diary_item_comments) && count($diary_item->diary_item_comments) > 0)
					@foreach($diary_item->diary_item_comments as $diary_item_comment)
					<tr>
						<td>{{ $diary_item_comment->id }}</td>
						<td>{{ $diary_item_comment->comment }}</td>
						<td>{{ $diary_item_comment->created_at }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_DIARY_ITEM_COMMENT))
							<td><a href="{{ route('update-diary-item-comment', ['diary_item_comment_id' => $diary_item_comment->id]) }}">Update</a></td>
						@endif
						<td><a href="{{ route('view-diary-item-comment', ['diary_item_comment_id' => $diary_item_comment->id]) }}">View</a></td>
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
@if (PermissionValidator::hasPermission(PermissionConstants::ADD_DIARY_ITEM_COMMENT))
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => array('add-diary-item-comment', $diary_item->id))) }}
				{{ Form::token() }}
				{{ Form::submit('Add Diary Item Comment', array('class' => 'btn btn-default')) }}
			{{ Form::close() }}
		</div>
	</div>
@endif