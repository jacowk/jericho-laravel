@extends('layouts.master')

@section('title')
	Search Properties
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-property', 'class' => 'form-horizontal')) }}
				{{ Form::token() }}
				
				<div class="form-group">
					{{ Form::label('reference_number', 'Reference Number', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('reference_number', $reference_number, array('class' => 'form-control', 'placeholder' => 'Reference Number')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('address', 'Address', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('address', $address, array('class' => 'form-control', 'placeholder' => 'Address')) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('suburb_id', 'Suburb', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::select('suburb_id', $suburbs, $suburb_id, ['class' => 'form-control']) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('area_id', 'Area', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::select('area_id', $areas, $area_id, ['class' => 'form-control']) }}
					</div>
				</div>
				
				<div class="form-group">
					{{ Form::label('greater_area_id', 'Greater Area', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::select('greater_area_id', $greater_areas, $greater_area_id, ['class' => 'form-control']) }}
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
				<h4 class="panel-title">Properties Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-2 text-center">Address</th>
						<th class="col-sm-2 text-center">Suburb</th>
						<th class="col-sm-2 text-center">Area</th>
						<th class="col-sm-2 text-center">Greater Area</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PROPERTY))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($properties) && count($properties) > 0)
						@foreach($properties as $property)
						<tr>
							<td>{{ $property->id }}</td>
							<td>
								{{ $property->address_line_1 }}<br>
								{{ $property->address_line_2 }}<br>
								{{ $property->address_line_3 }}<br>
								{{ $property->address_line_4 }}<br>
								{{ $property->address_line_5 }}<br>
							</td>
							<td>{{ $property->suburb_name }}</td>
							<td>{{ $property->area_name }}</td>
							<td>{{ $property->greater_area_name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PROPERTY))
								<td><a href="{{ route('update-property', ['property_id' => $property->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-property', ['property_id' => $property->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="7">No properties</td>
						</tr>
					@endif
				</tbody>
			</table>
			
			<!-- Pagination -->
			<div class="text-center">
				@if (!empty($properties) && count($properties) > 0)
					@if ($properties->hasMorePages())
						{{ $properties->render() }}<br/>
					@else
						<ul class="pagination">
							<li><a href="{{ $properties->previousPageUrl() }}" rel="prev">&laquo;</a></li>
							@for ($i = 1; $i <= $properties->lastPage(); $i++)
								<li class="{{ ($properties->currentPage() == $i) ? ' active' : '' }}">
									<a href="{{ $properties->url($i) }}"><span>{{ $i }}</span></a>
								</li>
							@endfor
						</ul>
					@endif
				@endif
			</div>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_PROPERTY))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-property')) }}
					{{ Form::token() }}
					{{ Form::submit('Add Property', array('class' => 'btn btn-default')) }}
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
