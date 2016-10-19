<div class="container">
	<div class="row">
		<div class="panel-heading text-center">
			<h4 class="panel-title">Issue Comments</h4>
		</div>
	</div>
	<div class="row">
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th class="col-sm-1 text-center">ID</th>
					<th class="col-sm-7 text-center">Comment</th>
					<th class="col-sm-2 text-center">Date Created</th>
					@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ISSUE_COMMENT))
						<th class="col-sm-1 text-center">Update</th>
					@endif
					<th class="col-sm-1 text-center">View</th>
				</tr>
			</thead>
			<tbody>
				@if (!empty($issue->issue_comments) && count($issue->issue_comments) > 0)
					@foreach($issue->issue_comments as $issue_comment)
					<tr>
						<td>{{ $issue_comment->id }}</td>
						<td>{{ $issue_comment->comment }}</td>
						<td>{{ $issue_comment->created_at }}</td>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ISSUE_COMMENT))
							<td><a href="{{ route('update-issue-comment', ['issue_comment_id' => $issue_comment->id]) }}">Update</a></td>
						@endif
						<td><a href="{{ route('view-issue-comment', ['issue_comment_id' => $issue_comment->id]) }}">View</a></td>
					</tr>
					@endforeach
				@else
					<tr>
						<td colspan="5">No issue comments</td>
					</tr>
				@endif
			</tbody>
		</table>
	</div>
</div>
@if (PermissionValidator::hasPermission(PermissionConstants::ADD_ISSUE_COMMENT))
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => array('add-issue-comment', $issue->id))) }}
				{{ Form::token() }}
				{{ Form::submit('Add Issue Comment', array('class' => 'btn btn-default')) }}
			{{ Form::close() }}
		</div>
	</div>
@endif