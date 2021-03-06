@extends('layouts.master')

@section('title')
	Search Suburbs
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-suburb', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				
				<div class="form-group">
					{{ Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('name', $name, array('class' => 'form-control', 'placeholder' => 'Name')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('box_code', 'Box Code', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('box_code', $box_code, array('class' => 'form-control', 'placeholder' => 'Box Code')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('street_code', 'Street Code', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('street_code', $street_code, array('class' => 'form-control', 'placeholder' => 'Street Code')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('area_id', 'Area', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						{{ Form::select('area_id', $areas, $area_id, array('class' => 'form-control')) }}
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
				@if (!empty($suburbs) && count($suburbs) > 0)
					<h4 class="panel-title">Suburbs Search Result ({{ $suburbs->total() }} items found)</h4>
				@else
					<h4 class="panel-title">Suburbs Search Result</h4>
				@endif
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-3 text-center">Name</th>
						<th class="col-sm-2 text-center">Box Code</th>
						<th class="col-sm-2 text-center">Street Code</th>
						<th class="col-sm-2 text-center">Area</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_SUBURB))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($suburbs) && count($suburbs) > 0)
						@foreach($suburbs as $suburb)
						<tr>
							<td>{{ $suburb->id }}</td>
							<td>{{ $suburb->name }}</td>
							<td>{{ $suburb->box_code }}</td>
							<td>{{ $suburb->street_code }}</td>
							<td>{{ $suburb->area->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_SUBURB))
								<td><a href="{{ route('update-suburb', ['suburb_id' => $suburb->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-suburb', ['suburb_id' => $suburb->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="7">No suburbs</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($suburbs) && count($suburbs) > 0)
					@if ($suburbs->hasMorePages())
						{{ 
							$suburbs
								->appends([
									'name' => $name,
									'box_code' => $box_code,
									'street_code' => $street_code,
									'area_id' => $area_id
								])
								->render() 
						}}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $suburbs->appends(['name' => $name, 'box_code' => $box_code, 'street_code' => $street_code, 'area_id' => $area_id])->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@if ($suburbs->lastPage() > 10)
								@for ($i = 1; $i <= 5; $i++)
									<li class="{{ ($suburbs->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $suburbs->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
								<li><span>...</span></li>
								<li><a href="{{ $suburbs->appends(['name' => $name, 'box_code' => $box_code, 'street_code' => $street_code, 'area_id' => $area_id])->url($suburbs->lastPage() - 1) }}"><span>{{ $suburbs->lastPage() - 1 }}</span></a></li>
								<li><a href="{{ $suburbs->appends(['name' => $name, 'box_code' => $box_code, 'street_code' => $street_code, 'area_id' => $area_id])->url($suburbs->lastPage()) }}"><span>{{ $suburbs->lastPage() }}</span></a></li>
							@else
								@for ($i = 1; $i <= $suburbs->lastPage(); $i++)
									<li class="{{ ($suburbs->currentPage() == $i) ? ' active' : '' }}">
										<a href="{{ $suburbs->url($i) }}"><span>{{ $i }}</span></a>
									</li>
								@endfor
							@endif
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_SUBURB))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-suburb')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Suburb', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
