@extends('layouts.master')

@section('title')
	Search Contractors
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-contractor', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('name', $name, array('class' => 'form-control', 'placeholder' => 'Name')) }}
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
				@if (!empty($contractors) && count($contractors) > 0)
					<h4 class="panel-title">Contractors Search Result ({{ $contractors->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Contractors Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Name</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTRACTOR))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($contractors) && count($contractors) > 0)
						@foreach($contractors as $contractor)
						<tr>
							<td>{{ $contractor->id }}</td>
							<td>{{ $contractor->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_CONTRACTOR))
								<td><a href="{{ route('update-contractor', ['contractor_id' => $contractor->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-contractor', ['contractor_id' => $contractor->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No contractors</td>
						</tr>
					@endif
				</tbody>
			</table>
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($contractors) && count($contractors) > 0)
					@if ($contractors->hasMorePages())
						{{ $contractors->appends(['name' => $name])->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $contractors->appends(['name' => $name])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($contractors->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($contractors->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $contractors->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $contractors->appends(['name' => $name])->url($contractors->lastPage() - 1) }}"><span>{{ $contractors->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $contractors->appends(['name' => $name])->url($contractors->lastPage()) }}"><span>{{ $contractors->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $contractors->lastPage(); $i++)
									<li class="{{ ($contractors->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $contractors->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_CONTRACTOR))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-contractor')) }}
					{{ csrf_field() }}
					{{ Form::submit('Add Contractor', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
