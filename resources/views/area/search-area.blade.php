@extends('layouts.master')

@section('title')
	Search Areas
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-area', 'class' => 'form-horizontal')) }}
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
				@if (!empty($areas) && count($areas) > 0)
					<h4 class="panel-title">Areas Search Result ({{ $areas->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Areas Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Name</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_AREA))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($areas) && count($areas) > 0)
						@foreach($areas as $area)
						<tr>
							<td>{{ $area->id }}</td>
							<td>{{ $area->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_AREA))
								<td><a href="{{ route('update-area', ['area_id' => $area->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-area', ['area_id' => $area->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No areas</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($areas) && count($areas) > 0)
					@if ($areas->hasMorePages())
						{{ 
							$areas
								->appends([
									'name' => $name
								])
								->render() 
						}}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $areas->appends(['name' => $name])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($areas->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($areas->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $areas->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $areas->appends(['name' => $name])->url($areas->lastPage() - 1) }}"><span>{{ $areas->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $areas->appends(['name' => $name])->url($areas->lastPage()) }}"><span>{{ $areas->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $areas->lastPage(); $i++)
									<li class="{{ ($areas->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $areas->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_AREA))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-area')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Area', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
