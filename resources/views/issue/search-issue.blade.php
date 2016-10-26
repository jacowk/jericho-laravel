@extends('layouts.master')

@section('title')
	Search Issues
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-issue', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				
				<div class="form-group">
					{{ Form::label('id', 'ID', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::text('id', $id, array('class' => 'form-control', 'placeholder' => 'ID')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{  Form::label('created_by_id', 'Created By', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::select('created_by_id', $users, $created_by_id, ['class' => 'form-control']) }}
					</div>
				</div>
				
				<div class="form-group">
					{{  Form::label('assigned_to_id', 'Assigned To', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::select('assigned_to_id', $users, $assigned_to_id, ['class' => 'form-control']) }}
					</div>
				</div>
				
				<div class="form-group">
					{{  Form::label('issue_status_id', 'Status', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::select('issue_status_id', $issue_statuses, $issue_status_id, ['class' => 'form-control']) }}
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10"> 
						{{ Form::submit('Search', array('class' => 'btn btn-default')) }}
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div><br/>
	<div class="container">
		<div class="row">
			<div class="panel-heading text-center">
				@if (!empty($issues) && count($issues) > 0)
					<h4 class="panel-title">Issues Search Result ({{ $issues->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Issues Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-1 text-center">Created By</th>
						<th class="col-sm-1 text-center">Assigned To</th>
						<th class="col-sm-1 text-center">Component</th>
						<th class="col-sm-1 text-center">Status</th>
						<th class="col-sm-5 text-center">Description</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ISSUE))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($issues) && count($issues) > 0)
						@foreach($issues as $issue)
						<tr>
							<td>{{ $issue->id }}</td>
							<td>
								@if ($issue->created_by)
									{{ $issue->created_by->firstname }} {{ $issue->created_by->surname }}
								@endif
							</td>
							<td>
								@if ($issue->assigned_to)
									{{ $issue->assigned_to->firstname }} {{ $issue->assigned_to->surname }}
								@endif
							</td>
							<td>
								@if ($issue->issue_component)
									{{ $issue->issue_component->description }}
								@endif
							</td>
							<td>
								@if ($issue->issue_status)
									{{ $issue->issue_status->description }}
								@endif
							</td>
							<td>{{ $issue->description }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ISSUE))
								<td><a href="{{ route('update-issue', ['issue_id' => $issue->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-issue', ['issue_id' => $issue->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="8">No issues</td>
						</tr>
					@endif
				</tbody>
			</table>
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($issues) && count($issues) > 0)
					@if ($issues->hasMorePages())
						{{ $issues->appends(['id' => $id, 'created_by_id' => $created_by_id, 'assigned_to_id' => $assigned_to_id, 'issue_status_id' => $issue_status_id])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $issues->appends(['id' => $id, 'created_by_id' => $created_by_id, 'assigned_to_id' => $assigned_to_id, 'issue_status_id' => $issue_status_id])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($issues->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($issues->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $issues->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $issues->appends(['id' => $id, 'created_by_id' => $created_by_id, 'assigned_to_id' => $assigned_to_id, 'issue_status_id' => $issue_status_id])->url($issues->lastPage() - 1) }}"><span>{{ $issues->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $issues->appends(['id' => $id, 'created_by_id' => $created_by_id, 'assigned_to_id' => $assigned_to_id, 'issue_status_id' => $issue_status_id])->url($issues->lastPage()) }}"><span>{{ $issues->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $issues->lastPage(); $i++)
									<li class="{{ ($issues->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $issues->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_ISSUE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-issue')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Issue', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
