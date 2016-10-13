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
					{{ Form::label('name', 'Address', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10"> 
						{{ Form::text('address', '', array('class' => 'form-control', 'placeholder' => 'Address')) }}
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10"> 
						<button type="submit" class="btn btn-default">Search</button>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div><br/>
	<div class="container">
		<div class="row">
			<div class="panel-heading">
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
						@for($i = 0; $i < count($properties); $i++)
						<tr>
							<td>{{ $properties[$i]->id }}</td>
							<td>
								{{ $properties[$i]->address_line_1 }}<br>
								{{ $properties[$i]->address_line_2 }}<br>
								{{ $properties[$i]->address_line_3 }}<br>
								{{ $properties[$i]->address_line_4 }}<br>
								{{ $properties[$i]->address_line_5 }}<br>
							</td>
							<td>{{ $properties[$i]->suburb_name }}</td>
							<td>{{ $properties[$i]->area_name }}</td>
							<td>{{ $properties[$i]->greater_area_name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PROPERTY))
								<td><a href="{{ route('update-property', ['property_id' => $properties[$i]->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-property', ['property_id' => $properties[$i]->id]) }}">View</a></td>
						</tr>
						@endfor
					@else
						<tr>
							<td colspan="7">No properties</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_PROPERTY))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-property')) }}
					{{ Form::token() }}
					<button type="submit" class="btn btn-default">Add Property</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
