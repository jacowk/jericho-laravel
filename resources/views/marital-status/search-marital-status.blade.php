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
						{{ Form::text('description', '', array('class' => 'form-control', 'placeholder' => 'Description')) }}
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
				<h4 class="panel-marital-status">Marital Statuses Search Result</h4>
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
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_MARITAL_STATUS))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-marital-status')) }}
					{{ Form::token() }}
					<button type="submit" class="btn btn-default">Add Marital Status</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
