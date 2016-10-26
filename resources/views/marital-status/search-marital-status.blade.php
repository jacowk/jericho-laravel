@extends('layouts.master')

@section('title')
	Search Marital Statuses
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-marital-status', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('description', 'Description', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('description', $description, array('class' => 'form-control', 'placeholder' => 'Description')) }}
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
				@if (!empty($marital_statuses) && count($marital_statuses) > 0)
					<h4 class="panel-title">Marital Statuses Search Result ({{ $marital_statuses->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Marital Statuses Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Description</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_MARITAL_STATUS))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($marital_statuses) && count($marital_statuses) > 0)
						@foreach($marital_statuses as $marital_status)
						<tr>
							<td>{{ $marital_status->id }}</td>
							<td>{{ $marital_status->description }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_MARITAL_STATUS))
								<td><a href="{{ route('update-marital-status', ['marital_status_id' => $marital_status->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-marital-status', ['marital_status_id' => $marital_status->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No marital statuses</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($marital_statuses) && count($marital_statuses) > 0)
					@if ($marital_statuses->hasMorePages())
						{{ $marital_statuses->appends(['description' => $description])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $marital_statuses->appends(['description' => $description])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($marital_statuses->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($marital_statuses->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $marital_statuses->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $marital_statuses->appends(['description' => $description])->url($marital_statuses->lastPage() - 1) }}"><span>{{ $marital_statuses->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $marital_statuses->appends(['description' => $description])->url($marital_statuses->lastPage()) }}"><span>{{ $marital_statuses->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $marital_statuses->lastPage(); $i++)
									<li class="{{ ($marital_statuses->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $marital_statuses->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_MARITAL_STATUS))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-marital-status')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Marital Status', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
