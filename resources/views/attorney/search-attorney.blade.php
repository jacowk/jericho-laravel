@extends('layouts.master')

@section('title')
	Search Attorneys
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-attorney', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				<div class="form-group">
					<label class="control-label col-sm-2" for="name">Name:</label>
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
				<h4 class="panel-title">Attorneys Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Name</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ATTORNEY))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($attorneys) && count($attorneys) > 0)
						@foreach($attorneys as $attorney)
						<tr>
							<td>{{ $attorney->id }}</td>
							<td>{{ $attorney->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ATTORNEY))
								<td><a href="{{ route('update-attorney', ['attorney_id' => $attorney->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-attorney', ['attorney_id' => $attorney->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No attorneys</td>
						</tr>
					@endif
				</tbody>
			</table>
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($attorneys) && count($attorneys) > 0)
					@if ($attorneys->hasMorePages())
						{{ $attorneys->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $attorneys->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@for ($i = 1; $i <= $attorneys->lastPage(); $i++)
								<li class="{{ ($attorneys->currentPage() == $i) ? ' active' : '' }}">
									<a href="{{ $attorneys->url($i) }}"><span>{{ $i }}</span></a>
								</li>
							@endfor
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_ATTORNEY))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-attorney')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Attorney', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
