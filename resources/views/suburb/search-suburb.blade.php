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
				<h4 class="panel-title">Suburbs Search Result</h4>
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
						@for($i = 0; $i < count($suburbs); $i++)
						<tr>
							<td>{{ $suburbs[$i]->id }}</td>
							<td>{{ $suburbs[$i]->name }}</td>
							<td>{{ $suburbs[$i]->box_code }}</td>
							<td>{{ $suburbs[$i]->street_code }}</td>
							<td>{{ $suburbs[$i]->area_name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_SUBURB))
								<td><a href="{{ route('update-suburb', ['suburb_id' => $suburbs[$i]->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-suburb', ['suburb_id' => $suburbs[$i]->id]) }}">View</a></td>
						</tr>
						@endfor
					@else
						<tr>
							<td colspan="7">No suburbs</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_SUBURB))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-suburb')) }}
					{{ Form::token() }}
					<button type="submit" class="btn btn-default">Add Suburb</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
