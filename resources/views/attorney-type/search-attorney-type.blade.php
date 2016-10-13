@extends('layouts.master')

@section('title')
	Search Attorney Types
@endsection

@section('content')
	<div class="container">
		<div class="row">
			{{ Form::open(array('route' => 'do-search-attorney-type', 'class' => 'form-horizontal')) }}
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
				<h4 class="panel-attorney-type">Attorney Types Search Result</h4>
			</div>
		</div>
		<div class="row">
			<table class="table table-bordered table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th class="col-sm-1 text-center">ID</th>
						<th class="col-sm-9 text-center">Description</th>
						@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ATTORNEY_TYPE))
							<th class="col-sm-1 text-center">Update</th>
						@endif
						<th class="col-sm-1 text-center">View</th>
					</tr>
				</thead>
				<tbody>
					@if (!empty($attorney_types) && count($attorney_types) > 0)
						@foreach($attorney_types as $attorney_type)
						<tr>
							<td>{{ $attorney_type->id }}</td>
							<td>{{ $attorney_type->description }}</td>
							@if (PermissionValidator::hasPermission(PermissionConstants::UPDATE_ATTORNEY_TYPE))
								<td><a href="{{ route('update-attorney-type', ['attorney_type_id' => $attorney_type->id]) }}">Update</a></td>
							@endif
							<td><a href="{{ route('view-attorney-type', ['attorney_type_id' => $attorney_type->id]) }}">View</a></td>
						</tr>
						@endforeach
					@else
						<tr>
							<td colspan="4">No attorney types</td>
						</tr>
					@endif
				</tbody>
			</table>
		</div>
	</div>
	@if (PermissionValidator::hasPermission(PermissionConstants::ADD_ATTORNEY_TYPE))
		<div class="container">
			<div class="row">
				{{ Form::open(array('route' => 'add-attorney-type')) }}
					{{ Form::token() }}
					<button type="submit" class="btn btn-default">Add Attorney Type</button>
				{{ Form::close() }}
			</div>
		</div>
	@endif
@endsection
