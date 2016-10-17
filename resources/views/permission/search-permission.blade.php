@extends('layouts.master')

@section('title')
	Search Permissions
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-permission', 'class' => 'form-horizontal')) }}
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
				<h4 class="panel-title">Permissions Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Name</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PERMISSION))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($permissions) && count($permissions) > 0)
						@for($i = 0; $i < count($permissions); $i++)
						<tr>
							<td>{{ $permissions[$i]->id }}</td>
							<td>{{ $permissions[$i]->name }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_PERMISSION))
								<td><a href="{{ route('update-permission', ['permission_id' => $permissions[$i]->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-permission', ['permission_id' => $permissions[$i]->id]) }}">View</a></td>
						</tr>
						@endfor
					@else
						<tr>
							<td colspan="4">No permissions</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_PERMISSION))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-permission')) }}
					{{ Form::token() }}
					<button type="submit" class="btn btn-default">Add Permission</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
